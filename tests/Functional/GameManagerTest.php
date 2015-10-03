<?php namespace Tests\Functional;

use Garmential\Game\GameManager;

class GameManagerTest  extends \TestCase {

    public function test_i_can_create_a_game_manager()
    {
        $gameManager = new GameManager;
        $this->assertTrue($gameManager instanceof GameManager);
    }
}