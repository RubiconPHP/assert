<?php

namespace Rubicon\Assert\Extension;

/**
 * @method $this childOf
 * @method $this instanceOf
 * @method $this implementationOf
 * @method $this objectOf
 * @method $this beThrown
 */
class Object extends AbstractExtension
{
    /**
     * @var string
     */
    protected $value;

    /**
     * @param string $value
     *
     * @return $this
     */
    public function validate($value)
    {
        if (! is_object($value)) {
            throw new \InvalidArgumentException('Expecting an object, got' . gettype($value));
        }
    }

    /**
     * @return string
     */
    public function getNamespace()
    {
        return 'object';
    }
}