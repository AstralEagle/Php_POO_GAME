<?php
namespace App\Model;

abstract class AbstractEntity
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
        $damage = random_int($this->power - $this->power / 5, $this->power + $this->power / 5) * 1.2;
        echo $this->name . " lance une attaque\n";
        return $damage;
    }

    public function getDamage(int $attack): void
    {
        $touch = random_int(0, 20);
        $damage = $attack;
        if ($touch == 0) {
            print_r($this->name . " esquive le coup.\n");
        } else if ($touch == 20) {
            $damage = $attack*2.5;
            print_r("Coup critique!!\n" . $this->name . " subit ".$damage ." dégat.\n");
            $this->stamina -= $damage;

        } else {
            print_r($this->name . " subit ".$damage ." dégat.\n");
            $this->stamina -= $damage;
        }
        if ($this->stamina < 1) {
            $this->isDead = true;
            sleep(1);
            print_r("\n".$this->name . " meurt sous ces coup.\n");
        }
    }

    public function __toString(): string
    {
        return $this->name . " a " . $this->stamina . " de stamina, " . $this->power . " de puissance.\n";
    }


}