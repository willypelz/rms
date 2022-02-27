<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class AllInOneMultienancy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multitenancySetup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this runs all the neccessary commands that set up multitenancy system';

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
        
    }
}
