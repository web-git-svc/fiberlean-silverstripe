<?php

namespace App\Extensions\Elemental;

use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;

class ElementContentExtension extends Extension
{
    private static $db = [
        'BackgroundColour' => 'Varchar(255)'
    ];

    public function updateCMSFields(FieldList $fields): void
    {
        if ($this->owner->ClassName !== ElementContent::class) {
            return;
        }

        $fields->insertBefore(
            'Content',
            DropdownField::create('BackgroundColour', 'Background colour', [
                'white' => 'White',
                'grey'  => 'Grey',
            ])->setEmptyString('Please select')
        );
    }
}
