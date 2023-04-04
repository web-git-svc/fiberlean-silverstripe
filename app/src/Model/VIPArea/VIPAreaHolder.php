<?php

namespace App\Model\VIPArea;

use App\Forms\GridField\GridFieldConfig_OrderableRecordEditor;
use App\Model\Page;
use App\Model\VIPArea\Components\FeatureBox;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\HasManyList;
use SilverStripe\View\TemplateGlobalProvider;

/**
 * @method HasManyList FeatureBoxes()
 */
class VIPAreaHolder extends Page implements TemplateGlobalProvider
{
    private static string $table_name = 'VIPAreaHolder';

    private static array $db = [
        'FeatureBoxesTitle'   => 'Varchar',
        'FeatureBoxesContent' => 'Text',
    ];

    private static array $has_one = [
        'LoginImage' => Image::class,
    ];

    private static array $has_many = [
        'FeatureBoxes' => FeatureBox::class
    ];

    private static array $owns = [
        'LoginImage',
    ];

    /**
     * This logic is used in a few places.
     * To keep code DRY this function calls the callback function param if the condition is true.
     */
    public static function inVIPArea($callback): void
    {
        $controller = Controller::has_curr() ? Controller::curr() : null;
        $request = $controller?->getRequest();
        $currentPage = SiteTree::get_by_link($request?->getVar('BackURL'));

        if ($currentPage) {
            $pagesToCompare = in_array(VIPAreaHolder::class, $currentPage->getAncestors()->column('ClassName'));
            $inVIPArea = $currentPage instanceof VIPAreaHolder || $pagesToCompare;

            if ($controller && $inVIPArea) {
                $callback();
            }
        }
    }

    public static function get_current_vip_area(): ?VIPAreaHolder
    {
        $controller = Controller::has_curr() ? Controller::curr() : null;
        $request = $controller?->getRequest();
        $currentPage = SiteTree::get_by_link($request?->getVar('BackURL'));
        $ancestors = $currentPage->getAncestors();

        if ($currentPage instanceof VIPAreaHolder) {
            return $currentPage;
        }

        foreach ($ancestors as $ancestor) {
            if ($ancestor instanceof VIPAreaHolder) {
                return $ancestor;
            }
        }

        return null;
    }

    public static function get_template_global_variables(): array
    {
        return [
            'CurrentVIPArea' => 'get_current_vip_area',
        ];
    }

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $fields->addFieldsToTab(
                    'Root.LoginPage',
                    [
                        UploadField::create('LoginImage', 'Login image')
                            ->setAllowedFileCategories('image/supported')
                            ->setFolderName('uploads'),
                        TextField::create('FeatureBoxesTitle', 'Feature boxes title'),
                        TextareaField::create('FeatureBoxesContent', 'Feature boxes content'),
                        GridField::create(
                            'FeatureBoxes',
                            'Feature boxes',
                            $this->FeatureBoxes(),
                            GridFieldConfig_OrderableRecordEditor::create('SortOrder')
                        ),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }
}
