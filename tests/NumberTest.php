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
        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Can't set area");
        $Number = Number::dial('1234567890');
        $Number->area = '890';
    }

    public function testGetArrayOfSegments(): void
    {
        $Number = Number::dial('11234567890');
        $this->assertEquals(
            [
                'intl' => '1',
                'area' => '123',
                'first' => '456',
                'second' => '7890',
            ],
            $Number->array()
        );
    }

    public function testCountryCodeSupport(): void
    {
        $Number = Number::dial('18001234567');
        $this->assertEquals(
            1,
            $Number->intl
        );
        $this->assertEquals(
            800,
            $Number->area
        );
        $this->assertEquals(
            123,
            $Number->first
        );
        $this->assertEquals(
            4567,
            $Number->second
        );

        $NumberAlt = Number::dial('2238001234567');
        $this->assertEquals(
            223,
            $NumberAlt->intl
        );
        $this->assertEquals(
            800,
            $NumberAlt->area
        );
        $this->assertEquals(
            123,
            $NumberAlt->first
        );
        $this->assertEquals(
            4567,
            $NumberAlt->second
        );
    }
}
