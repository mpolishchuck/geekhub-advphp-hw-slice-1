<?php

namespace PaulMaxwell\SimulatorBasis\Universe;

/**
 * Interface ThingInterface
 * @package Universe
 *
 * Interface for universe thing
 * Every thing in the universe changes according to time flow
 */
interface ThingInterface
{
    /**
     * "Thinker" of the universe thing
     * Do process of thing
     * Simulates time flow, changes internal variables according to time flow
     */
    public function think();
}
