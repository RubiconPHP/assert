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
     * @var string
     */
    protected $value;

    /**
     * @param string $value
     *
     * @return $this
     */
    public function setValue($value)
    {
        if (! is_string($value)) {
            throw new \InvalidArgumentException(
                'Expecting a string, got' . (is_object($value) ? get_class($value) : gettype($value))
            );
        }
        $this->value = $value;
    }

    /**
     * @param $service
     *
     * @return string
     */
    protected function getServiceName($service)
    {
        return 'string.' . $service;
    }

}