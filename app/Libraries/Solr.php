<?php 

namespace App\Libraries;

use Auth;

class Solr {

	static $host = "http://50.28.104.199:8983/solr/resumes/select?";

	static $default_params = [ 'q' => '*', 'row' => 20, 'start' => 0, 'default_op' => 'AND', 'search_field' => 'text', 'show_expired' => false ,'sort' => 'post_date+desc', 'grouped'=>FALSE ];
	


	static function search_resume($data,$additional=''){
		extract($data);
		if(empty($q))
			return array();
		
		$dop = '';
		if($default_op == 'AND'){
			$dop = "";
		}
		$q = $dop.$q;	

		$q = str_ireplace(" ", "+", $q);
		
		// if(substr($q, 0, 1) == "*")
		// 	$sort = 'post_date+desc';
		// else
		// 	$sort = 'post_date+desc,score+desc';
		
		// $filename = $this->host."q=".$search_field.":".$q."&rows=".$row."&start=".$start
		// 					."&fq=-site_name:olx.com.ng&fq=admin_id:[*+TO+*]&facet=true&facet.field=job_type&facet.field=company&facet.field=location&facet.field=site_name&facet.date=expiry_date&facet.date.start=NOW/DAY&facet.date.end=NOW/DAY%2B60DAY&facet.date.gap=%2B7DAY&wt=json&sort=".$sort;
		if(!empty($search_field))
			$search_field .= ':';

		$filename = Solr::$host."q=".$search_field.$q."&rows=".$row."&start=".$start
							."&facet=true&facet.field=gender&facet.field=marital_status&facet.field=edu_school&facet.field=exp_company&facet.field=edu_grade&facet.field=folder_name&facet.field=folder_type"
							// ."&facet=true&facet.field=job_type&facet.field=company&facet.field=loc&facet.field=job_level&facet.field=site_name&facet.date=expiry_date&facet.date.start=NOW/DAY&facet.date.end=NOW/DAY%2B60DAY&facet.date.gap=%2B7DAY&wt=json"
							// ."&sort=".$sort
							.$additional
							."&fq=cv_file:*&wt=json"
							;
		if(@$filter_query)
		{
			//$filter_string = "";

			foreach ($filter_query as $key => $value) {
				
					// $filter_item = array();

				// foreach ($value as $key => $field) {
				// 	// $filter_item[] = "&fq=".$value."=".$
				// 	$filter_string .= "&fq=".$value."=".$field;
				// }

					// $filter_string .= implode('', $filter_item);
				
				$filename .= '&fq='.str_ireplace(" ", "+", $value);
			}
			// $filename .= $filter_string;
		}
		// if(!$show_expired)	
		// 	$filename .= "&fq=expiry_date:[NOW+TO+*]";

		
		// echo $filename.'<br/>';
		
		// dd( $filename );
		
		try {
		 	// $handle = fopen($filename, "r");

		  // 	if ($handle)
		 	// {
		  // 		$response = json_decode(stream_get_contents($handle), true);
		 	// 	fclose($handle);
		 
		
				//  return $response;
				 
		 
		 	// }
		 	// 
		 	$ch = curl_init();
			 
			curl_setopt($ch, CURLOPT_URL, $filename);
			curl_setopt($ch, CURLOPT_HEADER, false);
			curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
			 
			$re = curl_exec($ch);
			curl_close($ch);

			return json_decode($re, true);
		 }catch(exception $e){
		 	print_r($e);
		 }
		 
		 
		 return array();
		
		
		
	}

	static function get_saved_cvs($data)
	{
		$additional = "&fq=company_folder_id:". @Auth::user()->companies[0]->id;
		return Solr::search_resume($data,$additional);
	}


	static function quick_search_job($data){
		extract($data);
		if(empty($q))
			return array();
		
		$dop = '';
		if($default_op == 'AND'){
			$dop = "";
		}
		$q = $dop.$q;	
		
		
		// if(substr($q, 0, 1) == "*")
		// 	$sort = 'post_date+desc';
		// else
		// 	$sort = 'score+desc';
		if(!empty($search_field))
			$search_field .= ':';

		$filename = Solr::$host."q=".$search_field.$q."&rows=".$row."&start=".$start
							."&facet=false&wt=json&sort=".$sort;							
		
		if(!$show_expired)	
			$filename .= "&fq=expiry_date:[NOW+TO+*]";

		if($grouped)	
			$filename .= "&group=true&group.main=true&group.field=site_id&group.limit=2";

		$filename = str_ireplace("&#40;", "(", $filename);
			$filename = str_ireplace("&#41;", ")", $filename);

		// echo htmlspecialchars($filename).'<br/>----------<br/><br/>';
//        echo '------------------------------------BEGIN---------------------------------------------------';
			// print_r($filename .'<br/>');
//        echo '--------------------------------------END-------------------------------------------------';

		try {
		 	$handle = fopen($filename, "r");

		  	if ($handle)
		 	{
		 		$response = json_decode(stream_get_contents($handle), true);
		 		fclose($handle);

		  		return $response;
				 
		 
		 	}

		 }catch(exception $e){
		 	// print_r($e);
		 	// echo 'no handle';
		 }
		 
		 
		 return array();
		
		
		
	}
	
