<?php

namespace App\Model\Elements;

use App\Forms\GridField\GridFieldConfig_OrderableRecordEditor;
use App\Model\Elements\Components\Feature;
use App\Model\Elements\Components\Slide;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\ORM\HasManyList;

/**
 * @method HasManyList Slides()
 */
class ElementSlideshow extends BaseElement
{
    private static string $table_name = 'ElementSlideshow';

    private static array $db = [
    ];

    private static array $has_many = [
        'Slides' => Slide::class,
    ];

    private static array $owns = [
        'Slides',
    ];

    private static array $cascade_deletes = [
        'Slides',
    ];

    private static array $cascade_duplicates = [
        'Slides',
    ];

    private static string $singular_name = 'slides block';

    private static string $plural_name = 'slides blocks';

    private static string $description = 'Slides block';

    private static string $icon = 'font-icon-block-story-carousel';

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'Slides',
                    ]
                );

                $fields->addFieldToTab(
                    'Root.Main',
                    GridField::create(
                        'Slides',
                        'Slides',
                        $this->Slides(),
                        GridFieldConfig_OrderableRecordEditor::create()
                    )
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Slideshow';
    }

    public function getSummary(): string
    {
        $plural = $this->Slides()->count() === 1 ? '' : 's';
        return "Currently shows {$this->Slides()->count()} slide{$plural}";
    }
}
