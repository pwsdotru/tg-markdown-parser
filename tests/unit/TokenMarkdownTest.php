<?php

declare(strict_types=1);

namespace unit;

use TgMarkdownParser\Token;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use PHPUnit\Framework\Attributes\DataProvider;

final class TokenMarkdownTest extends TestCase
{
    /**
     * @param array<string, mixed> $data
     * @param string $plain
     * @param string $markdown
     */
    #[DataProvider('buildMarkdownSimpleProvider')]
    #[DataProvider('buildMarkdownFunctionsProvider')]
    #[DataProvider('buildMarkdownLinkProvider')]
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
                '*Test text*'
            ],
            [
                ['offset' => 1, 'length' => 1, 'type' => 'italic', 'url' => ''],
                'Test',
                '_Test_'
            ],
            [
                ['offset' => 1, 'length' => 1, 'type' => 'code', 'url' => ''],
                'text',
                '`text`'
            ],
            [
                ['offset' => 1, 'length' => 1, 'type' => 'strikethrough', 'url' => ''],
                'strike',
                '~~strike~~'
            ],
            [
                ['offset' => 1, 'length' => 1, 'type' => 'spoiler', 'url' => ''],
                'hidden under spoiler',
                '||hidden under spoiler||'
            ],
        ];
    }

    /**
     * @param array<string, mixed> $data
     * @param string $plain
     * @param string $markdown
     */
    #[DataProvider('buildMarkdownFunctionsProvider')]
    #[DataProvider('buildMarkdownLinkProvider')]
    public function testBuildMarkdownFunctions(array $data, string $plain, string $markdown): void
    {
        $obj = new Token($data);
        $this->assertEquals($markdown, $this->runProtectedMethod($obj, 'buildMarkdownFunctions', $plain));
    }

    /**
     * @return array<int, array<int, mixed>>
     */
    public static function buildMarkdownFunctionsProvider(): array
    {
        return [
            [
                ['offset' => 1, 'length' => 1, 'type' => 'pre', 'url' => ''],
                'Test text',
                "```\nTest text\n```\n"
            ],
        ];
    }

    /**
     * @param array<string, mixed> $data
     * @param string $plain
     * @param string $markdown
     */
    #[DataProvider('buildMarkdownLinkProvider')]
    public function testBuildMarkdownLink(array $data, string $plain, string $markdown): void
    {
        $obj = new Token($data);
        $this->assertEquals($markdown, $this->runProtectedMethod($obj, 'buildMarkdownLink', $plain));
    }

    /**
     * @return array<int, array<int, mixed>>
     */
    public static function buildMarkdownLinkProvider(): array
    {
        return [
            [
                ['offset' => 1, 'length' => 1, 'type' => 'text_link', 'url' => 'http://site.com'],
                'link',
                "[link](http://site.com)"
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
