<?php

namespace App\Extensions\Elemental;

use AdrHumphreys\TextDropdownField\TextDropdownField;
use App\Control\PageController;
use SilverStripe\Control\Controller;
use SilverStripe\Core\Convert;
use SilverStripe\Forms\CompositeValidator;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Tab;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\ValidationResult;
use SilverStripe\View\HTML;

class BaseElementExtension extends DataExtension
{
    private static array $db = [
        'HeadingLevel' => 'Enum(array("h1", "h2", "h3", "hidden"), "h2")',
    ];

    private static array $casting = [
        'TitleTag' => 'HTMLFragment'
    ];

    private array $HeadingLevels = [
        'h1'     => 'Heading 1',
        'h2'     => 'Heading 2',
        'h3'     => 'Heading 3',
        'hidden' => 'Hide title',
    ];

    public static $breadcrumbs_rendered = false;

    public function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName(
            [
                'ExtraClass',
                'HeadingLevel',
                'Title',
                'Settings',
                'BackgroundColour',
            ]
        );

        $titleField = TextDropdownField::create('TitleAndHeadingLevel', 'Title', 'Title', 'HeadingLevel', $this->HeadingLevels)
            ->setName('TitleAndHeadingLevel');

//        // The title field in elemental is a fancy composite field containing a text box and a checkbox,
//        // so we have to manually add the fluent "field is translatable" badge
//        if (class_exists(Locale::class) && !$titleField->hasClass('fluent__localised-field')) {
//            $translatedTooltipTitle = _t(FluentExtension::class . ".FLUENT_ICON_TOOLTIP", 'Translatable field');
//            $tooltip = DBField::create_field(
//                'HTMLFragment',
//                "<span class='font-icon-translatable' title='$translatedTooltipTitle'></span>"
//            );
//
//            $titleField->addExtraClass('fluent__localised-field');
//            $titleField->setTitle(DBField::create_field('HTMLFragment', $tooltip . $titleField->Title()));
//        }

        /** @var Tab $tab */
        $tab = $fields->fieldByName('Root.Main');
        $tab->getChildren()->unshift($titleField);

        // Move history tab last
        if ($historyTab = $fields->fieldByName('Root.History')) {
            $fields->removeByName($historyTab->getName());
            $fields->fieldByName('Root')->push($historyTab);
        }
    }

    public function TitleTag(string $extraClass = ''): string
    {
        if ($this->owner->HeadingLevel === 'hidden' || !$this->owner->Title) {
            return '';
        }

        return HTML::createTag(
            $this->owner->HeadingLevel,
            ['class' => $extraClass],
            Convert::raw2xml($this->owner->Title)
        );
    }

    public function getPageController(): ?Controller
    {
        $controller = Controller::curr();

        return $controller instanceof PageController ? $controller : null;
    }

    public function BreadcrumbsRendered(): bool
    {
        if (!self::$breadcrumbs_rendered) {
            self::$breadcrumbs_rendered = true;

            return false;
        }

        return true;
    }
}
