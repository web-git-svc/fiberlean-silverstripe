<?php

namespace App\Model\Elements;

use App\Extensions\Elemental\BeforeAfterContentExtension;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\ORM\FieldType\DBEnum;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use UncleCheese\DisplayLogic\Forms\Wrapper;

class ElementNarrowTwoColumn extends ElementTwoColumn
{
    private static string $table_name = 'ElementNarrowTwoColumn';

    private static array $db = [
        'LeftImageScaleWidth'    => 'Boolean',
        'RightImageScaleWidth'    => 'Boolean',
    ];

    private static string $singular_name = 'narrow two column block';

    private static string $plural_name = 'narrow two column blocks';

    private static string $description = 'Narrow two column block';

    private static string $icon = 'font-icon-block-layout-8';

    public function getCMSFields(): FieldList
    {
        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'BallColour',
                        'LeftImageScaleWidth',
                        'RightImageScaleWidth',
                    ]
                );

                $fields->insertAfter('LeftColumnType',
                    Wrapper::create(
                        FieldGroup::create('Image size',
                            CheckboxField::create('LeftImageScaleWidth', 'Scale image')
                        )
                    )->displayIf('LeftColumnType')->isEqualTo('Image')->end(),
                );

                $fields->insertAfter('RightColumnType',
                    Wrapper::create(
                        FieldGroup::create('Image size',
                            CheckboxField::create('RightImageScaleWidth', 'Scale image')
                        )
                    )->displayIf('RightColumnType')->isEqualTo('Image')->end(),
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Narrow two column';
    }
}
