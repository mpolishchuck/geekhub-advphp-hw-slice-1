<?php

namespace Home;

/**
 * Class PetInterface
 * @package Home
 *
 * Interface for pet
 * Every pet has own name, given by owner
 */
interface PetInterface
{
    /**
     * Creates new pet object
     * @param string $name name of the pet
     */
    public function __construct($name);

    /**
     * Get name of the pet
     * @return string name of the pet
     */
    public function getName();

    /**
     * Feed the pet
     * @param float $food amount of food
     */
    public function feed($food);

    /**
     * Get mood of the pet
     * @return float current mood of the pet
     */
    public function getMood();

    /**
     * Start playing with pet
     * @param integer $duration number of steps to play
     */
    public function play($duration);

    /**
     * Is pet playing now?
     * @return bool
     */
    public function isPlaying();
}
