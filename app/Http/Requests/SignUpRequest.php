<?php

namespace App\Http\Requests;

use App\Rules\AllowBusinessEmail;
use Illuminate\Validation\Rules\Password;
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
        // return url('') == config('constants.signupUrl') ? true : false;
        return true;
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $char = [' ','.','*','/','www','https',':'];
        $this->merge([ 
            "domain"  => strtolower('https://'.str_replace($char,'',trim($this->domain)).'.seamlesshiring.com'),
            "sub_domain_string" => strtolower(str_replace($char,'',trim($this->domain))),
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
            "password" => ["required","confirmed",Password::min(8)->mixedCase()->numbers()->symbols()],  
            "type"=>'nullable|in:STARTER,PROFESSIONAL,ENTERPRISE'
        ];
    }

}
