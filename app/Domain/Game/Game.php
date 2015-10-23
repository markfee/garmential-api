<?php namespace Garmential\Game;


class Game {
    /*** @var Player[] */   private $players = [];
    /*** @var Player */     private $currentPlayer;
    /*** @var int*/         private $currentPlayerIndex = 0;

    function startPlayWhenReady()
    {
        if ($this->isReadyToStart())
        {
            $this->firstPlayer()->notifyTurn();
        }
    }

    /**
     * @return Player
     */
    function firstPlayer()
    {
        $this->currentPlayerIndex = 0;
        $this->currentPlayer = $this->players[$this->currentPlayerIndex];
        return $this->currentPlayer;
    }

    /**
     * @return Player
     */
    function nextPlayer()
    {
        $this->currentPlayerIndex = ($this->currentPlayerIndex == 0 ? 1 : 0);
        $this->currentPlayer = $this->players[$this->currentPlayerIndex];
        return $this->currentPlayer;
    }

    function notifyPlayerOfTurn()
    {
        $this->currentPlayer->notifyTurn();
    }

    function addPlayer($player)
    {
        $this->players[] = $player;
        $this->currentPlayer = $this->currentPlayer ?: $this->firstPlayer();
    }

    function isReadyToStart()
    {
        return $this->doWeHaveEnoughPlayers() && $this->areAllPlayersReady();
    }

    /**
     * @param $turn // json details of move to be played
     */
    function playATurn($turn)
    {//TODO: implement the turn.
        $this->nextPlayer()->notifyTurn();
    }

    /**
     * @return bool
     */
    public function areAllPlayersReady()
    {
        foreach ($this->players as $player) {
            if (false === $player->isReadyToPlay()) {
                return false;
            }
        }
        return true;
    }

    /**
     * @return bool
     */
    public function doWeHaveEnoughPlayers()
    {
        return (count($this->players) == 2);
    }

}