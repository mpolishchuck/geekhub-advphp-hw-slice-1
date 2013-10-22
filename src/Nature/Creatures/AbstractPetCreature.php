<?php

namespace Nature\Creatures;

use Home\PetInterface;

/**
 * Class AbstractPetCreature
 * @package Nature\Creatures
 *
 * This is abstract class for pet
 */
abstract class AbstractPetCreature extends AbstractLiveCreature implements PetInterface
{
    protected $name;
    protected $mood = 50;
    protected $playing = 0;

    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * Get pet's name
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Feed the pet
     * @param float $food
     */
    public function feed($food)
    {
        $this->bellyful += $food;
        $this->energy -= $food / 2;
    }

    /**
     * Get pet's mood
     * @return float
     */
    public function getMood()
    {
        return $this->mood;
    }

    /**
     * Play with pet
     * @param integer $duration
     */
    public function play($duration)
    {
        $this->playing += $duration;
    }

    /**
     * Is pet now playing?
     * @return bool
     */
    public function isPlaying()
    {
        return ($this->playing > 0);
    }

    public function think()
    {
        if ($this->isDead())
            return;
        if (!$this->isSleeping()) {
            if ($this->playing > 0) {
                $this->playing--;
                $this->changeMoodAndEnergyPlaying();
            } else {
                $this->changeMoodAndEnergyIdle();
            }
            if ($this->mood <= 1) {
                /* Do suicide */
                $this->health = 0;
            }
        }
        parent::think();
    }

    abstract protected function changeMoodAndEnergyPlaying();

    abstract protected function changeMoodAndEnergyIdle();
}
