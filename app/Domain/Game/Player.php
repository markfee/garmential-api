<?php namespace Garmential\Game;
use Garmential\Warrior\IdentifierTrait;
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
    use IdentifierTrait;
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
        $this->Identifier_setIdentity("Player");

        print "\n Adding {$this->Identifier_getIdentity()} to a game";

        $this->game = $game;
        $this->game->addPlayer($this);
    }

    function addSquadron(Squadron $squadron)
    {
        $this->squadron = $squadron;
    }

    public function isReadyToPlay()
    {
        return !empty($this->squadron) && ($this->squadron->count() > 0);
    }

    public function isDefeated()
    {
        return $this->squadron->isDefeated();
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
        print "\n{$this->Identifier_getIdentity()} notified of a turn";
        $this->setNextTurn(null);
        $warrior = $this->getNextWarrior();
        if (empty($warrior)) {
            $this->game->concedeDefeat();
            return;
        }
        $this->setNextTurn([["warrior" => $warrior]]);
        print "\n{$this->Identifier_getIdentity()} good to go after notified of a turn";
    }

    /**
     * @return Warrior
     */
    public function getNextWarrior()
    {
        return $this->squadron->getNext();
    }
}