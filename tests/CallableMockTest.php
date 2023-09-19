<?php

/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */
declare (strict_types=1);

namespace pvcTests\testingutils;

use PHPUnit\Framework\TestCase;
use pvc\testingutils\CallableMock;

class CallableMockTest extends TestCase
{
    protected CallableMock $callableMock;

    public function setUp(): void
    {
        $this->callableMock = new CallableMock();
    }

    /**
     * testWasCalledWithNullParameter
     * @covers pvc\testingutils\CallableMock::wasCalled
     * @covers pvc\testingutils\CallableMock::__invoke
     * @covers pvc\testingutils\CallableMock::__construct
     */
    public function testWasCalledWithNullParameter(): void
    {
        $params = ['foo' => 'bar'];
        call_user_func($this->callableMock, $params);
        self::assertTrue($this->callableMock->wasCalled());
    }

    /**
     * testWasCalledWithParameter
     * @covers pvc\testingutils\CallableMock::wasCalled
     */
    public function testWasCalledWithParameter(): void
    {
        $paramSet1 = ['foo' => 'bar'];
        $paramSet2 = [5, 9, 14, 22];
        call_user_func($this->callableMock, $paramSet1);
        call_user_func($this->callableMock, $paramSet2);
        self::assertTrue($this->callableMock->wasCalled(2));
    }

    /**
     * testWasNotCalled
     * @covers pvc\testingutils\CallableMock::wasNotCalled
     */
    public function testWasNotCalled(): void
    {
        self::assertTrue($this->callableMock->wasNotCalled());
    }
}
