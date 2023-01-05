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
        return $this->power * 2;
    }

    public function getDamage(int $damage): void
    {
        $this->stamina = $this->stamina - $damage;
        if ($this->stamina < 1) {
            $this->isDead = true;
        }
    }
    public function toString(): string
    {
        return $this->name . " a " . $this->stamina . " de stamina, " . $this->power . " de puissance.\n";
    }


}