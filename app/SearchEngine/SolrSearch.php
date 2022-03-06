<?php

namespace App\SearchEngine;

use App\Models\Job;
use App\Jobs\UploadApplicant;
use App\Models\JobApplication;
use App\SearchEngine\SearchEngine;

use Illuminate\Support\Facades\Log;

class SolrSearch implements SearchEngine
{

    static $url;
    static $host;
    static $core;
    static $clientId;

    public function __construct()
    {
        self::$url = getEnvData("SOLR_URL", null, self::$clientId); //getEnvData("SOLR_CORE",null, 1); // formerly env("SOLR_URL") but now gotten from DB. it's same value for all clients;
        self::$core = getEnvData("SOLR_CORE", null, self::$clientId);  //null;
        self::$host = getEnvData("SOLR_URL", null, self::$clientId) . self::$core . "/select?"; // null; //formerly env("SOLR_URL").self::$core."/select?" but now gotten from DB per client;

    }

    

    static $default_params = [
        'q' => '*', 'row' => 20, 'start' => 0, 
        'default_op' => 'AND', 'search_field' => 'text', 
        'show_expired' => false, 'sort' => 'last_modified+desc', 
        'grouped' => false
    ];


    public function create_new_document($in_data, $client_id = '')
    {
        self::$clientId = $client_id;
        self::__construct();

        $ch = curl_init(self::$url . self::$core . "/update?wt=json");

        $data = array(
            "add" => array(
                "doc" => $in_data,
                "commitWithin" => 1000,
            ),
        );
        $data_string = json_encode($data);

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-type: application/json'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

        $response = curl_exec($ch);

        dump($response);
        

    }

