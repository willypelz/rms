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
        $path = asset('public_html/uploads/school_template/school.json');
        $json = file_get_contents($path);
        $json_data = json_decode($json,true);
        $school_exist = School::where('name','Abu Dhabi University')->first();
        
        if(is_null($school_exist)){
            foreach($json_data as $data){
                School::FirstOrCreate([
                    'name' => $data['name'],
                ]);
            };
        }else{
            echo 'Record Exists';
        }
        
    }
}
