<?php

declare(strict_types=1);

namespace pvc\testingutils\testingTraits;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\MockObject\Rule\InvocationOrder;
use PHPUnit\Framework\TestCase;

trait MatcherResultsTrait
{
    /**
     * makeMockReturnOnConsecutiveInvocations
     * @param  MockObject  $mock
     * @param  string  $method
     * @param  array<int, mixed>  $results
     *
     * @return void
     */
    public function makeMockReturnByInvocationNumber(MockObject $mock, InvocationOrder $matcher, string $method, array $results): void
    {
        $closure = function () use ($matcher, $results) {
            $resultValues = array_values($results);
            return $resultValues[$matcher->numberOfInvocations() - 1];
        };
        $mock->expects($matcher)->method($method)->willReturnCallback($closure);
    }

    /**
     * makeMockReturnFromResultsArray
     * @param  MockObject  $mock
     * @param  string  $method
     * @param  array<int|string, mixed>  $results
     *
     * @return void
     */
    public function makeMockReturnFromResultsArray(MockObject $mock, string $method, array $results): void
    {
        $matcher = TestCase::exactly(count($results));
        $closure = function ($index) use ($results) {
            return $results[$index];
        };
        $mock->expects($matcher)->method($method)->willReturnCallback($closure);
    }
}