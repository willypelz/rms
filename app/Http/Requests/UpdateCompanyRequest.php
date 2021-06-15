<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class UpdateCompanyRequest extends FormRequest
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
			'slug' => 'unique:companies,slug,' . $this->company_id,
			'email' => 'required|unique:companies,email,' . $this->company_id,
			'name' => 'required',
			'phone' => 'required',
			'about' => 'required',
			'website' => 'regex:/^https:\/\/\w+(\.\w+)*(:[0-9]+)?\/?$/',
		];
	}


	/**
	 * Get the error messages for the defined validation rules.
	 *
	 * @return array
	 */
	public function messages()
	{
		return [];
	}

}
