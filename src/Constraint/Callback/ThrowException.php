<?php

namespace Rubicon\Assert\Constraint\Callback;

use Rubicon\Assert\Constraint\ConstraintInterface;

class ThrowException implements ConstraintInterface
{
    /**
     * @param $actual
     * @param $expected
     *
     * @return bool
     */
    public function evaluate($actual, $expected)
    {
        if (! $expected) {
            $expected = 'Exception';
        }
        try {
            $actual();
        }
        catch (\Exception $exception) {
            return $exception instanceof $expected;
        }
        return false;
    }

    /**
     * @param $actual
     * @param $expected
     *
     * @return string
     */
    public function getMessage($actual, $expected)
    {
        return sprintf('callable throw exception of type "%s"', is_object($expected) ? get_class($expected) : $expected);
    }

}