<?php

use AlwaysBlank\Rotary\Render;
use PHPUnit\Framework\TestCase;

final class RenderTest extends TestCase
{
    public function testGetNormalizedNumber(): void
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

    public function testGetPrettyNumber(): void
    {
        $expected = '(123) 456-7890';
        $this->assertEquals(
            $expected,
            Render::pretty('1234567890')
        );
        $this->assertEquals(
            $expected,
            Render::pretty('(123) 456-7890')
        );
        $this->assertEquals(
            $expected,
            Render::pretty('[123)    456/7890')
        );
    }

    public function testGetSimpleNumber(): void
    {
        $expected = '123 456-7890';
        $this->assertEquals(
            $expected,
            Render::simple('1234567890')
        );
        $this->assertEquals(
            $expected,
            Render::simple('(123) 456-7890')
        );
        $this->assertEquals(
            $expected,
            Render::simple('[123)    456/7890')
        );
    }

    public function testGetHrefNumber(): void
    {
        $expected = 'tel:1234567890';
        $this->assertEquals(
            $expected,
            Render::href('1234567890')
        );
        $this->assertEquals(
            $expected,
            Render::href('(123) 456-7890')
        );
        $this->assertEquals(
            $expected,
            Render::href('[123)    456/7890')
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