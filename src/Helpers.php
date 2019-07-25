<?php

namespace AlwaysBlank\Rotary\Helpers;

use AlwaysBlank\Rotary\Number;

/**
 * Get a Number.
 *
 * @param string $number
 *
 * @return Number
 */
function number(string $number)
{
    return is_int($number) ? Number::dialInt($number) : Number::dial($number);
}

/**
 * Is this a value that we can interpret?
 *
 * @param $number
 *
 * @return bool
 */
function validInput($number)
{
    return is_string($number) || is_int($number);
}