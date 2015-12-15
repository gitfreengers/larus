<?php namespace App\Http\Controllers;

use App\Alert;
use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Task;

use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Http\Request;

class AlertsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
        setlocale(LC_TIME, 'es_ES');

        $user = Sentinel::getUser();

        $task = Task::find($id);

        $alerts = Alert::where('task_id', '=', $id)->first();


        if(empty($alerts->alert_display)){
            $array_read[] = $user->id;

            $alerts->alert_display = serialize($array_read);
            $alerts->save();
        }else{
            $array_read = unserialize($alerts->alert_display);

            if(!in_array($user->id, $array_read)){
                array_push($array_read, $user->id);
                $alerts->alert_display = serialize($array_read);
                $alerts->save();
            }

        }




        return view('notifications.alerts.show', compact('task'));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
