<?php

namespace App\Model\Elements\Components;

use App\Forms\GridField\GridFieldConfig_OrderableRecordEditor;
use App\Model\Elements\ElementHero;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Versioned\Versioned;

class HeroSlide extends DataObject
{
    private static string $table_name = 'ElementHero_HeroSlide';

    private static array $db = [
        'Sort'       => 'Int',
        'Title'      => 'Text',
        'BallColour' => 'Varchar'
    ];

    private static array $has_one = [
        'HeroBlock' => ElementHero::class,
        'Image'     => Image::class,
    ];

    private static array $owns = [
        'Image'
    ];

    private static array $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Title'              => 'Title',
    ];

    private static string $default_sort = 'Sort ASC';

    private static array $extensions = [
        Versioned::class,
    ];

    public function canView($member = null): bool|int
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canEdit($member = null): bool|int
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canDelete($member = null): bool|int
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canCreate($member = null, $context = []): bool|int
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName(['Sort', 'HeroBlockID']);

            $fields->dataFieldByName('Title')->setRows(2);
            $fields->dataFieldByName('Image')->setFolderName('hero-image');

            $fields->replaceField(
                'BallColour',
                DropdownField::create('BallColour', '“Ball” colour', [
                    'pink-alt' => 'Pink',
                    'yellow' => 'Yellow',
                    'orange' => 'Orange',
                    'blue-alt' => 'Blue',
                    'red-alt' => 'Red',
                    'green' => 'Green'
                ])
            );
        });

        return parent::getCMSFields();
    }

    public function getBallColour(): string
    {
        return $this->getField('BallColour') ?: 'pink-alt';
    }
}
