<?php

namespace Rubicon\Assert\Assertion;

/**
 * @method $this childOf
 * @method $this instanceOf
 * @method $this implementationOf
 * @method $this objectOf
 * @method $this beThrown
 */
class Object extends AbstractAssertion
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
        if (! is_object($value)) {
            throw new \InvalidArgumentException('Expecting an object, got' . gettype($value));
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
        return 'object.' . $service;
    }
}