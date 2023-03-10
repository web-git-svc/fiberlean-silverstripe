<?php

namespace App\Model\Elements;

use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\OptionsetField;

class ElementTallIntroBlock extends ElementContent
{
    private static string $table_name = 'ElementTallIntroBlock';

    private static string $singular_name = 'tall intro block';

    private static string $plural_name = 'tall intro blocks';

    private static string $description = 'Tall intro block';

    private static string $icon = 'font-icon-block-promo-3';

    private static array $db = [
        'Colour' => 'Varchar',
    ];

    private static array $has_one = [
        'Image' => Image::class,
    ];

    private static array $owns = [
        'Image',
    ];

    private static array $fields_exclude = [
        'Colour',
    ];

    public function getCMSFields(): FieldList
    {
        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        UploadField::create('Image', 'Image')
                            ->setAllowedFileCategories('image'),
                    ]
                );

                $fields->addFieldsToTab(
                    'Root.Settings',
                    [
                        OptionsetField::create(
                            'Colour',
                            'Colour',
                            Config::inst()->get('Colours', 'colours')
                        ),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Tall intro';
    }
}
