<?php namespace Tests\Functional;

use Garmential\Game\Player;
use Mockery\Mock;

class PlayerTest  extends \TestCase {

    public function test_i_can_create_a_player()
    {
        $player = new Player(new Mock('Game'));
        $this->assertTrue($player instanceof Player);
    }

    public function test_a_player_is_not_ready_to_play_until_they_have_a_ready_squadron()
    {
        $player = new Player(new Mock('Game'));

        $this->assertFalse($player->isReadyToPlay(), "The player should not be ready until it has a squadron");

        $squadron = new Mock('Squadron');
        $squadron->shouldReceive('count')->once()->andReturn(5);
        $player->addSquadron($squadron);
        $this->assertTrue($player->isReadyToPlay(), "The player should be ready once it has a squadron");

        $squadron->shouldReceive('count')->once()->andReturn(4);
        $this->assertFalse($player->isReadyToPlay(), "The player should not be ready if the squadron is not full");
    }

    public function test_a_player_will_play_a_turn_when_notified()
    {
        $this->assertFalse(true);
    }


}