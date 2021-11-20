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
            'company_name'=>'required|max:200|min:3',
            'package'=>'required',
            'firstname'=>'required|max:200|min:2',
            'surname'=> 'required|max:200|min:2',
            'phone'=> 'required|numeric',
            'email'=>'required|email',
        ];
    }
}
