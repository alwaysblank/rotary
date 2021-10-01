<?php

namespace AlwaysBlank\Rotary;

class Number
{
    protected $intl   = false;
    protected $area   = false;
    protected $first  = false;
    protected $second = false;

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
            if (!empty($value)) {
                $this->$segment = $value;
            }
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
        throw new \Exception("Can't set $name");
    }

    /**
     * Since segments are protected, we need this to get at them.
     *
     * @param $name
     *
     * @return mixed
     */
    final function __get($name)
    {
        return $this->$name;
    }

    /**
     * Get values as array.
     *
     * @return array
     */
    public function array(): array
    {
        $array = [];
        foreach ($this as $name => $value) {
            $array[$name] = $value;
        }

        return $array;
    }
}
