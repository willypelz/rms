<?php
use App\Models\JobActivity;


	function test(){

		return 'Working well';
	}

	function qualifications(){
		return $options = array('MPhil / PhD' => 'MPhil / PhD', 'MBA / MSc'=>'MBA / MSc', 'MBBS'=>'MBBS', 'Degree'=>'Degree', 'HND'=>'HND', 'OND'=>'OND', 'N.C.E'=>'N.C.E', 'Diploma'=>'Diploma', 'High School (S.S.C.E)'=>'High School (S.S.C.E)', 'Vocational'=>'Vocational', 'Others'=>'Others');
	}

	

	function save_activities($user_id, $activity_type,  $job_id = false, $cv_id = false, $comment = false) {
		  if (!$job_id) $job_id = NULL;
		  if (!$cv_id) $cv_id = NULL;
		  if (!$comment) $comment = NULL;
		  // code
		  //return $user_id.' activity_type is --'.$activity_type.' comment is ---'.$comment;

		$response =  JobActivity::firstOrCreate([
		  	'user_id'=>$user_id,
		  	'activity_type'=>$activity_type,
		  	'job_id'=>$job_id,
		  	'cv_id'=>$cv_id,
		  	'comment'=>$comment,
		  	]);

		return $response;


	}

	function locations(){
	return array(
				'Abuja FCT'=>'Abuja FCT',
				'Abia'=>'Abia',
				'Adamawa'=>'Adamawa',
				'Akwa Ibom'=>'Akwa Ibom',
				'Anambra'=>'Anambra',
				'Bauchi'=>'Bauchi',
				'Bayelsa'=>'Bayelsa',
				'Benue'=>'Benue',
				'Borno'=>'Borno',
				'Cross River'=>'Cross River',
				'Delta'=>'Delta',
				'Edo'=>'Edo',
				'Ekiti'=>'Ekiti',
				'Enugu'=>'Enugu',
				'Gombe'=>'Gombe',
				'Imo'=>'Imo',
				'Jigawa'=>'Jigawa',
				'Kaduna'=>'Kaduna',
				'Kano'=>'Kano',
				'Katsina'=>'Katsina',
				'Kebbi'=>'Kebbi',
				'Kogi'=>'Kogi',
				'Kwara'=>'Kwara',
				'Lagos'=>'Lagos',
				'Nassarawa'=>'Nassarawa',
				'Niger'=>'Niger',
				'Ogun'=>'Ogun',
				'Ondo'=>'Ondo',
				'Osun'=>'Osun',
				'Oyo'=>'Oyo',
				'Plateau'=>'Plateau',
				'Rivers'=>'Rivers',
				'Sokoto'=>'Sokoto',
				'Taraba'=>'Taraba',
				'Yobe'=>'Yobe',
				'Zamfara'=>'Zamfara',
				'Nigeria'=>'Nigeria',
				'Outside Nigeria'=>'Outside Nigeria',

			);
	
	}

?>