<?php

namespace App\Model;

final class Monster extends AbstractEntity
{
    static private array $monsters = [["Slime", 7, 1, 1], ["Gobelin", 10, 3, 1], ["Orc", 15, 5, 2], ["Bandit", 17, 8, 3], ["Basilic", 40, 4, 3], ["Orgre", 60, 14, 5], ["Naga Osseux", 90, 40, 15], ["Dragon", 1500, 200, 150], ["Dieu del a colère", 40000000, 15000, 50000000]];

    private int $stats;

    private function __construct(int $stamina, int $power, string $name, int $stats)
    {
        parent::__construct($stamina, $power, $name);
        $this->stats = $stats;
    }

    public function getStats(): int
    {
        return $this->stats;
    }

    static public function getAllName()
    {
        print_r("\n\nSelectionnez le monstre que vous souhaitez affronter :\n");
        foreach (self::$monsters as $index => $monster) {
            print_r($index . " - " . $monster[0] . "\n");
        }
    }

    static public function getMonster($i): Monster
    {
        if ($i !== "") {
            echo $i;
            if (is_int(intval($i)) && $i < count(self::$monsters)) {
                return new Monster(self::$monsters[$i][1], self::$monsters[$i][2], self::$monsters[$i][0], self::$monsters[$i][3]);
            } else {
                $pow = random_int(1, 50);
                return new Monster($pow * 4, $pow, "Inconnue", $pow);
            }
        } else {
            $pow = random_int(1, 50000);
            return new Monster($pow * 4, $pow, "Inconnue Suprême", $pow);
        }
    }

}