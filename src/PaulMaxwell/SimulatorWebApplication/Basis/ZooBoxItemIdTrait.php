<?php

namespace PaulMaxwell\SimulatorWebApplication\Basis;

trait ZooBoxItemIdTrait
{
    protected $id;

    public function getId()
    {
        return $this->id;
    }

    public function generateId()
    {
        $this->id = md5(uniqid('', true));
    }
}
