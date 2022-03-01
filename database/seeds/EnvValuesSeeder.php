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
            $envValues = \App\Enum\EnvSettingsEnum::getConstants();
            $keys = array_keys($envValues);
            $envFile = $_ENV;

            foreach ($keys as $envValue) {
                SystemSetting::firstOrCreate(
                    [
                        'client_id' => $clientId,
                        'key' => $envValue],
                    [
                        'value' => $envFile[$envValue] ?? ($envValues[$envValue] ?? '')
                    ]
                );
            }

        }
    }
}
