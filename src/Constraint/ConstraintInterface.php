<?php

namespace Rubicon\Assert\Constraint;

interface ConstraintInterface
{
    /**
     * @param $actual
     * @param $expected
     *
     * @return bool
     */
    public function evaluate($actual, $expected);

    /**
     * @param $actual
     * @param $expected
     *
     * @return string
     */
    public function getMessage($actual, $expected);
}