<?php

namespace App\Model\Elements;

use App\Extensions\Elemental\BeforeAfterContentExtension;
use Bummzack\SortableFile\Forms\SortableUploadField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\ManyManyList;

class ElementContactUs extends BaseElement
{
    private static array $defaults = [
        'Title' => 'Contact us',
    ];

    private static string $table_name = 'ElementContactUs';

    private static string $singular_name = 'contact us block';

    private static string $plural_name = 'contact us blocks';

    private static string $description = 'Contact us block';

    private static string $icon = 'font-icon-block-phone';

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
        return 'Contact us';
    }

    protected function provideBlockSchema(): array
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = "Renders a contact us block";

        return $blockSchema;
    }
}
