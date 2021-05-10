<?php

namespace App\Console\Commands;

use App\Models\Candidate;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class UpdateNullCandidate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:nullCandidates';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all null applicant';

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
        try {
            $candidate = Candidate::where('email', '');

            if ($candidate->count())
                $candidate->update(['email' => 'NULL']);

            $candidate_password = Candidate::where('password', '');
            if ($candidate_password->count())
                $candidate_password->update(['password' => Hash::make('NULL')]);

            dump('Update Done');
        } catch (\Exception $e) {
            dump($e->getMessage());
        }

    }
}
