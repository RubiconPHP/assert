<?php

namespace Rubicon\Assert\Constraint\Callback;

use Rubicon\Assert\Constraint\ConstraintInterface;

class ReturnValue implements ConstraintInterface
{
    /**
     * @param $actual
     * @param $expected
     *
     * @return bool
     */
    public function evaluate($actual, $expected)
    {
        try {
            return $actual() === $expected;
        }
        catch(\Exception $e) {
            return false;
        }
    }

    /**
     * @param $actual
     * @param $expected
     *
     * @return mixed
     */
    public function getMessage($actual, $expected)
    {
        return sprintf('callable return value %s', $expected);
    }
}