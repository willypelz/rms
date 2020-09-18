<?php
use App\Jobs\UploadApplicant;
use App\Libraries\Solr;
use App\Models\Candidate;
use App\Models\Company;
use App\Models\Cv;
use App\Models\Job;
use App\Models\JobActivity;
use App\Models\JobApplication;
use SeamlessHR\SolrPackage\Facades\SolrPackage;
// use Faker;

	function test(){

		return 'Working well';
	}

	

	function qualifications(){
		return $options = array('MPhil / PhD' => 'MPhil / PhD', 'MBA / MSc'=>'MBA / MSc', 'MBBS'=>'MBBS', 'Degree'=>'Degree', 'HND'=>'HND', 'OND'=>'OND', 'N.C.E'=>'N.C.E', 'Diploma'=>'Diploma', 'High School (S.S.C.E)'=>'High School (S.S.C.E)', 'Vocational'=>'Vocational', 'Others'=>'Others');
	}

	function grades(){
		return [
                'First Class',
                'Distinction',
                'Second Class Upper',
                'Second Class Lower',
                'Upper Credit',
                'Lower Credit',
                'Third Class',
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

		return ($future) ? implode(', ', $unit_string_array) . ' to go' : implode(', ', $unit_string_array) . ' ago';
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

		return 'https://dummyimage.com/300x300/10588a/ffffff.jpg&text='.strtoupper( substr($string1,0,1).substr($string2,0,1) );

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


		return [ 'color' => '#'.$color, 'image' => 'https://dummyimage.com/300x300/'.$color.'/ffffff.jpg&text='.$text ];

	}



	function get_application_statuses($status,$job_id=null, $statuses = [])
	{
		$ret = array();
		$all = 0; //total number of results
		// dd($solr_arr);

        if( is_null($job_id) )
            $status_from_db = collect( \DB::select("SELECT DISTINCT `cvs`.`email`,`job_applications`.status FROM `cvs`,`job_applications` where `job_applications`.`cv_id`=`cvs`.`id`") );
        else
            $status_from_db = collect( \DB::select("SELECT DISTINCT `cvs`.`email`,`job_applications`.status FROM `cvs`,`job_applications` where `job_applications`.`job_id` = ".$job_id." and `job_applications`.`cv_id`=`cvs`.`id`") );

        $status_array2  =['ALL' => $status_from_db->count()];

        foreach ($statuses as $stat) {
            $status_array2[$stat] = $status_from_db->where('status',$stat)->count();
        }
        $status_array2 ['ALL'] = $status_from_db->count();

        return $status_array2;

	}


	function preloader(){

		return '<div style="width:100%;text-align:center"><img src="'.asset('img/hourglass.svg').'" width="50"></div>';

	}

	function check_if_job_owner($job_id)
	{
		$user =  Auth::user();
		$job_access = Job::where('id',$job_id)->whereHas('users',function($q) use($user){
            $q->where('user_id',$user->id);
        })->get()->pluck('id')->toArray();

        $company_role = get_current_company()->users()->wherePivot('user_id', $user->id )->first()->pivot->role;



        if(!$company_role && $user->is_super_admin != 1)
        {

            if ( !in_array($job_id, $job_access) )
			{
				abort(404);
			}
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


		if( Auth::user()->companies && Auth::user()->companies->count() < 1 )
		{
			return redirect()->guest('login');
		}

		// If a company is not selected, default to the first on the list
		return Auth::user()->companies[0];
    }

    function get_form_field_types()
    {
        return [
            'DROPDOWN' => 'Dropdown',
            'RADIO' => 'Radio',
            'CHECKBOX' => 'Checkbox',
            'TEXT' => 'Short Text',
            'TEXTAREA' => 'Long Text',
            'MULTIPLE_OPTION' => 'Multiple Option',
            'FILE' => 'File'
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

	function get_interview_note_templates()
	{
		return \App\Models\InterviewNoteTemplates::where('company_id',get_current_company()->id )->orderBy('name')->get();

	}

function saveCompanyUploadedCv($cvs, $additional_data, $request)
{

    extract($additional_data);

    $cv_source = "";

    $options = ( is_null( $options ) ) ? 'upToJob' : $options;

    \Log::info(json_encode($cvs));

    switch ($options) {
        case 'upToJob':
            $cv_source = "Uploaded Candidate";
            break;
        case 'upToFolder':
            $cv_source = $folder;
            break;
        default:
            # code...
            break;
    }

    // dd($cvs, $request);


    foreach ($cvs as $key => $cv) {

		$token = hash_hmac('sha256', str_random(40), config('app.key'));

		if(isset($request->willing_to_relocate) && $request->willing_to_relocate == 'yes')
		{
			$relocate = 1;
		}else{
			$relocate = 0;
		}

         \Log::info($request->type);

        switch ( $request->type ) {
            case 'single':
                $last_cv = Cv::insertGetId([
                    'first_name' => $request->cv_first_name,
                    'last_name' => $request->cv_last_name,
                    'email' => $request->cv_email,
                    'phone' => $request->cv_phone,
                    'gender' => $request->gender,
                    'state' => $request->location,
                    'highest_qualification' => $request->highest_qualification,
                    'years_of_experience' => $request->years_of_experience,
                    'last_company_worked' => $request->last_company_worked,
                    'last_position' => $request->last_position,
                    'willing_to_relocate' => $relocate,
                    'graduation_grade' => $request->graduation_grade,
                    'cv_file' => $cv ,
                    'cv_source' => $cv_source
				]);
				$data = [
					'name'=>$request->cv_last_name,
					'job'=>$job_id,
					'email'=> $request->cv_email
				];
				$data = (object)$data;
				
				$candidate = Candidate::firstOrCreate(['email' => $request->cv_email, 'first_name' => $request->cv_first_name,
				'last_name' => $request->cv_last_name]);
				Candidate::where('id',$candidate->id)->update(['token'=>$token]);

				$company = Company::find(get_current_company()->id);

				$accept_link = route('candidate-invite', ['id' => $candidate->id,'token'=>$token]);

				Mail::send('emails.new.candidate-invite', ['data' => $data, 'company' => $company, 'accept_link' => $accept_link], function ($m) use($data) {
					$m->from(env('COMPANY_EMAIL'))->to($data->email)->subject('You Have Been Exclusively Invited');
				});
                break;

            case 'bulk':
                // $last_cv_upload_index++;
                $emailKey = trim(strtolower($key));
                \Log::info('Bulk uploaid');
                $last_cv = Cv::insertGetId([ 'first_name' => $key, 'email' => $emailKey.'@seamlesshrbulk.com', 'cv_file' => $cv , 'cv_source' => $cv_source ]);
                break;

            default:
                // continue;
                break;
        }


        if($options == 'upToJob'){
            $jb = JobApplication::FirstorCreate([
                'cv_id' => $last_cv,
                'job_id' => $job_id,
                'created' => date('Y-m-d H:i:s'),
                'action_date' => date('Y-m-d H:i:s'),
				'status' => 'PENDING',
				'candidate_id'=> $candidate = (isset($candidate->id)) ? $candidate->id : null
            ]);

            $job_application = JobApplication::with('cv')->find($jb->id);

    		UploadApplicant::dispatch($job_application)->onQueue('solr');
        }
    }

    $user = Auth::user();
    
    Mail::send('emails.new.cv_upload_successful', ['user' => $user, 'link'=> url('cv/talent-pool') ], function ($m) use ($user) {
        $m->from(env('COMPANY_EMAIL'))->to($user->email)->subject('Talent Pool :: File(s) Upload Successful');
    });

    return [ 'status' => 1 ,'data' => 'Cv(s) uploaded successfully' ] ;
}

function checkIfUserHasCompanyPermission() {
	    //check if user is a super admin
	    $user = auth()->user()->load('roles');
        return $user->is_super_admin ?  true :  false;
}

function getRoleArray($job_id, $user) {
    $job = \App\Models\Job::find($job_id);
    $user = \App\User::find($user->id);
    $roles = $user->roles()->where('job_id', $job->id)->get();
    $role_array = [];
    foreach ($roles as $role) {
        $role = \App\Models\Role::select('id', 'display_name')->find($role->pivot->role_id);

        if(!is_null($role))
            $role_array[] = $role->id;
    }

    return $role_array;
}

function getRoleArrayName($job_id, $user) {
    $job = \App\Models\Job::find($job_id);
    $user = \App\User::find($user->id);
    $roles = $user->roles()->where('job_id', $job->id)->get();
    $role_array = [];
    foreach ($roles as $role) {
        $role = \App\Models\Role::select('id', 'name')->find($role->pivot->role_id);

        if(!is_null($role))
            $role_array[] = $role->name;
    }

    return $role_array;
}

function checkIfUserHasJobPermission($job_id) {
    $user = auth()->user()->load('roles');
    //get all the roles the user has for this job
    $role_array = getRoleArray($job_id, $user);
    //if no roles for this job then he has no permissions
    return empty($role_array) ?  false :  true;
}

function checkForBothPermissions($job_id) {
	    $has_job = checkIfUserHasJobPermission($job_id);
	    $has_comp = checkIfUserHasCompanyPermission();
        return ($has_comp || $has_job) ?  true :  false;
}

function getUserPermissions() {

    $roles = auth()->user()->roles;

    $perm_array = [];

    foreach ($roles as $role) {
        foreach ($role->perms as $permission) {
            $perm_array[] = $permission->name;
        }
    }
    return !empty($perm_array) ?  array_unique($perm_array) : null;

}

/**
 * @param $roleName
 * @return string
 */
function getAdminName($roleName) {
	$name = '';
    switch ($roleName){
        case 'admin':
            $name = 'Talent Acquisition Partner';
            break;
        case 'interviewer':
            $name = "Business Manager";
            break;
        case 'commenter':
            $name = 'Business Partner';
            break;
    }

    return $name;
}

/**
 * @return array
 */
function getAdminPermissions() {
	$perms = auth()->user()->roles()->first();
	$perms_array = [];
	if(isset($perms->perms)){
		$perms = $perms->perms;
		foreach ($perms as $perm) {
			$perms_array[] = $perm->name;
		}
	}
		
		

    return $perms_array;
}

/**
 * @return mixed
 */
function getCurrentLoggedInUserRole() {
        return auth()->user()->roles()->first();
}

function get_company_email_logo(){
	$logo = env("APP_LOGO");
	$url = env("APP_URL");
	return 
	"<a href='$url' style='font-family:Arial,Helvetica,sans-serif;word-wrap:break-word;color:#136fd2' target='_blank'>
		<img src='$logo' width='50%' height='' style='outline:none;text-decoration:none;display:block;min-height:31px;margin:0 auto;border:0;' class='CToWUd' alt='COMPANY_LOGO'>
	</a>";
}

function candidateDossierPercentage($value) {
	if($value == 0 || $value == null || $value == "") {
		return 0;
	}elseif($value == 1) {
		return 20;
	}elseif($value == 2) {
		return 40;
	}elseif($value == 3) {
		return 60;
	}elseif($value == 4) {
		return 80;
	}elseif($value == 5) {
		return 100;
	}
}