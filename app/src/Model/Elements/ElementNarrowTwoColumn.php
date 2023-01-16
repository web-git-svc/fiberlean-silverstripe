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
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBEnum;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\View\Parsers\ShortcodeParser;
use UncleCheese\DisplayLogic\Forms\Wrapper;

class ElementNarrowTwoColumn extends ElementTwoColumn
{
    private static string $table_name = 'ElementNarrowTwoColumn';

    private static array $db = [
        'LeftColumnContent'    => 'HTMLText',
        'LeftImageScaleWidth'  => 'Boolean',
        'RightImageScaleWidth' => 'Boolean',
        'LeftColumnVideoURL'   => 'Text',
        'RightColumnVideoURL'  => 'Text',
    ];

    private static array $fields_exclude = [
        'LeftImageScaleWidth',
        'RightImageScaleWidth',
    ];

    private static array $columns = [
        "Text",
        "Image",
        "Video"
    ];

    private static string $singular_name = 'narrow two column block';

    private static string $plural_name = 'narrow two column blocks';

    private static string $description = 'Narrow two column block';

    private static string $icon = 'font-icon-block-layout-8';

    private static array $casting = [
        'LeftColumnVideo'  => 'HTMLText',
        'RightColumnVideo' => 'HTMLText',
    ];

    public function getCMSFields(): FieldList
    {
        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'BallColour',
                        'LeftImageScaleWidth',
                        'RightImageScaleWidth',
                        'LeftColumnVideoURL',
                        'RightColumnVideoURL',
                    ]
                );

                $fields->insertAfter('LeftColumnType',
                    Wrapper::create(
                        FieldGroup::create('Image size',
                            CheckboxField::create('LeftImageScaleWidth', 'Scale image')
                        )
                    )->displayIf('LeftColumnType')->isEqualTo('Image')->end(),
                );

                $fields->insertAfter('LeftColumnType',
                    Wrapper::create(
                        TextField::create('LeftColumnVideoURL', 'Left column video URL')
                    )->displayIf('LeftColumnType')->isEqualTo('Video')->end(),
                );

                $fields->insertAfter('RightColumnType',
                    Wrapper::create(
                        FieldGroup::create('Image size',
                            CheckboxField::create('RightImageScaleWidth', 'Scale image')
                        )
                    )->displayIf('RightColumnType')->isEqualTo('Image')->end(),
                );

                $fields->insertAfter('RightColumnType',
                    Wrapper::create(
                        TextField::create('RightColumnVideoURL', 'Right column video URL')
                    )->displayIf('RightColumnType')->isEqualTo('Video')->end(),
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Narrow two column';
    }

    public function getLeftColumnVideo(): ?string
    {
        if (!$this->LeftColumnVideoURL) {
            return null;
        }

        $parser = ShortcodeParser::get();
        $content = "[embed url={$this->LeftColumnVideoURL}][/embed]";
        return $parser->parse($content);
    }

    public function getRightColumnVideo(): ?string
    {
        if (!$this->RightColumnVideoURL) {
            return null;
        }

        $parser = ShortcodeParser::get();
        $content = "[embed url={$this->RightColumnVideoURL}][/embed]";
        return $parser->parse($content);
    }

    public function getLeftColumnsTypes(): array
    {
        /** @var DBEnum $leftColumnTypeField */
        $leftColumnTypeField = $this->dbObject('LeftColumnType');
        return $leftColumnTypeField->enumValues();
    }

    public function getRightColumnsTypes(): array
    {
        /** @var DBEnum $leftColumnTypeField */
        $leftColumnTypeField = $this->dbObject('LeftColumnType');
        return $leftColumnTypeField->enumValues();
    }
}
