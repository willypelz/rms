<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class MultitenacyDeploy extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'multitenancy:deploy';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Moved release v2 v8 clients to multitenancy with algolia';

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
     * @return void
     */
    public function handle()
    {
        Artisan::call('migrate --seed');
        Artisan::call('scout:sync');
        if (config('app.env' == 'local')) {
            //since personal accounts a free and donot have luxury of plenty operations, do not always do this
            if($this->ask('do you want to reimport scout?', 'yes') == 'yes') {
                Artisan::call('scout:reimport');
            }
        } else {
            Artisan::call('scout:reimport');
        }

    }
}
