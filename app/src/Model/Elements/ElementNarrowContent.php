<?php

namespace App\Model\Elements;

use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\OptionsetField;
use UncleCheese\DisplayLogic\Forms\Wrapper;

class ElementNarrowContent extends ElementContent
{
    private static string $table_name = 'ElementNarrowContent';

    private static string $singular_name = 'narrow content block';

    private static string $plural_name = 'narrow content blocks';

    private static string $description = 'Narrow content block';

    private static array $db = [
        'CircleColour'      => 'Enum(array("None", "Orange", "Blue", "Yellow"), "None")',
        'BackgroundColour'  => 'Varchar(255)',
        'ShowBall'          => 'Boolean',
        'BallColour'        => 'Enum(array("None", "Orange", "Blue", "Yellow", "Pink", "Red"), "None")',
    ];

    private static array $fields_exclude = [
        'CircleColour',
        'BackgroundColour',
        'ShowBall',
        'BallColour',
    ];

    public function getCMSFields(): FieldList
    {
        $this->afterUpdateCMSFields(
            function (FieldList $fields) {

                $fields->removeByName([
                    'ShowBall',
                    'BallColour',
                ]);

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
                        ])->setEmptyString('Please select'),
                        FieldGroup::create('Ball',
                            CheckboxField::create('ShowBall', 'Show ball?'),
                        ),
                        $ballColour = Wrapper::create(OptionsetField::create(
                            'BallColour',
                            'Ball colour',
                            $this->dbObject('BallColour')->enumValues()
                        )),
                    ]
                );

                $ballColour->displayIf('ShowBall')->isChecked();
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Narrow content';
    }
}

