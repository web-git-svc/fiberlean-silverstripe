<?php

namespace App\Helpers;

trait LinkSetTrait
{
    public function LinkSet(): ?string
    {
        switch ($this->LinkType) {
            case 'Page':
                $page = $this->LinkedPage();
                if ($page->exists()) {
                    return $page->Link();
                }
                break;
            case 'File':
                $file = $this->LinkedFile();
                if ($file->exists()) {
                    return $file->Link();
                }
                break;
            case 'URL':
                return $this->LinkURL;
        }

        return '';
    }
}
