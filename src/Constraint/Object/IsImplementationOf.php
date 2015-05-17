<?php

namespace Rubicon\Assert\Constraint\Object;

use Rubicon\Assert\Assertion\AssertionInterface;
use Rubicon\Assert\Constraint\ConstraintInterface;

class IsImplementationOf implements ConstraintInterface
{
    /**
     * @param AssertionInterface $actual
     * @param                    $expected
     *
     * @return bool
     */
    public function evaluate($actual, $expected)
    {
        $reflection = new \ReflectionClass($expected);

        return $reflection->isInterface() && $actual instanceof $expected;
    }

    /**
     * @param $actual
     * @param $expected
     *
     * @return string
     */
    public function getMessage($actual, $expected)
    {
        return sprintf('%s implements of %s', get_class($actual), $expected);
    }
}