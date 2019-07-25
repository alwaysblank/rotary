<?php

use AlwaysBlank\Rotary\Parse;
use PHPUnit\Framework\TestCase;

final class ParseTest extends TestCase
{
    public function testReturnEmptyExtractedArrayOnBadInput(): void
    {
        $extracted = Parse::extract(3);
        $this->assertEmpty($extracted);
    }

    public function testReturnEmptyParsedArrayOnBadInput(): void
    {
        $parsed = Parse::parse(3);
        $this->assertEmpty($parsed);
    }
}