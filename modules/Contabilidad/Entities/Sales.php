<?php

namespace Modules\Contabilidad\Entities;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model {

    protected $table = "contabilidad_sales";
	
    protected $fillable = [
		'transaction_id',
    	'reference',
	    'ra_start_date',
	    'ra_end_date',
	    'factura_uuid',
    	'ammount',
    	'credit_debit',
    	'payment_method',
   		'ra_total',
	    'customer_number',
    	'op_location',
		'cl_location',
    	'gl_account',
    	'concept',
	    'description',
    	'date',
    	'factura_number',
    	'ammount_applied',
    ];

    public function depositosAplicados()
    {
    	return $this->hasMany('Modules\Contabilidad\Entities\DepositoAplicacion');
    }
}