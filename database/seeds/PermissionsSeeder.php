<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $permissions = \App\Models\Permission::all();
        if(count($permissions) == 0) {

            \App\Models\Permission::insert([
                ['name' => 'can-view-job', 'display_name' => 'can view job', 'description' => 'can view job'],
                ['name' => 'can-view-candidates', 'display_name' => 'can view candidates', 'description' => 'can view candidates'],
                ['name' => 'can-view-comments', 'display_name' => 'can view comments', 'description' => 'can view comments'],
                ['name' => 'can-make-comments', 'display_name' => 'can make comments', 'description' => 'can make comments'],
                ['name' => 'can-take-interview-notes', 'display_name' => 'can take interview notes', 'description' => 'can take interview notes'],
                ['name' => 'can-view-interview', 'display_name' => 'can view interview', 'description' => 'can view interview'],
            ]);
        }
    }
}
