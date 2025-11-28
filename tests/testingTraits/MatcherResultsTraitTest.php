<?php

namespace pvcTests\testingutils\testingTraits;

use Iterator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use pvc\testingutils\testingTraits\MatcherResultsTrait;
use pvcTests\testingutils\testingTraits\fixtures\ClassWithTestMethod;

class MatcherResultsTraitTest extends TestCase
{
    use MatcherResultsTrait;
    protected MockObject&ClassWithTestMethod $mock;

    protected ClassWithTestMethod $classWithTestMethod;

    public function setUp(): void
    {
        $this->mock = $this->createMock(ClassWithTestMethod::class);
    }

    /**
     * testInvocationNumbers
     * @return void
     * @covers \pvc\testingutils\testingTraits\MatcherResultsTrait::makeMockReturnByInvocationNumber
     */
    public function testInvocationNumbers(): void
    {
        $testArray = array('foo', 'bar', 'baz');
        $classWithTestMethod = new ClassWithTestMethod($testArray);
        $this->makeMockReturnByInvocationNumber($this->mock, 'testMethod', $testArray);

        for ($i = 0; $i < count($testArray); $i++) {
            self::assertSame($classWithTestMethod->testMethod($i), $this->mock->testMethod($i));
        }
    }

    /**
     * testMockReturnFromResultsArray
     * @return void
     * @covers \pvc\testingutils\testingTraits\MatcherResultsTrait::makeMockReturnFromResultsArray
     */
    public function testMockReturnFromResultsArray(): void
    {
        $indexA = 'fooId';
        $indexB = 'barId';
        $indexC = 'bazId';

        $testArray = array($indexA => 'foo', $indexB => 'bar', $indexC => 'baz');
        $classWithTestMethod = new ClassWithTestMethod($testArray);
        $this->makeMockReturnFromResultsArray($this->mock, 'testMethod', $testArray);

        self::assertSame($classWithTestMethod->testMethod($indexC), $this->mock->testMethod($indexC));
        self::assertSame($classWithTestMethod->testMethod($indexA), $this->mock->testMethod($indexA));
        self::assertSame($classWithTestMethod->testMethod($indexB), $this->mock->testMethod($indexB));
    }

}
