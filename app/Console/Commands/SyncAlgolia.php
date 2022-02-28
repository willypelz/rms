<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;

class SyncAlgolia extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'AlgoliaSync:data';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this is a command that sync data to algolia every five Minute';

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
        Artisan::call('scout:reimport');
        Log::info("scout reimport done fine");
        $this->info('Algolia Sync Cummand Run successfully!');
    }
}
