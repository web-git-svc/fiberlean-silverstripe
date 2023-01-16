<?php

namespace App\Model\Elements;

use App\Forms\GridField\GridFieldConfig_OrderableRecordEditor;
use App\Model\Elements\Components\FeatureNoIcon;
use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\ORM\HasManyList;

/**
 * @method HasManyList Features()
 */
class ElementContentWithFeatures extends ElementContent
{
    private static string $table_name = 'ElementContentWithFeatures';

    private static array $db = [
        'Colour'  => 'Varchar',
        'Columns' => 'Enum(array("Three", "Four", "Five"), "Four")',
    ];

    private static array $has_one = [
        'Image' => Image::class,
    ];

    private static array $has_many = [
        'Features' => FeatureNoIcon::class,
    ];

    private static array $owns = [
        'Features',
        'Image',

    ];

    private static array $cascade_deletes = [
        'Features',
    ];

    private static array $cascade_duplicates = [
        'Features',
    ];

    private static array $fields_exclude = [
        'Colour',
        'Columns',
    ];

    private static string $singular_name = 'content with features block';

    private static string $plural_name = 'content with feature blocks';

    private static string $description = 'Content with features block';

    private static string $icon = 'font-icon-block-layout-2';

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'Features',
                        'image'
                    ]
                );

                $fields->insertBefore(
                    'Content',
                    UploadField::create('Image', 'Image')
                        ->setAllowedFileCategories('image')
                );

                $fields->addFieldToTab(
                    'Root.Main',
                    GridField::create(
                        'Features',
                        'Features',
                        $this->Features(),
                        GridFieldConfig_OrderableRecordEditor::create()
                    )
                );
            }
        );

        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $options = Config::inst()->get('Colours', 'colours');

                $fields->addFieldsToTab(
                    'Root.Settings',
                    [
                        OptionsetField::create(
                            'Colour',
                            'Colour',
                            $options,
                        )->setEmptyString('None'),
                        OptionsetField::create(
                            'Columns',
                            'Columns',
                            $this->dbObject('Columns')->enumValues()
                        ),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Content with features';
    }

    public function getSummary(): string
    {
        $plural = $this->Features()->count() === 1 ? '' : 's';
        return "Currently shows {$this->Features()->count()} feature{$plural}";
    }
}
