<?php namespace Garmential\Game;


class Game {
    /*** @var Player[] */   private $players = [];
    /*** @var Player */     private $currentPlayer;
    /*** @var Player */     private $currentOpponent;
    /*** @var int*/         private $currentPlayerIndex = 0;
    /*** @var int*/         private $currentOpponentIndex = 0;

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
        $this->currentOpponentIndex = 1;
        $this->currentOpponent();
        return $this->currentPlayer();
    }

    /**
     * @return Player
     */
    function nextPlayer()
    {
        $this->currentOpponentIndex = $this->currentPlayerIndex;
        $this->currentPlayerIndex = ($this->currentPlayerIndex == 0 ? 1 : 0);
        $this->currentOpponent();
        return $this->currentPlayer();
    }

    public function currentPlayer()
    {
        return $this->currentPlayer = $this->players[$this->currentPlayerIndex];
    }

    public function currentOpponent()
    {
        return $this->currentOpponent = isset($this->players[$this->currentOpponentIndex]) ? $this->players[$this->currentOpponentIndex] : null;
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
    {
        $warrior1 = $this->currentPlayer->getNextWarrior();
        $warrior2 = $this->currentOpponent->getNextWarrior();
        $warrior1->attack($warrior2);
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