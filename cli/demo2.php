<?php
require '../vendor/autoload.php';

$animal = new \Home\SphericalCat('Fluffy');

$i = 0;
while (true) {
    printf(
        "%3d. %s - Health: %.1f; Bellyful: %.1f; Energy: %.1f; Mood: %.1f - %s, %s, %s\n",
        ++$i,
        $animal->getName(),
        $animal->getHealth(),
        $animal->getBellyful(),
        $animal->getEnergy(),
        $animal->getMood(),
        $animal->isSleeping() ? 'Sleeping' : 'Active',
        $animal->isPlaying() ? 'Playing' : 'Idle',
        $animal->isAlive() ? 'Still alive' : 'Dead'
    );
    if ($animal->isDead())
        break;
    if (($i % 15 == 0) && !$animal->isSleeping()) {
        echo "Playing with {$animal->getName()}\n";
        $animal->play(5);
    }
    if ($i % 21 == 0) {
        echo "Feeding {$animal->getName()}\n";
        $animal->feed(30);
    }
    $animal->think();
    sleep(1);
}

echo "Working cycle complete\n";
