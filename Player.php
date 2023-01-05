<?php
require_once("./Entity.php");

class Player extends Entity
{

    public function __construct(int $power, string $name)
    {
        parent::__construct(35, $power, $name);
    }

    public function fuir(): void
    {
        // Fuir le combat
    }

    public function heal(): void
    {
        if (!$this->isDead) {
            $regen = random_int(1, $this->power);
            $this->stamina = $this->stamina + $regen * 2;
        }
    }

    public function toString(): string
    {
        return $this->name . " a " . $this->stamina . " de stamina, " . $this->power . " de puissance.\n";
    }

}