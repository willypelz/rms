<?php

namespace App\Providers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;
use Illuminate\Console\Scheduling\Schedule;
use App\Console\Commands\UpdateNullCandidate;
use App\Console\Commands\SubsidiaryExpireNotify;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

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
        
        $this->app->singleton( \App\Services\UserService::class, function ($app){
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
        //Registering a Custom excel headings formatter with name uppercase_sluged
        HeadingRowFormatter::extend('uppercase_sluged', function($value) {
            return strtoupper(Str::slug($value, "-"));
        });
    }

    public function provides()
    {
<<<<<<< HEAD
        return [\App\Services\UserService::class]; 
=======
        return [\App\Services\UserService::class];
>>>>>>> 8f4d5e2a1d2bc6991c5d9d94c30c143f9f9dcf94
    }
}
