<?php

declare(strict_types=1);

global $entities;

require_once(__DIR__ . "/vendor/autoload.php");

use TgMarkdownParser\Parser;

$example = "00";

$ent = sprintf(__DIR__ . "/examples/example%s.php", $example);

require_once($ent);

$text = sprintf(__DIR__ . "/examples/example%s.txt", $example);

$parser = new Parser(file_get_contents($text), $entities);

$parser->parse();

echo("Done:\n");
echo($parser->getMarkdown());
echo("\n");
