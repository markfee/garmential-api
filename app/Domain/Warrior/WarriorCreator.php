<?php namespace Garmential\Warrior;


class WarriorCreator extends Warrior implements CharacterCreatorInterface {

    function __construct()    {    }

    /**
     * @param $attributes Array
     * @return CharacterInterface
     */
    public function Generate($attributes = [])
    {
        return new Warrior($attributes);
    }
}