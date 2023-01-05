<?php

abstract class Entity
{
    protected int $stamina, $power;
    protected string $name;
    protected bool $isDead;


    public function __construct(int $stamina, int $power, string $name)
    {
        $this->stamina = $stamina;
        $this->power = $power;
        $this->name = $name;
        $this->isDead = false;
    }

    // Getter
    public function getStamina(): int
    {
        return $this->stamina;
    }
    public function getPower(): int
    {
        return $this->power;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function isDead(): bool
    {
        return $this->isDead;
    }

    // Setter
    public function setPower(int $power): void
    {
        $this->power = $power;
    }

    public function attack(): int
    {
        $damage = random_int($this->power-$this->power/5,$this->power+$this->power/5)*2;
        echo $this->name." lance une attaque et inflige ".$damage." dégat\n";
        return $damage;
    }

    public function getDamage(int $damage): void
    {
        $this->stamina = $this->stamina - $damage;
        if ($this->stamina < 1) {
            $this->isDead = true;
            print_r($this->name." meurt sous ces coup.\n");
        }
    }
    public function __toString(): string
    {
        return $this->name . " a " . $this->stamina . " de stamina, " . $this->power . " de puissance.\n";
    }


}