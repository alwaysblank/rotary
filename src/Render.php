<?php

namespace AlwaysBlank\Rotary;

use AlwaysBlank\Rotary\Number;

class Render
{
    /**
     * Process a number through a template.
     *
     * @param Number $Number
     * @param string $template
     *
     * @return string
     */
    function through(Number $Number, string $template)
    {
        return vsprintf($template, $Number->array());
    }

    /**
     * Get a phone number in the format `(123) 456-7890`.
     *
     * @param $num
     *
     * @return string
     */
    function pretty($num): string
    {
        if ( ! Helpers::validInput($num)) {
            return null;
        }

        $Number = Helpers::number($num);

        $template = $Number->area ? Constants::TEMPLATE_PRETTY_AREA : Constants::TEMPLATE_SIMPLE;

        return Render::through($Number, $template);
    }

    /**
     * Get a phone number in the format `tel:1234567890`.
     *
     * @param $num
     *
     * @return string
     */
    function href($num): string
    {
        if ( ! Helpers::validInput($num)) {
            return null;
        }

        $Number = Helpers::number($num);

        $template = $Number->area ? Constants::TEMPLATE_HREF_AREA : Constants::TEMPLATE_HREF;

        return Render::through($Number, $template);
    }

    /**
     * Get a phone number in the format `123 456-7890`.
     *
     * @param $num
     *
     * @return string
     */
    function simple($num): string
    {
        if ( ! Helpers::validInput($num)) {
            return null;
        }

        $Number = Helpers::number($num);

        $template = $Number->area ? Constants::TEMPLATE_SIMPLE_AREA : Constants::TEMPLATE_SIMPLE;

        return Render::through($Number, $template);
    }

    /**
     * Get a phone number in the format `1234567890`.
     *
     * @param $num
     *
     * @return string
     */
    function normalized($num): string
    {
        if ( ! Helpers::validInput($num)) {
            return null;
        }

        $Number = Helpers::number($num);

        $template = $Number->area ? Constants::TEMPLATE_NORMALIZED_AREA : Constants::TEMPLATE_NORMALIZED;

        return Render::through($Number, $template);
    }
}