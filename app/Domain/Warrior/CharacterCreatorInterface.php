<?php namespace Garmential\Warrior;


interface CharacterCreatorInterface {
    /**
     * @return CharacterInterface
     */
    public function Generate();
}