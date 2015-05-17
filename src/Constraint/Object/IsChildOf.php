<?php

namespace Rubicon\Assert\Constraint\Object;

use Rubicon\Assert\Constraint\ConstraintInterface;

class IsChildOf implements ConstraintInterface
{
    /**
     * @param $actual
     * @param $expected
     *
     * @return bool
     */
    public function evaluate($actual, $expected)
    {
        $parent = $actual;
        while($parent = get_parent_class($parent)) {
            if ($parent === $expected) {
                return true;
            }
        }
        return false;
    }

    /**
     * @param $expected
     *
     * @return mixed
     */
    public function getMessage($actual, $expected)
    {
        return sprintf('%s is a child of class %s', get_class($actual), $expected);
    }
}