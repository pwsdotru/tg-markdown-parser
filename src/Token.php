<?php

declare(strict_types=1);

namespace TgMarkdownParser;

class Token
{
    private int $_offset;
    private int $_length;
    private string $_type;
    private string $_url;

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
}
