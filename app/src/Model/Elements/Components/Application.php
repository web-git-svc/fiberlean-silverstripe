<?php

namespace App\Model\Elements\Components;

use App\Forms\GridField\GridFieldConfig_OrderableRecordEditor;
use App\Model\Elements\ElementApplications;
use SilverStripe\Assets\File;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\LiteralField;
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
class Application extends DataObject
{
    private static string $table_name = 'ElementApplications_Application';

    private static array $db = [
        'Sort'    => 'Int',
        'Title'   => 'Varchar',
        'Content' => 'HTMLText',
    ];

    private static array $has_one = [
        'ApplicationBlock' => ElementApplications::class,
    ];

    private static array $has_many = [
        'ApplicationItems' => ApplicationItem::class,
    ];

    private static array $owns = [
        'ApplicationItems',
    ];

    private static array $summary_fields = [
        'Title'           => 'Title',
        'Content.Summary' => 'Content',
    ];

    private static string $default_sort = 'Sort ASC';

    private static string $singular_name = 'Application';

    private static string $plural_name = 'Applications';

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
                        'ApplicationBlockID',
                        'ApplicationItems',
                        'Sort',
                    ]
                );

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        TextField::create('Title', 'Title'),
                        HTMLEditorField::create('Content', 'Content')
                    ]
                );

                if ($this->ID) {
                    $fields->addFieldsToTab(
                        'Root.ApplicationItems',
                        [
                            GridField::create(
                                'ApplicationItems',
                                'Application items',
                                $this->ApplicationItems(),
                                GridFieldConfig_OrderableRecordEditor::create()
                            )
                        ]
                    );
                } else {
                    $fields->insertBefore(
                        'Title',
                      LiteralField::create('', <<<HTML
<div class="alert alert-info">
    You will need to save first before you can add any application items
</div>
HTML
                      )
                    );
                }
            }
        );

        return parent::getCMSFields();
    }
}
