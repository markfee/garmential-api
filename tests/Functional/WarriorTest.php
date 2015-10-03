<?php namespace Tests\Functional;

use Garmential\Warrior\Warrior;


class WarriorTest extends \TestCase {

    private $attributes1 = [
        "strength"          => 5,
        "weight"            => 10,
        "health"            => 15,
        "intelligence"      => 20,
        "agility"           => 25,
    ];

    private $attributes2 = [
        "strength"          => 15,
        "weight"            => 20,
        "health"            => 25,
        "intelligence"      => 30,
        "agility"           => 35,
    ];


    public function test_i_can_create_a_warrior()
    {
        $warrior = new Warrior;
        $this->assertTrue($warrior  instanceof Warrior);
    }

    public function test_a_warrior_has_default_attributes()
    {
        $warrior = new Warrior;
        $this->assertTrue($warrior->getStrength() == Warrior::DEFAULT_STRENGTH);
        $this->assertTrue($warrior->getWeight() == Warrior::DEFAULT_WEIGHT);
        $this->assertTrue($warrior->getHealth() == Warrior::DEFAULT_HEALTH);
        $this->assertTrue($warrior->getIntelligence() == Warrior::DEFAULT_INTELLIGENCE);
        $this->assertTrue($warrior->getAgility() == Warrior::DEFAULT_AGILITY);
    }

    public function test_a_warrior_has_assigned_attributes()
    {
        $attributes = &$this->attributes1;
        $warrior = new Warrior($attributes);
            $this->assertTrue($warrior->getStrength()       == $attributes["strength"]);
            $this->assertTrue($warrior->getWeight()         == $attributes["weight"]);
            $this->assertTrue($warrior->getHealth()         == $attributes["health"]);
            $this->assertTrue($warrior->getIntelligence()   == $attributes["intelligence"]);
            $this->assertTrue($warrior->getAgility()        == $attributes["agility"]);

    }


}