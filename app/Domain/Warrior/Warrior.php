<?php namespace Garmential\Warrior;

class Warrior extends Character {

    protected function __construct($attributes = [])
    {
        $this->attributes   = $attributes;
        $this->initialise_attribute("strength"       ,    $this->random_normal(100.0, 15.0));
        $this->initialise_attribute("weight"         ,    $this->random_normal(85,    15.0));
        $this->initialise_attribute("health"         ,    $this->random_normal(100.0, 15.0));
        $this->initialise_attribute("intelligence"   ,    $this->random_normal(100.0, 15.0));
        $this->initialise_attribute("agility"        ,    $this->random_normal(100.0, 15.0));
        parent::__construct($attributes);
    }
}