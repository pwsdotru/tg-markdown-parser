<?php

declare(strict_types=1);

namespace TgMarkdownParser;

class Parser
{
    protected string $_text;
    /** @var array<array<mixed>>  */
    protected array $_entities;
    protected string $_parsed;

    /**
     * Parser constructor.
     * @param string $text
     * @param array<array<mixed>> $entities
     */
    public function __construct(string $text = '', array $entities = [])
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
