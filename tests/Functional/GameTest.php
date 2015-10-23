<?php namespace Tests\Functional;

use Garmential\Game\Game;
use Garmential\Game\Player;
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

        $this->player1_mock->shouldReceive('isReadyToPlay')->once()->andReturn(true);

        $this->player2_mock->shouldReceive('isReadyToPlay')->once()->andReturn(true);

        $game->addPlayer($this->player1_mock);
        $game->addPlayer($this->player2_mock);

        $this->assertTrue($game->isReadyToStart(), "The game should now be ready when two players are added and are both ready.");
    }

    public function test_a_game_cannot_start_without_two_players_who_are_both_ready()
    {
        $game = new Game;

        $this->player1_mock->shouldReceive('isReadyToPlay')->once()->andReturn(true);
        $this->player2_mock->shouldReceive('isReadyToPlay')->once()->andReturn(false);

        $game->addPlayer($this->player1_mock);
        $game->addPlayer($this->player2_mock);

        $this->assertFalse($game->isReadyToStart(), "The game should not be ready when both players aren't ready.");
    }

    public function test_I_can_get_player_whose_turn_it_is()
    {
        $game = new Game;
        $this->player1_mock->shouldReceive('notifyTurn')->once();
        $game->addPlayer($this->player1_mock);
        $game->notifyPlayerOfTurn();
    }

    public function test_that_the_games_begins_with_a_notification_to_player_1_when_it_is_ready()
    {
        $game = new Game;

        $this->player1_mock->shouldReceive('isReadyToPlay')->once()->andReturn(true);
        $this->player1_mock->shouldReceive('notifyTurn')->once();

        $this->player2_mock->shouldReceive('isReadyToPlay')->once()->andReturn(true);
        $this->player1_mock->shouldReceive('notifyTurn')->never();

        $game->addPlayer($this->player1_mock);
        $game->addPlayer($this->player2_mock);

        $game->startPlayWhenReady();
    }

    public function test_next_player()
    {
        $game = new Game;

        $game->addPlayer($this->player1_mock);
        $game->addPlayer($this->player2_mock);
        $this->assertTrue($game->firstPlayer() === $this->player1_mock, "First Player should be the first one added");
        $this->assertTrue($game->nextPlayer()  === $this->player2_mock, "Next Player should be Player2");

    }

    public function test_that_the_second_player_is_attacked_and_notified_after_the_first_plays_a_turn()
    {
        $game = new Game;

        $this->player1_mock->shouldReceive('isReadyToPlay')->once()->andReturn(true);
        $this->player1_mock->shouldReceive("notifyTurn")->once();

        $this->player2_mock->shouldReceive('isReadyToPlay')->once()->andReturn(true);
        $this->player2_mock->shouldReceive("notifyTurn")->once();

        $game->addPlayer($this->player1_mock);
        $game->addPlayer($this->player2_mock);

        $game->startPlayWhenReady();
        $game->playATurn([["warrior" => $this->warrior1_mock]]);

        $this->warrior1_mock->shouldHaveReceived("attack")->withArgs([$this->warrior2_mock])->once();
    }
}