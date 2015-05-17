<?php

namespace Rubicon\Assert;

use Rubicon\Assert\Listener\ArticulationListener;
use Rubicon\Assert\Listener\AssertionTypeListener;
use Rubicon\Assert\Listener\SatisfyListener;
use Zend\EventManager\EventManager;

class EventManagerFactory
{
    /**
     * @return EventManager
     */
    public function __invoke()
    {
        $manager = new EventManager(['assert']);
        $manager->attach(new ArticulationListener);
        $manager->attach(new AssertionTypeListener());
        $manager->attach(new SatisfyListener());

        return $manager;
    }
}