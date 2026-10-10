<?php

declare(strict_types=1);

namespace TgMarkdownParser;

use TgMarkdownParser\Token;
use TgMarkdownParser\Text;

class Parser
{
    protected Text $_text;
    /** @var array<array<mixed>>  */
    protected array $_entities;
    protected string $_parsed;
    /** @var array <Token> */
    protected array $_tokens;

    /**
     * Parser constructor.
     * @param string $text
     * @param array<array<mixed>> $entities
     */
    public function __construct(string $text = '', array $entities = [])
    {
        $this->_text = new Text(trim($text));
        $this->_entities = $entities;
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

    public function getPlainText(): string
    {
        return $this->_text->get();
    }

    public function getPlainTextLen(): int
    {
        return $this->_text->length();
    }

    /**
     * @return array<Token>
     */
    public function getTokens(): array
    {
        return $this->_tokens;
    }

    public function getMarkdown(): string
    {
        return $this->_parsed;
    }

    public function parse(): bool
    {
        $this->_parsed = '';
        $this->_tokens = [];
        if (0 < count($this->_entities)) {
            $this->sortEntities();
            $this->buildTokens();
            $this->buildResult();
        } else {
            $this->_parsed = $this->_text->get();
        }
        return true;
    }

    protected function buildResult(): void
    {
        $this->_parsed = "";
        /** @var Token $token */
        foreach ($this->_tokens as $token) {
            $this->_parsed .= $this->_text->substr($token->getOffset(), $token->getLength());
        }
    }
    protected function buildTokens(): void
    {
        $start = 0;
        foreach ($this->_entities as $e) {
            if ($start < $e['offset']) {
                $this->_tokens[] = Token::buildPlain($start, (int)$e['offset'] - $start);
                $start = (int)$e['offset'];
            }
            $this->_tokens[] = new Token($e);
            $start += (int)$e['length'];
        }
        $length = $this->getPlainTextLen();
        if ($start < $length) {
            $this->_tokens[] = Token::buildPlain($start, $length - $start);
        }
    }

    protected function sortEntities(): void
    {
        usort($this->_entities, function ($a, $b): int {
            return $a['offset'] <=> $b['offset'];
        });
    }
}
