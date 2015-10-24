<?php namespace Tests\Functional;

use Garmential\Game\Player;
use Garmential\Warrior\Squadron;
use Mockery\Mock;
use Mockery;

class PlayerTest  extends \TestCase {

    public function test_i_can_create_a_player()
    {
        $player = new Player($this->game_mock);
        $this->assertTrue($player instanceof Player);
    }

    public function test_a_player_is_not_ready_to_play_until_they_have_a_ready_squadron()
    {
        $player = new Player($this->game_mock);

        $this->assertFalse($player->isReadyToPlay(), "The player should not be ready until it has a squadron");

//        $this->squadron = Mockery::mock("Garmential\Warrior\Squadron");
        $this->squadron1_mock->shouldReceive('count')->once()->andReturn(5);
        $player->addSquadron($this->squadron1_mock);
        $this->assertTrue($player->isReadyToPlay(), "The player should be ready once it has a squadron");

        $this->squadron1_mock->shouldReceive('count')->once()->andReturn(0);
        $this->assertFalse($player->isReadyToPlay(), "The player should not be ready if the squadron is not full");
    }

    public function test_a_player_adds_itself_to_a_game_when_it_is_initialised()
    {
        $game = $this->game_mock;
        $player1 = new Player($game);
        $player2 = new Player($game);
        $game->shouldHaveReceived('addPlayer')->withArgs([$player1])->once();
        $game->shouldHaveReceived('addPlayer')->withArgs([$player2])->once();
        $game->mockery_verify();
    }

}
