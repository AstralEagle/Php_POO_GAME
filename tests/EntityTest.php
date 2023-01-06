<?php

namespace Tests;

use App\Model\Monster;
use PHPUnit\Framework\TestCase;

class EntityTest extends TestCase
{
    public function testGetName()
    {
        /*
         * Test la recuperation du nom du Monstre
         */
        $entity = Monster::getMonster(0);
        $this->assertEquals("Slime", $entity->getName());
    }

    public function testGetPower()
    {
        /*
         * Test la recuperation de la force du Monstre
         */
        $entity = Monster::getMonster(0);
        $this->assertEquals(1, $entity->getPower());
    }
    public function testGetStamina()
    {
        /*
         * Test la recuperation de la stamina du Monstre
         */
        $entity = Monster::getMonster(0);
        $this->assertEquals(7, $entity->getStamina());
    }
    public function testTakeDamage()
    {
        /*
         * Test de subition de dégat
         * 1 chance sur 10 d'echouer si coup critique ou esquive ...
         */
        $entity = Monster::getMonster(0);
        $this->assertEquals(7, $entity->getStamina());
        $entity->getDamage(1);
        $this->assertEquals(6, $entity->getStamina());
    }

}