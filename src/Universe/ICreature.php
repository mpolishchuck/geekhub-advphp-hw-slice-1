<?php

namespace Universe;

interface ICreature extends ILifeForm
{
    public function getHealth();

    public function getBellyful();

    public function getEnergy();

    public function isSleeping();
}
