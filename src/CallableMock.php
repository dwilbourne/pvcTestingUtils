<?php

/**
 * @author: Doug Wilbourne (dougwilbourne@gmail.com)
 */
declare(strict_types=1);

namespace pvc\testingutils;

/**
 * Class CallableMock
 */
class CallableMock
{
    /**
     * @var array<array<mixed>>
     *     an array of arrays - each element is the parameter set for an invocation of the callable
     */
    protected array $invocations = [];

    /**
     * @var callable
     * you can set an internal callable if you need to test certain parameter shapes, return types or return values
     */
    protected $callable;

    public function __construct()
    {
        $this->callable = function (...$params) {
        };
    }

    /**
     * __invoke
     * @param mixed ...$params
     * @return mixed
     */
    public function __invoke(...$params): mixed
    {
        $this->invocations[] = $params;
        return call_user_func($this->callable, $params);
    }

    public function wasNotCalled(): bool
    {
        return !$this->wasCalled();
    }

    /**
     * wasCalled
     * @return bool
     */
    public function wasCalled(int $times = null): bool
    {
        return (is_null($times) ? (count($this->invocations) > 0) : ($times == count($this->invocations)));
    }
}
