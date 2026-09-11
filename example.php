<?php

declare(strict_types=1);

echo("Start\n");

global $entities;

require_once(__DIR__ . "/vendor/autoload.php");

use TgMarkdownParser\Parser;

if (array_key_exists(1, $argv)) {
    $example = trim($argv[1]);
} else {
    $example = "00";
}

$ent = sprintf(__DIR__ . "/examples/example%s.php", $example);
echo("Including file to entities: " . $ent . "\n");
require_once($ent);

$text = sprintf(__DIR__ . "/examples/example%s.txt", $example);

echo("Reading plain text: " . $text . "n");
$parser = new Parser(file_get_contents($text), $entities);

echo("Parsing\n");
$parser->parse();

echo("\nDone\nResult:\n---\n");
echo($parser->getMarkdown());
echo("\n---\n");
