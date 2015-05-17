<?php

namespace Rubicon\Assert;

use Rubicon\Assert\Extension\AbstractExtension;
use Zend\ServiceManager\ConfigInterface;
use Zend\ServiceManager\Exception;
use Zend\ServiceManager\ServiceManager;

class AsserterManager extends ServiceManager
{
    /**
     * @var self
     */
    private static $instance;

    /**
     * @var array
     */
    protected $invokableClasses = [
        'string'            => 'Rubicon\Assert\Extension\String',
        'object'            => 'Rubicon\Assert\Extension\Object',
        'constraintmanager' => 'Rubicon\Assert\Constraint\ConstraintManager'
    ];

    /**
     * @var array
     */
    protected $factories = [
        'eventmanager' => 'Rubicon\Assert\EventManagerFactory',
    ];

    /**
     * @return self
     */
    public static function getInstance()
    {
        if (null === self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * @param ConfigInterface $configuration
     */
    public function __construct(ConfigInterface $configuration = null)
    {
        parent::__construct($configuration);

        $this->addInitializer(function($instance){
            if ($instance instanceof AbstractExtension) {
                $instance->setServiceLocator($this->get('constraint-manager'));
                $instance->setEventManager($this->get('eventmanager'));
            }
        });
    }
}