<?php

namespace Rubicon\Assert\Constraint;

class CallbackConstraintHandler implements ConstraintInterface
{
    /**
     * @var callable
     */
    protected $callback;

    /**
     * @param callable $callback
     */
    public function __construct(callable $callback)
    {
        $this->callback = $callback;
    }

    /**
     * @param $actual
     * @param $expected
     *
     * @return bool
     */
    public function evaluate($actual, $expected)
    {
        return call_user_func($this->callback, $actual, $expected);
    }

    /**
     * @param $actual
     * @param $expected
     *
     * @return string
     */
    public function getMessage($actual, $expected)
    {
        return sprintf("callback evaluate type %s %s",
            gettype($actual),
            is_object($actual) ? get_class($actual) : var_export($actual, true)
        );
    }
}