<?php

namespace PaulMaxwell\SimulatorWebApplication\Model;

use PaulMaxwell\SimulatorBasis\Universe\ThingInterface;
use PaulMaxwell\SimulatorWebApplication\Basis\ZooBoxItemInterface;

/**
 * Class ZooBoxModel
 * @package PaulMaxwell\SimulatorWebApplication\Model
 *
 * This is model of our ZooBox
 */
class ZooBoxModel
{
    protected $items = array();

    /**
     * Get all items of the ZooBox as the array
     * @return \PaulMaxwell\SimulatorWebApplication\Basis\ZooBoxItemInterface[]
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Adds new item to our ZooBox
     * @param \PaulMaxwell\SimulatorWebApplication\Basis\ZooBoxItemInterface $item
     */
    public function addItem(ZooBoxItemInterface $item)
    {
        $this->items[] = $item;
    }

    /**
     * Searches creatures according to some method's return
     * @param  string    $method
     * @param  mixed     $val
     * @return null|\PaulMaxwell\SimulatorWebApplication\Basis\ZooBoxItemInterface
     */
    public function searchByMethodReturn($method, $val)
    {
        foreach ($this->items as $item) {
            if (method_exists($item, $method)) {
                if ($item->$method() == $val) {
                    return $item;
                }
            }
        }

        return null;
    }

    /**
     * Moves to the next step of the simulation
     */
    public function think()
    {
        foreach ($this->items as $item) {
            /* @var \PaulMaxwell\SimulatorBasis\Universe\ThingInterface $item */
            $item->think();
        }
    }
}
