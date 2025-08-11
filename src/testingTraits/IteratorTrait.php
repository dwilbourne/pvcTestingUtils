<?php

declare (strict_types=1);
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

namespace pvc\testingutils\testingTraits;

use PHPUnit\Framework\MockObject\MockObject;
use stdClass;

trait IteratorTrait
{
    /**
     * makeMockIterableOverArray
     * @param  MockObject  $mock
     * @param  array<mixed>  $items
     *
     * @return void
     */
    public function makeMockIterableOverArray(
        MockObject $mock,
        array $items
    ): void {
        $iteratorData = new stdClass();
        $iteratorData->array = $items;
        $iteratorData->position = 0;

        $mock->method('rewind')->with()->willReturnCallback(
            function () use ($iteratorData): void {
                $iteratorData->position = 0;
            }
        );

        $mock->method('current')->with()->willReturnCallback(
            fn() => $iteratorData->array[$iteratorData->position]
        );

        $mock->method('key')->with()->willReturnCallback(
            fn(): int => $iteratorData->position
        );

        $mock->method('next')->with()->willReturnCallback(
            function () use ($iteratorData): void {
                $iteratorData->position++;
            }
        );

        $mock->method('valid')->with()->willReturnCallback(
            fn(): bool => isset($iteratorData->array[$iteratorData->position])
        );
    }
}
