<?php

namespace App\Console;

use App\Console\Commands\MultitenacyDeploy;
use App\Console\Commands\PopulateCvEmails;
use App\Console\Commands\SendExportDoneNotification;
use App\Console\Commands\SyncAlgolia;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Commands\UploadApplicantsToSor::class,
        Commands\FixNullCvs::class,
        Commands\ResyncTestScoreFromSeamlessTesting::class,
        Commands\StreamFilesFromHRMS::class,
        PopulateCvEmails::class,
        MultitenacyDeploy::class,
        Commands\SyncAlgolia::class,
        SendExportDoneNotification::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //$this->load(__DIR__.'/Commands');
        // $schedule->command('inspire')
        //          ->hourly();
//        $schedule->command('AlgoliaSync:data')->everyFiveMinutes();
        $schedule->command('check:spreadsheet-is-done-exporting')->everyFiveMinutes();
    }
}
