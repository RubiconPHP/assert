<?php

namespace Rubicon\Assert;

use Zend\EventManager\EventManagerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * @method Assertion\String string
 * @method Assertion\Object object
 */
class Asserter
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $locator;

    /**
     * @var EventManagerInterface
     */
    protected $events;

    /**
     * @var self
     */
    private static $instance;

    /**
     * @return Asserter
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            $manager        = AsserterManager::getInstance();
            $events         = $manager->get('event-manager');
            self::$instance = new self($manager, $events);
        }

        return self::$instance;
    }

    /**
     * @param ServiceLocatorInterface $locator
     * @param EventManagerInterface   $events
     */
    public function __construct(ServiceLocatorInterface $locator, EventManagerInterface $events)
    {
        $this->events  = $events;
        $this->locator = $locator;
    }

    /**
     * @param $event
     * @param $callback
     * @param $priority
     *
     * @return $this
     */
    public function attach($event, $callback = null, $priority = 1)
    {
        call_user_func_array([$this->events, 'attach'], func_get_args());

        return $this;
    }

    /**
     * @param $method
     * @param $arguments
     *
     * @return array|object
     */
    public function __call($method, $arguments)
    {
        if (! $this->locator->has($method)) {
            throw new \BadMethodCallException('Assertions not available for ' . $method);
        }

        $plugin = $this->locator->get($method);
        $plugin->setValue(array_shift($arguments));
        $this->events->addIdentifiers(get_class($plugin));

        return $plugin;
    }
}