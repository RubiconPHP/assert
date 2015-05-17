<?php

namespace Rubicon\Assert\Constraint\Object;

use Rubicon\Assert\Constraint\ConstraintInterface;

class IsException implements ConstraintInterface
{
    /**
     * @param $actual
     * @param $expected
     *
     * @return bool
     */
    public function evaluate($actual, $expected)
    {
        // checks for php 7
        if (class_exists('\BaseException', false)) {
            return $actual instanceof \BaseException;
        }

        return $actual instanceof \Exception;
    }

    /**
     * @param object $actual
     * @param $expected
     *
     * @return mixed
     */
    public function getMessage($actual, $expected)
    {
        return sprintf('%s cannot be thrown', get_class($actual));
    }
}