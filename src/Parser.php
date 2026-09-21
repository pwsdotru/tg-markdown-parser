<?php

declare(strict_types=1);

namespace TgMarkdownParser;

use TgMarkdownParser\Entity;

class Parser
{
    protected string $_text;
    /** @var array<array<mixed>>  */
    protected array $_entities;
    protected string $_parsed;
    /** @var array <int, Entity> */
    protected array $_tokens;

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

    /**
     * @param array<array<mixed>> $entities
     * @return $this
     */
    public function setEntities(array $entities): self
    {
        $this->_entities = $entities;
        return $this;
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
        if (0 < count($this->_entities)) {
            $this->sortEntities();
            $this->buildTokens();
        } else {
            $this->_parsed = $this->_text;
        }
        return true;
    }

    protected function buildTokens(): void
    {
        $this->_tokens = [];
        foreach ($this->_entities as $e) {
            $this->_tokens[] = new Entity($e);
        }
    }

    protected function sortEntities(): void
    {
        usort($this->_entities, function ($a, $b): int {
            return $a['offset'] <=> $b['offset'];
        });
    }
}
