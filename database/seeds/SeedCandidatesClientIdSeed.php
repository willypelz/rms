<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Client;
use Illuminate\Database\Seeder;

class SeedCandidatesClientIdSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (!Candidate::whereNotNull('client_id')->first()) {
            $client = Client::first();
            Candidate::whereNull('client_id')->update(['client_id' => $client->id]);
        }
    }
}
