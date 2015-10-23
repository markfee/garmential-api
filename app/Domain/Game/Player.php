<?php namespace Garmential\Game;

/**
 * Class Player
 * a Player represents an instance of a player of a game.
 * a player cannot exist without a game to play.
 * A player without a game is a user (for want of a better word).
 * A default player without a user is classed as a CPU player and will
 * automatically play turns.
 * A player with a user will wait for the user to perform a turn.
 * @package Garmential\Game
 */
class Player {
    /**
     * @var Game
     */
    private $game;
    private $squadron;

    function __construct($game)
    {
        $this->game = $game;
    }

    function addSquadron($squadron)
    {
        $this->squadron = $squadron;
    }

    public function isReadyToPlay()
    {
        return !empty($this->squadron) && ($this->squadron->count() == 5);
    }

    /**
     * Tell the player it's their turn to play
     */
    public function notifyTurn()
    {
        $this->game->playATurn([]);
    }
}