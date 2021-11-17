<?php

use Illuminate\Database\Seeder;
use Database\Seeders\ClientSeeder;
use Database\Seeders\CompanySeeder;
use Illuminate\Support\Facades\Artisan;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Artisan::call('migrate:fresh');
        // $this->call(UserTableSeeder::class);
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        // $this->call(SchoolSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(EnvValuesSeeder::class);
        // $this->call(IntegrationSeeder::class);
        
    }
}
