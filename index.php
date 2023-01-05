<?php

require_once("./Monster.php");
require_once ("./Player.php");

//Create entity
$player = new Player(10,"Arthur");
$monster1 = new Monster("Gobelin");

// Round 1
print_r($player->toString());
print_r($monster1->toString());
$monster1->setPower(20);
$player->getDamage($monster1->attack());
print_r($player->toString());
print_r($monster1->toString());

// Round 2
$player->heal();
print_r($player->toString());
print_r($monster1->toString());
if($player->isDead()){
    echo "Game over!\n";
}
