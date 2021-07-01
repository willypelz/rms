<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class SyncCompanyRequest extends FormRequest
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
			'companies' => 'required|array|min:1',
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
			"companies.required"=> "You need to select atleast one company"
		];
	}

}
