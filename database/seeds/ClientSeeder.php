<?php

namespace Database\Seeders;

use App\User;
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
        if (Client::count() == 0) {
            $client = Client::FirstOrCreate(
                [
                    'url' => config('app.url'),
                    'name' => config('app.company_name'),
                ]
            );

            User::whereNull('client_id')->update(['client_id' => $client->id]);
        }

    }
}
