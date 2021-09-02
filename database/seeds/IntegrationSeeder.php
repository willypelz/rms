<?php

use Illuminate\Database\Seeder;
use App\Http\Controllers\API\SyncController;

class IntegrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //checking if the hrms is integrated 
        if(isHrmsIntegrated()) {
            app()->make(SyncController::class)->companyAndSubsidiaries();
        }
    }
}
