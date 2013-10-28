<?php

namespace PaulMaxwell\SimulatorWebApplication\Basis;

/**
 * Class ZooBoxItemInterface
 * @package PaulMaxwell\SimulatorWebApplication\Basis
 *
 * ZooBox item interface
 * General object in the ZooBox
 */
interface ZooBoxItemInterface
{
    /**
     * @return string
     */
    public function getDisplayName();

    /**
     * @return string
     */
    public function getDisplayIconClass();

    /**
     * @return array
     */
    public function getCurrentStatus();

    /**
     * @return string
     */
    public function getStateStatus();

    /**
     * @return array
     */
    public function getActionLinks();
}
