<?php

use App\View\Shortcodes\EmbedShortcodeProvider;
use SilverStripe\Forms\HTMLEditor\TinyMCEConfig;
use SilverStripe\i18n\i18n;
use SilverStripe\View\Parsers\ShortcodeParser;

// Set the site locale
//i18n::set_locale('en_GB');

// TinyMCE Config
$config = TinyMCEConfig::get('cms');
$config->disablePlugins(['importcss', 'contextmenu']);
$config->enablePlugins(['anchor', 'hr']);
$config->setButtonsForLine(1, 'formatselect styleselect | bullist numlist | bold italic subscript superscript |
    sslink unlink anchor ssmedia ssembed hr');
$config->setButtonsForLine(2, 'table | pastetext undo redo | code | alignleft aligncenter alignright alignjustify');
$config->setOptions([
    'block_formats' => 'Paragraph=p;Heading 2=h2;Heading 3=h3',
    'table_advtab' => false,
    'table_appearance_options' => false,
    'table_cell_advtab' => false,
    'table_default_styles' => [
        'width' => '100%'
    ],
    'table_row_advtab' => false,
    'style_formats' => [
        [
            'title' => 'Small',
            'selector' => 'p',
            'classes' => 'typography--small'
        ],
        [
            'title' => 'Large',
            'selector' => 'p, h2',
            'classes' => 'typography--large'
        ],
        [
            'title' => 'Large (h1)',
            'selector' => '*',
            'classes' => 'h1'
        ],
        [
            'title' => 'Button white',
            'selector' => 'a',
            'classes' => 'button',
        ],
        [
            'title' => 'Button green',
            'selector' => 'a',
            'classes' => 'button button--green',
        ],
        [
            'title' => 'Button blue dark',
            'selector' => 'a',
            'classes' => 'button button--blue-dark',
        ],
        [
            'title' => 'Button orange',
            'selector' => 'a',
            'classes' => 'button button--orange',
        ],
    ]
]);

ShortcodeParser::get('default')
    ->register('embed', [EmbedShortcodeProvider::class, 'handle_shortcode']);
