<?php

require_once '../vendor/autoload.php';

use App\Controlleur\FightController;
use App\Model\Monster;
use App\Model\Player;

// Boucle majeur du jeux, si le persdonnage meur le jeux recommence
while (true) {

    print_r("Bienvenue dans POO Game\nAvant de commence, merci de rentrer votre nom:\n");
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    $player = new Player(random_int(2, 8), trim($line));
    fclose($handle);

    while (!$player->isDead()) {
        Monster::getAllName();
        print_r("\n");
        $handle = fopen("php://stdin", "r");
        $line = fgets($handle);
        fclose($handle);
        if (trim($line) == "player") {
            print_r($player."\n");
            sleep(3);
        } else {
            $monster = Monster::getMonster(trim($line));
            $fight = new FightController($player, $monster);
            $fight->launch();
        }
    }
}


