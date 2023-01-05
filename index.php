<?php

require_once("./Monster.php");
require_once ("./Player.php");
require_once ("./Figth.php");


//Create entity
$player = new Player(2,"Arthur");
$monster1 = new Monster("Gobelin");

$figth = new Figth($player, $monster1);
$figth->launch();
