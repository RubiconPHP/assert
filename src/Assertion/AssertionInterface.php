<?php

namespace Rubicon\Assert\Assertion;

interface AssertionInterface
{
    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param $value
     * @return $this
     */
    public function setMessage($value);
}