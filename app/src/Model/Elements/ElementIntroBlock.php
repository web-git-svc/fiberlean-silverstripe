<?php

namespace App\Model\Elements;

use DNADesign\Elemental\Models\ElementContent;
use SilverStripe\AssetAdmin\Forms\UploadField;
use SilverStripe\Assets\Image;
use SilverStripe\Forms\FieldList;
use SilverStripe\Forms\OptionsetField;

class ElementIntroBlock extends ElementTallIntroBlock
{
    private static string $table_name = 'ElementIntroBlock';

    private static string $singular_name = 'intro block';

    private static string $plural_name = 'intro blocks';

    private static string $description = 'Intro block';

    private static string $icon = 'font-icon-block-promo-3';

    public function getType(): string
    {
        return 'Intro';
    }
}
