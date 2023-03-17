<?php

namespace App\Model\Elements\Components;

use App\Helpers\LinkSetTrait;
use App\Model\Elements\ElementHero;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Versioned\Versioned;
use UncleCheese\DisplayLogic\Forms\Wrapper;

/**
 * @property string|null $LinkType
 * @property string|null $LinkURL
 * @method SiteTree LinkedPage()
 * @method File LinkedFile()
 */
class HeroSlide extends DataObject
{
    use LinkSetTrait;

    private static string $table_name = 'ElementHero_HeroSlide';

    private static array $db = [
        'Sort'       => 'Int',
        'Title'      => 'Text',
        'BallColour' => 'Varchar',
        'LinkType'   => 'Varchar',
        'LinkURL'    => 'Text',
        'LinkTarget' => 'Varchar',
    ];

    private static array $has_one = [
        'HeroBlock' => ElementHero::class,
        'Image'     => Image::class,
        'LinkedPage'      => SiteTree::class,
        'LinkedFile'      => File::class,
    ];

    private static array $owns = [
        'Image',
        'LinkedFile',
    ];

    private static array $summary_fields = [
        'Image.CMSThumbnail' => 'Image',
        'Title'              => 'Title',
        'LinkType'           => 'Link type',
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
            $fields->removeByName([
                'LinkedFile',
                'LinkedPageID',
                'LinkTarget',
                'LinkType',
                'LinkURL',
                'Sort',
                'HeroBlockID'
            ]);

            $fields->dataFieldByName('Title')->setRows(2);
            $fields->dataFieldByName('Image')->setFolderName('hero-image');

            $fields->replaceField(
                'BallColour',
                DropdownField::create('BallColour', '“Ball” colour', [
                    'none' => 'None (hidden)',
                    'pink-alt' => 'Pink',
                    'yellow' => 'Yellow',
                    'orange' => 'Orange',
                    'blue-alt' => 'Blue',
                    'red-alt' => 'Red',
                    'green' => 'Green'
                ])
            );

            $fields->addFieldsToTab(
                'Root.Main',
                [
                    OptionsetField::create(
                        'LinkType',
                        'Link type',
                        [
                            'None' => 'No link',
                            'Page' => 'Link to a page on this site',
                            'File' => 'Link to a file on this site',
                            'URL'  => 'Link to another website'
                        ]
                    ),
                    Wrapper::create(
                        TreeDropdownField::create('LinkedPageID', 'Linked page', SiteTree::class)
                            ->setTitleField('MenuTitle')
                    )->displayIf('LinkType')
                        ->isEqualTo('Page')
                        ->end(),
                    Wrapper::create(
                        UploadField::create('LinkedFile', 'Linked file')
                            ->setFolderName('Files')
                    )->displayIf('LinkType')
                        ->isEqualTo('File')
                        ->end(),
                    Wrapper::create(
                        TextField::create('LinkURL', 'Linked page')
                            ->setDescription('Please include the "https://" prefix')
                    )->displayIf('LinkType')
                        ->isEqualTo('URL')
                        ->end(),
                    Wrapper::create(
                        DropdownField::create('LinkTarget', 'Link target', [
                            '_blank' => 'Open in a new window'
                        ])->setEmptyString('Open in the same window')
                    )->displayIf('LinkType')
                        ->isNotEqualTo('None')
                        ->end(),
                ]
            );
        });

        return parent::getCMSFields();
    }

    public function getBallColour(): string
    {
        return $this->getField('BallColour') ?: 'pink-alt';
    }
}
