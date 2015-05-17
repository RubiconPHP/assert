<?php

namespace Rubicon\Assert\Listener;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;

class ArticulationListener extends AbstractListenerAggregate
{
    /**
     * @param EventManagerInterface $events
     *
     * @return void
     */
    public function attach(EventManagerInterface $events)
    {
        $this->listeners[] = $events->attach('assert.pre', $this, 100);
    }

    /**
     * @param EventInterface $event
     */
    public function __invoke(EventInterface $event)
    {
        $articulation = $event->getTarget()->getArticulation();
        switch (strtolower($event->getParam('method'))) {

            // positive condition
            case 'is':
            case 'should':
                $articulation->setCondition(true);
                $event->stopPropagation();
                break;

            // negative condition
            case 'not':
            case 'shouldnot':
                $articulation->setCondition(false);
                $event->stopPropagation();
                break;

            // reverse condition
            case 'but':
                $articulation->setCondition(! $articulation->getCondition());
                $event->stopPropagation();
                break;

            // "sugar" condition
            case 'and':
                $event->stopPropagation();
                break;
        }
    }
}