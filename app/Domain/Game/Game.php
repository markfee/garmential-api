<?php namespace Garmential\Game;
use Garmential\Warrior\Warrior;

class Game {
    /*** @var Player[] */   private $players = [];
    private $gameover = false;

    /**
     * @return boolean
     */
    public function isGameover()
    {
        return $this->gameover || $this->players[0]->isDefeated() || $this->players[1]->isDefeated();
    }

    public function concedeDefeat()
    {
        $this->gameover = true;
    }

    function startPlayWhenReady()
    {
        if ($this->isReadyToStart())
        {
            $this->requestPlayersToPlayATurn();
        }
    }

    function requestPlayersToPlayATurn()
    {
        foreach($this->players as $player){
            $player->notifyTurn();
        }
        $this->playTurnWhenReady();

    }

    function addPlayer($player)
    {
        $this->players[] = $player;
    }

    function isReadyToStart()
    {
        return $this->doWeHaveEnoughPlayers() && $this->areAllPlayersReady();
    }


    function playTurnWhenReady()
    {
        if ($this->isGameover())
        {
            return;
        }
        $turn1 = $this->players[0]->getNextTurn();
        $turn2 = $this->players[1]->getNextTurn();
        if (empty($turn1)||empty($turn2)) {
            return;
        }

        print "\nplaying a turn";

        /* @var $warrior1 Warrior */
        /* @var $warrior2 Warrior */
        $warrior1 = $turn1[0]["warrior"];
        $warrior2 = $turn2[0]["warrior"];

        if (!$warrior1->isDefeated()) {
            $warrior1->attack($warrior2);
        }
        if (!$warrior2->isDefeated()) {
            $warrior2->attack($warrior1);
        }

        $this->requestPlayersToPlayATurn();
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