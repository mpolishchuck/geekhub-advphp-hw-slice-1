<?php

namespace Vacuum;

use Nature\Creatures\LiveCreature;

class SphericalHorse extends LiveCreature
{
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

    protected function consumeBellyfulActive()
    {
        $diff = $this->bellyful / 25;
        $this->bellyful -= $diff;
        return $diff;
    }

    protected function consumeBellyfulSleeping()
    {
        $diff = $this->bellyful / 50;
        $this->bellyful -= $diff;
        return $diff;
    }

    protected function changeHealthAndEnergyActive($consumedFood) {
        $energy = 4 - $consumedFood;
        $this->energy -= $energy;
        $this->health += min($consumedFood * $energy, 100 - $this->health);
    }

    protected function changeHealthAndEnergySleeping($consumedFood) {
        $energy = 0.5 * $consumedFood;
        $this->energy += $energy;
        $this->health += min($consumedFood * $energy, 100 - $this->health);
    }
}
