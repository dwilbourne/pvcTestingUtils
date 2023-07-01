<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace pvcTests\testingutils\testingTraits;

use PHPUnit\Framework\TestCase;
use pvc\testingutils\testingTraits\PrivateMethodTestingTrait;
use pvcTests\testingutils\testingTraits\fixtures\ClassWithPrivateMethod;

class PrivateMethodTestingTraitTest extends TestCase
{

    use PrivateMethodTestingTrait;

    /**
     * testPrivateMethod
     * @throws \ReflectionException
     * @covers \pvc\testingutils\testingTraits\PrivateMethodTestingTrait::invokeMethod
     */
    public function testPrivateMethod(): void
    {
        $class = new ClassWithPrivateMethod();
        /**
         * setResult is a public method
         */
        $class->setResult(2);

        /**
         * invokeMethod allows you to invoke a private method, in this case called 'doubleResult'
         */
        $this->invokeMethod($class, 'doubleResult');
        self::assertEquals(4, $class->getResult());
    }
}
