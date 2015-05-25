<?php

namespace Rubicon\Assert\Extension;

use Rubicon\Assert\Constraint\Articulation;
use Rubicon\Assert\Constraint\ConstraintInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\EventManager\EventManagerAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareTrait;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

/**
 * @method $this is
 * @method $this not
 * @method $this and
 * @method $this but
 * @method $this should
 * @method $this satisfy
 */
abstract class AbstractExtension implements
    ServiceLocatorAwareInterface,
    EventManagerAwareInterface,
    ExtensionInterface
{
    use ServiceLocatorAwareTrait,
        EventManagerAwareTrait;

    /**
     * @var string
     */
    protected $value;

    /**
     * @var Articulation
     */
    protected $articulation;

    /**
     * @todo: Messy messy messy...
     *
     * @param string $method
     * @param array  $arguments
     *
     * @return $this
     */
    public function __call($method, $arguments)
    {
        $events = $this->getEventManager();
        $result = $events->trigger('assert.pre', $this, compact('method'));
        if ($result->stopped()) {
            return $this;
        }

        $alias   = $this->getServiceName($method);
        $locator = $this->getServiceLocator();

        if (! $locator->has($alias)) {
            $result = $events->trigger('assert.not-found', $this, compact('method', 'arguments'))->last();
            if ($result instanceof self) {
                return $result;
            }
            if ($result instanceof ConstraintInterface) {
                $plugin = $result;
            }
        } else {
            $plugin = $locator->get($alias);
        }

        /** @var ConstraintInterface $plugin */
        array_unshift($arguments, $this->value);
        $result = $this->getArticulation()->evaluate($plugin, $arguments);

        $events->trigger($result ? 'assert.success' : 'assert.error', $this, [
            'articulation' => $this->getArticulation(),
            'plugin'       => $plugin,
            'arguments'    => $arguments
        ]);

        return $this;
    }

    /**
     * @return Articulation
     */
    public function getArticulation()
    {
        if (null === $this->articulation) {
            $this->articulation = new Articulation();
        }
        return $this->articulation;
    }

    /**
     * @param mixed $value
     *
     * @return void
     */
    public function setValue($value)
    {
        $this->validate($value);
        $this->value = $value;
    }

    /**
     * @param string $service
     *
     * @return string
     */
    public function getServiceName($service)
    {
        return $this->getNamespace() . '.' . $service;
    }

    /**
     * @param $value
     *
     * @return mixed
     */
    abstract protected function validate($value);

    /**
     * @return mixed
     */
    abstract protected function getNamespace();
}