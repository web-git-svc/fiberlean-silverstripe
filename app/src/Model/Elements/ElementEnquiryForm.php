<?php

namespace App\Model\Elements;

use App\Control\Elements\ElementEnquiryFormController;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\TextField;

class ElementEnquiryForm extends BaseElement
{
    private static array $defaults = [
        'Title' => 'Enquiry Form',
    ];

    private static string $table_name = 'ElementEnquiryForm';

    private static string $singular_name = 'enquiry form block';

    private static string $plural_name = 'enquiry form blocks';

    private static string $description = 'Enquiry form block';

    private static string $icon = 'font-icon-block-form';

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
        return 'Enquiry form';
    }

    protected function provideBlockSchema(): array
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = "Renders an enquiry form";

        return $blockSchema;
    }
}
