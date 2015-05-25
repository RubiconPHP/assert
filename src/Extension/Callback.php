<?php

namespace Rubicon\Assert\Extension;

class Callback extends AbstractExtension
{
    /**
     * @param mixed $value
     *
     * @return mixed
     * @throws \Exception if the value is invalid
     */
    public function validate($value)
    {
        if (! is_callable($value)) {
            throw new \InvalidArgumentException(
                'Expecting callable, got' . (is_object($value) ? get_class($value) : gettype($value))
            );
        }
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return 'callback';
    }
}