<?php

namespace AlwaysBlank\Rotary;


class Parse
{
    /**
     * Parse segments into the parts of a phone number.
     *
     * @param string $number
     *
     * @return array
     */
    public static function parse(string $number): array
    {
        return Parse::extract($number);
    }

    /**
     * Get the segments of a number.
     *
     * @param string $number
     *
     * @return array
     */
    public static function extract(string $number): array
    {
        $cleaned = preg_replace( Constants::REGEX_CLEAN, '', $number );

        // A number with less than 7 digits can't be a valid phone number.
        if (strlen($cleaned) < 7) {
            return [];
        }

        preg_match(Constants::REGEX, strrev($cleaned), $matches, PREG_UNMATCHED_AS_NULL);

        // If there's no full match, we have an invalid number.
        if (!isset($matches[0])) {
            return [];
        }

        // We only care about certain rows.
        $matches = array_filter($matches, function($key) {
            return in_array((string)$key, ['intl', 'area', 'first', 'second']);
        }, ARRAY_FILTER_USE_KEY);

        // Can't have a phone number without these.
        if (!$matches['first'] || !$matches['second']) {
            return [];
        }

        // We have to have an area code for an valid intl segment.
        if (!$matches['area'] && $matches['intl']) {
            return [];
        }

        // All digits are important, so fail if any have been trimmed.
        if (strlen($cleaned) !== strlen(join('', $matches))) {
            return [];
        }

        // Turn all segments the right way round again.
        return array_map('strrev', $matches);
    }
}
