<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace pvcTests\testingutils\testingTraits;

use PHPUnit\Framework\TestCase;
use pvc\testingutils\testingTraits\NonNegativeIntegerValidatorTrait;

class NonNegativeIntegerValidatorTraitTest extends TestCase
{

    use \pvc\testingutils\testingTraits\NonNegativeIntegerValidatorTrait;

    /**
     * testIntegerValidatorTrait
     * @covers \pvc\testingutils\testingTraits\NonNegativeIntegerValidatorTrait::makeMockValidator
     */
    public function testIntegerValidatorTrait(): void
    {
        $v = $this->makeMockValidator();
        self::assertTrue($v->validate(4));
        self::assertFalse($v->validate(-2));
        self::assertFalse($v->validate('foo'));
    }
}
