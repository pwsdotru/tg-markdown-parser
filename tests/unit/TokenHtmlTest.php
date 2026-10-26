<?php

declare(strict_types=1);

namespace unit;

use TgMarkdownParser\Token;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use PHPUnit\Framework\Attributes\DataProvider;

final class TokenHtmlTest extends TestCase
{
    /**
     * @param array<string, mixed> $data
     * @param string $plain
     * @param string $html
     */
    #[DataProvider('buildHtmlTagsProvider')]
    #[DataProvider('buildHtmlProvider')]
    public function testBuildHtml(array $data, string $plain, string $html): void
    {
        $obj = new Token($data);
        $this->assertEquals($html, $this->runProtectedMethod($obj, 'buildHtml', $plain));
    }

    /**
     * @return array<int, array<int, mixed>>
     */
    public static function buildHtmlProvider(): array
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
     * @param string $html
     */
    #[DataProvider('buildHtmlTagsProvider')]
    public function testBuildHtmlTags(array $data, string $plain, string $html): void
    {
        $obj = new Token($data);
        $this->assertEquals($html, $this->runProtectedMethod($obj, 'buildHtmlTags', $plain));
    }

    /**
     * @return array<int, array<int, mixed>>
     */
    public static function buildHtmlTagsProvider(): array
    {
        return [
            [
                ['offset' => 1, 'length' => 1, 'type' => 'bold', 'url' => ''],
                'Test text',
                '<b>Test text</b>'
            ],
            [
                ['offset' => 1, 'length' => 1, 'type' => 'italic', 'url' => ''],
                'Test',
                '<i>Test</i>'
            ],
            [
                ['offset' => 1, 'length' => 1, 'type' => 'code', 'url' => ''],
                'text',
                '<code>text</code>'
            ],
            [
                ['offset' => 1, 'length' => 1, 'type' => 'strike', 'url' => ''],
                'strike',
                '<s>strike</s>'
            ],
            [
                ['offset' => 1, 'length' => 1, 'type' => 'underline', 'url' => ''],
                'underline text',
                '<u>underline text</u>'
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
}
