<?php namespace Tests\Functional;

use Garmential\Warrior\Warrior;
use Garmential\Warrior\WarriorCollection;

class WarriorCollectionTest  extends \TestCase {

    public function test_i_can_create_a_warrior_collection()
    {
        $this->assertTrue(new WarriorCollection instanceof WarriorCollection);
    }

    public function test_i_can_a_warrior_collection_is_countable_and_empty()
    {
        $warriorCollection = new WarriorCollection;
        $this->assertTrue(count($warriorCollection) == 0, "Count of Warrior Collection should return 0");
    }

    public function test_i_can_add_to_the_warrior_collection()
    {
        $warriorCollection = new WarriorCollection;
        $warriorCollection->add(new Warrior());
        $this->assertTrue(count($warriorCollection) == 1, "Count of Warrior Collection should return 1");
    }

    public function test_that_a_defeated_warrior_is_not_counted()
    {
        $warriorCollection = new WarriorCollection;
        $warrior = new Warrior();
        $warriorCollection->add($warrior);
        $this->assertTrue(count($warriorCollection) == 1, "Count of Warrior Collection should return 1");
        (new Warrior(["strength" => 1000000]))->attack($warrior); // large attack will defeat immediately
        $this->assertTrue(count($warriorCollection) == 0, "Count of Warrior Collection should return 0 after warrior is defeated");
    }

    public function test_I_can_get_the_warrior_i_have_just_added()
    {
        $warriorCollection = new WarriorCollection;
        $warrior = new Warrior();
        $warriorCollection->add($warrior);
        $firstWarrior = $warriorCollection->getNextWarrior();
        $this->assertTrue($warrior === $firstWarrior, "getNextWarrior should return the only warrior I have added");

    }

    public function test_I_can_get_the_first_warrior_i_have_just_added()
    {
        $warriorCollection = new WarriorCollection;
        $warrior1 = new Warrior();
        $warriorCollection->add($warrior1);

        $warrior2 = new Warrior();
        $warriorCollection->add($warrior2);

        $this->assertTrue($warrior1 === $warriorCollection->getNextWarrior(), "getNextWarrior should return the first warrior I added");

        (new Warrior(["strength" => 1000000]))->attack($warrior1); // large attack will defeat warrior1

        $this->assertTrue($warrior2 === $warriorCollection->getNextWarrior(), "getNextWarrior should return the second warrior I added as the first is defeated");
    }


}