<?php namespace Garmential\Warrior;

class CharacterCreator extends Character implements CharacterCreatorInterface {
    /**
     * @var Character
     */
    private $character;

    /**
     * pass in an instance of the type of character that you want to generate
     * @param Character $character
     */
    public function __construct(Character $character)
    {
        $this->character = $character;
    }

    /**
     * @param $attributes Array
     * @return Warrior
     */
    public function Generate($attributes = [])
    {
        return $this->character->create_instance($attributes);
    }

    /**
     * @param int $size Number of instances to generate
     * @param array $attributes associative array of common defaults or numbered array of attributes for each instance.
     * @return Array
     */
    public function GenerateCollection($size = 1, $attributes = [])
    {
        $characters = [];
        for ($i = 0; $i < $size; $i++)
        {
            $default_attributes = empty($attributes[$i]) ? $attributes : $attributes[$i];
            $characters[] =  $this->Generate($default_attributes);
        }
        return $characters;
    }
}