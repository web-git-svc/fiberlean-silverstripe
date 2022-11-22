<?php

namespace App\Model\Elements;

use App\Extensions\Elemental\BeforeAfterContentExtension;
use Bummzack\SortableFile\Forms\SortableUploadField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\ManyManyList;

/**
 * @method ManyManyList Images()
 */
class ElementRibbon extends BaseElement
{
    private static array $defaults = [
        'Title' => 'Ribbon',
    ];

    private static string $table_name = 'ElementRibbon';

    private static string $singular_name = 'ribbon block';

    private static string $plural_name = 'ribbon blocks';

    private static string $description = 'Ribbon block';

    private static string $icon = 'font-icon-block-carousel';

    public function getCMSFields(): FieldList
    {
        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'TitleAndHeadingLevel',
                    ]
                );

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        TextField::create('Title', 'Title')
                            ->performReadonlyTransformation(),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Ribbon';
    }

    protected function provideBlockSchema(): array
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = "Renders a ribbon across the page";

        return $blockSchema;
    }
}
