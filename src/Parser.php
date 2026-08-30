<?php

declare(strict_types=1);

namespace TgMarkdownParser;

class Parser
{
    protected $_text;
    protected $_entities;

    public function __construct(string $text = '', ?array $entities = null)
    {
        $this->_text = trim($text);
        $this->_entities = $entities;
    }

    public function getText(): string
    {
        return $this->_text;
    }
}
