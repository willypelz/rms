<?php

namespace Database\Seeders;

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
        dd($company);
        if(!$company){
            Company::factory()->create();
        }
    }
}
