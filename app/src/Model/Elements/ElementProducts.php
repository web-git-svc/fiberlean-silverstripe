<?php

namespace App\Model\Elements;

use Bummzack\SortableFile\Forms\SortableUploadField;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\ManyManyList;


class ElementProducts extends BaseElement
{
    private static string $table_name = 'ElementProducts';

    private static string $singular_name = 'products block';

    private static string $plural_name = 'products blocks';

    private static string $description = 'Products block';

    private static string $icon = 'font-icon-block-layout-10';

    private static array $many_many = [
        'Images' => Image::class,
    ];

    private static array $many_many_extraFields = [
        'Images' => [
            'SortOrder' => 'Int',
        ],
    ];

    private static array $owns = [
        'Images',
    ];

    public function getCMSFields(): FieldList
    {
        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'Images',
                    ]
                );

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        SortableUploadField::create('Images', 'Images')
                            ->setAllowedFileCategories('image')
                            ->setFolderName('produts'),
                    ]
                );
            }
        );

        return parent::getCMSFields();
    }

    public function getType(): string
    {
        return 'Products';
    }

    protected function provideBlockSchema(): array
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = "Showing {$this->Images()->count()} image(s)";

        return $blockSchema;
    }

    public function Images(): ManyManyList
    {
        return $this->getManyManyComponents('Images')->sort('SortOrder ASC');
    }
}
