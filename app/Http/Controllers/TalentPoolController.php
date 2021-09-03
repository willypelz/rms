<?php

namespace App\Http\Controllers;

use App\Models\Cv;

use App\Models\Job;
use App\Http\Requests;
use App\Models\JobActivity;
use Illuminate\Http\Request;
use App\Models\JobApplication;
use Illuminate\Support\Facades\DB;
use App\Models\JobApplicationMessage;


class TalentPoolController extends Controller
{
    //

    public function __construct()
    {
        // $this->middleware('auth');
    }


    public function AddCandidates($id){
        mixPanelRecord("Talent Pool Add Candidate Started (Admin)", auth()->user());
        return view ('talent-pool.add-candidates');
    }

    public function MigrateInfrastructure(){

    	$jobs = DB::connection('mysql_inf')->select('SELECT * FROM jobs');

    	foreach($jobs as $j){

    		$job = new Job;
    		$job->title = $j->title;
    		$job->details = $j->description;
    		$job->location = 'Abuja';
    		$job->post_date = $j->post_date;
    		$job->expiry_date = $j->expiry_date;
    		$job->job_type = 'Full Time';
    		$job->position = $j->title;
    		$job->company_id = 6; //9
    		$job->status = 'ACTIVE';
    		$job->save();

    	}


    	$jas = DB::connection('mysql_inf')->select('SELECT * FROM job_applications');
    	foreach ($jas as $ja) {

    		$j = DB::connection('mysql_inf')->select('SELECT * FROM jobs WHERE id = '.$ja->job_id);
    		$j = $j[0];
    		$job = Job::where('title', $j->title)->first();
    		// dd($j);

    		
    		$cv = new CV;
    		$cv->first_name = $ja->first_name;
    		$cv->last_name = $ja->last_name;
    		$cv->email = $ja->email;
    		$cv->phone = $ja->phone;
    		$cv->gender = $ja->gender;
    		$cv->date_of_birth = $ja->date_of_birth;
    		$cv->state_of_origin = $ja->state_of_origin;
    		$cv->willing_to_relocate = $ja->willing_to_relocate;
    		$cv->marital_status = $ja->marital_status;
    		$cv->state = $ja->location;
    		$cv->headline = $ja->cover_note;
    		$cv->highest_qualification = $ja->highest_qualification;
    		$cv->last_position = $ja->last_position;
    		$cv->last_company_worked = $ja->last_company_worked;
    		$cv->years_of_experience = $ja->years_of_experience;
    		$cv->cv_file = $ja->cv_file;
    		$cv->save();

    		$app = new JobApplication;
    		$app->status = $ja->status;
    		$app->cv_id = $cv->id;
    		$app->job_id = $job->id;
    		$app->cover_note = $ja->cover_note;
    		$app->created = $ja->created_at;
    		$app->action_date = $ja->updated_at;
    		$app->save();

    		$jam = new JobApplicationMessage;
    		$jam->job_application_id = $app->id;
    		$jam->message = $ja->cover_note;
    		$jam->created = $ja->created_at;
    		$jam->modified = $ja->updated_at;
    		$jam->save();

            JobActivity::firstOrCreate([
                'activity_type'=>'APPLIED',
                'job_id'=>$job_id,
                'job_application_id'=>$app->id,
                'created_at'=>$app->created
                ]);

            mixPanelRecord("Talent Pool Job Activity Created Successfully (Admin)", auth()->user());
    	}


    }


    public function InfMigrate2(){

        $jas = JobApplication::where('job_id', '>', 9)->take(10)->get();
        foreach ($jas as $ja) {
            JobActivity::firstOrCreate([
                'activity_type'=>'APPLIED',
                'job_id'=>$ja->job_id,
                'job_application_id'=>$ja->id,
                'created_at'=>$ja->created
                ]);
        }
        
    }

    public function InfMigrate3(){


        $count = JobApplication::whereIn('job_id', array(37,38,39,40,41,42,43,44,45,46,47,48,49))->count();
        // dd($count);

        $jas = DB::connection('mysql_far')->select('SELECT * FROM job_applications WHERE id > '.$count);

        foreach ($jas as $ja) {

            $j = DB::connection('mysql_far')->select('SELECT * FROM jobs WHERE id = '.$ja->job_id);
            $j = $j[0];
            $job = Job::where('title', $j->title)->first();
            // dd($j, $job);

            
            $cv = new CV;
            $cv->first_name = $ja->first_name;
            $cv->last_name = $ja->last_name;
            $cv->email = $ja->email;
            $cv->phone = $ja->phone;
            $cv->gender = $ja->gender;
            $cv->date_of_birth = $ja->date_of_birth;
            $cv->state_of_origin = $ja->state_of_origin;
            $cv->willing_to_relocate = $ja->willing_to_relocate;
            $cv->marital_status = $ja->marital_status;
            $cv->state = $ja->location;
            $cv->headline = $ja->cover_note;
            $cv->highest_qualification = $ja->highest_qualification;
            $cv->last_position = $ja->last_position;
            $cv->last_company_worked = $ja->last_company_worked;
            $cv->years_of_experience = $ja->years_of_experience;
            $cv->cv_file = $ja->cv_file;
            $cv->save();

            $app = new JobApplication;
            $app->status = $ja->status;
            $app->cv_id = $cv->id;
            $app->job_id = $job->id;
            $app->cover_note = $ja->cover_note;
            $app->created = $ja->created_at;
            $app->action_date = $ja->updated_at;
            $app->save();

            $jam = new JobApplicationMessage;
            $jam->job_application_id = $app->id;
            $jam->message = $ja->cover_note;
            $jam->created = $ja->created_at;
            $jam->modified = $ja->updated_at;
            $jam->save();

            JobActivity::firstOrCreate([
                'activity_type'=>'APPLIED',
                'job_id'=>$job->id,
                'job_application_id'=>$app->id,
                'created_at'=>$app->created
                ]);
 

        }


    }
}
