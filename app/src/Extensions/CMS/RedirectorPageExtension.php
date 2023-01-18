<?php

namespace App\Extensions\CMS;

use Bramus\Ansi\ControlFunctions\Base;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\CMS\Model\RedirectorPage;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\LiteralField;
use SilverStripe\ORM\DataExtension;

/**
 * @method BaseElement Element()
 */
class RedirectorPageExtension extends DataExtension
{
    private static array $db = [
        'NewWindow' => 'Boolean',
    ];

    private static array $has_one = [
        'Element' => BaseElement::class,
    ];

    public function updateCMSFields(FieldList $fields): void
    {
        $fields->addFieldsToTab(
            'Root.Main',
            [
                FieldGroup::create(
                    'Open in new window',
                    CheckboxField::create('NewWindow', 'Check to open URL in a new window')
                )->setName('OpenInANewWindow'),
            ]
        );

        if ($this->getOwner()->RedirectionType != 'Internal') {
            $fields->addFieldsToTab(
                'Root.Main',
                [
                    LiteralField::create('', <<<HTML
<div class="alert alert-info">
    To link to an element on a page, first save this page to be able to select the element for that page.
</div>
HTML
                    )
                ]
            );
        }

        if (
            $this->getOwner()->LinkToID &&
            $this->getOwner()->LinkTo()?->ElementalArea()?->Elements()?->count()
        ) {
            $elements = $this->getOwner()->LinkTo()->ElementalArea()->Elements();

            $fields->addFieldsToTab(
                'Root.Main',
                [
                    DropdownField::create('ElementID', 'Elements', $elements->map())
                        ->setEmptyString('Element')
                        ->setDescription('If "Page on your website" is changed this page will need to be saved to update the list'),
                ]
            );
        }
    }

    public function updateRedirectionLink(&$link): void
    {
        /** @var RedirectorPage $page */
        $page = $this->getOwner();
        if ($page->RedirectionType === 'Internal' && $page->LinkTo() && $page->Element()) {
            $anchor = "#{$page->Element()->getAnchor()}";
            $link = $page->LinkTo()->Link($anchor);
        }
    }
}
