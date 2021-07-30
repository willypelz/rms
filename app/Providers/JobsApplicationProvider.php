<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Services\ApplicantContract;
use App\Services\ApplicantService;
use App\Dtos\DownloadApplicantSpreadsheetDto;
use App\Dtos\DownloadApplicantCvDto;
use App\Dtos\DownloadApplicantInterviewNoteDto;

class JobsApplicationProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app()->bind(ApplicantContract::class, ApplicantService::class);
        $this->app()->bind(DownloadApplicantSpreadsheetDto::class, function($app) {
            return new DownloadApplicantSpreadsheetDto();
        });
        
        $this->app()->bind(DownloadApplicantCvDto::class, function($app) {
            return new DownloadApplicantCvDto();
        });

        $this->app()->bind(DownloadApplicantInterviewNoteDto::class, function($app) {
            return new DownloadApplicantInterviewNoteDto();
        });

    }
}
