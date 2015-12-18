<?php namespace Modules\Contabilidad\Entities;
   
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model {

    protected $table = "payment_method";
	
    protected $fillable = [
    	'payment_method'
    ];

}