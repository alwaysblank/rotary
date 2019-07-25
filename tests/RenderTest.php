<?php

use AlwaysBlank\Rotary\Render;
use PHPUnit\Framework\TestCase;

final class RenderTest extends TestCase
{
    public function testHandleVariedInput(): void
    {
        $expected = '1234567890';
        $this->assertEquals(
            $expected,
            Render::normalized('1234567890')
        );
        $this->assertEquals(
            $expected,
            Render::normalized('(123) 456-7890')
        );
        $this->assertEquals(
            $expected,
            Render::normalized('[123)    456/7890')
        );
    }

    public function testGetNormalizedNumber(): void
    {
        $this->assertEquals(
            '1234567890',
            Render::normalized('1234567890')
        );
        $this->assertEquals(
            '4567890',
            Render::normalized('4567890')
        );
    }

    public function testGetPrettyNumber(): void
    {
        $this->assertEquals(
            '(123) 456-7890',
            Render::pretty('1234567890')
        );
        $this->assertEquals(
            '456-7890',
            Render::pretty('4567890')
        );
    }

    public function testGetSimpleNumber(): void
    {
        $this->assertEquals(
            '123 456-7890',
            Render::simple('1234567890')
        );
        $this->assertEquals(
            '456-7890',
            Render::simple('4567890')
        );
    }

    public function testGetHrefNumber(): void
    {
        $this->assertEquals(
            'tel:+11234567890',
            Render::href('1234567890')
        );
        $this->assertEquals(
            'tel:4567890',
            Render::href('4567890')
        );
    }

    public function testGetNullValueWhenNumberInvalid(): void
    {
        $this->assertEquals(
            '',
            Render::render(function ($Number) {
                return 'template';
            }, [])
        );
    }
}