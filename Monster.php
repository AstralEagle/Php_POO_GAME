<?php
require_once("./Entity.php");

class Monster extends Entity
{
    static private array $monsters = [["Gobelin",10,3,1],["Orc",15,5,2],["Orgre",60,14,5],["Slime",7,1,1],["Bandit",17,8,3],["Dragon",150,20,40],["Dieu",4000,150,50000000]];

    private int $stats;

    private function __construct(int $stamina, int $power, string $name, int $stats){
        parent::__construct($stamina, $power, $name);
        $this->stats = $stats;
    }

    public function getStats(): int
    {
        return $this->stats;
    }

    static public function getAllName(){
        print_r("\n\nSelectionnez le monstre que vous souhaitez affronter :\n");
        foreach (self::$monsters as $index=>$monster){
            print_r($index." - ".$monster[0]."\n");
        }
    }
    static public function getMonster($i): Monster
    {
        if(is_int(intval($i)) and $i<count(self::$monsters)){
        return  new Monster(self::$monsters[$i][1], self::$monsters[$i][2], self::$monsters[$i][0], self::$monsters[$i][3]);
        }
        else{
            $pow = random_int(1, 50);
            return new Monster($pow * 4, $pow,"Inconnue",$pow);
        }
    }

}