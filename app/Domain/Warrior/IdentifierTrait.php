<?php namespace Garmential\Warrior;


trait IdentifierTrait {
    protected static  $IdentifierTrait_counter = 0;
    protected $IdentifierTrait_identifier = 0;

    private function Identifier_setIdentity($string)
    {
        $this->IdentifierTrait_identifier = "{$string}:" . static::$IdentifierTrait_counter++;
    }
    private function Identifier_getIdentity() {
        return $this->IdentifierTrait_identifier;
    }
}