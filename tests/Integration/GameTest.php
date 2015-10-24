<?php namespace Tests\Integration;

use Garmential\Game\Game;
use Garmential\Game\Player;
use Garmential\Warrior\Squadron;
use \WarriorCreator;

class GameTest  extends \TestCase {

    public function test_a_game_will_play_out()
    {
        $squadron =
        $game = new Game();
        $player1 = new Player($game);
        $player2 = new Player($game);

        $player1->addSquadron(new Squadron(WarriorCreator::GenerateCollection(5)));
        $player2->addSquadron(new Squadron(WarriorCreator::GenerateCollection(5)));

        $game->startPlayWhenReady();
        $this->assertTrue($player1->isDefeated()  || $player2->isDefeated(), "One of the players must be defeated");
        $this->assertFalse($player1->isDefeated() && $player2->isDefeated(), "One of the players must not be defeated");
        print "\n\n";

    }
}