<?php

namespace App\Model\Elements;

use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;

class ElementTwoColumnCurve extends ElementContent
{
    private static string $table_name = 'ElementTwoColumnCurve';

    private static array $db = [
        'Colour'        => 'Enum(array("Blue", "Yellow"), "Yellow")',
        'LeftContent'   => 'HTMLText',
        'RightContent'  => 'HTMLText',
    ];

    private static array $fields_exclude = [
        'Colour',
    ];

    private static string $singular_name = 'two column curve block';

    private static string $plural_name = 'two column curve blocks';

    private static string $description = 'Two column curve block';

    private static string $icon = 'font-icon-block-layout-8';

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {

                $fields->removeByName(
                    [
                        'HTML'
                    ]
                );

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        HTMLEditorField::create('LeftContent', 'Left content'),
                        HTMLEditorField::create('RightContent', 'Right content')
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
                            'Colour',
                            'Colour',
                            $this->dbObject('Colour')->enumValues()
                        ),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Two column curve';
    }

    protected function provideBlockSchema(): array
    {
        $blockSchema = parent::provideBlockSchema();

        /** @var DBHTMLText $content */
        $content = DBField::create_field('HTMLFragment', $this->LeftContent ?? $this->RightContent);
        $blockSchema['content'] = $content->summary();

        return $blockSchema;
    }
}
