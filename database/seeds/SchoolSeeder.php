<?php

use Illuminate\Database\Seeder;
use App\Models\School;

class SchoolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Read the JSON file 
        $path = public_path().'/school.json';
        $json = file_get_contents($path);
        $json_data = json_decode($json,true);
        foreach($json_data as $data){
            School::FirstOrCreate([
                'name' => $data['name'],
            ]);
        };
    }
}
