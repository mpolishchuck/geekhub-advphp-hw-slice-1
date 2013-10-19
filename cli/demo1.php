<?php
include '../src/AutoLoader.php';
AutoLoader::register();

$animal = new \Vacuum\SphericalHorse();

$i = 0;
while (true) {
    printf(
        "%3d. Health: %.1f; Bellyful: %.1f; Energy: %.1f - %s, %s\n",
        ++$i,
        $animal->getHealth(),
        $animal->getBellyful(),
        $animal->getEnergy(),
        $animal->isSleeping() ? 'Sleeping' : 'Active',
        $animal->isAlive() ? 'Still alive' : 'Dead'
    );
    if($animal->isDead())
        break;
    $animal->think();
    sleep(1);
}

echo "Working cycle complete\n";
