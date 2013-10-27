<?php

namespace PaulMaxwell\SimulatorWebApplication\Model\ZooBoxItem;

use \PaulMaxwell\SimulatorBasis\Vacuum\SphericalHorse as VacuumSphericalHorse;
use PaulMaxwell\SimulatorWebApplication\Basis\ZooBoxItemInterface;

class SphericalHorse extends VacuumSphericalHorse implements ZooBoxItemInterface
{

    /**
     * @return string
     */
    public function getDisplayName()
    {
        return 'Spherical horse in the vacuum';
    }

    /**
     * @return string
     */
    public function getDisplayIconClass()
    {
        return $this->isDead() ? 'death' : 'spherical-horse';
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
        );
    }
}
