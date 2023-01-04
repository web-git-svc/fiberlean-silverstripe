<?php

namespace App\Model\Elements;

use App\Forms\GridField\GridFieldConfig_OrderableRecordEditor;
use App\Model\Elements\Components\FeatureBox;
use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\ORM\HasManyList;

/**
 * @method HasManyList FeatureBoxes()
 */
class ElementFeatureBoxes extends ElementContent
{
    private static string $table_name = 'ElementFeatureBoxes';

    private static array $db = [
        'Colour'  => 'Enum(array("Blue", "Yellow"), "Yellow")',
        'Columns' => 'Enum(array("Three", "Four", "Five"), "Four")',
    ];

    private static array $has_many = [
        'FeatureBoxes' => FeatureBox::class,
    ];

    private static array $owns = [
        'FeatureBoxes',
    ];

    private static array $cascade_deletes = [
        'FeatureBoxes',
    ];

    private static array $cascade_duplicates = [
        'FeatureBoxes',
    ];

    private static array $fields_exclude = [
        'Colour',
        'Columns',
    ];

    private static string $singular_name = 'feature boxes block';

    private static string $plural_name = 'feature box blocks';

    private static string $description = 'Feature boxes block';

    private static string $icon = 'font-icon-block-layout-2';

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'FeatureBoxes',
                    ]
                );

                $fields->addFieldToTab(
                    'Root.Main',
                    GridField::create(
                        'FeatureBoxes',
                        'Feature boxes',
                        $this->FeatureBoxes(),
                        GridFieldConfig_OrderableRecordEditor::create()
                    )
                );
            }
        );

        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $fields->addFieldsToTab(
                    'Root.Settings',
                    [
                        OptionsetField::create(
                            'Colour',
                            'Colour',
                            $this->dbObject('Colour')->enumValues()
                        ),
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
        return 'Feature boxes';
    }

    public function getSummary(): string
    {
        $plural = $this->FeatureBoxes()->count() === 1 ? '' : 'es';
        return "Currently shows {$this->FeatureBoxes()->count()} feature box{$plural}";
    }
}
