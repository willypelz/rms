<?php

use App\Models\Client;
use App\Models\SystemSetting;
use Illuminate\Database\Seeder;

class EnvValuesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clientIds = Client::pluck('id')->toArray();
        foreach ($clientIds as $clientId) {
            $envFile = $_ENV;
            foreach ($envFile as $envKey => $envValue) {
                SystemSetting::updateOrCreate(
                    [
                        'client_id' => $clientId,
                        'key' => strtoupper($envKey),
                        'value' => $envValue
                    ]
                );
            }
        }
    }
}
