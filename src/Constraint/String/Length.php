<?php

namespace Rubicon\Assert\Constraint\String;

use Rubicon\Assert\Constraint\ConstraintInterface;

class Length implements ConstraintInterface
{
    /**
     * @param $actual
     * @param $expected
     *
     * @return bool
     */
    public function evaluate($actual, $expected)
    {
        if (! is_numeric($actual)) {
            // todo: handle this with correct exception interface
        }

        return strlen($expected) === intval($actual);
    }

    /**
     * @param $expected
     *
     * @return mixed
     */
    public function getMessage($expected, $actual)
    {
        return sprintf('%s contains to %s', $expected, $actual);
    }
}