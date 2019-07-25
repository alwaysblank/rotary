<?php

namespace AlwaysBlank\Rotary;

class Number
{
    public $area   = false;
    public $first  = false;
    public $second = false;

    /**
     * Assign segments to properties.
     *
     * Number constructor.
     *
     * @param string $number
     */
    private function __construct(string $number)
    {
        foreach (Parse::parse($number) as $segment => $value) {
            $this->$segment = $value;
        }
    }

    /**
     * Create a Number from a string.
     *
     * @param string $number
     *
     * @return Number
     */
    public static function dial(string $number): Number
    {
        return new Number($number);
    }

    /**
     * Created a Number from an integer.
     *
     * @param int $number
     *
     * @return Number
     */
    public static function dialInt(int $number): Number
    {
        return new Number((string)$number);
    }

    /**
     * Prevent changing set values.
     *
     * @param $name
     * @param $value
     *
     * @throws \Exception
     */
    final function __set($name, $value): void
    {
        throw new \Exception("Can't set properties!");
    }

    /**
     * Get values as array.
     *
     * @return array
     */
    public function array(): array
    {
        return (array)$this;
    }
}