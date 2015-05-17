<?php

namespace Rubicon\Assert\Constraint\Object;

use Rubicon\Assert\Constraint\AbstractConstraint;
use Rubicon\Assert\Exception\ValidationException;

abstract class AbstractObject extends AbstractConstraint
{
    /**
     * @param $value
     *
     * @return bool
     * @throws ValidationException
     */
    public function validate($value)
    {
        if (! is_object($value)) {
            throw new ValidationException('Expecting an object, got ' . gettype($value));
        }
    }
}