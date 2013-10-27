<?php

namespace PaulMaxwell\SimulatorWebApplication\Model\ZooBoxItem;

use PaulMaxwell\SimulatorBasis\Home\SphericalCat;
use PaulMaxwell\SimulatorWebApplication\Basis\ZooBoxItemInterface;

class Cat extends SphericalCat implements ZooBoxItemInterface
{

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return $this->getName() . ' (cat)';
    }

    /**
     * @return string
     */
    public function getDisplayIconClass()
    {
        return $this->isDead() ? 'death' : 'cat';
    }

    /**
     * @return array
     */
    public function getCurrentStatus()
    {
        return array(
            array('Health', $this->getHealth()),
            array('Bellyful', $this->getBellyful()),
            array('Energy', $this->getEnergy()),
            array('Mood', $this->getMood()),
        );
    }
}
