<?php

namespace Rubicon\Assert\Constraint\String;

use Rubicon\Assert\Constraint\ConstraintInterface;

class Contains implements ConstraintInterface
{
    /**
     * @param $actual
     * @param $expected
     *
     * @return bool
     */
    public function evaluate($actual, $expected)
    {
        return strpos($actual, $expected) !== false;
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