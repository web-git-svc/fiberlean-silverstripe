<?php

namespace App\Model\Elements;

use App\Forms\GridField\GridFieldConfig_OrderableRecordEditor;
use App\Model\Elements\Components\CardFeatureBox;
use App\Model\Elements\Components\FeatureBox;
use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\ORM\HasManyList;

/**
 * @method HasManyList FeatureBoxes()
 */
class ElementCardFeatureBoxes extends ElementContent
{
    private static string $table_name = 'ElementCardFeatureBoxes';

    private static array $has_many = [
        'FeatureBoxes' => CardFeatureBox::class,
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

    private static string $singular_name = 'card feature boxes block';

    private static string $plural_name = 'card feature box blocks';

    private static string $description = 'Card feature boxes block';

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

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Card feature boxes';
    }

    public function getSummary(): string
    {
        $plural = $this->FeatureBoxes()->count() === 1 ? '' : 'es';
        return "Currently shows {$this->FeatureBoxes()->count()} feature box{$plural}";
    }
}
