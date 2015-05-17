<?php

namespace Rubicon\Assert\Listener;

use Rubicon\Assert\Constraint\CallbackConstraintHandler;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;

class SatisfyListener extends AbstractListenerAggregate
{
    /**
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('assert.not-found', $this, -100);
    }

    /**
     *
     * @param EventInterface $event
     * @return mixed
     */
    public function __invoke(EventInterface $event)
    {
        if ($event->getParam('method') === 'satisfy') {
            $event->stopPropagation();
            return new CallbackConstraintHandler(
                $event->getParam('arguments')[0]
            );
        }
    }
}