<?php

declare(strict_types=1);

namespace unit;

use TgMarkdownParser\Text;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use PHPUnit\Framework\Attributes\DataProvider;

final class TextTest extends TestCase
{
    public function testContruct(): void
    {
        $obj = new Text('test');
        $this->assertEquals('test', $this->getPrivateProperty($obj, '_text'));
    }


    #[DataProvider('getProvider')]
    public function testGet(string $text): void
    {
        $obj = new Text($text);
        $this->assertEquals($text, $obj->get());
    }

    /**
     * @return array<int, array<int, string>>
     */
    public static function getProvider(): array
    {
        return [
            ["text"],
            [""],
        ];
    }

    #[DataProvider('lengthProvider')]
    public function testLength(string $text, int $length): void
    {
        $obj = new Text($text);
        $this->assertEquals($length, $obj->length());
    }

    /**
     * @return array<int, array<int, int|string>>
     */
    public static function lengthProvider(): array
    {
        return [
            ["Test text", 9],
            ["", 0],
        ];
    }

    /**
     * @return mixed
     */
    protected function getPrivateProperty(Text $obj, string $propertyName)
    {
        $reflectionClass = new ReflectionClass($obj);
        $property = $reflectionClass->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }
}
