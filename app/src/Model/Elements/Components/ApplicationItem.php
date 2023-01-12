<?php

namespace App\Model\Elements\Components;

use SilverStripe\Assets\File;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\DataObject;
use SilverStripe\Security\Permission;
use SilverStripe\Versioned\Versioned;

/**
 * @property string|null $LinkType
 * @property string|null $LinkURL
 * @property mixed|null $Icon
 * @method SiteTree LinkedPage()
 * @method File LinkedFile()
 */
class ApplicationItem extends DataObject
{
    private static string $table_name = 'Application_ApplicationItem';

    private static array $db = [
        'Sort'  => 'Int',
        'Title' => 'Varchar',
    ];

    private static array $has_one = [
        'Application' => Application::class,
    ];

    private static array $summary_fields = [
        'Title' => 'Title',
    ];

    private static string $default_sort = 'Sort ASC';

    private static string $singular_name = 'Application item';

    private static string $plural_name = 'Application items';

    private static array $extensions = [
        Versioned::class,
    ];

    public function canView($member = null): bool|int
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canEdit($member = null): bool|int
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canDelete($member = null): bool|int
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function canCreate($member = null, $context = []): bool|int
    {
        return Permission::check('CMS_ACCESS_CMSMain', 'any', $member);
    }

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'ApplicationID',
                        'Sort',
                    ]
                );

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        TextField::create('Title', 'Title'),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }
}
