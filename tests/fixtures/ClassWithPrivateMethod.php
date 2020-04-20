<?php
/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 * @version 1.0
 */

namespace tests\fixtures;


/**
 * Class ClassWithPrivateMethod
 * @package tests\fixtures
 */

class ClassWithPrivateMethod {

    protected $result;

    function setResult(int $n) : void {
        $this->result = $n;
    }

    function getResult() : int {
        return $this->result;
    }

    private function doubleResult() {
        $this->result *= 2;
    }

}