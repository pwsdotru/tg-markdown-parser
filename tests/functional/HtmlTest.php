<?php

declare(strict_types=1);

namespace functional;

use TgMarkdownParser\Parser;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;

final class HtmlTest extends TestCase
{
    #[DataProvider('examplesProvider')]
    public function testExamples(string $num): void
    {
        global $entities;
        $dir = dirname(__DIR__, 2) . '/examples/html';
        $entities_filename = sprintf('%s/example%s.php', $dir, $num);
        $text_filename = sprintf('%s/example%s.txt', $dir, $num);
        $html_filename = sprintf('%s/example%s.html', $dir, $num);

        require_once($entities_filename);
        $plain_text = file_get_contents($text_filename);


        $parser = new Parser($plain_text, $entities);
        $parser->parse('html');

        $this->assertStringEqualsFile($html_filename, $parser->getMarkdown());
    }

    public static function examplesProvider(): array
    {
        return [
          ['02'],
        ];
    }
}
