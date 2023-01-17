<?php

namespace App\Extensions\Security;

use SilverStripe\Core\Extension;
use SilverStripe\Forms\FieldList;

class MemberExtension extends Extension
{
    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName(['OAuthSource', 'Passports']);

        if ($this->owner->OAuthSource) {
            $fields->removeByName(['Password', 'FailedLoginCount']);
            $fields->replaceField(
                'Email',
                $fields->dataFieldByName('Email')->performReadonlyTransformation()
            );
        }
    }
}
