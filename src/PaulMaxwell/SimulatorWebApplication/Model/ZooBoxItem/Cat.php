<?php

namespace PaulMaxwell\SimulatorWebApplication\Model\ZooBoxItem;

use PaulMaxwell\SimulatorBasis\Home\SphericalCat;
use PaulMaxwell\SimulatorWebApplication\Basis\ZooBoxItemIdTrait;
use PaulMaxwell\SimulatorWebApplication\Basis\ZooBoxItemInterface;

class Cat extends SphericalCat implements ZooBoxItemInterface
{
    use ZooBoxItemIdTrait;

    public function __construct($name)
    {
        parent::__construct($name);
        $this->generateId();
    }

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

    /**
     * @return string
     */
    public function getStateStatus()
    {
        if ($this->isDead()) {
            return 'Dead';
        }

        return ($this->isSleeping() ? 'Sleeping' : 'Active') . ', ' . ($this->isPlaying() ? 'Playing' : 'Idle');
    }

    /**
     * @return array
     */
    public function getActionLinks()
    {
        $links = array();
        if ($this->isAlive()) {
            if (!$this->isPlaying() && !$this->isSleeping()) {
                $links[] = array('Play', '?do=play&id='.$this->getId());
            }
            $links[] = array('Feed', '?do=feed&id='.$this->getId());
        }

        return $links;
    }
}
