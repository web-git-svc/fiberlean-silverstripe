<?php

namespace App\Extensions\MenuManager;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddExistingAutocompleter;

class MenuSetExtension extends Extension
{
    /**
     * @param FieldList $fields
     */
    public function updateCMSFields(FieldList $fields)
    {
        /** @var GridField $grid */
        $grid = $fields->dataFieldByName('MenuItems');
        $grid->getConfig()->removeComponentsByType(GridFieldAddExistingAutocompleter::class);
    }
}
