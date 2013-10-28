<?php

namespace PaulMaxwell\SimulatorWebApplication\Basis;

/**
 * Class GetterAndSetterTrait
 * @package PaulMaxwell\SimulatorWebApplication\Basis
 *
 * Magic methods for defining magic class properties
 */
trait GetterAndSetterTrait
{
    public function __get($name)
    {
        $methodName = 'get' . $name;
        if (method_exists($this, $methodName)) {
            return $this->$methodName();
        }

        return false;
    }

    public function __set($name, $value)
    {
        $methodName = 'set' . $name;
        if (method_exists($this, $methodName)) {
            $this->$methodName($value);
        }
    }
}
