<?php

namespace App\Extensions\Security;

use App\Model\VIPArea\VIPAreaHolder;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Extension;
use SilverStripe\LoginForms\EnablerExtension;
use SilverStripe\View\ArrayData;
use SilverStripe\View\SSViewer;

class VipAreaExtension extends Extension
{
    public function beforeCallActionHandler()
    {
        $callback = function () {
            Config::inst()->set(
                EnablerExtension::class,
                'login_themes',
                Config::inst()->get(SSViewer::class, 'themes')
            );
        };

        VIPAreaHolder::inVIPArea($callback);
    }
}
