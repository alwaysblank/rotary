<?php


use AlwaysBlank\Rotary\Rotary;
use PHPUnit\Framework\TestCase;

class RotaryTest extends TestCase
{
    public $testNumber = '1234567890';

    public function testCanBeInstantiated(): void
    {
        $rotary = new Rotary($this->testNumber);
        $this->assertInstanceOf(Rotary::class, $rotary);
    }

    public function testPrettyOutput(): void
    {
        $rotary = new Rotary($this->testNumber);
        $this->assertEquals(
            '(123) 456-7890',
            $rotary->pretty()
        );
    }

    public function testHrefOutput(): void
    {
        $rotary = new Rotary($this->testNumber);
        $this->assertEquals(
            'tel:+11234567890',
            $rotary->href()
        );
    }

    public function testSimpleOutput(): void
    {
        $rotary = new Rotary($this->testNumber);
        $this->assertEquals(
            '123 456-7890',
            $rotary->simple()
        );
    }

    public function testNormalizedOutput(): void
    {
        $rotary = new Rotary($this->testNumber);
        $this->assertEquals(
            '1234567890',
            $rotary->normalized()
        );
    }

    public function testFormattedOutput(): void
    {
        $rotary = new Rotary($this->testNumber);
        $this->assertEquals(
            $rotary->format(function($Number) {
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
