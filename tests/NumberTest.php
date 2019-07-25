<?php
declare(strict_types=1);

use AlwaysBlank\Rotary\Number;
use PHPUnit\Framework\TestCase;

final class NumberTest extends TestCase
{
    public function testCanBeCreated(): void
    {
        $Number = Number::dial('1234567890');
        $NumberInt = Number::dialInt(1234567890);

        $this->assertInstanceOf(
            Number::class,
            $Number
        );
        $this->assertInstanceOf(
            Number::class,
            $NumberInt
        );
    }

    public function testSegmentsCorrectlySet(): void
    {
        $Number = Number::dial('1234567890');
        $this->assertEquals(
            '123',
            $Number->area
        );
        $this->assertEquals(
            '456',
            $Number->first
        );
        $this->assertEquals(
            '7890',
            $Number->second
        );
    }

    public function testCannotSetSegmentsManually(): void
    {
//        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Can't set properties");
        $Number = Number::dial('1234567890');
        $Number->area = '890';
    }
}