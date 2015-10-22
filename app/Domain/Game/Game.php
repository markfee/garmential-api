<?php namespace Garmential\Game;


class Game {
    private $players = [];

    function addPlayer($player)
    {
        $this->players[] = $player;
    }

    function isReadyToStart()
    {
        if (count($this->players) != 2) {
            return false;
        }

        foreach($this->players as $player) {
            if (false === $player->isReadyToPlay()) {
                return false;
            }
        }
        return true;
    }

}