<?php
use App\Models\JobActivity;
use App\Models\Job;
// use Faker;

	function test(){

		return 'Working well';
	}

	function qualifications(){
		return $options = array('MPhil / PhD' => 'MPhil / PhD', 'MBA / MSc'=>'MBA / MSc', 'MBBS'=>'MBBS', 'Degree'=>'Degree', 'HND'=>'HND', 'OND'=>'OND', 'N.C.E'=>'N.C.E', 'Diploma'=>'Diploma', 'High School (S.S.C.E)'=>'High School (S.S.C.E)', 'Vocational'=>'Vocational', 'Others'=>'Others');
	}

	function human_time($time, $max_units = NULL){	
		$time  = strtotime($time);
		// $lengths = array(1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600);
		// $units = array('second', 'minute', 'hour', 'day', 'week', 'month', 'year', 'decade');
		$lengths = array(1, 60, 3600, 86400, 604800, 2630880, 31570560);
		$units = array('second', 'minute', 'hour', 'day', 'week', 'month', 'year');
		$unit_string_array = array();

		$max_units = (is_numeric($max_units) && in_array($max_units, range(1,8))) ? $max_units : sizeOf($lengths);
		$diff = (is_numeric($time) ? time() - $time : time() - strtotime($time));
		$future = ($diff < 0) ? 1 : 0;
		$diff = abs($diff); // Let's get positive!

		$total_units = 0;
		for ($i = sizeOf($lengths) - 1; $i >= 0; $i--)
		{
			if ($diff > $lengths[$i] && $total_units < $max_units)
			{
				$amount = floor($diff / $lengths[$i]);
				$mod = $diff % $lengths[$i];

				$unit_string_array[] = $amount . ' ' . $units[$i] . (($amount == 1) ? '' : 's');
				$diff = $mod;
				$total_units++;
			}
		}

		return ($future) ? implode($unit_string_array, ', ') . ' to go' : implode($unit_string_array, ', ') . ' ago';
	}
	

	function save_activities($activity_type,  $job_id = false, $job_app_id = false, $comment = false) {

		// List of all Activity type
		/*
			REJECT
			HIRE
			ADD-TEAM
			SHARE-APPLICANT
			MESSAGE
			SUSPEND-JOB
			PUBLISH-JOB
			APPLIED
			REVIEW
		*/
			if(!empty(Auth::user())){
				$user_id = Auth::user()->id;
			}else{
				$user_id = NULL;
			}

		  if (!$job_id) $job_id = NULL;
		  
		  if (!$comment) $comment = NULL;

		  if( is_array( $job_app_id ) )
		  {
		  	$insert = [];
		  	foreach ($job_app_id as $key => $app_id) {
			  	if (!$app_id) $app_id = NULL;
			  	$insert[] = [
				  	'user_id'=> $user_id,
				  	'activity_type'=>$activity_type,
				  	'job_id'=>$job_id,
				  	'job_application_id'=>$app_id,
				  	'comment'=>$comment,
			  	];
			  	# code...
			  }
		  }
		  else{
		  	$insert = [
			  	'user_id'=> $user_id,
			  	'activity_type'=>$activity_type,
			  	'job_id'=>$job_id,
			  	'job_application_id'=>$job_app_id,
			  	'comment'=>$comment,
		  	];
		  }
		  

		 

		$response =  JobActivity::insert( $insert );

		// return $response;


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

	function remove_cv_contact($string) {
	    // remove email
	    $string = preg_replace('/([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/','*****@****.***',$string);

	    // remove phone
	    $string = preg_replace("/((\+)*\s*\(*(234|0)\)*\s*\(*(234|0|1*)\)*\s*\-*\s*\d{3}\s*\-*\s*\d{3}\s*\d{4}|(\+)*\s*\(*(234|0|1)\)*\s*\(*(234|0|1)*\)*\s*\-*\s*\d{3}\s*\-*\s*\d{4})/i",'***-***-****',$string);
	    // '/([+]?[0-9]+[\- ]?[0-9]+)/'

	    return $string;
	}

	function default_picture($data, $type='cv')
	{
		if( !is_array($data) )
		{
			$data = $data->toArray();
		}

		switch ($type) {
			case 'cv':
				$string1 = $data['first_name'];
				$string2 = $data['last_name'];
				
				break;
			case 'user':
				$data_arr = explode(' ', $data['name']);
				$string1 = $data_arr[0];
				$string2 = @$data_arr[1];
				
				break;
			
			default:
				# code...
				break;
		}

		return 'http://dummyimage.com/300x300/ffffff/405465.jpg&text='.strtoupper( substr($string1,0,1).substr($string2,0,1) );
		
	}

	function default_color_picture($data, $type='cv')
	{
		if( !is_array($data) )
		{
			$data = $data->toArray();
		}

		switch ($type) {
			case 'cv':
				$string1 = $data['first_name'];
				$string2 = $data['last_name'];
				
				break;
			case 'user':
				$data_arr = explode(' ', $data['name']);
				$string1 = $data_arr[0];
				$string2 = @$data_arr[1];
				
				break;
			
			default:
				# code...
				break;
		}

		$colors = [
			"79DDE8",
			"7995E8",
			"E87979",
			"E8CC79",
			"E279E8",
			"90999C",
			"A8E879",
			"9A79E8",
			"EC8767",
			"C38E7B"
		];

		$color = $colors[ array_rand($colors) ];

		$text = strtoupper( substr($string1,0,1).substr($string2,0,1) );

		if($text == "" || $text == null)
		{
			$text = 'O';
		}


		return [ 'color' => '#'.$color, 'image' => 'http://dummyimage.com/300x300/'.$color.'/ffffff.jpg&text='.$text ];
		
	}

	function get_application_statuses($status)
	{


		$ret = array();

		// dd($solr_arr);

		for ($i=0; $i < count($status); $i = $i+2) { 


			
			$val = $status[$i];
			$count = $status[$i + 1];														
			if(empty($val))
				$val = "Not Specified";

			if(strtolower($val) == 'choose' ||
                strtolower(preg_replace('|[^a-z]|i', '', $val)) == 'choose' ||
                strtolower($val) == 'select')
				$val = "Not Specified";
			
			if($count > 0)
				$ret[$val] = $count;
			
		}

		
		$statuses = ['PENDING', 'INTERVIEWED', 'REJECTED','WAITING', 'HIRED','ASSESSED','SHORTLISTED'];

		$status_array = [];
		foreach ($statuses as $val) {
			$status_array[$val] = (isset($ret[$val]))?$ret[$val]:0;
		}
		



		// $status_array['PENDING'] = ( array_search('PENDING', $status) !== false && intval( array_search('PENDING', $status) + 1 ) > 0 ) ? @$status[ intval( array_search('PENDING', $status) ) + 1 ] : 0;
		// $status_array['INTERVIEWED'] = ( array_search('INTERVIEWED', $status) !== false && intval( array_search('INTERVIEWED', $status) + 1 ) > 0 ) ? @$status[ intval( array_search('INTERVIEWED', $status) ) + 1 ] : 0;
		// $status_array['REJECTED'] = ( array_search('REJECTED', $status) !== false && intval( array_search('REJECTED', $status) + 1 ) > 0 ) ? @$status[ intval( array_search('REJECTED', $status) ) + 1 ] : 0;
		// $status_array['HIRED'] = ( array_search('HIRED', $status) !== false && intval( array_search('HIRED', $status) + 1 ) > 0 ) ? @$status[ intval( array_search('HIRED', $status) ) + 1 ] : 0;
		// $status_array['ASSESSED'] = ( array_search('ASSESSED', $status) !== false && intval( array_search('ASSESSED', $status) + 1 ) > 0 ) ? @$status[ intval( array_search('ASSESSED', $status) ) + 1 ] : 0;
		// $status_array['SHORTLISTED'] = ( array_search('SHORTLISTED', $status) !== false && intval( array_search('SHORTLISTED', $status) + 1 ) > 0 ) ? @$status[ intval( array_search('SHORTLISTED', $status) ) + 1 ] : 0;

		
		
		// dd(array_search('PENDING', $status));
		return $status_array;
	}


	function preloader(){

		return '<div style="width:100%;text-align:center"><img src="'.asset('img/hourglass.svg').'" width="50"></div>';

	}

	function check_if_job_owner($job_id)
	{
		if ( !in_array($job_id, Job::getMyJobIds()) )
		{
			abort(404);
		}
	}

	function get_current_company()
	{
		//If a company is selected
		if( Session::get('current_company_index')  )
		{
			return Auth::user()->companies[ Session::get('current_company_index') ];
		}

		// If a company is not selected, default to the first on the list
		return Auth::user()->companies[0];
	}

	function get_form_field_types()
	{
		return [
			'DROPDOWN',
			'RADIO',
			'CHECKBOX',
			'TEXT',
			'TEXTAREA',
			'MULTIPLE_OPTION',
			'FILE'
		];
	}
?>