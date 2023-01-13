<?php

namespace App\Extensions\Fluent;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;

class LocaleExtension extends DataExtension
{
    private static array $has_one = [
        'Flag' => Image::class,
    ];

    private static array $owns = [
        'Flag',
    ];

    public function updateCMSFields(FieldList $fields): void
    {
        $fields->addFieldsToTab(
            'Root.Main',
            [
                UploadField::create('Flag', 'Flag')
                    ->setFolderName('flags')
                    ->setAllowedFileCategories('image'),
            ]
        );
    }
}
