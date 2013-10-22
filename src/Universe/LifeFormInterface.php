<?php

namespace Universe;

/**
 * Interface LifeFormInterface
 * @package Universe
 *
 * Interface for universe life form
 * Life form can alive or dead
 */
interface LifeFormInterface
{
    /**
     * Is creature alive?
     * @return bool
     */
    public function isAlive();

    /**
     * Is creature dead?
     * @return bool
     */
    public function isDead();
}
