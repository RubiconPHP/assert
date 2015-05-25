<?php

namespace Rubicon\Assert\Extension;

/**
 * @method $this contains
 * @method $this equalTo
 * @method $this match
 */
class String extends AbstractExtension
{
    /**
     * @param string $value
     *
     * @return $this
     */
    public function validate($value)
    {
        if (! is_string($value)) {
            throw new \InvalidArgumentException(
                'Expecting a string, got' . (is_object($value) ? get_class($value) : gettype($value))
            );
        }
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return 'string';
    }
}