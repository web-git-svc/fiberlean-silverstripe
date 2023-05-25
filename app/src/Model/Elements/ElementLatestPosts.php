<?php

namespace App\Model\Elements;

use App\Forms\GridField\GridFieldConfig_OrderableRecordEditor;
use App\Model\Elements\Components\Feature;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Blog\Model\BlogCategory;
use SilverStripe\Blog\Model\BlogPost;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\DataList;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\ORM\HasManyList;
use UncleCheese\DisplayLogic\Forms\Wrapper;

class ElementLatestPosts extends BaseElement
{
    private static string $table_name = 'ElementLatestPosts';

    private static array $db = [
        'BlockFormat' => 'Enum(array("Grid", "Compact"), "Grid")',
        'ButtonText' => 'Varchar',
        'Background' => 'Enum(array("Blue", "White"), "White")',
    ];

    private static array $has_one = [
        'LinkedCategory'    => BlogCategory::class,
        'LinkedPage'        => SiteTree::class,
    ];

    private static string $singular_name = 'latest posts block';

    private static string $plural_name = 'latest post blocks';

    private static string $description = 'Latest posts block';

    private static string $icon = 'font-icon-block-layout-2';

    private static array $fields_exclude = [
        'Background',
    ];

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {

                $fields->removeByName(
                    [
                        'BlockFormat',
                        'ButtonText',
                        'LinkedCategoryID',
                        'LinkedPageID',
                    ]
                );

                $linkedCategories = BlogCategory::get();

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        DropdownField::create('BlockFormat', 'Block format', $this->dbObject('BlockFormat')->enumValues()),
                        Wrapper::create(
                            TextField::create('ButtonText', 'Button text')
                        )->displayIf('BlockFormat')->isEqualTo('Grid')->end(),
                        DropdownField::create('LinkedCategoryID', 'Linked category', $linkedCategories)->setEmptyString('Please select'),
                        Wrapper::create(
                            TreeDropdownField::create('LinkedPageID', 'Linked page', SiteTree::class)->setDescription('This will only be used if no category is selected')
                        )->displayIf('BlockFormat')->isEqualTo('Grid')->end(),
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
                            'Background',
                            'Background',
                            $this->dbObject('Background')->enumValues()
                        ),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Latest posts';
    }

    protected function provideBlockSchema(): array
    {
        $blockSchema = parent::provideBlockSchema();

        $blockSchema['content'] = $this->LinkedCategory()->exists() ?
        "Show latest posts from {$this->LinkedCategory()->Title}"
        : 'No linked page selected';

        return $blockSchema;
    }

    public function getLatestPosts(int $limit = 3): DataList
    {
        $blogposts = BlogPost::get();
        return $blogposts->limit($limit);
    }
}
