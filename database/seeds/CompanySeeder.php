<?php

namespace Database\Seeders;

use App\User;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $company = Company::whereSlug('signup-company')->first();
        if (!$company) {
            $newCompany = Company::factory()->create();
            $user = User::firstOrCreate(
                [
                    'name' => 'John Doe',
                    'email' => 'johndoe@seamlesshr.com',
                    'password' => bcrypt('password'),
                    'is_internal' => 0,
                    'is_super_admin' => 1,
                    'activated' => 1
                ]
            ); //created user
            $role = Role::whereName('admin')->first()->id;
            $newCompany->users()->attach($user->id, ['role' => $role]);
            $user->roles()->attach([$role]);
        }
    }
}
