<?php

declare (strict_types=1);
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */

namespace tests\phpunit;

use Iterator;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use pvc\testingTraits\phpunit\PhpunitIteratorTrait;

class PhpunitIteratorTraitTest extends TestCase
{
    use PhpunitIteratorTrait;

    protected MockObject|Iterator $mock;
    protected array $testArray;

    public function setUp() : void
    {
        // $this->mock = $this->getMockBuilder(['\StdClass', '\Iterator'])->getMock();
	    $this->mock = $this->createMock(Iterator::class);
        $this->testArray = array('foo', 'bar', 'baz');
        $this->mock = $this->mockIterator($this->mock, $this->testArray);
    }

    public function testIteration() : void
    {

        // if you have a mocked object that needs to implement the iterator interface,
        // you can use the function mockIterator to add the proper expectations

        $arrayIndices = [];
        $arrayValues = [];

        foreach ($this->mock as $index => $value) {
            $arrayIndices[] = $index;
            $arrayValues[] = $value;
        }

        $this->assertSame(array(0, 1, 2), $arrayIndices);
        $this->assertSame($this->testArray, $arrayValues);
    }

    public function testIteratorMethods() : void
    {

        $this->assertTrue($this->mock->valid());
        $this->assertEquals(0, $this->mock->key());
        $this->assertEquals('foo', $this->mock->current());

        $this->mock->next();
        $this->assertEquals(1, $this->mock->key());
        $this->assertEquals('bar', $this->mock->current());

        $this->mock->next();
        $this->assertEquals(2, $this->mock->key());
        $this->assertEquals('baz', $this->mock->current());

        $this->mock->next();
        $this->assertFalse($this->mock->valid());
        $this->mock->rewind();
        $this->assertEquals(0, $this->mock->key());
    }
}
