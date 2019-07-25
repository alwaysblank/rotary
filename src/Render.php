<?php

namespace AlwaysBlank\Rotary\Render;

use AlwaysBlank\Rotary\Number;
use function AlwaysBlank\Rotary\Helpers\number;
use function AlwaysBlank\Rotary\Helpers\validInput;
use const AlwaysBlank\Rotary\Constants\TEMPLATE_HREF;
use const AlwaysBlank\Rotary\Constants\TEMPLATE_HREF_AREA;
use const AlwaysBlank\Rotary\Constants\TEMPLATE_NORMALIZED;
use const AlwaysBlank\Rotary\Constants\TEMPLATE_NORMALIZED_AREA;
use const AlwaysBlank\Rotary\Constants\TEMPLATE_PRETTY_AREA;
use const AlwaysBlank\Rotary\Constants\TEMPLATE_SIMPLE;
use const AlwaysBlank\Rotary\Constants\TEMPLATE_SIMPLE_AREA;

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
    if ( ! validInput($num)) {
        return null;
    }

    $Number = number($num);

    $template = $Number->area ? TEMPLATE_PRETTY_AREA : TEMPLATE_SIMPLE;

    return through($Number, $template);
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
    if ( ! validInput($num)) {
        return null;
    }

    $Number = number($num);

    $template = $Number->area ? TEMPLATE_HREF_AREA : TEMPLATE_HREF;

    return through($Number, $template);
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
    if ( ! validInput($num)) {
        return null;
    }

    $Number = number($num);

    $template = $Number->area ? TEMPLATE_SIMPLE_AREA : TEMPLATE_SIMPLE;

    return through($Number, $template);
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
    if ( ! validInput($num)) {
        return null;
    }

    $Number = number($num);

    $template = $Number->area ? TEMPLATE_NORMALIZED_AREA : TEMPLATE_NORMALIZED;

    return through($Number, $template);
}