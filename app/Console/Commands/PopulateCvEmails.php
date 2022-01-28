<?php

namespace App\Console\Commands;

use App\Models\Job;
use Illuminate\Console\Command;

class PopulateCvEmails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:populate {--job_id=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'populate cv emails from job';

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
     * @return int
     */
    public function handle()
    {
        $job = Job::with('applicantsViaJAT.cv', 'applicantsViaJAT.candidate')->find($this->option('job_id'));

        foreach ($job->applicantsViaJAT as $applicant) {
            $applicant->cv->update([
               'email' =>  $applicant->candidate->email,
               'first_name' =>  $applicant->candidate->first_name,
               'last_name' =>  $applicant->candidate->last_name,
            ]);
        }
        return 0;
    }
}
