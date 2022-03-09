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
            $defaultClient = Optional(Client::where('url', config('app.url'))->first())->id;
            if(!$defaultClient) {
	           if( substr(config('app.url'), -1) == '/'){
		          $defaultClient = Optional(Client::where('url',  substr_replace(config('app.url'), "", -1))->first())->id;
					if(!$defaultClient) exit;
	           }else {
		           exit;
	           }
            }

            foreach ($companies as $company) {
                $company->update(
                    [
                        'client_id' => $defaultClient
                    ]
                );
            }

            Candidate::whereNotNull('id')->update(['client_id' => $defaultClient]);
            User::whereNotNull('id')->update(['client_id' => $defaultClient]);
        }


    }
}
