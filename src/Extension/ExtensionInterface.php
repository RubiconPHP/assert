<?php

namespace Rubicon\Assert\Extension;

interface ExtensionInterface
{
    /**
     * @param mixed $value
     *
     * @return mixed
     * @throws \Exception if the value is invalid
     */
    public function setValue($value);

    /**
     * Get the service
     *
     * @param string $service
     *
     * @return string
     */
    public function getServiceName($service);
}