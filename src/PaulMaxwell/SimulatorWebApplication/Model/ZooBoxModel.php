<?php

namespace PaulMaxwell\SimulatorWebApplication\Model;

use PaulMaxwell\SimulatorBasis\Universe\ThingInterface;
use PaulMaxwell\SimulatorWebApplication\Basis\ZooBoxItemInterface;

class ZooBoxModel
{
    protected $items = array();

    /**
     * @return ZooBoxItemInterface[]
     */
    public function getItems()
    {
        return $this->items;
    }

    public function addItem(ZooBoxItemInterface $item)
    {
        $this->items[] = $item;
    }

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

    public function think()
    {
        foreach ($this->items as $item) {
            /* @var ThingInterface $item */
            $item->think();
        }
    }
}
