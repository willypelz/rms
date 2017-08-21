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

	function grades(){
		return [

                '1st Class',
                'Distinction',
                'Second Class Upper',
                'Second Class Lower',
                'Upper Credit',
                'Lower Credit',
                '3rd Class',
                'Pass',
                'Other',
                'Unspecified'
            ];
	}

	function getGrade($index){
		return grades()[$index];
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
				  	'created_at' => date('Y-m-d H:i:s'),
				  	'updated_at' => date('Y-m-d H:i:s'),
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
			  	'created_at' => date('Y-m-d H:i:s'),
				 'updated_at' => date('Y-m-d H:i:s'),
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

	function remove_cv_contact($cv) {

		$states = array('Abia','Abuja','Anambra','Adamawa','Akwa Ibom','Bauchi','Bayelsa','Benue','Borno','Cross River','Delta','Edo','Ekiti','Ebonyi','Enugu','Gombe','Imo','Kano','Lagos','Nassarawa','Jigawa','Kebbi','Kaduna','Kogi','Katsina','Kwara','Niger','Ogun','Ondo','Osun','Oyo','Plateau','Rivers','Sokoto','Taraba','Yobe','Zamfara');
		$states = array_merge($states, ["Avenue", "Close", "Estate", "District", "Post Office", "Crescent", "Street"] );
		$extaracted_content = $cv['extracted_content'][0];
	    // remove email
	    $extaracted_content = preg_replace('/([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)/','*****@****.***',$extaracted_content);

	    // remove phone
	    $extaracted_content = preg_replace("/((\+)*\s*\(*(234|0)\)*\s*\(*(234|0|1*)\)*\s*\-*\s*\d{3}\s*\-*\s*\d{3}\s*\d{4}|(\+)*\s*\(*(234|0|1)\)*\s*\(*(234|0|1)*\)*\s*\-*\s*\d{3}\s*\-*\s*\d{4})/i",'***-***-****',$extaracted_content);
	    // '/([+]?[0-9]+[\- ]?[0-9]+)/'

	    //remove Firstname
	    // $extaracted_content = preg_replace('/'.$cv['first_name'].'([ \,\.]+)/i', '', $extaracted_content);

	    $extaracted_content = preg_replace('/^.*' . '(?:' . preg_replace('/\s/', '|', $cv['first_name']) . ')' .'.*$(?:\r\n|\n)?/im', '', $extaracted_content);

	    //remove Lastname
	    $extaracted_content = preg_replace('/^.*' . '(?:' . preg_replace('/\s/', '|', $cv['last_name']) . ')' .'.*$(?:\r\n|\n)?/im', '', $extaracted_content);

	    //Remove address
	    $extaracted_content = preg_replace('/^.*' . '(?:' . implode('|', $states) . ')' .'.*$(?:\r\n|\n)?/im', '', $extaracted_content);

	    return $extaracted_content;
	}

	function default_picture($data, $type='cv')
	{
		if( !is_array($data) )
		{
			$data = $data->toArray();
		}

		switch ($type) {
			case 'cv':
				$string1 = trim( $data['first_name'] );
				$string2 = trim(  @$data['last_name'] );
				
				break;
			case 'user':
				$data['name'] = str_replace('  ', '', $data['name']);
				$data_arr = explode(' ', $data['name']);
				$string1 = $data_arr[0];
				$string2 = @$data_arr[1];
				
				break;
			
			default:
				# code...
				break;
		}

		return 'http://dummyimage.com/300x300/10588a/ffffff.jpg&text='.strtoupper( substr($string1,0,1).substr($string2,0,1) );
		
	}

	function default_color_picture($data, $type='cv')
	{
		if( !is_array($data) )
		{
			$data = $data->toArray();
		}

		switch ($type) {
			case 'cv':
				$string1 = @$data['first_name'];
				$string2 = @$data['last_name'];
				
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
		$all = 0; //total number of results
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

		
		$statuses = ['ALL','PENDING', 'INTERVIEWED', 'REJECTED','WAITING', 'HIRED','ASSESSED','SHORTLISTED'];

		$status_array = [];
		foreach ($statuses as $val) {
			$status_array[$val] = (isset($ret[$val]))?$ret[$val]:0;
			$all += $status_array[$val];
		}
		
		$status_array['ALL'] = $all;


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
			if( isset( Auth::user()->companies[ Session::get('current_company_index') ] ) )
				return Auth::user()->companies[ Session::get('current_company_index') ];
			else
				return Auth::user()->companies[0];
		}

		// if( is_null( @Auth::user()->companies[0] ) || !isset( @Auth::user()->companies[0] ) )
		// {
		// 	return redirect()->guest('login');
		// }

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

	function convert_number_to_words($number) {
	    
	    $hyphen      = '-';
	    $conjunction = ' and ';
	    $separator   = ', ';
	    $negative    = 'negative ';
	    $decimal     = ' point ';
	    $dictionary  = array(
	        0                   => 'zero',
	        1                   => 'one',
	        2                   => 'two',
	        3                   => 'three',
	        4                   => 'four',
	        5                   => 'five',
	        6                   => 'six',
	        7                   => 'seven',
	        8                   => 'eight',
	        9                   => 'nine',
	        10                  => 'ten',
	        11                  => 'eleven',
	        12                  => 'twelve',
	        13                  => 'thirteen',
	        14                  => 'fourteen',
	        15                  => 'fifteen',
	        16                  => 'sixteen',
	        17                  => 'seventeen',
	        18                  => 'eighteen',
	        19                  => 'nineteen',
	        20                  => 'twenty',
	        30                  => 'thirty',
	        40                  => 'fourty',
	        50                  => 'fifty',
	        60                  => 'sixty',
	        70                  => 'seventy',
	        80                  => 'eighty',
	        90                  => 'ninety',
	        100                 => 'hundred',
	        1000                => 'thousand',
	        1000000             => 'million',
	        1000000000          => 'billion',
	        1000000000000       => 'trillion',
	        1000000000000000    => 'quadrillion',
	        1000000000000000000 => 'quintillion'
	    );
	    
	    if (!is_numeric($number)) {
	        return false;
	    }
	    
	    if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
	        // overflow
	        trigger_error(
	            'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
	            E_USER_WARNING
	        );
	        return false;
	    }

	    if ($number < 0) {
	        return $negative . convert_number_to_words(abs($number));
	    }
	    
	    $string = $fraction = null;
	    
	    if (strpos($number, '.') !== false) {
	        list($number, $fraction) = explode('.', $number);
	    }
	    
	    switch (true) {
	        case $number < 21:
	            $string = $dictionary[$number];
	            break;
	        case $number < 100:
	            $tens   = ((int) ($number / 10)) * 10;
	            $units  = $number % 10;
	            $string = $dictionary[$tens];
	            if ($units) {
	                $string .= $hyphen . $dictionary[$units];
	            }
	            break;
	        case $number < 1000:
	            $hundreds  = $number / 100;
	            $remainder = $number % 100;
	            $string = $dictionary[$hundreds] . ' ' . $dictionary[100];
	            if ($remainder) {
	                $string .= $conjunction . convert_number_to_words($remainder);
	            }
	            break;
	        default:
	            $baseUnit = pow(1000, floor(log($number, 1000)));
	            $numBaseUnits = (int) ($number / $baseUnit);
	            $remainder = $number % $baseUnit;
	            $string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
	            if ($remainder) {
	                $string .= $remainder < 100 ? $conjunction : $separator;
	                $string .= convert_number_to_words($remainder);
	            }
	            break;
	    }
	    
	    if (null !== $fraction && is_numeric($fraction)) {
	        $string .= $decimal;
	        $words = array();
	        foreach (str_split((string) $fraction) as $number) {
	            $words[] = $dictionary[$number];
	        }
	        $string .= implode(' ', $words);
	    }
	    
	    return $string;
	}

	function rrmdir($dir) { 
	   if (is_dir($dir)) { 
	     $objects = scandir($dir); 
	     foreach ($objects as $object) { 
	       if ($object != "." && $object != "..") { 
	         if (filetype($dir."/".$object) == "dir") rrmdir($dir."/".$object); else unlink($dir."/".$object); 
	       } 
	     } 
	     reset($objects); 
	     rmdir($dir); 
	   } 
	 }

	function get_company_logo($logo){
		if($logo == "" or is_null($logo))
		{
			return asset('img/company.png');
		}
		
		if( File::exists( public_path( 'uploads/'.@$logo ) ) )
        {
            return asset('uploads/'.@$logo);
        }
        else
        {
            return asset('img/company.png');
        }
	}
?>