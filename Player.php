<?php
require_once("./Entity.php");

class Player extends Entity
{

    public function __construct(int $power, string $name)
    {
        parent::__construct(35, $power, $name);
    }

    public function heal(): void
    {
        if (!$this->isDead) {
            $regen = random_int(1, $this->power)*2;
            print_r("Vous vous soignez de ".$regen ." point de stamina\n");
            $this->stamina += $regen;
        }
    }


}