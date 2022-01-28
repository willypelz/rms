<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\User;
use App\Models\Role;
use App\Models\Company;
use App\Models\Client;
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
        $companies = Company::all();
        // if (!$company) {
        //     $newCompany = Company::factory()->create();
        //     $user = new SelfSignUpService();
        //     $user->createUserAndRoles('John Doe', 'johndoe@seamlesshr.com', 'password', $newCompany);
        // }
        if (Client::count() == 1) {
            $defaultClient = Client::where('url', config('app.url'))->first()->id;
            foreach ($companies as $company) {
                $company->update(
                    [
                        'client_id' => $defaultClient
                    ]
                );
            }

            Candidate::select('id')->get()->map(function ($candidate) use ($defaultClient) {
                $candidate->update(['client_id' => $defaultClient]);
            });
        }


    }
}
