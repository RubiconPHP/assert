<?php

namespace Rubicon\Assert\Listener;

use Rubicon\Assert\Asserter;
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;

class AssertionTypeListener extends AbstractListenerAggregate
{
    /**
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('assert.not-found', $this, -101);
    }

    /**
     * Lets try to get a Plugin Type if an assertion is not found
     *
     * @param EventInterface $event
     * @return mixed
     */
    public function __invoke(EventInterface $event)
    {
        return Asserter::getInstance()->__call(
            $event->getParam('method'),
            $event->getParam('arguments')
        );
    }
}