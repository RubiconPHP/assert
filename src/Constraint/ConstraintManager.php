<?php

namespace Rubicon\Assert\Constraint;

use Zend\ServiceManager\AbstractPluginManager;

class ConstraintManager extends AbstractPluginManager
{
    /**
     * @var array
     */
    protected $invokableClasses = [
        'string.contains' => 'Rubicon\Assert\Constraint\String\Contains',
        'string.equalto'  => 'Rubicon\Assert\Constraint\String\EqualTo',
        'string.match'    => 'Rubicon\Assert\Constraint\String\Match',
        'string.length'   => 'Rubicon\Assert\Constraint\String\Length',

        'object.instanceof'       => 'Rubicon\Assert\Constraint\Object\IsInstanceOf',
        'object.implementationof' => 'Rubicon\Assert\Constraint\Object\IsImplementationOf',
        'object.objectof'         => 'Rubicon\Assert\Constraint\Object\IsObjectOf',
        'object.childof'          => 'Rubicon\Assert\Constraint\Object\IsChildOf',
        'object.bethrown'         => 'Rubicon\Assert\Constraint\Object\IsException',

        'callback.returnvalue'    => 'Rubicon\Assert\Constraint\Callback\ReturnValue',
        'callback.throwexception' => 'Rubicon\Assert\Constraint\Callback\ThrowException',
    ];

    /**
     * Validate the plugin
     *
     * Checks that the filter loaded is either a valid callback or an instance
     * of FilterInterface.
     *
     * @param  mixed $plugin
     *
     * @return void
     * @throws \RuntimeException if invalid
     */
    public function validatePlugin($plugin)
    {
        if (! $plugin instanceof ConstraintInterface) {
            throw new \RuntimeException(sprintf(
                'Invalid constraint provided, expecting an instance of %s, got %s',
                ConstraintInterface::class,
                is_object($plugin) ? get_class($plugin) : gettype($plugin)
            ));
        }
    }
}