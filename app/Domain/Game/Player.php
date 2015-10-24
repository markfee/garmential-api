<?php namespace Garmential\Game;
use Garmential\Warrior\Squadron;
use Garmential\Warrior\Warrior;

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
    /**
     * @var Squadron
     */
    private $squadron;

    function __construct($game)
    {
        $this->game = $game;
        $this->game->addPlayer($this);
    }

    function addSquadron(Squadron $squadron)
    {
        $this->squadron = $squadron;
    }

    public function isReadyToPlay()
    {
        return !empty($this->squadron) && ($this->squadron->count() == 5);
    }

    private $nextTurn = null;

    /**
     *
     * When passed an array of arrays with details of move(s) to be played
     * the game will verify that turn and play it.
     * The minimum requirement is that single array item containing
     * a warrior is sent, who will then attack whoever the opponents sends.
     * [
     *   ["warrior"=>$warrior1], // Move 1
     *   ["warrior"=>$warrior2], // Move 2, etc.
     * ]
     * @return Array $turn[]
     */
    public function getNextTurn()
    {
        return $this->nextTurn;
    }

    /**
     * @param null $nextTurn
     */
    public function setNextTurn($nextTurn)
    {
        $this->nextTurn = $nextTurn;
    }

    /**
     * Tell the player it's their turn to play
     */
    public function notifyTurn()
    {
        $warrior = $this->getNextWarrior();
        $this->setNextTurn(["warrior" => $warrior]);
        $this->game->playTurnWhenReady();
    }

    /**
     * @return Warrior
     */
    public function getNextWarrior()
    {
        return $this->squadron->getNext();
    }
}