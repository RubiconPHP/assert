<?php

namespace Rubicon\Assert\Assertion;

class Assertion implements AssertionInterface
{
    /**
     * @var mixed
     */
    private $value;

    /**
     * @var string
     */
    private $message;

    /**
     * @param $value
     */
    public function __construct($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     *
     * @return $this
     */
    public function setMessage($value)
    {
        $arguments = func_get_args();
        array_shift($arguments);

        $this->message = sprintf((string) $value, $arguments);
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}