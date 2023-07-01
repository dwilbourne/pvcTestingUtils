<?php

declare (strict_types=1);
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

namespace pvc\testingutils\testingTraits\phpunit;

use PHPUnit\Framework\MockObject\MockObject;
use stdClass;

trait PhpunitIteratorTrait
{
    public function mockIterator(MockObject $mock, array $items): MockObject
    {
        $iteratorData = new stdClass();
        $iteratorData->array = $items;
        $iteratorData->position = 0;

        $mock->method('rewind')->with()->will($this->returnCallback(
            function () use ($iteratorData) {
                $iteratorData->position = 0;
            }
        ));

        $mock->method('current')->with()->will($this->returnCallback(
            function () use ($iteratorData) {
                return $iteratorData->array[$iteratorData->position];
            }
        ));

        $mock->method('key')->with()->will($this->returnCallback(
            function () use ($iteratorData) {
                return $iteratorData->position;
            }
        ));

        $mock->method('next')->with()->will($this->returnCallback(
            function () use ($iteratorData) {
                $iteratorData->position++;
            }
        ));

        $mock->method('valid')->with()->will($this->returnCallback(
            function () use ($iteratorData) {
                return isset($iteratorData->array[$iteratorData->position]);
            }
        ));

        return $mock;
    }
}
