<?php

namespace Rubicon\Assert\Constraint\Object;

use Rubicon\Assert\Assertion\AssertionInterface;
use Rubicon\Assert\Constraint\ConstraintInterface;

class IsInstanceOf implements ConstraintInterface
{
    /**
     * @param AssertionInterface $actual
     * @param                    $expected
     *
     * @return bool
     */
    public function evaluate($actual, $expected)
    {
        return $actual instanceof $expected;
    }

    /**
     * @param $actual
     * @param $expected
     *
     * @return string
     */
    public function getMessage($actual, $expected)
    {
        return sprintf('%s is instance of %s', get_class($actual), $expected);
    }
}