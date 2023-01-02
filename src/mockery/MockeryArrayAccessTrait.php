<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

namespace pvc\testingTraits\mockery;

use Mockery\MockInterface;
use stdClass;

/**
 * Trait MockeryArrayAccessTrait
 */
trait MockeryArrayAccessTrait
{

    /**
     * mockArrayAccess
     * @param MockInterface $mock
     * @param array $items
     * @return MockInterface
     */
    public function mockArrayAccess(MockInterface $mock, array $items): MockInterface
    {
        $arrayAccessData = new stdClass();

        foreach ($items as $key => $value) {
            $arrayAccessData->array[$key] = $value;
        }

        $mock->shouldReceive('offsetExists')->andReturnUsing(
            function ($arg) use ($arrayAccessData) {
                return isset($arrayAccessData->array[$arg]);
            }
        );

        $mock->shouldReceive('offsetGet')->andReturnUsing(
            function ($arg) use ($arrayAccessData) {
                return $arrayAccessData->array[$arg];
            }
        );

        $mock->shouldReceive('offsetSet')->andReturnUsing(
            function ($arg, $value) use ($arrayAccessData) {
                return $arrayAccessData->array[$arg] = $value;
            }
        );

        $mock->shouldReceive('offsetUnset')->andReturnUsing(
            function ($arg) use ($arrayAccessData) {
                unset($arrayAccessData->array[$arg]);
            }
        );

        return $mock;
    }
}
