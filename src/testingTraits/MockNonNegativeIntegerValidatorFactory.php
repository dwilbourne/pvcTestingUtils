<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

namespace pvc\testingutils\testingTraits;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use pvc\interfaces\validator\ValidatorInterface;

/**
 * Trait MockeryIntegerValidatorTrait
 */
class MockNonNegativeIntegerValidatorFactory extends TestCase
{

    public function makeMockValidator(): MockObject
    {
        $validator = $this->createMock(ValidatorInterface::class);
        $closure = function ($arg) {
            return is_int($arg) && ($arg >= 0);
        };
        $validator->method('validate')->willReturnCallback($closure);
        return $validator;
    }
}
