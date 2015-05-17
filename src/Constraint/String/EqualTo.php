<?php

namespace Rubicon\Assert\Constraint\String;

use Rubicon\Assert\Constraint\ConstraintInterface;

class EqualTo implements ConstraintInterface
{
    /**
     * @param $actual
     * @param $expected
     *
     * @return bool
     */
    public function evaluate($actual, $expected)
    {
        return $actual == $expected;
    }

    /**
     * @param $expected
     *
     * @return mixed
     */
    public function getMessage($expected, $actual)
    {
        return sprintf('%s is equal to %s', $expected, $actual);
    }
}