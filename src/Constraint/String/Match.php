<?php

namespace Rubicon\Assert\Constraint\String;

use Rubicon\Assert\Constraint\ConstraintInterface;

class Match implements ConstraintInterface
{
    /**
     * @param string $actual
     * @param string $expected
     *
     * @return bool
     */
    public function evaluate($actual, $expected)
    {
        return boolval(preg_match('`' . $expected . '`', preg_quote($actual, '`')));
    }

    /**
     * @param string $expected
     * @param string $actual
     *
     * @return mixed
     */
    public function getMessage($expected, $actual)
    {
        return sprintf('%s match %s', $expected, $actual);
    }
}