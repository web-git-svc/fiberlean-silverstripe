<?php

namespace App\Extensions\Security;

use App\Model\Page;
use App\Model\VIPArea\VIPAreaHolder;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;
use SilverStripe\Security\Security;

class VipAreaTwoExtension extends Extension
{
    public function beforeCallActionHandler()
    {
        $callback = function () {
            Config::inst()->set(Security::class, 'page_class', Page::class);
        };

        VIPAreaHolder::inVIPArea($callback);
    }
}
