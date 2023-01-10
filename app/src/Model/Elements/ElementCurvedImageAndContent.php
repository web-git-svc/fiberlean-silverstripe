<?php

namespace App\Model\Elements;

use App\Extensions\Elemental\BeforeAfterContentExtension;
use App\Helpers\LinkSetTrait;
use Bummzack\SortableFile\Forms\SortableUploadField;
use DNADesign\Elemental\Models\BaseElement;
use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\Assets\Image;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\ORM\ManyManyList;
use UncleCheese\DisplayLogic\Forms\Wrapper;

/**
 * @method Image Image()
 */
class ElementCurvedImageAndContent extends ElementContent
{
    use LinkSetTrait;

    private static string $table_name = 'ElementCurvedImageAndContent';

    private static array $db = [
        'LinkText'   => 'Varchar',
        'LinkType'   => 'Varchar',
        'LinkURL'    => 'Text',
        'LinkTarget' => 'Varchar',
        'Style'      => 'Enum(array("Left", "Right"), "Left")',
    ];

    private static array $has_one = [
        'Image'      => Image::class,
        'LinkedPage' => SiteTree::class,
        'LinkedFile' => File::class,
    ];

    private static array $owns = [
        'Image',
        'LinkedFile',
    ];

    private static array $defaults = [
        'LinkType' => 'None',
    ];

    private static string $singular_name = 'curved image and content block';

    private static string $plural_name = 'curved image and content blocks';

    private static string $description = 'Curved image and content block';

    private static string $icon = 'font-icon-block-image';

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'LinkTarget',
                        'LinkText',
                        'LinkType',
                        'LinkURL',
                        'LinkedFile',
                        'LinkedPageID',
                    ]
                );


                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        UploadField::create('Image', 'Image')
                            ->setAllowedFileCategories('image'),
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
                            TextField::create('LinkText', 'Link text')
                        )->displayIf('LinkType')
                            ->isNotEqualTo('None')
                            ->end(),
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
            }
        );

        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $fields->addFieldsToTab(
                    'Root.Settings',
                    [
                        OptionsetField::create(
                            'Style',
                            'Style',
                            $this->dbObject('Style')->enumValues()
                        ),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Curved image and content';
    }

    protected function provideBlockSchema(): array
    {
        $blockSchema = parent::provideBlockSchema();

        if ($this->Image()->exists() && $this->Image()->getIsImage()) {
            $blockSchema['fileURL'] = $this->Image()->CMSThumbnail()->getURL();
            $blockSchema['fileTitle'] = $this->Image()->getTitle();
        }

        return $blockSchema;
    }
}
