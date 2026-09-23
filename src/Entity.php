<?php

declare(strict_types=1);

namespace TgMarkdownParser;

class Entity
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
