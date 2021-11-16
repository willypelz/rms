<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Company::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $defaultClient = Client::where('url','https://signup.seamlesshiring.com')->first()->id;
        return [
            'name' => 'signup company',
            'slug' => str_slug('signup company'),
            'date_added' => date('Y-m-d'),
            'license_type' => 'PREMIUM',
            'client_id' => $defaultClient
        ];
    }
}
