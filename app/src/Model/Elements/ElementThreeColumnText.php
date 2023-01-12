<?php

namespace App\Model\Elements;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\TextField;

class ElementThreeColumnText extends BaseElement
{
    private static string $table_name = 'ElementThreeColumnText';

    private static string $singular_name = 'three column text block';

    private static string $plural_name = 'three column text blocks';

    private static string $description = 'Three column text block';

    private static string $icon = 'font-icon-block-layout-10';

    private static array $db = [
        'Colour'                    => 'Varchar',
        'LeftColumnTitle'           => 'Varchar',
        'LeftColumnContent'         => 'HTMLText',
        'MiddleColumnTitle'         => 'Varchar',
        'MiddleColumnContent'       => 'HTMLText',
        'RightColumnTitle'          => 'Varchar',
        'RightColumnContent'        => 'HTMLText',
    ];

    private static array $fields_exclude = [
        'Colour',
    ];

    public function getCMSFields(): FieldList
    {
        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'LeftColumnHeader',
                        'LeftColumnTitle',
                        'LeftColumnContent',
                        'MiddleColumnHeader',
                        'MiddleColumnTitle',
                        'MiddleColumnContent',
                        'RightColumnHeader',
                        'RightColumnTitle',
                        'RightColumnContent',
                    ]
                );

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        HeaderField::create('LeftColumnHeader', 'Left column'),
                        TextField::create('LeftColumnTitle', 'Title'),
                        HTMLEditorField::create('LeftColumnContent', 'Content')
                            ->setRows(8),

                        HeaderField::create('MiddleColumnHeader', 'Middle column'),
                        TextField::create('MiddleColumnTitle', 'Title'),
                        HTMLEditorField::create('MiddleColumnContent', 'Content')
                            ->setRows(8),

                        HeaderField::create('RightColumnHeader', 'Right column'),
                        TextField::create('RightColumnTitle', 'Title'),
                        HTMLEditorField::create('RightColumnContent', 'Content')
                            ->setRows(8),
                    ]
                );

                $fields->addFieldsToTab(
                    'Root.Settings',
                    [
                        OptionsetField::create(
                            'Colour',
                            'Colour',
                            Config::inst()->get('Colours', 'colours')
                        )->setEmptyString('None'),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Three column text';
    }
}
