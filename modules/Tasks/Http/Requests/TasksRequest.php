<?php namespace Modules\Tasks\Http\Requests;

use App\Http\Requests\Request;

class TasksRequest extends Request {

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
            'name'               => 'required',
            'description'         => 'required',
            'start_date' => "required",
			'due_date' => "required",
			'status' => "required"

        ];
	}

}
