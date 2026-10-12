<?php

declare(strict_types=1);

namespace unit;

use TgMarkdownParser\Token;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use PHPUnit\Framework\Attributes\DataProvider;

final class TokenTest extends TestCase
{
    public function testContructData(): void
    {
        $data = ['offset' => 1, 'length' => 10, 'type' => 'bold', 'url' => ''];
        $obj = new Token($data);
        $this->assertEquals(1, $this->getPrivateProperty($obj, '_offset'));
        $this->assertEquals(10, $this->getPrivateProperty($obj, '_length'));
        $this->assertEquals('bold', $this->getPrivateProperty($obj, '_type'));
        $this->assertEquals('', $this->getPrivateProperty($obj, '_url'));
    }

    /**
     * @param array<string, mixed> $data
     * @param string $plain
     * @param string $markdown
     */
    #[DataProvider('buildMarkdownSimpleProvider')]
    #[DataProvider('buildMarkdownProvider')]
    public function testBuildMarkdown(array $data, string $plain, string $markdown): void
    {
        $obj = new Token($data);
        $this->assertEquals($markdown, $this->runProtectedMethod($obj, 'buildMarkdown', $plain));
    }

    /**
     * @return array<int, array<int, mixed>>
     */
    public static function buildMarkdownProvider(): array
    {
        return [
            [
                ['offset' => 1, 'length' => 1, 'type' => 'plain', 'url' => ''],
                'Test text',
                'Test text'
            ],
        ];
    }

    /**
     * @param array<string, mixed> $data
     * @param string $plain
     * @param string $markdown
     */
    #[DataProvider('buildMarkdownSimpleProvider')]
    public function testBuildMarkdownSimple(array $data, string $plain, string $markdown): void
    {
        $obj = new Token($data);
        $this->assertEquals($markdown, $this->runProtectedMethod($obj, 'buildMarkdownSimple', $plain));
    }

    /**
     * @return array<int, array<int, mixed>>
     */
    public static function buildMarkdownSimpleProvider(): array
    {
        return [
            [
                ['offset' => 1, 'length' => 1, 'type' => 'bold', 'url' => ''],
                'Test text',
                '**Test text**'
            ],
            [
                ['offset' => 1, 'length' => 1, 'type' => 'italic', 'url' => ''],
                'Test',
                '*Test*'
            ],
            [
                ['offset' => 1, 'length' => 1, 'type' => 'code', 'url' => ''],
                'text',
                '`text`'
            ],
        ];
    }

    protected function runProtectedMethod(Token $obj, string $methodName, string $arg): string
    {
        $reflectionClass = new ReflectionClass($obj);
        $method = $reflectionClass->getMethod($methodName);
        $method->setAccessible(true);
        return $method->invoke($obj, $arg);
    }


    /**
     * @return mixed
     */
    protected function getPrivateProperty(Token $obj, string $propertyName)
    {
        $reflectionClass = new ReflectionClass($obj);
        $property = $reflectionClass->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }
}
