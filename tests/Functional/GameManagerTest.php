<?php namespace Tests\Functional;

use Garmential\Game\GameManager;

class GameManagerTest  extends \TestCase {

    public function test_i_can_create_a_game_manager()
    {
        $gameManager = new GameManager;
        $this->assertTrue($gameManager instanceof GameManager);
    }
   /*
    * When I start a simple game I need two players,each of whom should be
    * given 5 randomly generated Warriors.
    * The two players will keep battling with the next available
    * warrior that is not defeated until one of the players has no warriors
    * left. That player will have lost the contest and the other player is
    * considered the winner.
   */


}