<?php

namespace PaulMaxwell\SimulatorWebApplication\Basis;

/**
 * Class AbstractSingleton
 * @package PaulMaxwell\SimulatorWebApplication\Basis
 *
 * This is AbstractSingleton class for singleton implementation in
 * the project
 */
abstract class AbstractSingleton
{
    /**
     * Return the instance of class
     */
    public static function getInstance()
    {
        static $activeInstance = null;
        if ($activeInstance === null) {
            $activeInstance = new static();
        }

        return $activeInstance;
    }

    /**
     * Disabled creating new instances
     */
    protected function __construct()
    {
    }

    /**
     * Disabled cloning of object
     */
    private function __clone()
    {
    }

    /**
     * Disabled deserialization of the object
     */
    private function __wakeup()
    {
    }
}
