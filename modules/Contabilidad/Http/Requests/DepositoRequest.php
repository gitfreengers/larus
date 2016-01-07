<?php namespace Modules\Contabilidad\Http\Requests;

use App\Http\Requests\Request;

class DepositoRequest extends Request {

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
            'banco' 			=> 'required',
            'fecha'				=> 'required',
            'monto'				=> 'required',
            'moneda'			=> 'required',
            'cuenta_contable'	=> 'required',
        	'folio'				=> 'required',
            'complementaria'	=> 'required_if:moneda,2',
        ];
	}
	
	public function messages(){
		return [
				'banco.required' => 'El banco es requerido',
				'fecha.required' => 'La fecha es requerida',
            	'monto.required' => 'La cantidad es requerida',
            	'moneda.required' => 'La moneda es requerida',
				'folio.required' => 'El folio es requerido',
            	'cuenta_contable.required' => 'La cuenta es requerida',
            	'complementaria.required_if'=> 'El complementaria es requerida',
		];
	}

}