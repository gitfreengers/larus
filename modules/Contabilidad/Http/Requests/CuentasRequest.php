<?php namespace Modules\Contabilidad\Http\Requests;

use App\Http\Requests\Request;

class CuentasRequest extends Request
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
			'NUMERO' => 'required',
			'BANCO' => 'required',
			'SUCURSAL' => 'required',
			'EJECUTIVO' => 'required',
			'TIPO' => 'required',
			'DESCRIPCION' => 'required',
			'CC_CUENTA' => 'required',
        	'TIPOCHEQUE' => 'required'
		];
    }
    
    public function messages(){
    	return [
    			'NUMERO.required' => 'El numero es requerido',
    			'BANCO.required' => 'El banco es requerido',
    			'SUCURSAL.required' => 'La sucursal es requerida',
    			'EJECUTIVO.required' => 'El ejecutivo es requerido',
    			'TIPO.required' => 'El tipo es requerido',
    			'DESCRIPCION.required' => 'La descripcion es requerida',
    			'CC_CUENTA.required' => 'La cuenta es requerida',
    			'TIPOCHEQUE.required' => 'El tipo de cheque es requerida'
    	];
    }
    

}
