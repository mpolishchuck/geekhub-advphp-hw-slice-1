<?php

namespace Nature\Creatures;

use Universe\ICreature;
use Universe\IThing;

abstract class LiveCreature implements IThing, ICreature
{
    const STATE_ALIVE = __LINE__;
    const STATE_DEAD  = __LINE__;

    protected $state = self::STATE_ALIVE;
    protected $health = 100;
    protected $bellyful = 100;
    protected $energy = 100;
    protected $sleep = 0;

    public function isAlive()
    {
        return ($this->state == self::STATE_ALIVE);
    }

    public function isDead()
    {
        return ($this->state == self::STATE_DEAD);
    }

    public function getHealth()
    {
        return $this->health;
    }

    public function getBellyful()
    {
        return $this->bellyful;
    }

    public function getEnergy()
    {
        return $this->energy;
    }

    public function isSleeping()
    {
        return ($this->sleep > 0);
    }

    public function think()
    {
        if ($this->isDead())
            return;
        if ($this->health <= 0) {
            $this->state = self::STATE_DEAD;
            return;
        }
        if ($this->sleep > 0) {
            $this->sleep--;
            $this->thinkHealthSleeping();
            $this->changeHealthAndEnergySleeping($this->consumeBellyfulSleeping());
        } else {
            $this->thinkHealthActive();
            $this->changeHealthAndEnergyActive($this->consumeBellyfulActive());
        }
        if (($this->energy < 20) * !$this->isSleeping())
            $this->addSleep(30);
    }

    protected function addSleep($duration)
    {
        $this->sleep += $duration;
    }

    abstract protected function thinkHealthActive();

    abstract protected function thinkHealthSleeping();

    abstract protected function consumeBellyfulActive();

    abstract protected function consumeBellyfulSleeping();

    abstract protected function changeHealthAndEnergyActive($consumedBellyful);

    abstract protected function changeHealthAndEnergySleeping($consumedBellyful);
}
