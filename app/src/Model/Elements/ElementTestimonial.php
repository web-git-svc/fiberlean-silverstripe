<?php

namespace App\Model\Elements;

use App\Helpers\LinkSetTrait;
use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\File;
use SilverStripe\CMS\Model\SiteTree;
use SilverStripe\Core\Config\Config;
use SilverStripe\Forms\DropdownField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\OptionsetField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\Forms\TreeDropdownField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBText;
use UncleCheese\DisplayLogic\Forms\Wrapper;

class ElementTestimonial extends BaseElement
{
    use LinkSetTrait;

    private static string $table_name = 'ElementTestimonial';

    private static array $db = [
        'Testimonial'       => 'Text',
        'TestimonialAuthor' => 'Varchar',
        'LinkText'          => 'Varchar',
        'LinkType'          => 'Varchar',
        'LinkURL'           => 'Text',
        'LinkTarget'        => 'Varchar',
        'Colour'            => 'Varchar',
    ];

    private static array $has_one = [
        'LinkedPage' => SiteTree::class,
        'LinkedFile' => File::class,
    ];

    private static array $owns = [
        'LinkedFile',
    ];

    private static array $defaults = [
        'LinkType' => 'Page',
    ];

    private static array $fields_exclude = [
        'Colour',
    ];

    private static string $singular_name = 'testimonial block';

    private static string $plural_name = 'testimonial blocks';

    private static string $description = 'Testimonial block';

    private static string $icon = 'font-icon-block-quote';

    public function getCMSFields(): FieldList
    {
        $this->beforeUpdateCMSFields(
            function (FieldList $fields) {
                $fields->removeByName(
                    [
                        'FeatureBoxBlockID',
                        'Image',
                        'LinkedFile',
                        'LinkedPageID',
                        'LinkTarget',
                        'LinkText',
                        'LinkType',
                        'LinkURL',
                        'Sort',
                        'Title',
                    ]
                );

                $fields->addFieldsToTab(
                    'Root.Main',
                    [
                        TextareaField::create('Testimonial', 'Testimonial'),
                        TextField::create('TestimonialAuthor', 'Testimonial author'),
                        OptionsetField::create(
                            'LinkType',
                            'Link type',
                            [
                                'None' => 'No link',
                                'Page' => 'Link to a page on this site',
                                'File' => 'Link to a file on this site',
                                'URL'  => 'Link to another website'
                            ]
                        ),
                        Wrapper::create(
                            TextField::create('LinkText', 'Link text'),
                        )->displayIf('LinkType')
                            ->isNotEqualTo('None')
                            ->end(),
                        Wrapper::create(
                            TreeDropdownField::create('LinkedPageID', 'Linked page', SiteTree::class)
                                ->setTitleField('MenuTitle')
                        )->displayIf('LinkType')
                            ->isEqualTo('Page')
                            ->end(),
                        Wrapper::create(
                            UploadField::create('LinkedFile', 'Linked file')
                                ->setFolderName('Files')
                        )->displayIf('LinkType')
                            ->isEqualTo('File')
                            ->end(),
                        Wrapper::create(
                            TextField::create('LinkURL', 'Linked page')
                                ->setDescription('Please include the "https://" prefix')
                        )->displayIf('LinkType')
                            ->isEqualTo('URL')
                            ->end(),
                        Wrapper::create(
                            DropdownField::create('LinkTarget', 'Link target', [
                                '_blank' => 'Open in a new window'
                            ])->setEmptyString('Open in the same window')
                        )->displayIf('LinkType')
                            ->isNotEqualTo('None')
                            ->end(),
                    ]
                );
            }
        );

        $this->afterUpdateCMSFields(
            function (FieldList $fields) {
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
        return 'Testimonial';
    }

    protected function provideBlockSchema(): array
    {
        $blockSchema = parent::provideBlockSchema();

        /** @var DBText $text */
        $text = DBField::create_field('Text', $this->Testimonial);
        $blockSchema['content'] = $text->summary();

        return $blockSchema;
    }
}
