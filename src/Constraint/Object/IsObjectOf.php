<?php

namespace Rubicon\Assert\Constraint\Object;

use Rubicon\Assert\Constraint\ConstraintInterface;

class IsObjectOf implements ConstraintInterface
{
    /**
     * {@inheritdoc}
     */
    public function evaluate($actual, $expected)
    {
        return get_class($actual) === $expected;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage($actual, $expected)
    {
        return sprintf('%s is a direct object of class %s', get_class($actual), $expected);
    }
}