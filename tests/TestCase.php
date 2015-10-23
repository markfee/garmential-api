<?php

class TestCase extends Illuminate\Foundation\Testing\TestCase
{
    /*** @var \Mockery\MockInterface */    protected $squadron1_mock;
    protected $squadron2_mock;

    /*** @var \Mockery\MockInterface */    protected $warrior1_mock;
    /*** @var \Mockery\MockInterface */    protected $warrior2_mock;
    /*** @var \Mockery\MockInterface */    protected $player1_mock;
    /*** @var \Mockery\MockInterface */    protected $player2_mock;
    /*** @var \Mockery\MockInterface */    protected $game_mock;

    public function setUp()
    {
        parent::setUp();

        $this->game_mock = Mockery::mock("Garmential\Game\Game");
        $this->game_mock->shouldReceive("addPlayer");

        $this->warrior1_mock = Mockery::mock("Garmential\Warrior\Warrior");
        $this->warrior1_mock->shouldReceive("attack");
        $this->warrior2_mock = Mockery::mock("Garmential\Warrior\Warrior");
        $this->warrior2_mock->shouldReceive("attack");

        $this->squadron1_mock = Mockery::mock("Garmential\Warrior\Squadron");
        $this->squadron1_mock->shouldReceive("getNext")->andReturn($this->warrior1_mock);
        $this->squadron2_mock = Mockery::mock("Garmential\Warrior\Squadron");
        $this->squadron2_mock->shouldReceive("getNext")->andReturn($this->warrior2_mock);

        $this->player1_mock = Mockery::mock("Garmential\Warrior\Warrior");
        $this->player1_mock->shouldReceive("getNextWarrior")->andReturn($this->warrior1_mock);
        $this->player2_mock = Mockery::mock("Garmential\Warrior\Warrior");
        $this->player2_mock->shouldReceive("getNextWarrior")->andReturn($this->warrior2_mock);
    }

    public function tearDown()
    {
        Mockery::close();
    }


    /**
     * The base URL to use while testing the application.
     *
     * @var string
     */
    protected $baseUrl = 'http://localhost';

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__.'/../bootstrap/app.php';

        $app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

        return $app;
    }
}
