<?php namespace App\Providers;

use Garmential\Warrior\WarriorCreator;
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
            return new WarriorCreator();
        });
    }
}
