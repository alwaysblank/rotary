<?php

namespace AlwaysBlank\Rotary;

class Render
{
    /**
     * Process a number through a template.
     *
     * Returns an empty string when given invalid number argument.
     *
     * The $segments argument must have the form
     *
     * [
     *   'intl' => '1',
     *   'area' => '123',
     *   'first' => '456',
     *   'second' => '7890',
     * ]
     *
     * 'intl' and 'area' are optional.
     *
     * Templates can use the following terms, which will be replaced:
     *
     * - %intl%
     * - %area%
     * - %first%
     * - %second%
     *
     * @param array $segments
     * @param string $template
     *
     * @return string
     */
    public static function through(array $segments, string $template)
    {
        $pattern = array_intersect_key(self::regex_placeholders(), $segments);
        // If these don't match we get very non-phone-number numbers.
        if (count($pattern) !== count($segments)) {
            return '';
        }

        return preg_replace(
            $pattern,
            $segments,
            $template
        );
    }

    /**
     * Returns a formatted string, given a phone number and a function that returns a template.
     *
     * @param callable $template
     * @param $num
     * @return string
     */
    public static function render(callable $template, $num): string
    {
        if (!Helpers::validInput($num)) {
            return '';
        }

        $Number = Helpers::number($num);

        return Render::through(array_filter($Number->array()), $template($Number));
    }

    /**
     * Returns a callable taken a Number as its argument and returns a template string.
     *
     * This is used by internal functions to generate their templates: Its output is generally
     * going to be passed to render(). The usage here is to allow templates to vary based on
     * the properties of a number.
     *
     * @param array $template_segments
     * @return callable
     */
    public static function templater(array $template_segments): callable
    {
        return function (Number $Number) use ($template_segments) {
            // Allow for prepending something to the template.
            $pre = $template_segments['pre'] ?? '';
            if (!empty($pre)) {
                unset($template_segments['pre']);
            }
            return $pre . join('', array_intersect_key($template_segments, array_filter($Number->array())));
        };
    }

    /**
     * Returns a generated list of placeholders for use by the regex replace in through().
     *
     * @return array
     */
    public static function regex_placeholders(): array
    {
        return array_column(array_map(function ($segment) {
            return [$segment, "/(%$segment%)/"];
        }, ['intl', 'area', 'first', 'second']), 1, 0);
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
        return self::render(
            self::templater(Constants::TEMPLATE_PRETTY),
            $num
        );
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
        $Number = Helpers::number($num);

        return self::render(
            self::templater($Number->intl ? Constants::TEMPLATE_HREF_INTL : Constants::TEMPLATE_HREF),
            $num
        );
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
        return self::render(
            self::templater(Constants::TEMPLATE_SIMPLE),
            $num
        );
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
        return self::render(self::templater(
            Constants::TEMPLATE_NORMALIZED),
            $num
        );
    }
}
