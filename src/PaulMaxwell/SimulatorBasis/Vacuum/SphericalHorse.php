<?php

namespace PaulMaxwell\SimulatorBasis\Vacuum;

use PaulMaxwell\SimulatorBasis\Nature\Creatures\AbstractLiveCreature;

/**
 * Class SphericalHorse
 * @package Vacuum
 *
 * Implementation of spherical horse in the vacuum
 */
class SphericalHorse extends AbstractLiveCreature
{
    /**
     * Changing health of spherical horse in 'active' state
     */
    protected function thinkHealthActive()
    {
        $diff = 0;
        if ($this->bellyful > 30) {
            $diff += (($this->bellyful - 30) / 70) * 10;
        } else {
            $diff -= $this->bellyful / 6;
        }
        if ($this->energy > 20) {
            $diff += (($this->energy - 20) / 80) * 10;
        } else {
            $diff -= $this->energy / 4;
        }
        $this->health += min($diff, 100 - $this->health);
    }

    /**
     * Changing health of spherical horse in 'sleeping' state
     */
    protected function thinkHealthSleeping()
    {
        $diff = 0;
        if ($this->bellyful > 30) {
            $diff += (($this->bellyful - 30) / 70) * 15;
        } else {
            $diff -= $this->bellyful / 12;
        }
        if ($this->energy > 20) {
            $diff += (($this->energy - 20) / 80) * 15;
        } else {
            $diff -= $this->energy / 8;
        }
        $this->health += min($diff, 100 - $this->health);
    }

    /**
     * Spherical horse consumes bellyful in 'active' state
     * @return float amount of bellyful consumed
     */
    protected function consumeBellyfulActive()
    {
        $diff = $this->bellyful / 25;
        $this->bellyful -= $diff;

        return $diff;
    }

    /**
     * Spherical horse consumes bellyful in 'sleeping' state
     * @return float amount of bellyful consumed
     */
    protected function consumeBellyfulSleeping()
    {
        $diff = $this->bellyful / 50;
        $this->bellyful -= $diff;

        return $diff;
    }

    /**
     * By consumed bellyful health and energy of spherical horse changes in 'active' state
     * @param float $consumedBellyful
     */
    protected function changeHealthAndEnergyActive($consumedBellyful)
    {
        $energy = 4 - $consumedBellyful;
        $this->energy -= $energy;
        $this->health += min($consumedBellyful * $energy, 100 - $this->health);
    }

    /**
     * By consumed bellyful health and energy of spherical horse changes in 'sleeping' state
     * @param float $consumedBellyful
     */
    protected function changeHealthAndEnergySleeping($consumedBellyful)
    {
        $energy = 0.5 * $consumedBellyful;
        $this->energy += $energy;
        $this->health += min($consumedBellyful * $energy, 100 - $this->health);
    }
}
