<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

namespace pvc\testingutils\testingTraits\mockery;

use Mockery\MockInterface;
use stdClass;

/**
 * Trait MockIteratorTrait.  Also implements Countable.
 */
trait MockeryIteratorTrait
{

    /**
     * mockIterator
     * @param MockInterface $mock
     * @param array $items
     * @return MockInterface
     */
    public function mockIterator(MockInterface $mock, array $items): MockInterface
    {
        $iteratorData = new stdClass();
        $iteratorData->array = $items;
        $iteratorData->position = 0;

        $mock->shouldReceive('rewind')->withNoArgs()->andReturnUsing(
            function () use ($iteratorData) {
                $iteratorData->position = 0;
            }
        );
        $mock->shouldReceive('current')->withNoArgs()->andReturnUsing(
            function () use ($iteratorData) {
                return $iteratorData->array[$iteratorData->position];
            }
        );
        $mock->shouldReceive('key')->withNoArgs()->andReturnUsing(
            function () use ($iteratorData) {
                return $iteratorData->position;
            }
        );
        $mock->shouldReceive('next')->withNoArgs()->andReturnUsing(
            function () use ($iteratorData) {
                $iteratorData->position++;
            }
        );
        $mock->shouldReceive('valid')->withNoArgs()->andReturnUsing(
            function () use ($iteratorData) {
                return isset($iteratorData->array[$iteratorData->position]);
            }
        );
        $mock->shouldReceive('count')->withNoArgs()->andReturnUsing(
            function () use ($iteratorData) {
                return count($iteratorData->array);
            }
        );

        return $mock;
    }
}
