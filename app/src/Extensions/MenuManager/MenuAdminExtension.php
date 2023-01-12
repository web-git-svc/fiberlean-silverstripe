<?php


namespace App\Extensions\MenuManager;

use Heyday\MenuManager\MenuSet;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\GridField\GridFieldAddNewButton;
use SilverStripe\Forms\GridField\GridFieldDeleteAction;
use SilverStripe\Forms\GridField\GridFieldDetailForm;

class MenuAdminExtension extends Extension
{
    /**
     * @param Form $form
     */
    public function updateEditForm(Form $form)
    {
        /** @var GridField $grid */
        $grid = $form->Fields()->dataFieldByName(str_replace('\\', '-', MenuSet::class));

        if (!$grid) {
            return;
        }

        // Menu sets are hard-coded in YAML, so remove the ability to add/delete them
        $grid->getConfig()->removeComponentsByType(GridFieldDeleteAction::class)
            ->removeComponentsByType(GridFieldAddNewButton::class);

        /** @var GridFieldDetailForm $detailForm */
        $detailForm = $grid->getConfig()->getComponentByType(GridFieldDetailForm::class);
        $detailForm->setItemEditFormCallback(function (Form $form) {
            // Remove all actions - there are none that can be performed on a menu set
            $form->setActions(FieldList::create());
        });
    }
}
