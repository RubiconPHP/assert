<?php

namespace Rubicon\Assert\Constraint;

class Articulation
{
    /**
     * @var bool
     */
    private $condition = true;

    /**
     * @param bool $bool
     *
     * @return $this
     */
    public function setCondition($bool = true)
    {
        $this->condition = (bool) $bool;
        return $this;
    }

    /**
     * @return boolean
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param ConstraintInterface $constraint
     * @param array               $arguments
     *
     * @return mixed
     */
    public function evaluate(ConstraintInterface $constraint, array $arguments = [])
    {
        // hack to satisfy the interface
        if (count($arguments) < 2) {
            $arguments[] = null;
        }

        $result = call_user_func_array([$constraint, 'evaluate'], $arguments);

        return $this->condition === $result;
    }

    /**
     * @param ConstraintInterface $constraint
     * @param                     $arguments
     *
     * @return mixed
     */
    public function getMessage(ConstraintInterface $constraint, $arguments)
    {
        $message  = $this->condition ? 'Failing Positive assertion: ' : 'Failing Negative assertion: ';
        $message .= call_user_func_array([$constraint, 'getMessage'], $arguments);

        return $message;
    }
}