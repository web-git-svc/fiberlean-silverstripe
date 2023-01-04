<?php

namespace App\Model\Elements;

use App\Extensions\Elemental\BeforeAfterContentExtension;
use Bummzack\SortableFile\Forms\SortableUploadField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\ManyManyList;
use TractorCow\Fluent\Extension\FluentExtension;
use TractorCow\Fluent\Model\Locale;

/**
 * @method Image()
 */
class ElementHero extends BaseElement
{
    private static string $table_name = 'ElementHero';

    private static array $db = [
        'Title' => 'Text',
    ];

    private static array $has_one = [
        'Image' => Image::class,
    ];

    private static array $owns = [
        'Image',
    ];

    private static array $fields_include = [
        'Title',
    ];

    private static array $translate = [
        'Title',
    ];

    private static string $singular_name = 'hero block';

    private static string $plural_name = 'hero blocks';

    private static string $description = 'Hero block';

    private static string $icon = 'font-icon-block-image';

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        UploadField::create('Image', 'Image')
                            ->setAllowedFileCategories('image')
                            ->setFolderName('hero-image'),
                    ]
                );
            }
        );

        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $titleField = TextareaField::create('Title', 'Title')
                    ->setRows(2);

                // The title field in elemental is a fancy composite field containing a text box and a checkbox,
                // so we have to manually add the fluent "field is translatable" badge
                if (class_exists(Locale::class) && !$titleField->hasClass('fluent__localised-field')) {
                    $translatedTooltipTitle = _t(FluentExtension::class . ".FLUENT_ICON_TOOLTIP", 'Translatable field');
                    $tooltip = DBField::create_field(
                        'HTMLFragment',
                        "<span class='font-icon-translatable' title='$translatedTooltipTitle'></span>"
                    );

                    $titleField->addExtraClass('fluent__localised-field');
                    $titleField->setTitle(DBField::create_field('HTMLFragment', $tooltip . $titleField->Title()));
                }

                $fields->insertBefore(
                    'TitleAndHeadingLevel',
                    $titleField
                );

                $fields->removeByName(
                    [
                        'TitleAndHeadingLevel',
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Hero';
    }

    protected function provideBlockSchema(): array
    {
        $blockSchema = parent::provideBlockSchema();

        if ($this->Image()->exists() && $this->Image()->getIsImage()) {
            $blockSchema['fileURL'] = $this->Image()->CMSThumbnail()->getURL();
            $blockSchema['fileTitle'] = $this->Image()->getTitle();
        }

        $blockSchema['content'] = $this->Title;

        return $blockSchema;
    }
}