    public function search_resume($data, $additional = '', $client_id = '')
    {
        if ($client_id !== '') {
            self::$clientId = $client_id;
            self::__construct();
        }

        extract($data);

        if (empty($q)){

            return array();
        }

        $dop = '';
        if ($default_op == 'AND') {
            $dop = "";
        }
        $q = $dop . $q;

        $q = str_ireplace(" ", "+", $q);

        if (!empty($search_field)) {
            $search_field .= ':';
        }

        // self::$host = self::$url . getEnvData("SOLR_CORE",null, $client_id);
        $filename = self::$host . "q=" . $search_field . $q . "&rows=" . $row . "&start=" . $start

            . "&facet=true&facet.limit=-1&facet.field=gender&facet.field=marital_status&facet.field=last_position"
            . "&facet.field=years_of_experience&facet.field=state&facet.field=state_of_origin&facet.field=last_company_worked"
            . "&facet.field=folder_name&facet.field=folder_type&facet.field=application_status&facet.field=test_name"
            . "&facet.field=test_status&facet.field=test_score&facet.field=highest_qualification&facet.field=willing_to_relocate"
            . "&facet.field=cv_source&facet.field=video_application_score&facet.field=custom_field_name&facet.field=custom_field_value"
            . "&facet.field=grade&facet.field=is_approved&facet.field=applicant_type&facet.field=edu_school"
            . "&facet.field=marital_status&facet.field=state_of_origin&facet.field=course_of_study"
            . "&facet.field=completed_nysc&facet.field=minimum_remuneration&facet.field=maximum_remuneration"
            . "&facet.field=specializations"
            // ."&facet=true&facet.field=job_type&facet.field=company&facet.field=loc&facet.field=job_level&facet.field=site_name&facet.date=expiry_date&facet.date.start=NOW/DAY&facet.date.end=NOW/DAY%2B60DAY&facet.date.gap=%2B7DAY&wt=json"
            . "&sort=" . $sort
            . $additional
            // ."&fq=cv_file:*".
            . "&group=true&group.field=email&group.truncate=true&group.main=true&wt=json" //&group.main=true
        ;


        \Log::info($filename);

        if (@$filter_query) {

            foreach ($filter_query as $key => $value) {

                $filename .= '&fq=' . str_ireplace(" ", "+", $value);
            }
        }


        try {

            $ch = curl_init();

            curl_setopt($ch, CURLOPT_URL, $filename);
            curl_setopt($ch, CURLOPT_HEADER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

            $re = curl_exec($ch);
            curl_close($ch);

            return json_decode($re, true);
        } catch (\Exception $e) {
            print_r($e);
        }


        return array();
    }

    public function get_saved_cvs($data)
    {
        $additional = "&fq=company_folder_id:" . @get_current_company()->id . "&fq=folder_type:saved";

        return $this->search_resume($data, $additional, @request()->clientId);
    }

    public function get_purchased_cvs($data)
    {
        $additional = "&fq=company_folder_id:" . @get_current_company()->id . "&fq=folder_type:purchased";

        return $this->search_resume($data, $additional, @request()->clientId);

    }

    public function get_interview_notes($data)
    {
        $additional = "&fq=company_folder_id:" . @get_current_company()->id . "&fq=interview_recommendation:*";
        return $this->search_resume($data, $additional, @request()->clientId);
    }

    public function get_all_my_cvs($data, $age = null, $exp_years = null, $client_id = null)
    {

        $job_ids = Job::getMyJobIds();


        if (!empty($job_ids)) {
            $job = "job_id:(" .  implode('+', $job_ids)  . ")+OR+";
        } else {

            $job = "";
        }

        $additional = "&fq=" . $job . "(company_folder_id:" . @get_current_company()->id . "+AND+-folder_type:saved" . ")";

        if (!is_null($age)) {
            $additional .= "&fq=dob:[" . $age[1] . "+TO+" . $age[0] . "]";
        }

        if (!is_null($exp_years)) {
            $additional .= "&fq=years_of_experience:[" . $exp_years[0] . "+TO+" . $exp_years[1] . "]";
        }

        return $this->search_resume($data, $additional, @request()->clientId ?? $client_id);
    }


    public function get_applicants(
        $data, $job_id, $status = "", $client_id = "", 
        $age = null, $exp_years = null, $video_application_score = null, 
        $test_score = null, $graduation_grade = null, 
        $minimium_remuneration = null, $maximium_remuneration = null
    ) {
        if ($client_id !== '') {
            self::$clientId = $client_id;
            self::__construct();
        }

        $additional = "&fq=job_id:" . $job_id;

        if ($status != "") {
            $additional .= "&fq=application_status:" . $status;
        }

        if (!is_null($age)) {
            // $additional .= "&fq=dob<=".$age[0]."&fq=dob>=".$age[1];
            $additional .= "&fq=dob:[" . $age[1] . "+TO+" . $age[0] . "]";
        }

        if (!is_null($exp_years)) {
            $additional .= "&fq=years_of_experience:[" . $exp_years[0] . "+TO+" . $exp_years[1] . "]";
        }

        if (!is_null($graduation_grade)) {
            $additional .= "&fq=graduation_grade:[" . $graduation_grade[0] . "+TO+" . $graduation_grade[1] . "]";
        }

        if (!is_null($minimium_remuneration)) {
            $additional .= "&fq=minimum_remuneration:[" . $minimium_remuneration[0] . "+TO+" . $minimium_remuneration[1] . "]";
        }

        if (!is_null($maximium_remuneration)) {
            $additional .= "&fq=maximum_remuneration:[" . $maximium_remuneration[0] . "+TO+" . $maximium_remuneration[1] . "]";
        }

        if (!is_null($video_application_score)) {
            $additional .= "&fq=video_application_score:[" . $video_application_score[0] . "+TO+" . $video_application_score[1] . "]";
        }

        if (!is_null($test_score)) {
            $additional .= "&fq=test_score:[" . $test_score[0] . "+TO+" . $test_score[1] . "]";
        }


        return $this->search_resume($data, $additional, $client_id);
    }


    public function quick_search_job($data)
    {
        extract($data);
        if (empty($q)){

            return array();
        }

        $dop = '';
        if ($default_op == 'AND') {
            $dop = "";
        }
        $q = $dop . $q;


        if (!empty($search_field)) {
            $search_field .= ':';
        }

        $filename = self::$host . "q=" . $search_field . $q . "&rows=" . $row . "&start=" . $start

            . "&facet=false&wt=json&sort=" . $sort;

        if (!$show_expired) {
            $filename .= "&fq=expiry_date:[NOW+TO+*]";
        }

        if ($grouped) {
            $filename .= "&group=true&group.main=true&group.field=site_id&group.limit=2";
        }

        $filename = str_ireplace("&#40;", "(", $filename);
        $filename = str_ireplace("&#41;", ")", $filename);

        try {
            $handle = fopen($filename, "r");

            if ($handle) {
                $response = json_decode(stream_get_contents($handle), true);
                fclose($handle);

                return $response;
            }
        } catch (\Exception $e) {
        }


        return array();
    }

    public function get_faceted_values($solr_arr)
    {

        $ret = array();

        for ($i = 0; $i < count($solr_arr); $i = $i + 2) {

            $val = $solr_arr[$i];
            $count = $solr_arr[$i + 1];
            if (empty($val))
                $val = "Not Specified";

            if (
                strtolower($val) == 'choose' ||
                strtolower(preg_replace('|[^a-z]|i', '', $val)) == 'choose' ||
                strtolower($val) == 'select'
            ) {
                $val = "Not Specified";
            }

            if ($count > 0) {
                $ret[$val] = $ret[$val] ? $count : $ret[$val] + $count;
            }
        }

        ksort($ret);

        return $ret;
    }


    public function get_faceted_dates($solr_arr)
    {

        $ret = array();

        $index = 0;

        if (empty($solr_arr)) {
            return $ret;
        }

        foreach ($solr_arr as $key => $value) {
            $index++;

            if ($value > 0 && ($key != 'gap') && ($key != 'start') 
                && ($key != 'end')
            ) {
                $ret[$index . ' week(s) '] = $value;
            }
        }

        return $ret;
    }


    public function search_cv($q, $row = 10, $start = 0, $default_op = 'AND')
    {

        if (empty($q)) {
            return array();
        }

        $dop = '';
        if ($default_op == 'AND') {
            $dop = "";
        }
        $q = $dop . $q;

        $sort = 'score+desc';

        $filename = self::$url . self::$core . '/select?q={!q.op=AND}' . $q . '&rows=' . $row . '&start=' . $start . '&facet=true&facet.field=exp_company&facet.field=state&facet.field=gender&facet.field=experience&facet.field=edu_end_year&facet.field=edu_school&facet.field=edu_grade&facet.field=marital_status&facet.field=religion&facet.date=dob&facet.date.start=NOW/DAY-60YEAR&facet.date.end=NOW/DAY-10YEAR&facet.date.gap=%2B1YEAR&wt=json&sort=rank+desc';

        // echo $filename.'<br/>';

        try {
            $handle = fopen($filename, "r");
            if ($handle) {
                $response = json_decode(stream_get_contents($handle), true);
                fclose($handle);
                return $response;
            }
        } catch (\Exception $e) {
            print_r($e);
        }

        return array();
    }

    public function search_applications($q, $row = 10, $start = 0, $default_op = 'AND')
    {

        if (empty($q)) {
            return array();
        }

        $dop = '';
        if ($default_op == 'AND') {
            $dop = "";
        }
        $q = $dop . $q;

        $sort = 'score+desc';


        $link = self::$url . 'applications/select?q=' . $q . '&rows=' . $row . '&start=' . $start

            . '&facet=true&facet.field=exp_company&facet.field=state&facet.field=gender&facet.field=experience'
            . '&facet.field=edu_end_year&facet.field=edu_school&facet.field=edu_grade&facet.field=marital_status&facet.field=religion&facet.field=test_name&facet.field=tr_status&facet.field=score&facet.date=dob&facet.date.start=NOW/DAY-60YEAR&facet.date.end=NOW'
            . '/DAY-10YEAR&facet.date.gap=%2B1YEAR&wt=json&sort=created+desc';

        // echo $link.'<br/>';

        try {
            $handle = fopen($link, "r");
            if ($handle) {
                $response = json_decode(stream_get_contents($handle), true);
                fclose($handle);

                return $response;
            }
        } catch (\Exception $e) {
            print_r($e);
        }


        return array();
    }

    public function update_applications($command = "full-import")
    {

        $url = self::$url . "applications/dataimport?command=" . $command;

        try {
            $handle = fopen($url, "r");
            if ($handle) {
                $response = json_decode(stream_get_contents($handle), true);
                fclose($handle);

                return $response;
            }
        } catch (exception $e) {
            print_r($e);
        }
    }

    public function update_core($core = null, $command = "delta-import")
    {

        $applicants = JobApplication::find(request()->app_ids);

        if ($applicants) {
            foreach ($applicants as $applicant) {
                UploadApplicant::dispatch($applicant)->onQueue('solr');
            }
        }
    }


    public function full_update_core($core = null)
    {
        $applicants = JobApplication::has('cv')->with('job', 'cv')
            ->orderBy('id', 'asc')
            ->chunk(
                100, function ($applicants) {
                    foreach ($applicants as $applicant) {
                        UploadApplicant::dispatch($applicant)->onQueue('solr');
                    }
                }
            );
    }


    public function quick_search_cv($q, $row = 10, $start = 0, $default_op = 'AND')
    {

        if (empty($q)) {
            return array();
        }

        $sort = 'score+desc';

        $filename = self::$url . self::$core . '/select?q=' . $q . '&rows=' . $row . '&start=' . $start . '&wt=json&sort=rank+desc';

        try {
            $handle = fopen($filename, "r");
            if ($handle) {
                $response = json_decode(stream_get_contents($handle), true);
                fclose($handle);
                return $response;
            }
        } catch (\Exception $e) {
            print_r($e);
        }


        return array();
    }


    public function get_faceted_dob($solr_arr)
    {

        $ret = array();

        $index = 0;

        if (!empty($solr_arr)) {
            foreach ($solr_arr as $key => $value) {
                $index++;

                if ($value > 0 && ($key != 'gap') && ($key != 'start') && ($key != 'end')) {

                    $k = (intval(date('Y'))  - intval(date('Y', strtotime(substr($key, 0, 10))))) . ' years old';

                    $ret[$k] = $value;
                }
            }
        }

        return $ret;
    }

    public function extend_network(
        $q, $type = "exp_company", $followers, 
        $is_followers = true, $row = 12, $start = 0, 
        $default_op = 'AND', $start_year = '', $end_year = ''
    ) {

        if (empty($q)) {
            return array();
        }

        $dop = '';
        if ($default_op == 'AND') {
            $dop = "";
        }
        $q = $dop . $q;

        $sign = ($is_followers == true) ? "" : "-";

        $dq = '';

        //start year...
        if (!empty($start_year)) {
            if ($type = 'edu_school') {
                $dq .= '&fq=edu_start_year:[' . ($start_year - 2) . '+TO+' . ($start_year + 2) . ']';
            } else {
                $dq .= '&fq=exp_start_year:[' . ($start_year - 2) . '+TO+' . ($start_year + 2) . ']';
            }
        }
        //end year...
        if (!empty($end_year)) {
            if ($type = 'edu_school') {
                $dq .= '&fq=edu_end_year:[' . ($end_year - 2) . '+TO+' . ($end_year + 2) . ']';
            } else {
                $dq .= '&fq=exp_end_year:[' . ($end_year - 2) . '+TO+' . ($end_year + 2) . ']';
            }
        }

        if (substr($q, 0, 1) == "*") {
            $sort = 'post_date+desc';
        } else {
            $sort = 'score+desc';
        }
        $filename = self::$url . self::$core . "/select?q=" . $type . ":" . trim($q) . $dq . "&fq=-personal_url:[*+TO+*]&rows=" . $row . "&start=" . $start

            . "&fq=" . $sign . "userId:(" . $followers . ")&facet=false&wt=json";

        try {
            $handle = fopen($filename, "r");
            if ($handle) {
                $response = json_decode(stream_get_contents($handle), true);
                fclose($handle);

                return $response;
            }
        } catch (\Exception $e) {
            print_r($e);
        }


        return array();
    }
}
