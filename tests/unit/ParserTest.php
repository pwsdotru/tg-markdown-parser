<?php

declare(strict_types=1);

namespace unit;

use TgMarkdownParser\Parser;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
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
            [
                [
                    ['offset' => 20, 'length' => 10, 'type' => 'bold'],
                    ['offset' => 45, 'length' => 2, 'type' => 'underline'],
                ],
                [
                    ['offset' => 20, 'length' => 10, 'type' => 'bold'],
                    ['offset' => 45, 'length' => 2, 'type' => 'underline'],
                ]
            ],
            [
                [
                    ['offset' => 45, 'length' => 2, 'type' => 'underline'],
                    ['offset' => 20, 'length' => 10, 'type' => 'bold'],
                ],
                [
                    ['offset' => 20, 'length' => 10, 'type' => 'bold'],
                    ['offset' => 45, 'length' => 2, 'type' => 'underline'],
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
        $this->runProtectedMethod($obj, "sortEntities");
        $this->assertEquals($expected, $this->getPrivateProperty($obj, "_entities"));
    }

    protected function runProtectedMethod(Parser $obj, string $methodName): void
    {
        $reflectionClass = new ReflectionClass($obj);
        $method = $reflectionClass->getMethod($methodName);
        $method->setAccessible(true);
        $method->invoke($obj);
    }

    /**
     * @return mixed
     */
    protected function getPrivateProperty(Parser $obj, string $propertyName)
    {
        $reflectionClass = new ReflectionClass($obj);
        $property = $reflectionClass->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }
}
