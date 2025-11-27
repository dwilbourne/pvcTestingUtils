<?php

declare(strict_types=1);

namespace pvc\testingutils\testingTraits;

use PHPUnit\Framework\MockObject\MockObject;
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
    public function makeMockReturnByInvocationNumber(MockObject $mock, string $method, array $results): void
    {
        $matcher = TestCase::exactly(count($results));
        $closure = function () use ($matcher, $results) {
            return $results[$matcher->numberOfInvocations()];
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
        $args = array_keys($results);
        $closure = function ($index) use ($args, $results) {
            $key = $args[$index];
            return $results[$key];
        };
        $mock->expects($matcher)->method($method)->willReturn($closure);
    }
}