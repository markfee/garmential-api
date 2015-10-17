<?php namespace Garmential\Warrior;


class Squadron implements \Countable {
    private $warriors = [];

    public function add(Warrior $warrior)
    {
        $this->warriors[] = $warrior;
    }

    public function getNextWarrior()
    {
        foreach($this->warriors as $warrior) {
            if (!$warrior->is_defeated()) {
                return $warrior;
            }
        }
        return null;
    }

   public function count()
   {
       $count = 0;
       /** @var Warrior $warrior */
       foreach($this->warriors as $warrior) {
           $count += ($warrior->is_defeated() ? 0:1);
       }
       return $count;
   }
}