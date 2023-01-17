<?php

namespace App\Extensions\Security;

use SilverStripe\Core\Extension;
use SilverStripe\Security\Member;

class LostPasswordHandler extends Extension
{
    public function forgotPassword(?Member $member)
    {
        // Members registered via OAuth shouldn't be able to reset their password
        if ($member && $member->OAuthSource) {
            return false;
        }
    }
}
