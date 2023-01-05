<?php

require_once("./Monster.php");
require_once ("./Player.php");
require_once("./Fight.php");



print_r("Bienvenue dans POO Game\nAvant de commence, merci de rentrer votre nom:\n");
$handle = fopen("php://stdin", "r");
$line = fgets($handle);
$player = new Player(10,trim($line));
fclose($handle);

while(true){
    Monster::getAllName();
    print_r("\n");
    $handle = fopen("php://stdin", "r");
    $line = fgets($handle);
    fclose($handle);
    $monster = Monster::getMonster(trim($line));
    $fight = new Fight($player,$monster);
    $fight->launch();
}


