<?php

namespace App\Console\Commands;

use App\Jobs\UploadApplicant;
use App\Models\JobApplication;
use Illuminate\Console\Command;

class UploadApplicantsToSor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'applicants:upload';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Upload All applicants to Solr';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        
        
        $applicants = JobApplication::has('cv')->with('job', 'cv')->where('job_id', 557)->chunk(100, function ($applicants) {
            foreach ($applicants as $applicant) {
                UploadApplicant::dispatch($applicant)->onQueue('solr');                
            }
        });
        
    }
}
