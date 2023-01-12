<?php

namespace App\Traits;

use SilverStripe\Control\Controller;

trait SentTrait
{
    public function Sent(string $formName): bool
    {
        $session = $this->getRequest()->getSession();

        if ($session->get('CompletedForm') === $formName) {
            $session->clear('CompletedForm');
            return true;
        }

        return false;
    }
}
