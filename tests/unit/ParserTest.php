<?php

declare(strict_types=1);

namespace unit;

use TgMarkdownParser\Parser;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

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

    /**
     * @return array<array<mixed>, array<mixed>>
     */
    public static function sortEntitiesProvider(): array
    {
        return [
            [
                [],
                [],
            ],
            [
                [
                    ['offset' => 20, 'length' => 10, 'type' => 'bold'],
                ],
                [
                    ['offset' => 20, 'length' => 10, 'type' => 'bold'],
                ]
            ],
        ];
    }

    /**
     * @param array<array<mixed>> $input
     * @param array<array<mixed>> $expected
     */
    #[DataProvider('sortEntitiesProvider')]
    public function testSortEntities(array $input, array $expected): void
    {
        $obj = new Parser("", $input);
        $this->assertEquals($expected, $obj->getEntities());
    }
}