	function get_faceted_values($solr_arr){
		
		$ret = array();
		
		for ($i=0; $i < count($solr_arr); $i = $i+2) { 
			
			$val = $solr_arr[$i];
			$count = $solr_arr[$i + 1];														
			if(empty($val))
				$val = "Not Specified";

			if(strtolower($val) == 'choose' ||
                strtolower(preg_replace('|[^a-z]|i', '', $val)) == 'choose' ||
                strtolower($val) == 'select')
				$val = "Not Specified";
			
			if($count > 0)
				$ret[$val] = $ret[$val] ? $count : $ret[$val] + $count;
			
		}
		
		ksort($ret);
		
		return $ret;
		
	}
	
	
	function get_faceted_dates($solr_arr){
		
		$ret = array();
		
		$index = 0;

		if(empty($solr_arr))
			return $ret;
		
		foreach ($solr_arr as $key => $value) {
			$index++;
			
			if($value > 0 && ($key != 'gap') && ($key != 'start') && ($key != 'end'))
				$ret[$index.' week(s) '] = $value;
		}
		
		return $ret;
		
	}


	function search_cv($q, $row = 10, $start = 0, $default_op = 'AND'){

		if(empty($q))
			return array();
		
		$dop = '';
		if($default_op == 'AND'){
			$dop = "";
		}
		$q = $dop.$q;	
		
		$sort = 'score+desc';
		
		$filename = 'http://50.28.37.75:8983/solr/resumes/select?q={!q.op=AND}'.$q.'&rows='.$row.'&start='.$start.'&facet=true&facet.field=exp_company&facet.field=state&facet.field=gender&facet.field=experience&facet.field=edu_end_year&facet.field=edu_school&facet.field=edu_grade&facet.field=marital_status&facet.field=religion&facet.date=dob&facet.date.start=NOW/DAY-60YEAR&facet.date.end=NOW/DAY-10YEAR&facet.date.gap=%2B1YEAR&wt=json&sort=rank+desc';

		// echo $filename.'<br/>';
			
		try {
		 	$handle = fopen($filename, "r");
		  	if ($handle)
		 	{
		  		$response = json_decode(stream_get_contents($handle), true);
		 		fclose($handle);
		 
				 // echo '<pre>';
				 // print_r($response);
				 // echo '</pre>';
				 
				 
				 return $response;
				 
		 
		 	}
		 }catch(exception $e){
		 	print_r($e);
		 }
		 
		 return array();
	}

	function search_applications($q, $row = 10, $start = 0, $default_op = 'AND'){

		if(empty($q))
			return array();
		
		$dop = '';
		if($default_op == 'AND'){
			$dop = "";
		}
		$q = $dop.$q;	
		
		$sort = 'score+desc';


		
		$link = 'http://50.28.37.75:8983/solr/applications/select?q='.$q.'&rows='.$row.'&start='.$start
					.'&facet=true&facet.field=exp_company&facet.field=state&facet.field=gender&facet.field=experience'
					.'&facet.field=edu_end_year&facet.field=edu_school&facet.field=edu_grade&facet.field=marital_status&facet.field=religion&facet.field=test_name&facet.field=tr_status&facet.field=score&facet.date=dob&facet.date.start=NOW/DAY-60YEAR&facet.date.end=NOW'
					.'/DAY-10YEAR&facet.date.gap=%2B1YEAR&wt=json&sort=created+desc';
		
		// echo $link.'<br/>';	
		
		try {
		 	$handle = fopen($link, "r");
		  	if ($handle)
		 	{
		  		$response = json_decode(stream_get_contents($handle), true);
		 		fclose($handle);
				 
				 return $response;
		 	}
		 }catch(exception $e){
		 	print_r($e);
		 }
		 
		 
		 return array();
		
		
		
	}

	function update_applications($command="full-import"){

		$url = "http://50.28.37.75:8983/solr/applications/dataimport?command=".$command;

		try {
		 	$handle = fopen($url, "r");
		  	if ($handle)
		 	{
		  		$response = json_decode(stream_get_contents($handle), true);
		 		fclose($handle);
				 
				 return $response;
		 
		 	}
		 }catch(exception $e){
		 	print_r($e);
		 }

	}


