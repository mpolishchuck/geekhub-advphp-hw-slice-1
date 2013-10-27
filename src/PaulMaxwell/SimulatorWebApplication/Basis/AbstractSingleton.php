<?php

namespace PaulMaxwell\SimulatorWebApplication\Basis;

abstract class AbstractSingleton
{
    public static function getInstance()
    {
        static $activeInstance = null;
        if ($activeInstance === null) {
            $activeInstance = new static();
        }

        return $activeInstance;
    }

    protected function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }
}
