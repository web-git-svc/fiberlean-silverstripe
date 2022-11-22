<?php

namespace App\Model\Elements;

use App\Extensions\Elemental\BeforeAfterContentExtension;
use Bummzack\SortableFile\Forms\SortableUploadField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextareaField;
use SilverStripe\ORM\ManyManyList;

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
                $fields->insertBefore(
                    'TitleAndHeadingLevel',
                    TextareaField::create('Title', 'Title')
                        ->setRows(2)
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
