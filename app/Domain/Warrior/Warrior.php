<?php namespace Garmential\Warrior;

class Warrior {
    const DEFAULT_STRENGTH      = 50;
    const DEFAULT_WEIGHT        = 50;
    const DEFAULT_HEALTH        = 50;
    const DEFAULT_INTELLIGENCE  = 50;
    const DEFAULT_AGILITY       = 50;

    private $attributes = [];

    public function __construct($attributes = [])
    {
        $this->attributes   = $attributes;
    }

    private function getAttribute($name, $default = null)
    {
        return empty($this->attributes[$name]) ? $default :$this->attributes[$name];
    }

    public function getStrength() {         return $this->getAttribute("strength",      Warrior::DEFAULT_STRENGTH);        }
    public function getWeight() {           return $this->getAttribute("weight",        Warrior::DEFAULT_WEIGHT);          }
    public function getHealth() {           return $this->getAttribute("health",        Warrior::DEFAULT_HEALTH);          }
    public function getIntelligence() {     return $this->getAttribute("intelligence",  Warrior::DEFAULT_INTELLIGENCE);    }
    public function getAgility() {          return $this->getAttribute("agility",       Warrior::DEFAULT_AGILITY);         }
}