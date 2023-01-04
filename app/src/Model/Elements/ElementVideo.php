<?php

namespace App\Model\Elements;

use App\Extensions\Elemental\BeforeAfterContentExtension;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\View\Parsers\ShortcodeParser;

class ElementVideo extends BaseElement
{
    private static string $table_name = 'ElementVideo';

    private static array $db = [
        'VideoURL'    => 'Text',
    ];

    private static array $casting = [
        'EmbedVideo' => 'HTMLFragment'
    ];

    private static string $singular_name = 'video block';

    private static string $plural_name = 'video blocks';

    private static string $description = 'Video block';

    private static string $icon = 'font-icon-block-media';

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        TextField::create('VideoURL', 'Video URL')
                            ->setDescription('Please paste the link to the page the video is hosted on, not the embed code')
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Video';
    }

    public function getEmbedVideo(): ?string
    {
        if (!$this->VideoURL) return null;

        $parser = ShortcodeParser::get();
        $content = "[embed url={$this->VideoURL}][/embed]";
        return $parser->parse($content);
    }
}
