<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace pvcTests\testingutils\testingTraits;

use PHPUnit\Framework\TestCase;
use pvc\testingutils\testingTraits\MockNonNegativeIntegerValidatorFactory;

class MockNonNegativeIntegerValidatorFactoryTest extends TestCase
{

    /**
     * @function testNonNegativeIntegerValidatorMock
     * @covers \pvc\TestingUtils\testingtraits\MockNonNegativeIntegerValidatorFactory::makeMockValidator
     */
    public function testNonNegativeIntegerValidatorMock(): void
    {
        $factory = new MockNonNegativeIntegerValidatorFactory();
        $v = $factory->makeMockValidator();
        self::assertTrue($v->validate(4));
        self::assertFalse($v->validate(-2));
        self::assertFalse($v->validate('foo'));
    }
}
