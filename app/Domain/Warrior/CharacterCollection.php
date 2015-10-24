<?php namespace Garmential\Warrior;


class CharacterCollection implements \Countable {
    use IdentifierTrait;

    /**
     * @var array
     */
    protected $characters = [];

    function __construct($characters = [])
    {
        $this->Identifier_setIdentity("CharacterCollection");
        $this->characters = $characters;
    }

    public function add(CharacterInterface $character)
    {
        $this->characters[] = $character;
    }

    public function getNext()
    {
        foreach ($this->characters as $character) {
            if (!$character->isDefeated()) {
                print " {$this->Identifier_getIdentity()} Not defeated";
                return $character;
            }
        }
        print " {$this->Identifier_getIdentity()} Defeated";
        return null;
    }

    public function count()
    {
        $count = 0;
        /** @var Warrior $character */
        foreach ($this->characters as $character) {
            $count += ($character->isDefeated() ? 0 : 1);
        }
        return $count;
    }

    public function isDefeated()
    {
        return count($this) == 0;
    }
}