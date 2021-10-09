<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TestSetupRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            // 'test_id' => ['nullable'],
            // "test_type" => ['required_without:test_id'],
            "test_name" => ['required'],
            "test_name_id"=>['required'],
            "test_summary" =>['required'],
            "test_details" =>['nullable'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            // 'test_type.required_without' =>"The test type field is required when test category is not selected from the dropdown",
            'test_name_id.required' => "There seem to be no question setup on the question platform, please do so first"
             ];
    }
}
