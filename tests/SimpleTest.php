<?php

use \PaulMaxwell\SimulatorWebApplication\Model\ZooBoxModel;
use \PaulMaxwell\SimulatorWebApplication\Model\ZooBoxItem\SphericalHorse;
use \PaulMaxwell\SimulatorWebApplication\Model\ZooBoxItem\Cat;

class SimpleTest extends PHPUnit_Framework_TestCase
{
    public function testSimple()
    {
        $model = new ZooBoxModel();

        $model->addItem(new SphericalHorse());
        $model->addItem(new Cat("Fluffy"));

        while (true) {
            $isAllDead = true;
            foreach ($model->getItems() as $item) {
                /* @var \PaulMaxwell\SimulatorBasis\Nature\Creatures\AbstractLiveCreature $item */
                $isAllDead &= $item->isDead();
            }
            if ($isAllDead) {
                break;
            }
            $model->think();
        }
    }
}
