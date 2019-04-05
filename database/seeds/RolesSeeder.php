<?php

use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $view_job = \App\Models\Permission::where('name', 'can-view-job')->first();
        $view_candidates = \App\Models\Permission::where('name', 'can-view-candidates')->first();
        $view_comments = \App\Models\Permission::where('name', 'can-view-comments')->first();
        $make_comments = \App\Models\Permission::where('name', 'can-make-comments')->first();
        $take_int_notes = \App\Models\Permission::where('name', 'can-take-interview-notes')->first();
        $view_interview = \App\Models\Permission::where('name', 'can-view-interview')->first();
        $perform_actions_int = \App\Models\Permission::where('name', 'can-perform-interview-actions')->first();
        $move_application = \App\Models\Permission::where('name', 'can-move-application')->first();
        $can_test = \App\Models\Permission::where('name', 'can-test')->first();
        $background_checks = \App\Models\Permission::where('name', 'can-view-background-check')->first();

            $admin = \App\Models\Role::firstOrCreate([
                'name' => 'admin',
                'display_name' => 'Admin',
                'description' => 'Admin'
            ]);
            if (count ($admin->perms()) == 0) {
                $admin->attachPermissions([$view_job, $view_candidates, $view_comments, $make_comments, $take_int_notes, $view_interview, $perform_actions_int, $move_application, $can_test, $background_checks]);
            } else if(count($admin->perms()) == 9){ // this means the last permission for background check added hasn't be synced with admin role....
                $admin->attachPermission($background_checks);
            }

            $commenter = \App\Models\Role::firstOrCreate([
                'name' => 'commenter',
                'display_name' => 'Commenter',
                'description' => 'Commenter'
            ]);

            if(count($commenter->perms()) == 0) $commenter->attachPermissions([$view_job, $view_candidates, $view_comments, $make_comments]);


            $interviewer = \App\Models\Role::firstOrCreate([
                'name' => 'interviewer',
                'display_name' => 'Interviewer',
                'description' => 'Interviewer'
            ]);

            if(count($interviewer->perms()) == 0)  $interviewer->attachPermissions([$view_job, $view_candidates, $take_int_notes, $view_interview]);

        }
}
