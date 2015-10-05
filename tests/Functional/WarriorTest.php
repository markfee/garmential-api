<?php namespace Tests\Functional;

use Garmential\Warrior\Warrior;


class WarriorTest extends \TestCase {

    private $attributes1 = [
        "strength"          => 5,
        "weight"            => 10,
        "health"            => 100,
        "intelligence"      => 20,
        "agility"           => 25,
    ];

    private $attributes2 = [
        "strength"          => 15,
        "weight"            => 20,
        "health"            => 100,
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

    public function test_a_brute_strength_attack_causes_damage()
    {
        $warrior1 = new Warrior(["strength"=>50, "health"=>75]);
        $warrior2 = new Warrior(["strength"=>35, "health"=>100]);

        $warrior1->attack($warrior2);

        $this->assertTrue($warrior2->gethealth() == (100 - 50), "warrior2 should be damaged when attacked by warrior 1");
    }

    public function test_fighting_a_round_causes_damage_to_both()
    {
        $warrior1 = new Warrior(["strength"=>50, "health"=>75]);
        $warrior2 = new Warrior(["strength"=>35, "health"=>100]);

        $warrior1->fight_a_round($warrior2);

        $this->assertTrue($warrior1->gethealth() == (75  - 35), "warrior1 should be damaged when attacking warrior 2");
        $this->assertTrue($warrior2->gethealth() == (100 - 50), "warrior2 should be damaged when attacked by warrior 1");
    }


    public function test_repeated_fighting_causes_a_defeat()
    {
        $warrior1 = new Warrior(["strength"=>50, "health"=>75]);
        $warrior2 = new Warrior(["strength"=>35, "health"=>100]);

        $warrior1->fight_a_round($warrior2);

        $this->assertTrue($warrior1->gethealth() == (40), "warrior1 should be damaged when attacking warrior 2");
        $this->assertTrue($warrior2->gethealth() == (50), "warrior2 should be damaged when attacked by warrior 1");
        $this->assertFalse($warrior1->is_defeated(), "Warrior 1 not yet defeated");
        $this->assertFalse($warrior2->is_defeated(), "Warrior 2 not yet defeated");

        $warrior1->fight_a_round($warrior2);

        $this->assertTrue($warrior1->gethealth() == (5), "warrior1 should be damaged when attacking warrior 2");
        $this->assertTrue($warrior2->gethealth() == (0), "warrior2 should be damaged when attacked by warrior 1");
        $this->assertFalse($warrior1->is_defeated(), "Warrior 1 not yet defeated");
        $this->assertTrue($warrior2->is_defeated(), "Warrior 2 is defeated");
    }

    public function test_i_can_create_randomised_warrior()
    {
        $warrior = (new Warrior)->randomise();

        $testcount = 0;
        $testcount += ($warrior->getStrength()      == Warrior::DEFAULT_STRENGTH);
        $testcount += ($warrior->getWeight()        == Warrior::DEFAULT_WEIGHT);
        $testcount += ($warrior->getHealth()        == Warrior::DEFAULT_HEALTH);
        $testcount += ($warrior->getIntelligence()  == Warrior::DEFAULT_INTELLIGENCE);
        $testcount += ($warrior->getAgility()       == Warrior::DEFAULT_AGILITY);
        $this->assertFalse($testcount == 5, "It is unlikely that test count will be 5 but it may happen occasionally");
    }
}