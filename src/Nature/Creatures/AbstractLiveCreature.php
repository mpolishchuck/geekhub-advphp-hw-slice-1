<?php

namespace Nature\Creatures;

use Universe\CreatureInterface;
use Universe\ThingInterface;

/**
 * Class AbstractLiveCreature
 * @package Nature\Creatures
 *
 * This is abstract class for live creature
 * Implements basic life processes
 */
abstract class AbstractLiveCreature implements ThingInterface, CreatureInterface
{
    /**
     * Describes 'alive' state of the creature
     */
    const STATE_ALIVE = __LINE__;
    /**
     * Describes 'dead' state if the creature
     */
    const STATE_DEAD  = __LINE__;

    /**
     * @var int life state of the creature
     */
    protected $state = self::STATE_ALIVE;
    /**
     * @var float health of the creature
     */
    protected $health = 100;
    /**
     * @var float bellyful of the creature
     */
    protected $bellyful = 100;
    /**
     * @var float energy of the creature
     */
    protected $energy = 100;
    /**
     * @var int number of steps to complete sleeping
     */
    protected $sleep = 0;

    /**
     * Is creature alive now?
     * @return bool
     */
    public function isAlive()
    {
        return ($this->state == self::STATE_ALIVE);
    }

    /**
     * Is creature dead now?
     * @return bool
     */
    public function isDead()
    {
        return ($this->state == self::STATE_DEAD);
    }

    /**
     * Get current health of the creature
     * @return float
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Get current bellyful of the creature
     * @return float
     */
    public function getBellyful()
    {
        return $this->bellyful;
    }

    /**
     * Get current energy of the creature
     * @return float
     */
    public function getEnergy()
    {
        return $this->energy;
    }

    /**
     * Is creature sleeping now?
     * @return bool
     */
    public function isSleeping()
    {
        return ($this->sleep > 0);
    }

    /**
     * Run life one step of creature's life process
     */
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

    /**
     * Add some 'sleeping' steps
     * @param int $duration number of steps to sleep
     */
    protected function addSleep($duration)
    {
        $this->sleep += $duration;
    }

    /**
     * Change health of the creature when it in 'active' state
     */
    abstract protected function thinkHealthActive();

    /**
     * Change health of the creature when it in 'sleeping' state
     */
    abstract protected function thinkHealthSleeping();

    /**
     * Consume bellyful in 'active' state
     * @return float amount of consumed bellyful
     */
    abstract protected function consumeBellyfulActive();

    /**
     * Consume bellyful in 'sleeping' state
     * @return float amount of consumed bellyful
     */
    abstract protected function consumeBellyfulSleeping();

    /**
     * Change health and energy in 'active' state with values based on consumed bellyful
     * @param float $consumedBellyful
     */
    abstract protected function changeHealthAndEnergyActive($consumedBellyful);

    /**
     * Change health and energy in 'sleeping' state with values based on consumed bellyful
     * @param $consumedBellyful
     */
    abstract protected function changeHealthAndEnergySleeping($consumedBellyful);
}
