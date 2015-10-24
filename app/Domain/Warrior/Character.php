<?php namespace Garmential\Warrior;


class Character implements CharacterInterface {

    use IdentifierTrait;
    protected $attributes = [];

    protected function create_instance($attributes = [])
    {
        $instance = new static($attributes);
        return $instance;
    }

    public function __construct($attributes = [])
    {
        $this->Identifier_setIdentity(get_called_class());
        $this->initialise($attributes);
    }

    protected function initialise($attributes = [])
    {
        $this->attributes   = $attributes;
        $this->initialise_attribute("strength"     , 100);
        $this->initialise_attribute("weight"       , 85);
        $this->initialise_attribute("health"       , 105);
        $this->initialise_attribute("intelligence" , 100);
        $this->initialise_attribute("agility"      , 100);
    }

    public function getStrength()
    {
        return $this->attributes["strength"];
    }

    public function getWeight()
    {
        return $this->attributes["weight"];
    }

    public function getHealth()
    {
        return $this->attributes["health"];
    }

    public function getIntelligence()
    {
        return $this->attributes["intelligence"];
    }

    public function getAgility()
    {
        return $this->attributes["agility"];
    }

    public function attack(Warrior $target)
    {
        $target->attributes["health"] -= $this->getStrength();
    }

    public function fight_a_round(Warrior $opponent)
    {
        $this->attack($opponent);
        $opponent->attack($this);
    }

    public function isDefeated()
    {
        $health = $this->getHealth();
        print "\n{$this->Identifier_getIdentity()} Health Check: " . $health;
        if ($health <= 0){
            return true;
        }
        return false;
    }

    protected function random_normal($mean, $standard_deviation)
    {
        static $arr = [];
        if (empty($arr[$mean][$standard_deviation])) {
//            print "\ngenerating stats N({$mean}, {$standard_deviation})\n";
            $arr[$mean][$standard_deviation] = explode(" ", shell_exec("/usr/bin/Rscript -e 'cat(rnorm(100, {$mean}, {$standard_deviation}))'"));
        }

        $val = array_pop($arr[$mean][$standard_deviation]);
//        print "{$val}\n";
        return $val;
    }

    protected function initialise_attribute($name, $default)
    {
        if (empty($this->attributes[$name])) {
            $this->attributes[$name] = $default;
        }
        return $this->attributes[$name];
    }
}