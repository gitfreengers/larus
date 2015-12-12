<?php namespace Ekko\PackageTest;

use Illuminate\Database\Eloquent\Model;



class Test extends Model {

	//
    protected $table = 'tests';
    protected $fillable = ['name'];

    public $widget_type = 1;



    public function total(){
        $test = Test::all()->count();
        return $test;
    }



}
