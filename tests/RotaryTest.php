<?php


use AlwaysBlank\Rotary\Rotary;
use PHPUnit\Framework\TestCase;

class RotaryTest extends TestCase
{
    public $testNumber = '1234567890';

    public function potentialNumbers(?string $type): array
    {
        $db = [
            '1234567890' => [
                'desc' => 'Valid number with no intl',
                'normal' => '1234567890',
                'pretty' => '(123) 456-7890',
                'href' => 'tel:+11234567890',
                'simple' => '123 456-7890',
            ],
            '1234567' => [
                'desc' => 'Valid number with no intl or area',
                'normal' => '1234567',
                'pretty' => '123-4567',
                'href' => 'tel:1234567',
                'simple' => '123-4567',
            ],
            '771234567890' => [
                'desc' => 'Valid number with intl and area',
                'normal' => '771234567890',
                'pretty' => '77 (123) 456-7890',
                'href' => 'tel:+771234567890',
                'simple' => '77 123 456-7890',
            ],
            '12345678' => [
                'desc' => 'Invalid number that should fail',
                'normal' => '',
                'pretty' => '',
                'href' => 'tel:',
                'simple' => '',
            ],
        ];

        if (!in_array($type, ['normal', 'pretty', 'simple', 'href'])) {
            return $db;
        }

        $return = [];
        foreach ($db as $test => $types) {
            $return[$types['desc']] = [$test, $types[$type]];
        }

        return $return;
    }

    public function testCanBeInstantiated(): void
    {
        $rotary = new Rotary($this->testNumber);
        $this->assertInstanceOf(Rotary::class, $rotary);
    }

    public function providePrettyOutput(): array
    {
        return $this->potentialNumbers('pretty');
    }

    /**
     * @dataProvider providePrettyOutput
     */
    public function testPrettyOutput($test, $expected): void
    {
        $rotary = new Rotary($test);
        $this->assertEquals($expected, $rotary->pretty());
    }

    public function provideHrefOutput(): array
    {
        return $this->potentialNumbers('href');
    }

    /**
     * @dataProvider provideHrefOutput
     * @param $test
     * @param $expected
     */
    public function testHrefOutput($test, $expected): void
    {
        $rotary = new Rotary($test);
        $this->assertEquals($expected, $rotary->href());
    }

    public function provideSimpleOutput(): array
    {
        return $this->potentialNumbers('simple');
    }

    /**
     * @dataProvider provideSimpleOutput
     * @param $test
     * @param $expected
     */
    public function testSimpleOutput($test, $expected): void
    {
        $rotary = new Rotary($test);
        $this->assertEquals($expected, $rotary->simple());
    }

    public function provideNormalizedOutput(): array
    {
        return $this->potentialNumbers('normal');
    }

    /**
     * @dataProvider provideNormalizedOutput
     * @param $test
     * @param $expected
     */
    public function testNormalizedOutput($test, $expected): void
    {
        $rotary = new Rotary($test);
        $this->assertEquals($expected, $rotary->normalized());;
    }

    public function testFormattedOutput(): void
    {
        $rotary = new Rotary($this->testNumber);
        $this->assertEquals(
            $rotary->format(function ($Number) {
                return '%area%!%first%!%second%';
            }),
            '123!456!7890'
        );
    }

    public function testBadInput(): void
    {
        $rotary = new Rotary('');
        $this->assertEquals(
            '',
            $rotary->pretty()
        );
    }
}
