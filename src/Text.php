<?php

declare(strict_types=1);

namespace TgMarkdownParser;

class Text
{
    protected string $_text;

    public function __construct(string $text = '')
    {
        $this->_text = $text;
    }

    public function get(): string
    {
        return $this->_text;
    }

    public function length(): int
    {
        return strlen($this->_text);
    }
}
