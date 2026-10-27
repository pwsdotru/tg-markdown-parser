<?php

declare(strict_types=1);

namespace TgMarkdownParser;

class Token
{
    private int $_offset;
    private int $_length;
    private string $_type;
    private string $_url;

    private const SIMPLE = [
        "bold" => "*",
        "italic" => "_",
        "code" => "`",
        "strikethrough" => "~~",
        "spoiler" => "||",
    ];

    private const TAGS = [
        "bold" => "b",
        "italic" => "i",
        "code" => "code",
        "strikethrough" => "s",
        "underline" => "u",
    ];

    private const FUNCTIONS = [
        "pre" => "buildMarkdownPre",
        "text_link" => "buildMarkdownLink",
    ];

    /**
     * @param array <string, mixed> $data
     */
    public function __construct(array $data)
    {
        $this->_type = $data['type'];
        $this->_length = $data['length'];
        $this->_offset = $data['offset'];
        $this->_url = $data['url'];
    }

    /**
     * @param int $start
     * @param int $length
     */
    public static function buildPlain(int $start, int $length): self
    {
        $blank = [
            'type' => 'plain',
            'offset' => $start,
            'length' => $length,
            'url' => '',
        ];
        return new self($blank);
    }

    public function buildMarkdown(string $text): string
    {
        if ("plain" === $this->_type) {
            return $text;
        }
        if (array_key_exists($this->_type, self::SIMPLE)) {
            return $this->buildMarkdownSimple($text);
        }
        if (array_key_exists($this->_type, self::FUNCTIONS)) {
            return $this->buildMarkdownFunctions($text);
        }
        return $text;
    }

    public function buildHtml(string $text): string
    {
        if ("plain" === $this->_type) {
            return $text;
        }
        if (array_key_exists($this->_type, self::TAGS)) {
            return $this->buildHtmlTags($text);
        }
        if (array_key_exists($this->_type, self::FUNCTIONS)) {
            return $this->buildMarkdownFunctions($text);
        }
        return $text;
    }

    public function getOffset(): int
    {
        return $this->_offset;
    }

    public function getLength(): int
    {
        return $this->_length;
    }

    public function getType(): string
    {
        return $this->_type;
    }

    public function getUrl(): string
    {
        return $this->_url;
    }

    protected function buildMarkdownSimple(string $text): string
    {
        $mark = self::SIMPLE[$this->_type];
        return $mark . $text . $mark;
    }

    protected function buildHtmlTags(string $text): string
    {
        $tag = self::TAGS[$this->_type];
        return sprintf("<%s>%s</%s>", $tag, $text, $tag);
    }

    protected function buildMarkdownFunctions(string $text): string
    {
        $method = self::FUNCTIONS[$this->_type];
        return $this->$method($text);
    }

    protected function buildMarkdownPre(string $text): string
    {
        return "```\n" . $text . "\n```\n";
    }

    protected function buildMarkdownLink(string $text): string
    {
        return "[" . $text . "](" . $this->_url . ")";
    }
}
