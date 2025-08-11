<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

declare(strict_types=1);

namespace pvc\testingutils\testingTraits;

use PHPUnit\Framework\MockObject\MockObject;
use stdClass;

/**
 * Trait ArrayAccessTrait
 */
trait ArrayAccessTrait
{

    /**
     * mockArrayAccess
     * @param MockObject $mock
     * @param array<mixed> $items
     * @return MockObject
     */
    public function mockArrayAccess(MockObject $mock, array $items): MockObject
    {
        $arrayAccessData = new stdClass();
        $arrayAccessData->array = $items;

        $mock->method('offsetExists')->willReturnCallback(
            fn($arg): bool => isset($arrayAccessData->array[$arg])
        );

        $mock->method('offsetGet')->willReturnCallback(
            fn($arg) => $arrayAccessData->array[$arg]
        );

        $mock->method('offsetSet')->willReturnCallback(
            fn($arg, $value) => $arrayAccessData->array[$arg] = $value
        );

        $mock->method('offsetUnset')->willReturnCallback(
            function ($arg) use ($arrayAccessData): void {
                unset($arrayAccessData->array[$arg]);
            }
        );

        return $mock;
    }
}
