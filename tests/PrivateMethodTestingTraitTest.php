<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use pvc\testingTraits\PrivateMethodTestingTrait;
use tests\fixtures\ClassWithPrivateMethod;

class PrivateMethodTestingTraitTest extends TestCase {

    use PrivateMethodTestingTrait;

    public function testPrivateMethod() {

        $class = new ClassWithPrivateMethod();
        $class->setResult(2);

        $this->invokeMethod($class, 'doubleResult');
        self::assertEquals(4, $class->getResult());
    }
}
