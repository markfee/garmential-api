<?php namespace Garmential\Warrior;

class Warrior {

    const DEFAULT_STRENGTH      = 100;
    const DEFAULT_WEIGHT        = 85; //kg
    const DEFAULT_HEALTH        = 100;
    const DEFAULT_INTELLIGENCE  = 100; // IQ
    const DEFAULT_AGILITY       = 100; // N(100, 15)

    private $attributes = [];

    public function __construct($attributes = [])
    {
        $this->attributes   = $attributes;
        $this->attributes["strength"]      =   $this->coalesce("strength",      Warrior::DEFAULT_STRENGTH);
        $this->attributes["weight"]        =   $this->coalesce("weight",        Warrior::DEFAULT_WEIGHT);
        $this->attributes["health"]        =   $this->coalesce("health",        Warrior::DEFAULT_HEALTH);
        $this->attributes["intelligence"]  =   $this->coalesce("intelligence",  Warrior::DEFAULT_INTELLIGENCE);
        $this->attributes["agility"]       =   $this->coalesce("agility",       Warrior::DEFAULT_AGILITY);
    }

    private function random_normal($mean, $standard_deviation)
    {
        $val = shell_exec("Rscript -e 'cat(rnorm(1, {$mean}, {$standard_deviation}))'");
        return $val;
    }

    public function randomise()
    {
        $this->attributes["strength"]      =   round($this->random_normal(100.0, 15.0));
        $this->attributes["weight"]        =   round($this->random_normal(85, 15.0));
        $this->attributes["health"]        =   round($this->random_normal(100.0, 15.0));
        $this->attributes["intelligence"]  =   round($this->random_normal(100.0, 15.0));
        $this->attributes["agility"]       =   round($this->random_normal(100.0, 15.0));
        return $this;
    }

    private function coalesce($name, $default = null)
    {
        return empty($this->attributes[$name]) ? $default :$this->attributes[$name];
    }

    public function getStrength() {         return $this->attributes["strength"];      }
    public function getWeight() {           return $this->attributes["weight"];        }
    public function getHealth() {           return $this->attributes["health"];        }
    public function getIntelligence() {     return $this->attributes["intelligence"];  }
    public function getAgility() {          return $this->attributes["agility"];       }

    public function attack(Warrior $target)
    {
        $target->attributes["health"] -= $this->getStrength();
    }

    public function fight_a_round(Warrior $opponent)
    {
        $this->attack($opponent);
        $opponent->attack($this);
    }

    public function is_defeated()
    {
        return ($this->getHealth() <= 0);
    }
}