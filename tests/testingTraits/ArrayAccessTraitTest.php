<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

namespace pvcTests\testingutils\testingTraits;

use ArrayAccess;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use pvc\testingutils\testingTraits\ArrayAccessTrait;

class ArrayAccessTraitTest extends Testcase
{

    use ArrayAccessTrait;

    protected MockObject|ArrayAccess $mock;
    protected array $testArray;

    public function setUp(): void
    {
        $this->mock = $this->createMock(ArrayAccess::class);
        $this->testArray = array('a' => 'foo', 'b' => 'bar', 2 => 'baz');
        $this->mock = $this->mockArrayAccess($this->mock, $this->testArray);
    }

    /**
     * testArrayAccess
     * @covers \pvc\testingutils\testingTraits\ArrayAccessTrait::mockArrayAccess
     */
    public function testArrayAccess(): void
    {
        // if you have a mocked object that needs to implement the ArrayAccess interface,
        // you can use the function mockArrayAccess to add the proper expectations

        $this->assertEquals('foo', $this->mock['a']);
        $this->assertEquals('bar', $this->mock['b']);
        $this->assertEquals('baz', $this->mock[2]);
        unset($this->mock['b']);
        $this->assertFalse(isset($this->mock['b']));
        $this->mock['b'] = 'quux';
        $this->assertEquals('quux', $this->mock['b']);
        $this->mock[2] = 9;
        $this->assertEquals(9, $this->mock[2]);
    }

    /**
     * testArrayAccessMethods
     * @covers \pvc\testingutils\testingTraits\ArrayAccessTrait::mockArrayAccess
     */
    public function testArrayAccessMethods(): void
    {
        $this->assertTrue($this->mock->offsetExists('a'));
        $this->assertEquals('foo', $this->mock->offsetGet('a'));

        $this->assertTrue($this->mock->offsetExists(2));
        $this->assertEquals('baz', $this->mock->offsetGet(2));

        $this->assertTrue($this->mock->offsetExists('b'));
        $this->mock->offsetUnset('b');
        $this->assertFalse($this->mock->offsetExists('b'));

        $this->mock->offsetSet('b', 'quux');
        $this->assertTrue($this->mock->offsetExists('b'));
        $this->assertEquals('quux', $this->mock->offsetGet('b'));

        $this->mock->offsetSet(2, 9);
        $this->assertEquals(9, $this->mock->offsetGet(2));
    }
}
