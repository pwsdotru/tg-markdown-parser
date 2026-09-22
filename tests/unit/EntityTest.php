<?php

declare(strict_types=1);

namespace unit;

use TgMarkdownParser\Entity;
use PHPUnit\Framework\TestCase;
use ReflectionClass;
use PHPUnit\Framework\Attributes\DataProvider;

final class EntityTest extends TestCase
{
    public function testContructData(): void
    {
        $data = ['offset' => 1, 'length' => 10, 'type' => 'bold', 'url' => ''];
        $obj = new Entity($data);
        $this->assertEquals(1, $this->getPrivateProperty($obj, '_offset'));
        $this->assertEquals(10, $this->getPrivateProperty($obj, '_length'));
        $this->assertEquals('bold', $this->getPrivateProperty($obj, '_type'));
        $this->assertEquals('', $this->getPrivateProperty($obj, '_url'));
    }

    /**
     * @return mixed
     */
    protected function getPrivateProperty(Entity $obj, string $propertyName)
    {
        $reflectionClass = new ReflectionClass($obj);
        $property = $reflectionClass->getProperty($propertyName);
        $property->setAccessible(true);
        return $property->getValue($obj);
    }
}
