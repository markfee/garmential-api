<?php namespace Garmential\Facades;

use Illuminate\Support\Facades\Facade;

class WarriorCreator extends Facade {

    protected static function getFacadeAccessor()
    {
        return "WarriorCreatorAlias";
    }
}