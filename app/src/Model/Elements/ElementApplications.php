<?php

namespace App\Model\Elements;

use App\Forms\GridField\GridFieldConfig_OrderableRecordEditor;
use App\Model\Elements\Components\Application;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\GridField\GridField;
use SilverStripe\Forms\OptionsetField;

class ElementApplications extends BaseElement
{
    private static string $table_name = 'ElementApplications';

    private static string $singular_name = 'application block';

    private static string $plural_name = 'application blocks';

    private static string $description = 'Application block';

    private static string $icon = 'font-icon-block-promo-3';

    private static array $db = [
        'Colour' => 'Varchar',
    ];

    private static array $has_many = [
        'Applications' => Application::class,
    ];

    private static array $owns = [
        'Applications'
    ];

    public function getCMSFields(): FieldList
    {
        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName('Applications');

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        GridField::create(
                            'Applications',
                            'Applications',
                            $this->Applications(),
                            GridFieldConfig_OrderableRecordEditor::create()
                        ),
                    ]
                );

                $fields->addFieldsToTab(
                    'Root.Settings',
                    [
                        OptionsetField::create(
                            'Colour',
                            'Colour',
                            Config::inst()->get('Colours', 'colours')
                        )->setEmptyString('None'),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Application';
    }
}
