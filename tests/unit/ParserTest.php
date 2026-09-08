<?php

declare(strict_types=1);

namespace unit;

use TgMarkdownParser\Parser;
use PHPUnit\Framework\TestCase;

final class ParserTest extends TestCase
{
    public function testContructDefault(): void
    {
        $obj = new Parser();
        $this->assertEquals('', $obj->getText());
    }

    public function testGetText(): void
    {
        $text = "Test text";
        $obj = new Parser($text);
        $this->assertEquals($text, $obj->getText());
    }
}
