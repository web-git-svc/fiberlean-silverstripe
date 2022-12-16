<?php

namespace App\Helpers;

use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBField;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\View\HTML;
use SilverStripe\View\SSViewer;
use SilverStripe\View\TemplateGlobalProvider;
use SilverStripe\View\ViewableData;

class HelperTemplateVariables implements TemplateGlobalProvider
{
    private static int $ballCount = 0;

    public static function ball(?string $color=null): DBHTMLText
    {
        self::$ballCount++;
        $template = SSViewer::create('App\Includes\Ball');
        return $template->process(
            DataObject::singleton()->customise(
                [
                    'Colour' => $color,
                    'Count'  => self::$ballCount,
                ]
            )
        );
    }

    public static function svg_icon(
        string $iconName,
        int $width = null,
        int $height = null,
        string $classes = null
    ): DBField
    {
        $markup = HTML::createTag(
            'svg',
            [
                'width' => $width,
                'height' => $height,
                'class' => $classes,
            ],
            HTML::createTag(
                'use',
                [
                    'xlink:href' => ViewableData::singleton()->ThemeDir() . '/dist/images/icons.svg#icon-' . $iconName
                ]
            )
        );

        return DBField::create_field('HTMLFragment', $markup);
    }

    public static function get_template_global_variables(): array
    {
        return [
            'SVGIcon' => 'svg_icon',
            'Ball'    => 'ball',
        ];
    }
}
