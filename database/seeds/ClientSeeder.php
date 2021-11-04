<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::FirstOrCreate([
            'name' => 'sign up',
            'url' => 'signup.seamlesshiring.com'
        ]);
    }
}
