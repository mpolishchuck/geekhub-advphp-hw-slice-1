<?php

namespace PaulMaxwell\SimulatorBasis\Universe;
use PaulMaxwell\SimulatorBasis\Universe\LifeFormInterface;

/**
 * Interface CreatureInterface
 * @package Universe
 *
 * Interface for creature
 * Creature can have following attributes:
 *  - health
 *  - bellyful
 *  - energy
 * Also every creature can sleep
 */
interface CreatureInterface extends LifeFormInterface
{
    /**
     * Get current health of the creature
     * @return float current health of the creature
     */
    public function getHealth();

    /**
     * Get current bellyful of the creature
     * @return float current bellyful of the creature
     */
    public function getBellyful();

    /**
     * Get current energy of the creature
     * @return mixed current energy of the creature
     */
    public function getEnergy();

    /**
     * Is creature sleeping now?
     * @return bool
     */
    public function isSleeping();
}
