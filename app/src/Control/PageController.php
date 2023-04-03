<?php

namespace App\Control;

use App\Forms\PopupForm;
use App\Forms\RegisterForm;
use App\Traits\SentTrait;
use SilverStripe\CMS\Controllers\ContentController;
use SilverStripe\Control\Email\Email;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Forms\CompositeField;
use SilverStripe\Forms\EmailField;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\Form;
use SilverStripe\Forms\FormAction;
use SilverStripe\Forms\LiteralField;
use SilverStripe\Forms\RequiredFields;
use SilverStripe\Forms\TextareaField;
use SilverStripe\Forms\TextField;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\View\Requirements;

class PageController extends ContentController
{
    use SentTrait;

    private static array $allowed_actions = [
        'EnquiryForm',
        'PopupForm',
        'RegisterForm',
    ];

    protected function init()
    {
        parent::init();

        Requirements::set_force_js_to_bottom(true);
        Requirements::themedJavascript('dist/js/app.js');
    }

    public function EnquiryForm(): Form
    {
        $holder_template = 'SilverStripe\Forms\FormFieldShrinkyLabel_holder';

        return Form::create(
            $this,
            __FUNCTION__,
            FieldList::create(
                TextField::create('Title', 'Title')
                    ->addExtraClass('h-hide-visually')
                    ->setAttribute('tabindex', '-1'),
                CompositeField::create(
                    TextField::create('Name', $label = 'Name')
                        ->setAttribute('placeholder', $label . '*')
                        ->setFieldHolderTemplate($holder_template),
                    TextField::create('Company', $label = 'Company')
                        ->setAttribute('placeholder', $label . '*')
                        ->setFieldHolderTemplate($holder_template),
                    TextField::create('Telephone', $label = 'Telephone')
                        ->setAttribute('placeholder', $label)
                        ->setFieldHolderTemplate($holder_template),
                    EmailField::create('Email', $label = 'Email')
                        ->setAttribute('placeholder', $label . '*')
                        ->setFieldHolderTemplate($holder_template),
                )->addExtraClass('form__two-column'),
                TextareaField::create('EnquiryDetails', $label = 'Enquiry details')
                    ->setAttribute('placeholder', $label)
                    ->setFieldHolderTemplate($holder_template),
                LiteralField::create('',
                    $this->SiteConfig()->EnquiryFormPrivacyContent
                        ? '<div class="typography typography--white element-enquiry-form__privacy">' . DBField::create_field('HTMLFragment', $this->SiteConfig()->EnquiryFormPrivacyContent . '</div>')
                        : ''
                )
            ),
            FieldList::create(
                FormAction::create('do' . __FUNCTION__)
                    ->addExtraClass('button button--blue-light')
                    ->setUseButtonTag(true)
                    ->setTitle('Submit')
            ),
            RequiredFields::create(
                [
                    'Name',
                    'Company',
                    'Email',
                ]
            )
        );
    }

    public function doEnquiryForm(array $data, Form $form, HTTPRequest $request): ?HTTPResponse
    {
        if (empty($data['Title'])) {
            $form->captureForm('Enquiry form submission', 'Name', 'Email' );

            Email::create()
                ->setHTMLTemplate('App\Email\EnquiryFormEmail')
                ->addData($data)
                ->setReplyTo($data['Email'])
                ->setTo($this->SiteConfig()->EnquiryFormRecipient ?? 'info@fiberlean.com')
                ->setSubject($this->SiteConfig()->EnquiryFormSubject ?? 'New Enquiry Form Submission')
                ->send();

            $request->getSession()->set('CompletedForm', $form->getName());
        }

        return $this->redirect($this->Link('#enquiry-form'));
    }

    public function PopupForm(): PopupForm
    {
        return PopupForm::create($this, __FUNCTION__);
    }

    public function doPopupForm(array $data, Form $form, HTTPRequest $request): DBHTMLText
    {
        if (empty($data['Title'])) {
            $form->captureForm('Popup form submission', 'Name', 'Email' );

            if (isset($data['AreasOfInterest'] )) {
                $data['AreasOfInterest'] = implode(', ', $data['AreasOfInterest']);
            }

            Email::create()
                ->setHTMLTemplate('App\Email\PopupFormEmail')
                ->addData($data)
                ->setReplyTo($data['Email'])
                ->setTo($this->SiteConfig()->EnquiryFormRecipient ?? 'info@fiberlean.com')
                ->setSubject($this->SiteConfig()->EnquiryFormSubject ?? 'New Enquiry Form Submission')
                ->send();

            $request->getSession()->set('CompletedForm', $form->getName());
        }

        return $this->renderWith(['App\Includes\PopupFormComplete']);
    }

    public function RegisterForm(): RegisterForm
    {
        return RegisterForm::create($this, __FUNCTION__);
    }

}
