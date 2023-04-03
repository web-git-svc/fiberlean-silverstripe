<?php

namespace App\Model\VIPArea\Components;

use App\Model\VIPArea\VIPAreaHolder;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;

/**
 * @method VIPAreaHolder Parent()
 * @property int $SortOrder
 */
class FeatureBox extends DataObject
{
    private static string $singular_name = 'Feature box';

    private static string $plural_name = 'Feature boxes';

    private static string $table_name = 'VIPAreaHolder_FeatureBoxes';

    private static array $db = [
        'Title'     => 'Varchar',
        'Content'   => 'Text',
        'SortOrder' => 'Int',
    ];

    private static array $has_one = [
        'Image'  => Image::class,
        'Parent' => VIPAreaHolder::class,
    ];

    private static array $owns = [
        'Image',
    ];

    private static array $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Title'              => 'Title',
    ];

    private static string $sort = '';

    public function canView($member = null): bool
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

    public function onBeforeWrite()
    {
        if (!$this->SortOrder) {
            $this->SortOrder = $this?->Parent()?->FeatureBoxes()?->count() + 1;
        }

        parent::onBeforeWrite();
    }

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'SortOrder',
                        'ParentID',
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }
}
