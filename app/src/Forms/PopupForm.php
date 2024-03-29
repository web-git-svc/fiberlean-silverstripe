<?php

namespace App\Forms;

use SilverStripe\Forms\CheckboxField;
use SilverStripe\Forms\CheckboxSetField;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\ArrayLib;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\SiteConfig\SiteConfig;

class PopupForm extends Form
{
    const HOLDER_TEMPLATE = 'SilverStripe\Forms\FormFieldShrinkyLabel_holder';

    public function __construct($controller, $name)
    {
        $siteConfig = SiteConfig::current_site_config();

        $fields = FieldList::create(
            TextField::create('Title', 'Title')
                ->addExtraClass('h-hide-visually')
                ->setAttribute('tabindex', '-1'),
            TextField::create('Name', $label = 'Name')
                ->setAttribute('placeholder', $label . '*')
                ->setFieldHolderTemplate(self::HOLDER_TEMPLATE),
            TextField::create('Company', $label = 'Company')
                ->setAttribute('placeholder', $label . '*')
                ->setFieldHolderTemplate(self::HOLDER_TEMPLATE),
            TextField::create('Telephone', $label = 'Telephone')
                ->setAttribute('placeholder', $label  . '*')
                ->setFieldHolderTemplate(self::HOLDER_TEMPLATE),
            EmailField::create('Email', $label = 'Email')
                ->setAttribute('placeholder', $label . '*')
                ->setFieldHolderTemplate(self::HOLDER_TEMPLATE),
            TextareaField::create('Message', $label = 'Message')
                ->setAttribute('placeholder', $label . '*')
                ->setFieldHolderTemplate(self::HOLDER_TEMPLATE),
//            CheckboxField::create('SubscribeToEmailNewsletter', 'Subscribe to email newsletter', true),
            CheckboxSetField::create(
                'AreasOfInterest',
                'Areas of interest',
                ArrayLib::valuekey(
                    [
                        'Paper & packaging',
                        'Building materials',
                        'Agriculture',
                    ]
                )
            ),
            LiteralField::create('',
                $siteConfig->EnquiryFormPrivacyContent
                    ? '<div style="margin-top: 1em;text-align: left;">' . DBField::create_field('HTMLFragment', $siteConfig->EnquiryFormPrivacyContent . '</div>')
                    : ''
            )
        );

        $actions = FieldList::create(
            FormAction::create("do{$name}", 'Submit')
                ->setUseButtonTag(true)
                ->addExtraClass('button button--blue-light')
        );

        $required = RequiredFields::create(
            [
                'Name',
                'Company',
                'Telephone',
                'Email',
                'Message',
            ]
        );

        // now we create the actual form with our fields and actions defined
        // within this class
        parent::__construct($controller, $name, $fields, $actions, $required);

        $this->setAttribute('novalidate', true);
//        $this->enableSpamProtection();
    }
}
