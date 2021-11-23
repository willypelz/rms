<?php

namespace Database\Seeders;

use App\User;
use App\Models\Role;
use App\Models\Client;
use App\Models\Company;
use App\Models\Candidate;
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

        $client = Client::whereUrl('https://seamlesshrhead.seamlesshiring.com')->first();
        if ($client) {
            $newCompany = Candidate::whereEmail('lawrence@seamlesshr.com')->update(['client_id'=> $client->id]);
    
        }
    }
}
