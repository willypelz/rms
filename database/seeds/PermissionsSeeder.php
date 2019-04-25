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
            \App\Models\Permission::firstOrCreate(['name' => 'can-view-job', 'display_name' => 'can view job', 'description' => 'can view job']);
            \App\Models\Permission::firstOrCreate(['name' => 'can-view-candidates', 'display_name' => 'can view candidates', 'description' => 'can view candidates']);
            \App\Models\Permission::firstOrCreate(['name' => 'can-view-comments', 'display_name' => 'can view comments', 'description' => 'can view comments']);
            \App\Models\Permission::firstOrCreate(['name' => 'can-make-comments', 'display_name' => 'can make comments', 'description' => 'can make comments']);
            \App\Models\Permission::firstOrCreate(['name' => 'can-take-interview-notes', 'display_name' => 'can take interview notes', 'description' => 'can take interview notes']);
            \App\Models\Permission::firstOrCreate(['name' => 'can-view-interview', 'display_name' => 'can view interview', 'description' => 'can view interview']);
            \App\Models\Permission::firstOrCreate(['name' => 'can-perform-interview-actions', 'display_name' => 'can perform interview actions', 'description' => 'can perform interview actions']);
            \App\Models\Permission::firstOrCreate(['name' => 'can-move-application', 'display_name' => 'can move application', 'description' => 'can move application']);
            \App\Models\Permission::firstOrCreate(['name' => 'can-test', 'display_name' => 'can test', 'description' => 'can test']);
            \App\Models\Permission::firstOrCreate(['name' => 'can-view-background-check', 'display_name' => 'can view background checks', 'description' => 'can view background checks']);

    }
}