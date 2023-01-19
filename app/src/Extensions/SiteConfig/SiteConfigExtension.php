<?php

namespace App\Extensions\SiteConfig;

use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\HeaderField;
use SilverStripe\Forms\HTMLEditor\HTMLEditorField;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;

class SiteConfigExtension extends Extension
{
    private static array $db = [
        'EmailAddress'              => 'Varchar',
        'Telephone'                 => 'Varchar',
        'StartOfHead'               => 'Text',
        'EndOfHead'                 => 'Text',
        'StartOfBody'               => 'Text',
        'EndOfBody'                 => 'Text',
        'FooterContent'             => 'HTMLText',
        'FacebookURL'               => 'Text',
        'TwitterURL'                => 'Text',
        'LinkedInURL'               => 'Text',
        'ContactTitle'              => 'Varchar',
        'ContactContent'            => 'HTMLText',
        'EnquiryFormContent'        => 'HTMLText',
        'EnquiryFormPrivacyContent' => 'HTMLText',
        'EnquiryFormSuccessContent' => 'HTMLText',
        'EnquiryFormRecipient'      => 'Varchar',
        'EnquiryFormSubject'        => 'Varchar',
    ];

    private static array $has_one = [
        'ContactImage' => Image::class,
    ];

    private static array $owns = [
        'ContactImage',
    ];

    public function updateCMSFields(FieldList $fields): void
    {
        $fields->removeByName(
            [
                'Tagline',
            ]
        );

        $fields->addFieldsToTab(
            'Root.SiteSettings',
            [
                EmailField::create('EmailAddress', 'Email address'),
                TextField::create('Telephone', 'Telephone number'),

                HeaderField::create('FooterHeader', 'Footer'),
                HTMLEditorField::create('FooterContent', 'Content'),

                HeaderField::create('FooterHeader', 'Footer'),
                TextField::create('FacebookURL', 'Facebook URL'),
                TextField::create('TwitterURL', 'Twitter URL'),
                TextField::create('LinkedInURL', 'LinkedIn URL'),

                HeaderField::create('ContactHeader', 'Contact'),
                UploadField::create('ContactImage', 'Image')
                    ->setAllowedFileCategories('image'),
                TextField::create('ContactTitle', 'Title'),
                HTMLEditorField::create('ContactContent', 'Content'),

                HeaderField::create('EnquiryFormHeader', 'Enquiry form'),
                HTMLEditorField::create('EnquiryFormContent', 'Content'),
                HTMLEditorField::create('EnquiryFormPrivacyContent', 'Form privacy content'),
                HTMLEditorField::create('EnquiryFormSuccessContent', 'Success content'),
                EmailField::create('EnquiryFormRecipient', 'Email recipient'),
                TextField::create('EnquiryFormSubject', 'Email subject'),
            ]
        );

        $fields->addFieldsToTab(
            'Root.Scripts',
            [
                TextareaField::create('StartOfHead', 'Start of head'),
                TextareaField::create('EndOfHead', 'End of head'),
                TextareaField::create('StartOfBody', 'Start of body'),
                TextareaField::create('EndOfBody', 'End of body'),
            ]
        );
    }
}
