<?php

namespace Rubicon\Assert\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;

class ExceptionListener extends AbstractListenerAggregate
{
    /**
     * @param EventManagerInterface $events
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('assert.error', $this, -100);
    }

    /**
     * @param EventInterface $event
     *
     * @throws \Exception
     */
    public function __invoke(EventInterface $event)
    {
        throw new \Exception($event->getParam('articulation')->getMessage(
            $event->getParam('plugin'),
            $event->getParam('arguments')
        ));
    }
}