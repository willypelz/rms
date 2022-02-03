<?php

namespace App\SearchEngine;

interface SearchEngine
{

    public function search_resume($data, $additional = '');

    public function get_saved_cvs($data);

    public function get_interview_notes($data);

    public function get_all_my_cvs($data, $age = null, $exp_years = null);

    public function get_applicants(
        $data, $job_id, $status , $clientId, 
        $age = null, $exp_years = null, 
        $video_application_score = null, 
        $test_score = null, $graduation_grade = null, 
        $minimium_remuneration = null, $maximium_remuneration = null
    );


    public function create_new_document($in_data);

    public function update_core($core = null, $command = "delta-import");
}
