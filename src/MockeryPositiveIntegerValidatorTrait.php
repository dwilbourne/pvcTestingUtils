<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

namespace pvc\testingTraits;


/**
 * Trait MockeryIntegerValidatorTrait
 */

trait MockeryPositiveIntegerValidatorTrait {

    public function makeMockValidator(string $interfaceName) {
        $validator = \Mockery::mock($interfaceName);
        $closure = function($arg) { return is_int($arg) && ($arg >= 0); };
        $validator->shouldReceive('validate')->andReturnUsing($closure);
        return $validator;
    }

}