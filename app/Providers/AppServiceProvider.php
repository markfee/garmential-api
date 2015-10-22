<?php namespace App\Providers;

use Garmential\Warrior\CharacterCreator;
use Garmential\Warrior\Warrior;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('WarriorCreatorAlias', function()
        {
            return new CharacterCreator(new Warrior);
        });
    }
}
