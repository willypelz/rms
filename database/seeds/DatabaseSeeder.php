<?php

use Illuminate\Database\Seeder;

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
        $this->call(PermissionsSeeder::class);
        $this->call(RolesSeeder::class);
        $this->call(SchoolSeeder::class);
        $this->call(EnvValuesSeeder::class);
        $this->call(ClientSeeder::class);
        // $this->call(IntegrationSeeder::class);
    }
}
