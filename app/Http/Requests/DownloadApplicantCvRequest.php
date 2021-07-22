<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DownloadApplicantCvRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        check_if_job_owner($this->jobId);
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "filter_query" => "nullable",
            "age" => "nullable",
            "exp_years" => "nullable",
            "test_score" => "nullable",
            "video_application_score" => "nullable",
            "jobId" => "nullable",
            "status" => "nullable",
        ];
    }
}
