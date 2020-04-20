<?php
/**
 * @package: pvc
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version: 1.0
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use Mockery as m;
use pvc\testingTraits\MockeryArrayAccessTrait;


class MockeryArrayAccessTraitTest extends Testcase {

    use MockeryArrayAccessTrait;

    protected $mock;
    protected $testArray;

    function setUp() : void {
        $this->mock = m::mock('\StdClass', '\ArrayAccess');
        $this->testArray = array('a' => 'foo', 'b' => 'bar', 2 => 'baz');
        $this->mock = $this->mockArrayAccess($this->mock, $this->testArray);
    }

    function testArrayAccess() {

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

    function testArrayAccessMethods() {

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