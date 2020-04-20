<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace tests;

use PHPUnit\Framework\TestCase;
use pvc\testingTraits\RandomStringGeneratorTrait;

class RandomStringGeneratorTraitTest extends TestCase {

    use RandomStringGeneratorTrait;

    protected $iterations;
    protected $seededStringLength;

    public function setUp() : void {
        $this->iterations = 10;
        $this->seededStringLength = 7;
    }

    public function testSetGetKeySpace() {
        $ks = 'abc123';
        $this->setKeyspace($ks);
        self::assertEquals($ks, $this->getKeyspace());
    }

    public function createSeededArray() : array {
        $result = [];
        for ($i = 0; $i < $this->iterations; $i++) {
            $result[] = $this->randomString($this->seededStringLength);
        }
        return $result;
    }

    public function testRandomStringGenerator() {
        $array = $this->createSeededArray();
        foreach($array as $string) {
            self::assertEquals($this->seededStringLength, strlen($string));
            // now confirm that all chars in the generated string are within the keyspace
            $result = true;
            foreach(str_split($string) as $char) {
                $result = $result && (false !== mb_strpos($this->getKeyspace(), $char));
            }
            self::assertTrue($result);
        }
    }

}
