<?php

namespace PaulMaxwell\SimulatorBasis\Nature\Creatures;

use PaulMaxwell\SimulatorBasis\Home\PetInterface;
use PaulMaxwell\SimulatorBasis\Nature\Creatures\AbstractLiveCreature;

/**
 * Class AbstractPetCreature
 * @package Nature\Creatures
 *
 * This is abstract class for pet
 * Pet can do anything that can do any creature
 * Also pet can play, eat and have a mood property
 */
abstract class AbstractPetCreature extends AbstractLiveCreature implements PetInterface
{
    /**
     * @var string the name of the pet
     */
    protected $name;
    /**
     * @var float the mood of the pet
     */
    protected $mood = 50;
    /**
     * @var int number of steps to complete playing
     */
    protected $playing = 0;

    /**
     * Creates new pet with specified name
     * @param string $name pet's name
     */
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
     * Start playing with pet
     * @param integer $duration number of steps to play
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

    /**
     * Run life one step of pet's life process
     */
    public function think()
    {
        if ($this->isDead()) {
            return;
        }
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

    /**
     * Change pet's mood and energy in 'playing' state
     */
    abstract protected function changeMoodAndEnergyPlaying();

    /**
     * Change pet's mood and energy in 'idle' state
     */
    abstract protected function changeMoodAndEnergyIdle();
}
