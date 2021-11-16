<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestACallRequest extends FormRequest
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
            'company_name'=>'required',
            'package'=>'required',
            'firstname'=>'required',
            'surname'=>'required',
            'phone'=>'required|min:11',
            'email'=>'required|email',
        ];
    }
}
