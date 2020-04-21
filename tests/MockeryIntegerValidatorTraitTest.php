<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use pvc\testingTraits\MockeryPositiveIntegerValidatorTrait;

class MockeryIntegerValidatorTraitTest extends TestCase {

    use MockeryPositiveIntegerValidatorTrait;

    public function testIntegerValidatorTrait() {
        $v = $this->makeMockValidator('SomeValidatorInterface');
        self::assertTrue($v->validate(4));
        self::assertFalse($v->validate(-2));
        self::assertFalse($v->validate('foo'));
    }
}
