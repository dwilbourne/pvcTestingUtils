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

class ClassWithPrivateMethod
{

    protected int $result;

    public function setResult(int $n) : void
    {
        $this->result = $n;
    }

    public function getResult() : int
    {
        return $this->result;
    }

    private function doubleResult() : void
    {
        $this->result *= 2;
    }
}
