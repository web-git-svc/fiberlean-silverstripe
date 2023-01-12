<?php

namespace App\Extensions\ORM;

use App\Helpers\HelperTemplateVariables;
use SilverStripe\Core\Extension;
use SilverStripe\ORM\FieldType\DBField;

class DBStringExtension extends Extension
{
    /**
     * @return string
     */
    public function TelephoneHref(): string
    {
        return preg_replace(['/^0/', '/\s+/'], ['+44', ''], $this->owner->value);
    }
}
