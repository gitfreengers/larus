<?php namespace Modules\Tasks\Http\ViewComposers;
/**
 * Created by PhpStorm.
 * User: ekontiki89
 * Date: 05/11/15
 * Time: 5:11 PM
 */

use Illuminate\View\View;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Modules\User\Entities\User;

class TaskComposer{

    protected $model;
    protected $user_auth;
    protected $today;

    public function __construct(User $model){
        $this->user = $model;
        $this->user_auth = Sentinel::getUser();


    }


    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view){



        $user = $this->user->find($this->user_auth->id);


        $alerts = $user->tasks()->outtime()->nodone()->get();
        $alertsCount = $alerts->count();

        $tasks = $user->tasks()->nodone()->get();

        $tasksCount =  $tasks->count();
        $view->with([
            'tasksCount' => $tasksCount,
            'tasks' => $tasks,
            'alerts'=> $alerts,
            'alertsCount' => $alertsCount,
        ]);
    }

}