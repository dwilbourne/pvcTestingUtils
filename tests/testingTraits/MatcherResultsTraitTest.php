<?php

namespace pvcTests\testingutils\testingTraits;

use Iterator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use pvc\testingutils\testingTraits\MatcherResultsTrait;
use pvcTests\testingutils\testingTraits\fixtures\ClassWithTestMethod;
use pvcTests\testingutils\testingTraits\fixtures\Factory;
use stdClass;

class MatcherResultsTraitTest extends TestCase
{
    use MatcherResultsTrait;

    /**
     * testInvocationNumbers
     * @return void
     * @covers \pvc\testingutils\testingTraits\MatcherResultsTrait::makeMockReturnByInvocationNumber
     */
    public function testInvocationNumbers(): void
    {
        $mock = $this->createMock(ClassWithTestMethod::class);
        $testArray = array('foo', 'bar', 'baz');
        $classWithTestMethod = new ClassWithTestMethod($testArray);
        $matcher = $this->exactly(count($testArray));
        $this->makeMockReturnByInvocationNumber($mock, $matcher, 'testMethod', $testArray);

        for ($i = 0; $i < count($testArray); $i++) {
            self::assertSame($classWithTestMethod->testMethod($i), $mock->testMethod($i));
        }
    }

    /**
     * testMockReturnFromResultsArray
     * @return void
     * @covers \pvc\testingutils\testingTraits\MatcherResultsTrait::makeMockReturnFromResultsArray
     */
    public function testMockReturnFromResultsArray(): void
    {
        $mock = $this->createMock(ClassWithTestMethod::class);

        $indexA = 'fooId';
        $indexB = 'barId';
        $indexC = 'bazId';

        $testArray = array($indexA => 'foo', $indexB => 'bar', $indexC => 'baz');
        $matcher = $this->exactly(count($testArray));
        $classWithTestMethod = new ClassWithTestMethod($testArray);
        $this->makeMockReturnFromResultsArray($mock, $matcher, 'testMethod', $testArray);

        self::assertSame($classWithTestMethod->testMethod($indexC), $mock->testMethod($indexC));
        self::assertSame($classWithTestMethod->testMethod($indexA), $mock->testMethod($indexA));
        self::assertSame($classWithTestMethod->testMethod($indexB), $mock->testMethod($indexB));
    }

}
