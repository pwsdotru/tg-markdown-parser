<?php

declare(strict_types=1);

namespace TgMarkdownParser;

class Parser
{
    protected $_text;
    protected $_entities;
    protected $_parsed;

    public function __construct(string $text = '', ?array $entities = null)
    {
        $this->_text = trim($text);
        $this->_entities = $entities;
        $this->_parsed = '';
    }

    public function getText(): string
    {
        return $this->_text;
    }

    public function getMarkdown(): string
    {
        return $this->_parsed;
    }

    public function parse(): bool
    {
        $this->_parsed = $this->_text;
        return true;
    }
}
