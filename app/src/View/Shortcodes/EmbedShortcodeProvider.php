<?php

namespace App\View\Shortcodes;

use Exception;
use Psr\Log\LoggerInterface;
use Psr\SimpleCache\CacheInterface;
use SilverStripe\Core\Convert;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\View\HTML;
use SilverStripe\View\Parsers\ShortcodeHandler;
use SilverStripe\View\Shortcodes\EmbedShortcodeProvider as SilverStripeEmbedShortcodeProvider;

/**
 * Overrides the built-in embed shortcode provider so we can adjust
 * the HTML to create responsive video embeds
 */
class EmbedShortcodeProvider extends SilverStripeEmbedShortcodeProvider implements ShortcodeHandler
{
    public static function handle_shortcode($arguments, $content, $parser, $shortcode, $extra = [])
    {
        $cache = Injector::inst()->get(CacheInterface::class . '.Embed');
        $key = md5(preg_replace('/[^a-zA-Z0-9]/', '', implode('-_-', $arguments)));

        if (!$cache->has($key)) {
            try {
                $result = parent::handle_shortcode($arguments, $content, $parser, $shortcode, $extra);
                $cache->set($key, $result);
            } catch (Exception $e) {
                $logger = Injector::inst()->get(LoggerInterface::class . '.Embed');
                $logger->error($e->getMessage(), ['exception' => $e]);
                return '';
            }
        }

        return $cache->get($key);
    }

    public static function embedForTemplate($embed, $arguments): ?string
    {
        switch ($embed->getType()) {
            case 'video':
            case 'rich':
                // Attempt to inherit width (but leave height auto)
                if (empty($arguments['width']) && $embed->getWidth()) {
                    $arguments['width'] = $embed->getWidth();
                }
                return static::videoEmbed($arguments, $embed->getCode());
            case 'link':
                return static::linkEmbed($arguments, $embed->getUrl(), $embed->getTitle());
            case 'photo':
                return static::photoEmbed($arguments, $embed->getUrl());
            default:
                return null;
        }
    }

    protected static function videoEmbed($arguments, $content): string
    {
        // Convert caption to <p>
        if (!empty($arguments['caption'])) {
            $xmlCaption = Convert::raw2xml($arguments['caption']);
            $content .= "\n<p class=\"caption\">{$xmlCaption}</p>";
        }

        $html = HTML::createTag('div', ['class' => 'responsive-video'], $content);

        if (!empty($arguments['width'])) {
            $arguments['style'] = 'width: ' . intval($arguments['width']) . 'px;';
        }
        unset($arguments['width'], $arguments['height'], $arguments['url'], $arguments['caption']);
        return HTML::createTag('div', $arguments, $html);
    }
}
