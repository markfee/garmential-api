<?php namespace Tests\Functional;

use Garmential\Game\Game;
use Mockery\Mock;

class GameTest  extends \TestCase {

    public function test_i_can_create_a_game_manager()
    {
        $gameManager = new Game;
        $this->assertTrue($gameManager instanceof Game);
    }

   /*
    * When I start a simple game I need two players,each of whom should be
    * given 5 randomly generated Warriors.
    * The two players will keep battling with the next available
    * warrior that is not defeated until one of the players has no warriors
    * left. That player will have lost the contest and the other player is
    * considered the winner.
   */

    public function test_a_game_cannot_start_without_two_players()
    {
        $game = new Game;
        $this->assertFalse($game->isReadyToStart(), "The game should not be ready to start until two players are added.");

        $player1Mock = new Mock('Player');
        $player1Mock->shouldReceive('isReadyToPlay')->once()->andReturn(true);

        $player2Mock = new Mock('Player');
        $player2Mock->shouldReceive('isReadyToPlay')->once()->andReturn(true);

        $game->addPlayer($player1Mock);
        $game->addPlayer($player2Mock);

        $this->assertTrue($game->isReadyToStart(), "The game should now be ready when two players are added and are both ready.");
    }

    public function test_a_game_cannot_start_without_two_players_who_are_both_ready()
    {
        $game = new Game;

        $player1Mock = new Mock('Player');
        $player1Mock->shouldReceive('isReadyToPlay')->once()->andReturn(true);

        $player2Mock = new Mock('Player');
        $player2Mock->shouldReceive('isReadyToPlay')->once()->andReturn(false);

        $game->addPlayer($player1Mock);
        $game->addPlayer($player2Mock);

        $this->assertFalse($game->isReadyToStart(), "The game should not be ready when both players aren't ready.");
    }

}