	function update_core($core = 'jobs', $command="delta-import"){

		$url = "http://50.28.37.75:8983/solr/".$core."/dataimport?command=".$command;

		try {
			$handle = fopen($url, "r");
			if ($handle)
			{
				$response = json_decode(stream_get_contents($handle), true);
				fclose($handle);

				return $response;

			}
		}catch(exception $e){
			print_r($e);
		}

	}


	function quick_search_cv($q, $row = 10, $start = 0, $default_op = 'AND'){

		if(empty($q))
			return array();
		
		
		$sort = 'score+desc';
		
		$filename = 'http://50.28.37.75:8983/solr/resumes/select?q='.$q.'&rows='.$row.'&start='.$start.'&wt=json&sort=rank+desc';
			
		// echo $filename;

		try {
		 	$handle = fopen($filename, "r");
		  	if ($handle)
		 	{
		  		$response = json_decode(stream_get_contents($handle), true);
		 		fclose($handle);
		 
				 // echo '<pre>';
				 // print_r($response);
				 // echo '</pre>';
				 
				 
				 return $response;
				 
		 
		 	}
		 }catch(exception $e){
		 	print_r($e);
		 }
		 
		 
		 return array();
		
		
		
	}


	function get_faceted_dob($solr_arr){
		
		$ret = array();
		
		$index = 0;
		
		if(!empty($solr_arr))
			foreach ($solr_arr as $key => $value) {
				$index++;
				
				if($value > 0 && ($key != 'gap') && ($key != 'start') && ($key != 'end')){

					$k = (intval(date('Y'))  - intval(date('Y', strtotime(substr($key, 0, 10))))).' years old';

					$ret[$k] = $value;
				}
					
			}
		
		return $ret;
		
	}

	function extend_network($q, $type = "exp_company", $followers, $is_followers = true, $row = 12, $start = 0, $default_op = 'AND', $start_year = '', $end_year = ''){

		if(empty($q))
			return array();
		
		$dop = '';
		if($default_op == 'AND'){
			$dop = "";
		}
		$q = $dop.$q;	

		$sign = ($is_followers == true) ? "" : "-";
		
		$dq = '';
		
		//start year...
		if(!empty($start_year))
			if($type = 'edu_school')
				$dq .= '&fq=edu_start_year:['.($start_year - 2).'+TO+'.($start_year + 2).']'; 
			else
				$dq .= '&fq=exp_start_year:['.($start_year - 2).'+TO+'.($start_year + 2).']'; 

		//end year...
		if(!empty($end_year))
			if($type = 'edu_school')
				$dq .= '&fq=edu_end_year:['.($end_year - 2).'+TO+'.($end_year + 2).']'; 
			else
				$dq .= '&fq=exp_end_year:['.($end_year - 2).'+TO+'.($end_year + 2).']'; 


		if(substr($q, 0, 1) == "*")
			$sort = 'post_date+desc';
		else
			$sort = 'score+desc';
		$filename = "http://50.28.37.75:8983/solr/resumes/select?q=".$type.":".trim($q).$dq."&fq=-personal_url:[*+TO+*]&rows=".$row."&start=".$start
							."&fq=".$sign."userId:(".$followers.")&facet=false&wt=json";
							
		// echo $filename.'<br/>---<br/><br/>';
							
		try {
		 	$handle = fopen($filename, "r");
		  	if ($handle)
		 	{
		  		$response = json_decode(stream_get_contents($handle), true);
		 		fclose($handle);
		 		
		 	// 	echo '<pre>';
				// print_r($response);
				// echo '</pre>';

				 return $response;
				 
		 
		 	}
		 }catch(exception $e){
		 	print_r($e);
		 }
		 
		 
		 return array();
		
	}

	/*function search_work_connection($q, $type = "company", $friends, $row = 12, $start = 0){

		if(empty($q))
			return array();

		$filename = "http://50.28.37.75:8983/solr/connection/select?q=".$type.":".trim($q)."&rows=".$row."&start=".$start
							."&fq=connected_user_id:(".$friends.")&facet=false&wt=json";
							
		try {
		 	$handle = fopen($filename, "r");
		  	if ($handle) {
		  		$response = json_decode(stream_get_contents($handle), true);
		 		fclose($handle);

				 return $response;
		 	}
		 } catch(exception $e){
		 	print_r($e);
		 }
		 
		 return array();		
	}*/
	
}

/* End of file Sms.php */