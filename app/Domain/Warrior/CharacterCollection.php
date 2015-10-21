<?php namespace Garmential\Warrior;


class CharacterCollection {

    protected $characters = [];

    public function add(CharacterInterface $character)
    {
        $this->characters[] = $character;
    }

    public function getNext()
    {
        foreach ($this->characters as $character) {
            if (!$character->is_defeated()) {
                return $character;
            }
        }
        return null;
    }

    public function count()
    {
        $count = 0;
        /** @var Warrior $character */
        foreach ($this->characters as $character) {
            $count += ($character->is_defeated() ? 0 : 1);
        }
        return $count;
    }
}