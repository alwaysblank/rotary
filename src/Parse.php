<?php

namespace AlwaysBlank\Rotary\Parse;

use AlwaysBlank\Rotary\Number;

/**
 * Parse segments into the parts of a phone number.
 *
 * @param string $number
 *
 * @return array
 */
function parse(string $number): array
{
    $extracted = extract($number);

    if (empty($extracted)) {
        return [];
    }

    $segments = count($extracted);

    return [
        'area'   => $segments === 4 ? $extracted[1] : false,
        'first'  => $segments === 4 ? $extracted[2] : $extracted[1],
        'second' => $segments === 4 ? $extracted[3] : $extracted[2],
    ];
}

/**
 * Get the segments of a number.
 *
 * @param string $number
 *
 * @return array
 */
function extract(string $number)
{
    preg_match(REGEX, $number, $matches, PREG_UNMATCHED_AS_NULL);

    if ($matches && count($matches) >= 3) {
        return array_values(array_filter($matches));
    }

    return [];
}