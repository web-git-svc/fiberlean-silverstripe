<?php

namespace App\Model\Elements\Components;

use App\Helpers\HelperTemplateVariables;
use App\Model\Elements\ElementFeatureBoxes;
use App\Model\Elements\ElementFeatures;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\Security\Permission;
use SilverStripe\Versioned\Versioned;
use UncleCheese\DisplayLogic\Forms\Wrapper;

/**
 * @property string|null $LinkType
 * @property string|null $LinkURL
 * @property mixed|null $Icon
 * @method SiteTree LinkedPage()
 * @method File LinkedFile()
 */
class Feature extends DataObject
{
    private static string $table_name = 'ElementFeatures_Feature';

    private static array $db = [
        'Sort'  => 'Int',
        'Title' => 'Varchar',
        'Icon'  => 'Varchar',
    ];

    private static array $has_one = [
        'FeatureBlock' => ElementFeatures::class,
    ];

    private static array $summary_fields = [
        'Title' => 'Title',
    ];

    private static string $default_sort = 'Sort ASC';

    private static string $singular_name = 'Feature';

    private static string $plural_name = 'Features';

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
                        'FeatureBlockID',
                        'Sort',
                    ]
                );

                $icons = Config::inst()->get('Icons', 'icons');

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        TextField::create('Title', 'Title'),
                        DropdownField::create(
                            'Icon',
                            'Icon',
                            $icons,
                        )->setEmptyString('Please select'),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function Icon(): ?DBField
    {
        $icon = $this->Icon;

        if (!$icon) {
            return null;
        }

        return HelperTemplateVariables::svg_icon($icon, 149, 120);
    }
}
