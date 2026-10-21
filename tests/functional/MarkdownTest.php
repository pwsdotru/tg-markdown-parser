<?php

declare(strict_types=1);

namespace functional;

use TgMarkdownParser\Parser;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class MarkdownTest extends TestCase
{
    #[DataProvider('examplesProvider')]
    public function testExamples(string $num): void
    {
        global $entities;
        $dir = dirname(__DIR__, 2) . '/examples';
        $entities_filename = sprintf('%s/example%s.php', $dir, $num);
        $text_filename = sprintf('%s/example%s.txt', $dir, $num);
        $markdown_filename = sprintf('%s/example%s.md', $dir, $num);

        require_once($entities_filename);
        $plain_text = file_get_contents($text_filename);


        $parser = new Parser($plain_text, $entities);
        $parser->parse();

        $this->assertStringEqualsFile($markdown_filename, $parser->getMarkdown());
    }

    public static function examplesProvider(): array
    {
        return [
          ['00'],
          ['01'],
        ];
    }
}
