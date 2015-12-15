<?php

namespace Modules\Ejemplo\Entities;

use Illuminate\Database\Eloquent\Model;

class Example extends Model
{
    protected $table = 'example';

    protected $fillable = ['user_id', 'completed', 'todo'];
}
