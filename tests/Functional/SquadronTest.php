<?php namespace Tests\Functional;

use Garmential\Warrior\Warrior;
use Garmential\Warrior\Squadron;

class SquadronTest  extends \TestCase {

    public function test_i_can_create_a_squadron()
    {
        $this->assertTrue(new Squadron instanceof Squadron);
    }

    public function test_a_squadron_is_countable_and_empty()
    {
        $squadron = new Squadron;
        $this->assertTrue(count($squadron) == 0, "Count of Squadron should return 0");
    }

    public function test_i_can_add_to_the_squadron()
    {
        $squadron = new Squadron;
        $squadron->add(new Warrior());
        $this->assertTrue(count($squadron) == 1, "Count of Squadron should return 1");
    }

    public function test_that_a_defeated_warrior_is_not_counted()
    {
        $squadron = new Squadron;
        $warrior = new Warrior();
        $squadron->add($warrior);
        $this->assertTrue(count($squadron) == 1, "Count of Squadron should return 1");
        (new Warrior(["strength" => 1000000]))->attack($warrior); // large attack will defeat immediately
        $this->assertTrue(count($squadron) == 0, "Count of Squadron should return 0 after warrior is defeated");
    }

    public function test_I_can_get_the_warrior_i_have_just_added()
    {
        $squadron = new Squadron;
        $warrior = new Warrior();
        $squadron->add($warrior);
        $firstWarrior = $squadron->getNextWarrior();
        $this->assertTrue($warrior === $firstWarrior, "getNextWarrior should return the only warrior I have added");

    }

    public function test_I_can_get_the_first_warrior_i_have_just_added()
    {
        $squadron = new Squadron;
        $warrior1 = new Warrior();
        $squadron->add($warrior1);

        $warrior2 = new Warrior();
        $squadron->add($warrior2);

        $this->assertTrue($warrior1 === $squadron->getNextWarrior(), "getNextWarrior should return the first warrior I added");

        (new Warrior(["strength" => 1000000]))->attack($warrior1); // large attack will defeat warrior1

        $this->assertTrue($warrior2 === $squadron->getNextWarrior(), "getNextWarrior should return the second warrior I added as the first is defeated");
    }


}