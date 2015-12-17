<?php

namespace Modules\Contabilidad\Entities;

use Illuminate\Database\Eloquent\Model;

class SalesLog extends Model {

	protected $table = "sales_log";
	
    protected $fillable = [
    	'file_name',
    	'process'
    ];
    
}