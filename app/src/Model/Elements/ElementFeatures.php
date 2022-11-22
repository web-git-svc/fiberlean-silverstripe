<?php

namespace App\Model\Elements;

use App\Forms\GridField\GridFieldConfig_OrderableRecordEditor;
use App\Model\Elements\Components\Feature;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\ORM\HasManyList;

/**
 * @method HasManyList Features()
 */
class ElementFeatures extends BaseElement
{
    private static string $table_name = 'ElementFeatures';

    private static array $has_many = [
        'Features' => Feature::class,
    ];

    private static array $owns = [
        'Features',
    ];

    private static array $cascade_deletes = [
        'Features',
    ];

    private static array $cascade_duplicates = [
        'Features',
    ];

    private static string $singular_name = 'features block';

    private static string $plural_name = 'feature blocks';

    private static string $description = 'Features block';

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
                        $this->Features(),
                        GridFieldConfig_OrderableRecordEditor::create()
                    )
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Features';
    }

    public function getSummary(): string
    {
        $plural = $this->Features()->count() === 1 ? '' : 's';
        return "Currently shows {$this->Features()->count()} feature{$plural}";
    }
}
