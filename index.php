<?php

require_once("./Monster.php");
require_once ("./Player.php");
require_once ("./Figth.php");


//Create entity
$player = new Player(2,"Arthur");
$monster1 = new Monster("Gobelin");
$monster2 = new Monster("Gobeline");

$figth = new Figth($player, $monster1);
$figth->launch();
$figth = new Figth($player, $monster2);
$figth->launch();
