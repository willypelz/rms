<?php

namespace Database\Seeders;

use App\User;
use App\Models\Role;
use App\Models\Company;
use Illuminate\Database\Seeder;
use App\Services\SelfSignUpService;

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
            $user = new SelfSignUpService();
            $user->createUserAndRoles('John Doe', 'johndoe@seamlesshr.com', 'password', $newCompany);
        }
    }
}
