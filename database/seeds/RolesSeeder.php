<?php

use App\Models\Permission;
use App\Models\Role;
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

        $interviewer_permission_list = [
            'can-view-job',
            'can-view-candidates',
            'can-take-interview-notes',
            'can-view-interview',
            'can-perform-interview-actions',
        ];
        $commenter_permission_list = ['can-view-job', 'can-view-candidates', 'can-view-comments', 'can-make-comments'];
        $test_admin_permission_list = ['can-view-job', 'can-view-candidates', 'can-test'];
        $check_admin_permission_list = ['can-view-job', 'can-view-candidates', 'can-view-background-check'];
        $job_admin_permission_list = [
            'can-view-job',
            'can-view-candidates',
            'can-view-comments',
            'can-make-comments',
            'can-take-interview-notes',
            'can-view-interview',
            'can-perform-interview-actions',
            'can-move-application',
            'can-add-job-team-members',
            'can-test',
            'can-view-background-check',
            'can-post-job',
        ];


        //create job admin
        $job_admin = $this->checkIfExist('admin');
        $job_admin = is_null($job_admin) ? Role::create(
            [
                'name' => 'admin',
                'display_name' => 'job admin',
                'description' => 'job admin',
            ],[ 'name' => 'admin']
        ) : $job_admin;
        // check if permissions exist for this role if so detach them  because sync function that updates many to many relationship isnt working in 5.2 laravel version
        if ($job_admin->perms) {
            foreach ($job_admin->perms as $perm) {
                $job_admin->perms()->detach($perm);
            }
        }
        // attach an updated list of permissions to the role
        $this->attachPermmissions($job_admin_permission_list, $job_admin);


        //create role
        $interviewer = $this->checkIfExist('interviewer');
        $interviewer = is_null($interviewer) ? Role::create(
            [
                'name' => 'interviewer',
                'display_name' => 'job interviewer',
                'description' => 'job interviewer',
            ],
            [ 'name' => 'interviewer']
        ) : $interviewer;
        // check if permissions exist for this role if so detach them  because sync function that updates many to many relationship isnt working in 5.2 laravel version
        if ($interviewer->perms) {
            foreach ($interviewer->perms as $perm) {
                $interviewer->perms()->detach($perm);
            }
        }
        // attach an updated list of permissions to the role
        $this->attachPermmissions($interviewer_permission_list, $interviewer);


        //create role
        $commenter = $this->checkIfExist('commenter');
        $commenter = is_null($commenter) ? Role::create(
            [
                'name' => 'commenter',
                'display_name' => 'job commenter',
                'description' => 'job commenter',
            ], [ 'name' => 'commenter']
        ) : $commenter;
        // check if permissions exist for this role if so detach them  because sync function that updates many to many relationship isnt working in 5.2 laravel version
        if ($commenter->perms) {
            foreach ($commenter->perms as $perm) {
                $commenter->perms()->detach($perm);
            }
        }
        // attach an updated list of permissions to the role
        $this->attachPermmissions($commenter_permission_list, $commenter);

        //create role
        $test_admin = $this->checkIfExist('test_admin');
        $test_admin = is_null($test_admin) ? Role::create(
            [
                'name' => 'test_admin',
                'display_name' => 'job test admin',
                'description' => 'job test admin',
            ], [ 'name' => 'test_admin']
        ) : $test_admin;
        // check if permissions exist for this role if so detach them  because sync function that updates many to many relationship isnt working in 5.2 laravel version
        if ($test_admin->perms) {
            foreach ($test_admin->perms as $perm) {
                $test_admin->perms()->detach($perm);
            }
        }
        // attach an updated list of permissions to the role
        $this->attachPermmissions($test_admin_permission_list, $test_admin);



        //create role
        $check_admin = $this->checkIfExist('check_admin');
        $check_admin = is_null($check_admin) ? Role::create(
            [
                'name' => 'check_admin',
                'display_name' => 'background check admin',
                'description' => 'background check admin',
            ], [ 'name' => 'check_admin']
        ) : $check_admin;
        // check if permissions exist for this role if so detach them  because sync function that updates many to many relationship isnt working in 5.2 laravel version
        if ($check_admin->perms) {
            foreach ($check_admin->perms as $perm) {
                $check_admin->perms()->detach($perm);
            }
        }
        // attach an updated list of permissions to the role
        $this->attachPermmissions($check_admin_permission_list, $check_admin);

    }

    private function checkIfExist($name)
    {
        $role_exist = Role::where('name', $name)->first();
        return $role_exist;
    }

    private function attachPermmissions($permission_array, $role)
    {
        $perms = [];
        foreach ($permission_array as $perm) {
            $perms[] = Permission::whereName($perm)->first();
        }
        $role->attachPermissions($perms);
    }
}
