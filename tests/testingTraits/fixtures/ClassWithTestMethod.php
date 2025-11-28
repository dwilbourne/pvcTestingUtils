<?php

namespace pvcTests\testingutils\testingTraits\fixtures;

class ClassWithTestMethod
{
    public function __construct(
        protected array $testArray,
    ) {}
    public function testMethod(int|string $index): mixed
    {
        return $this->testArray[$index] ?? null;
    }

}