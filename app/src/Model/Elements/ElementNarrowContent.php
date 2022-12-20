<?php

namespace App\Model\Elements;

use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\OptionsetField;

class ElementNarrowContent extends ElementContent
{
    private static string $table_name = 'ElementNarrowContent';

    private static string $singular_name = 'narrow content block';

    private static string $plural_name = 'narrow content blocks';

    private static string $description = 'Narrow content block';

    private static array $db = [
        'CircleColour'      => 'Enum(array("None", "Orange", "Blue", "Yellow"), "None")',
        'BackgroundColour'  => 'Varchar(255)'
    ];

    public function getCMSFields(): FieldList
    {
        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $fields->addFieldsToTab(
                    'Root.Settings',
                    [
                        OptionsetField::create(
                            'CircleColour',
                            'Circle colour',
                            $this->dbObject('CircleColour')->enumValues()
                        ),
                        DropdownField::create('BackgroundColour', 'Background colour', [
                            'white' => 'White',
                            'grey'  => 'Grey',
                        ])->setEmptyString('Please select')
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Narrow content';
    }
}

