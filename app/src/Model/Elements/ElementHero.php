<?php

namespace App\Model\Elements;

use App\Forms\GridField\GridFieldConfig_OrderableRecordEditor;
use App\Model\Elements\Components\HeroSlide;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\TextField;

/**
 * @method Image()
 */
class ElementHero extends BaseElement
{
    private static string $table_name = 'ElementHero';

    private static array $db = [
        'Title' => 'Text',
    ];

    private static array $has_many = [
        'HeroSlides' => HeroSlide::class,
    ];

    private static array $owns = [
        'HeroSlides',
    ];

    private static array $fields_include = [
        'Title',
    ];

    private static array $translate = [
        'Title',
    ];

    private static string $singular_name = 'hero block';

    private static string $plural_name = 'hero blocks';

    private static string $description = 'Hero block';

    private static string $icon = 'font-icon-block-image';

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(function (FieldList $fields) {
            $fields->removeByName(['HeroSlides']);

            $fields->addFieldToTab(
                'Root.Main',
                GridField::create(
                    'HeroSlides',
                    'Hero slides',
                    $this->HeroSlides(),
                    GridFieldConfig_OrderableRecordEditor::create()
                )
            );
        });

        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'TitleAndHeadingLevel',
                    ]
                );

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        TextField::create('Title', 'Title')
                            ->performReadonlyTransformation(),
                    ],
                    'HeroSlides'
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getTitle(): string
    {
        return 'Hero';
    }

    public function getType(): string
    {
        return 'Hero';
    }

    protected function provideBlockSchema(): array
    {
        $blockSchema = parent::provideBlockSchema();

        $plural = $this->HeroSlides()->count() === 1 ? '' : 's';
        $blockSchema['content'] = "Currently shows {$this->HeroSlides()->count()} slide{$plural}";

        return $blockSchema;
    }
}
