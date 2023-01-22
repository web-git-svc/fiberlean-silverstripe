<?php

namespace App\Model\Elements\Components;

use App\Helpers\HelperTemplateVariables;
use App\Model\Elements\ElementContentWithFeatures;
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
class FeatureNoIcon extends Feature
{
    private static string $table_name = 'ElementFeatures_FeatureNoIcon';

    private static array $has_one = [
        'ElementContentWithFeatures' => ElementContentWithFeatures::class,
    ];

    public function getCMSFields(): FieldList
    {
        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'ElementContentWithFeaturesID',
                        'Icon',
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }
}
