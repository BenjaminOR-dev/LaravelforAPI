<?php

namespace App\Services;

use App\Helpers\ClassHelper;
use App\Helpers\ValidatorHelper;

class Service
{
    /**
     * Get the name of the class
     *
     * @return string
     */
    public function getClassName()
    {
        return ClassHelper::getName(static::class);
    }

    /**
     * Get the name of the method
     *
     * @return string
     */
    public function getMethodName()
    {
        return debug_backtrace()[1]['function'] . '()';
    }

    /**
     * Get the class name and method name
     *
     * @return string
     */
    public function getClassNameAndMethod()
    {
        return $this->getClassName() . '::' . $this->getMethodName();
    }

    /**
     * Validate for service
     *
     * @param string $rulesRequest
     * @param array $data
     * @param bool $returnValidated
     * @return array
     */
    public function validate(string $rulesRequest, array &$data, bool $returnValidated = true)
    {
        $data = ValidatorHelper::make($rulesRequest, $data, $returnValidated);
    }
}
