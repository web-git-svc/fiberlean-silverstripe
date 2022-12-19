<?php

namespace App\Model\Elements\Components;
use App\Model\Elements\ElementSlideshow;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Versioned\Versioned;

class Slide extends DataObject
{
    private static string $table_name = 'ElementSlides_Slide';

    private static array $db = [
        'Sort'  => 'Int',
        'Title' => 'Varchar',
    ];

    private static array $has_one = [
        'SlideshowBlock'    => ElementSlideshow::class,
        'Image'             => Image::class,
        'File'              => File::class,
    ];

    private static array $summary_fields = [
        'Title' => 'Title',
    ];

    private static string $default_sort = 'Sort ASC';

    private static string $singular_name = 'Slide';

    private static string $plural_name = 'Slides';

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
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'SlideshowBlockID',
                        'Sort',
                    ]
                );

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        TextField::create('Title', 'Title'),
                        UploadField::create('Image', 'Image'),
                        UploadField::create('File', 'File'),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getFileTypeNice(): string
    {
        $type = $this->File()->getFileType();

        if (!$type) {
            return '';
        } else if ($type == 'Adobe Acrobat PDF file') {
            return 'PDF';
        } else {
            return $type;
        }
    }
}
