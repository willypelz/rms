<?php

use Illuminate\Database\Seeder;
use Database\Seeders\ClientSeeder;
use Database\Seeders\CompanySeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserTableSeeder::class);
        $this->call(
            [
                PermissionsSeeder::class,
                RolesSeeder::class,
                SchoolSeeder::class,
                ClientSeeder::class,
                CompanySeeder::class,
                EnvValuesSeeder::class,
            ]
        );
        
        // $this->call(IntegrationSeeder::class);
        
    }
}
