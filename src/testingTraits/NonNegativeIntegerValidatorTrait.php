<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

namespace pvc\testingutils\testingTraits;

use Mockery;
use Mockery\LegacyMockInterface;

/**
 * Trait MockeryIntegerValidatorTrait
 */
trait NonNegativeIntegerValidatorTrait
{

    /**
     * makeMockValidator
     * @return LegacyMockInterface
     *
     * this is odd: phpstan sees that this method returns LegacyMockInterface, which doesn't make any sense to me.
     * @see https://github.com/mockery/mockery/issues/1019
     *
     * Leaving it as is rather than changing return value to MockInterface abd telling phpstan to ignore it.
     */
    public function makeMockValidator() : LegacyMockInterface
    {
        $interfaceName = 'Validator';
        $validator = Mockery::mock($interfaceName);
        $closure = function ($arg) {
            return is_int($arg) && ($arg >= 0);
        };
        $validator->shouldReceive('validate')->andReturnUsing($closure);
        return $validator;
    }
}
