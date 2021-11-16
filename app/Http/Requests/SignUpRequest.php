<?php

namespace App\Http\Requests;

use App\Rules\AllowBusinessEmail;
use Illuminate\Foundation\Http\FormRequest;

class SignUpRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        // return url('') == "https://signup.seamlesshiring.com" ? true : false;
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([ 
            "domain"  => strtolower(str_replace(' ','','https://'.trim($this->domain).'.seamlesshiring.com')),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name" => "required",
            'email' => ['required',new AllowBusinessEmail],
            "company_name" => "required",
            "phone" => "required|min:11",
            "domain" => "required",
            "password" => "required|confirmed|min:8",            
        ];
    }
}
