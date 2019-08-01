<?php

namespace AlwaysBlank\Rotary;

class Render
{
    /**
     * Process a number through a template.
     *
     * Returns an empty string when given invalid number argument.
     *
     * @param array  $segments
     * @param string $template
     *
     * @return string
     */
    public static function through(array $segments, string $template)
    {
        $cleaned = array_filter($segments);
        if (empty($cleaned)) {
            return '';
        }

        return vsprintf($template, $cleaned);
    }

    public static function render(callable $template, $num): string
    {
        if ( ! Helpers::validInput($num)) {
            return '';
        }

        $Number = Helpers::number($num);

        return Render::through($Number->array(), $template($Number));
    }

    /**
     * Get a phone number in the format `(123) 456-7890`.
     *
     * @param $num
     *
     * @return string
     */
    public static function pretty($num): string
    {
        return Render::render(function (Number $Number) {
            return $Number->area
                ? Constants::TEMPLATE_PRETTY_AREA
                : Constants::TEMPLATE_SIMPLE;
        }, $num);
    }

    /**
     * Get a phone number in the format `tel:1234567890`.
     *
     * @param $num
     *
     * @return string
     */
    public static function href($num): string
    {
        return Render::render(function (Number $Number) {
            return $Number->area
                ? Constants::TEMPLATE_HREF_AREA
                : Constants::TEMPLATE_HREF;
        }, $num);
    }

    /**
     * Get a phone number in the format `123 456-7890`.
     *
     * @param $num
     *
     * @return string
     */
    public static function simple($num): string
    {
        return Render::render(function (Number $Number) {
            return $Number->area
                ? Constants::TEMPLATE_SIMPLE_AREA
                : Constants::TEMPLATE_SIMPLE;
        }, $num);
    }

    /**
     * Get a phone number in the format `1234567890`.
     *
     * @param $num
     *
     * @return string
     */
    public static function normalized($num): string
    {
        return Render::render(function (Number $Number) {
            return $Number->area
                ? Constants::TEMPLATE_NORMALIZED_AREA
                : Constants::TEMPLATE_NORMALIZED;
        }, $num);
    }
}