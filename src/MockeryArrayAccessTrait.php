<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

namespace pvc\testingTraits;

use Mockery;
use stdClass;

/**
 * Trait MockeryArrayAccessTrait
 */
trait MockeryArrayAccessTrait {

    public function mockArrayAccess(Mockery\MockInterface $mock, array $items) {

        $arrayAccessData = new stdClass();

        foreach ($items as $key => $value) {
            $arrayAccessData->array[$key] = $value;
        }

        $arrayIndexValidator = function () {
            return (Mockery::type('int') || Mockery::type('string'));
        };

        $mock->shouldReceive('offsetExists')->withArgs($arrayIndexValidator)
             ->andReturnUsing(function ($arg) use ($arrayAccessData) {
                 return isset($arrayAccessData->array[$arg]);
             });
        $mock->shouldReceive('offsetGet')->withArgs($arrayIndexValidator)
             ->andReturnUsing(function ($arg) use ($arrayAccessData) {
                 return $arrayAccessData->array[$arg];
             });
        $mock->shouldReceive('offsetSet')->withArgs($arrayIndexValidator)
             ->andReturnUsing(function ($arg, $value) use ($arrayAccessData) {
                 return $arrayAccessData->array[$arg] = $value;
             });
        $mock->shouldReceive('offsetUnset')->withArgs($arrayIndexValidator)
             ->andReturnUsing(function ($arg) use ($arrayAccessData) {
                 unset($arrayAccessData->array[$arg]);
             });

        return $mock;
    }
}