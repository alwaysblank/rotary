<?php

namespace AlwaysBlank\Rotary;

use AlwaysBlank\Rotary\Number;

class Helpers
{
    /**
     * Get a Number.
     *
     * @param string $number
     *
     * @return Number
     */
    public static function number(string $number): Number
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
    public static function validInput($number)
    {
        return is_string($number) || is_int($number);
    }
}