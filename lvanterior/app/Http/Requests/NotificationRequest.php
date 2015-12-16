<?php namespace App\Http\Requests;

use App\Http\Requests\Request;

class NotificationRequest extends Request {

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
			//
            'optionsRadios'       => 'required',
            'title'               => 'required',
            'description'         => 'required',
            'url' => "required|url",

		];
	}

}
