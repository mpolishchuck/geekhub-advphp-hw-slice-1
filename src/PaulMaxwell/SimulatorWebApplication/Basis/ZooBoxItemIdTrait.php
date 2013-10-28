<?php

namespace PaulMaxwell\SimulatorWebApplication\Basis;

/**
 * Class ZooBoxItemIdTrait
 * @package PaulMaxwell\SimulatorWebApplication\Basis
 *
 * Adds $id field into ZooBox item
 */
trait ZooBoxItemIdTrait
{
    protected $id;

    /**
     * Get current id
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Generate new random id
     */
    public function generateId()
    {
        $this->id = md5(uniqid('', true));
    }
}
