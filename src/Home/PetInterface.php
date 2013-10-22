<?php

namespace Home;

/**
 * Class PetInterface
 * @package Home
 *
 * Interface for pet
 */
interface PetInterface
{
    public function __construct($name);

    public function getName();

    public function feed($food);

    public function getMood();

    public function play($duration);

    public function isPlaying();
}
