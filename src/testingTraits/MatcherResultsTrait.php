<?php

declare(strict_types=1);

namespace pvc\testingutils\testingTraits;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

trait MatcherResultsTrait
{
    public function makeMockReturnOnConsecutiveInvocations(MockObject $mock, string $method, array $results): void
    {
        $matcher = TestCase::exactly(count($results));
        $closure = function () use ($matcher, $results) {
            return $results[$matcher->numberOfInvocations()];
        };
        $mock->expects($matcher)->method($method)->willReturn($closure);
    }
}