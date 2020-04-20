<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use Mockery as m;
use pvc\testingTraits\MockeryIteratorTrait;

/**
 * Class MockeryHardDependencyTest
 */
class MockeryIteratorTraitTest extends Testcase {

    use MockeryIteratorTrait;

    protected $mock;
    protected $testArray;

    function setUp() : void {
        $this->mock = m::mock('\StdClass', '\Iterator');
        $this->testArray = array('foo', 'bar', 'baz');
        $this->mock = $this->mockIterator($this->mock, $this->testArray);
    }

    function testIteration() {

        // if you have a mocked object that needs to implement the iterator interface,
        // you can use the function mockIterator to add the proper expectations

        $arrayIndices = [];
        $arrayValues = [];

        foreach($this->mock as $index => $value) {
            $arrayIndices[] = $index;
            $arrayValues[] = $value;
        }

        $this->assertSame(array(0, 1, 2), $arrayIndices);
        $this->assertSame($this->testArray, $arrayValues);

    }

    function testIteratorMethods() {

        $this->assertTrue($this->mock->valid());
        $this->assertEquals(0, $this->mock->key());
        $this->assertEquals('foo', $this->mock->current());

        $this->mock->next();
        $this->assertEquals(1, $this->mock->key());
        $this->assertEquals('bar', $this->mock->current());

        $this->mock->next();
        $this->assertEquals(2, $this->mock->key());
        $this->assertEquals('baz', $this->mock->current());

        $this->assertEquals(3, $this->mock->count());

        $this->mock->next();
        $this->assertFalse($this->mock->valid());
        $this->mock->rewind();
        $this->assertEquals(0, $this->mock->key());

    }


}