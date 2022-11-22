<?php

namespace App\Model\Elements;

use App\Forms\GridField\GridFieldConfig_OrderableRecordEditor;
use App\Model\Elements\Components\Feature;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\ORM\HasManyList;

class ElementLatestPosts extends BaseElement
{
    private static string $table_name = 'ElementLatestPosts';

    private static array $db = [
        'ButtonText' => 'Varchar',
        'Background' => 'Enum(array("Blue", "White"), "White")',
    ];

    private static array $has_one = [
        'LinkedPage' => SiteTree::class,
    ];

    private static string $singular_name = 'latest posts block';

    private static string $plural_name = 'latest post blocks';

    private static string $description = 'Latest posts block';

    private static string $icon = 'font-icon-block-layout-2';

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $linkedPages = [];

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        TextField::create('ButtonText', 'Button text'),
                        DropdownField::create('LinkedPageID', 'Linked page', $linkedPages),
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

        $blockSchema['content'] = $this->LinkedPage()->exists() ?
        "Show latest posts from {$this->LinkedPage()->Title}"
        : 'No linked page selected';

        return $blockSchema;
    }
}
