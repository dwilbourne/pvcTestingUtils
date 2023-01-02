<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

namespace tests\mockery;

use Mockery;
use PHPUnit\Framework\TestCase;
use pvc\testingTraits\mockery\MockeryIteratorTrait;

/**
 * Class MockeryIteratorTraitTest
 * @package tests
 */
class MockeryIteratorTraitTest extends Testcase
{

    use MockeryIteratorTrait;

    /** @phpstan-ignore-next-line */
    protected $mock;
    protected array $testArray;

    public function setUp() : void
    {
        $this->mock = Mockery::mock('\StdClass', '\Iterator');
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

        $this->assertEquals(3, $this->mock->count());

        $this->mock->next();
        $this->assertFalse($this->mock->valid());
        $this->mock->rewind();
        $this->assertEquals(0, $this->mock->key());
    }
}
