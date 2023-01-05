<?php
require_once("./Entity.php");

class Monster extends Entity
{
    public function __construct(string $name)
    {
        $pow = random_int(1, 5);
        parent::__construct($pow * 2, $pow, $name);
    }

}