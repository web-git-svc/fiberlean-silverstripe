<?php

namespace App\Extensions\Security;

use App\Forms\RegisterForm;
use SilverStripe\Control\Email\Email;
use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\HTTPResponse;
use SilverStripe\Core\Extension;
use SilverStripe\Forms\Form;

class SecurityExtension extends Extension
{
    private static array $allowed_actions = [
        'RegisterForm',
    ];

    public function RegisterForm(): RegisterForm
    {
        return RegisterForm::create($this->owner, __FUNCTION__);
    }

    public function doRegisterForm(array $data, Form $form, HTTPRequest $request): HTTPResponse
    {
        if (empty($data['Title'])) {
            $form->captureForm('Register form submission', 'Name', 'Email' );

            if (isset($data['AreasOfInterest'] )) {
                $data['AreasOfInterest'] = implode(', ', $data['AreasOfInterest']);
            }

            Email::create()
                ->setHTMLTemplate('App\Email\RegisterFormEmail')
                ->addData($data)
                ->setReplyTo($data['Email'])
                ->setTo($this->SiteConfig()->EnquiryFormRecipient ?? 'info@fiberlean.com')
                ->setSubject('New Registration Form Submission')
                ->send();

            $request->getSession()->set('CompletedForm', $form->getName());
        }

        return $this->owner->redirect($this->owner->Link('#register-form'));
    }

    public function Sent(string $formName): bool
    {
        $session = $this->owner->getRequest()->getSession();

        if ($session->get('CompletedForm') === $formName) {
            $session->clear('CompletedForm');
            return true;
        }

        return false;
    }
}
