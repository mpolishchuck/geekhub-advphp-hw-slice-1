<?php

namespace Universe;

interface CreatureInterface extends LifeFormInterface
{
    public function getHealth();

    public function getBellyful();

    public function getEnergy();

    public function isSleeping();
}
