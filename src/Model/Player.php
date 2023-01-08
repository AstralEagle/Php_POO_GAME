<?php

namespace App\Model;
use App\Model\AbstractEntity;
use \App\Model\InterfaceCapacite;
final class Player extends AbstractEntity implements InterfaceCapacite
{
    private int $maxStamina;

    public function __construct(int $power, string $name)
    {
        parent::__construct(15, $power, $name);
        $this->maxStamina = 15;
    }

    //  Function qui permet de se soigner
    public function heal(): void
    {
        $regen = random_int($this->power / 6, $this->power) * 2;
        $this->stamina += $regen;
        if($this->stamina > $this->maxStamina){
            $this->stamina = $this->maxStamina;
        }
        print_r("Vous vous soignez de " . $regen . " point de stamina\n");
    }

    public function levelUp(int $stats): void
    {
        $this->power += $stats;
        $this->stamina += $stats;
        $this->maxStamina += $stats;
    }


}