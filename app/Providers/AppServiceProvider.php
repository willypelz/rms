<?php

namespace App\Providers;

use App\Console\Commands\UpdateNullCandidate;
use App\Console\Commands\SubsidiaryExpireNotify;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\Facades\URL;
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
        $this->app->booted(function () {
            $schedule = $this->app->make(Schedule::class);
           $schedule->command('update:nullCandidates')->daily();
           $schedule->command('subsidiary:notify-admin')->daily();

        });

        $this->commands([
           UpdateNullCandidate::class,
           SubsidiaryExpireNotify::class,
        ]);
        
        $this->app->singleton( \App\Interfaces\UserContract::class, function ($app){
            return new \App\Services\UserService();
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        URL::forceScheme('https');
        
        if ($this->app->environment() !== 'production') {
            //$this->app->register(\Way\Generators\GeneratorsServiceProvider::class);
            //$this->app->register(\Xethron\MigrationsGenerator\MigrationsGeneratorServiceProvider::class);
        }
    }
}
