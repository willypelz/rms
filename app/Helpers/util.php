<?php
use App\Models\JobActivity;


	function test(){

		return 'Working well';
	}

	function qualifications(){
		return $options = array('MPhil / PhD' => 'MPhil / PhD', 'MBA / MSc'=>'MBA / MSc', 'MBBS'=>'MBBS', 'Degree'=>'Degree', 'HND'=>'HND', 'OND'=>'OND', 'N.C.E'=>'N.C.E', 'Diploma'=>'Diploma', 'High School (S.S.C.E)'=>'High School (S.S.C.E)', 'Vocational'=>'Vocational', 'Others'=>'Others');
	}

	function human_time($time, $max_units = NULL)
	{	
		$time  = strtotime($time);
		$lengths = array(1, 60, 3600, 86400, 604800, 2630880, 31570560, 315705600);
		$units = array('second', 'minute', 'hour', 'day', 'week', 'month', 'year', 'decade');
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
	

	function save_activities($user_id, $activity_type,  $job_id = false, $cv_id = false, $comment = false) {
		  if (!$job_id) $job_id = NULL;
		  if (!$cv_id) $cv_id = NULL;
		  if (!$comment) $comment = NULL;

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
				$string2 = $data_arr[1];
				
				break;
			
			default:
				# code...
				break;
		}

		return 'http://dummyimage.com/300x300/ffffff/405465.jpg&text='.strtoupper( substr($string1,0,1).substr($string2,0,1) );
		
	}

	function get_application_statuses($status)
	{

		$status_array = [];

		$status_array['PENDING'] = ( array_search('PENDING', $status) !== false && intval( array_search('PENDING', $status) + 1 ) > 0 ) ? $status[ intval( array_search('PENDING', $status) ) + 1 ] : 0;
		$status_array['INTERVIEWED'] = ( array_search('INTERVIEWED', $status) !== false && intval( array_search('INTERVIEWED', $status) + 1 ) > 0 ) ? $status[ intval( array_search('INTERVIEWED', $status) ) + 1 ] : 0;
		$status_array['REJECTED'] = ( array_search('REJECTED', $status) !== false && intval( array_search('REJECTED', $status) + 1 ) > 0 ) ? $status[ intval( array_search('REJECTED', $status) ) + 1 ] : 0;
		$status_array['HIRED'] = ( array_search('HIRED', $status) !== false && intval( array_search('HIRED', $status) + 1 ) > 0 ) ? $status[ intval( array_search('HIRED', $status) ) + 1 ] : 0;
		$status_array['ASSESSED'] = ( array_search('ASSESSED', $status) !== false && intval( array_search('ASSESSED', $status) + 1 ) > 0 ) ? $status[ intval( array_search('ASSESSED', $status) ) + 1 ] : 0;
		
		// dd(array_search('PENDING', $status));

		return $status_array;
	}
?>