<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use pvc\testingTraits\MockeryNonNegativeIntegerValidatorTrait;

class MockeryNonNegativeIntegerValidatorTraitTest extends TestCase
{

    use MockeryNonNegativeIntegerValidatorTrait;

    public function testIntegerValidatorTrait() : void
    {
        $v = $this->makeMockValidator();
        self::assertTrue($v->validate(4));
        self::assertFalse($v->validate(-2));
        self::assertFalse($v->validate('foo'));
    }
}
