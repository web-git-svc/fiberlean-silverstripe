<?php

namespace App\Security\MemberAuthenticator;

use App\Forms\RegisterForm;
use App\Model\VIPArea\VIPAreaHolder;
use SilverStripe\Forms\FieldList;
use SilverStripe\Security\MemberAuthenticator\MemberLoginForm as SilverStripeMemberLoginForm;

class MemberLoginForm extends SilverStripeMemberLoginForm
{
    public function getFormFields(): FieldList
    {
        $fields = parent::getFormFields();

        $callback = function () use ($fields) {
            foreach (['Email', 'Password'] as $fieldName) {
                $field = $fields->dataFieldByName($fieldName);
                $field->setAttribute('placeholder', $field->Title() . '*')
                    ->setFieldHolderTemplate(RegisterForm::HOLDER_TEMPLATE);
            }
        };

        VIPAreaHolder::inVIPArea($callback);

        return $fields;
    }
}
