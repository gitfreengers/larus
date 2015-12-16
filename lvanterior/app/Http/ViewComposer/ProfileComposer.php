<?php
/**
 * Created by PhpStorm.
 * User: ekontiki89
 * Date: 21/07/15
 * Time: 12:22 PM
 */

namespace App\Http\ViewComposer;


use App\Alert;
use App\Notification;
use App\Package;
use App\Task;
use Carbon\Carbon;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProfileComposer {

    // view composer create Menu
    public function compose(View $view){

        $array_task = [];
        $array_alert = [];
        $array_notification = [];
        $tasks_count = 0;
        $alerts_count = 0;
        $notifications_count = 0;
        //menus
        $packages = Package::with('modules')->get();
        //datas of the user logged
        $userAuth = Sentinel::getUser();
        $today = Carbon::now();



        //  tareas
        $tasks = Task::where('user_id', '=', $userAuth->id)
                        ->orwhere('role_id','=', $userAuth->roles[0]->id)
                        ->orderBy('created_at','DESC')->get();
        foreach($tasks as $task){
            if(is_null($task->read)){
                array_push($array_task,$task);
                $tasks_count++;
            }elseif(!in_array($userAuth->id, unserialize($task->read))){
                array_push($array_task,$task);
                $tasks_count++;
            }

        }

        //  alertas
        $alerts = Task::where('expire_time', '<',  $today)
                            ->Where(function($query) use ($userAuth){
                                $query->where('user_id', '=', $userAuth->id)
                                    ->orwhere('role_id', '=', $userAuth->roles[0]->id);
                            })->with('hasAlert')->get();

        foreach( $alerts as $alert){
            if(is_null($alert->hasAlert[0]->alert_display)){
                array_push($array_alert, $alert);
                $alerts_count++;
            }elseif(!in_array($userAuth->id, unserialize($alert->hasAlert[0]->alert_display))){
                array_push($array_alert, $alert);
                $alerts_count++;
            }
        }

        //  notifications
        $notifications= Notification::where('user_id', '=', $userAuth->id)
                            ->orwhere('role_id','=', $userAuth->roles[0]->id)->get();


        foreach($notifications as $notification){
            if(is_null($notification->read)){
                array_push($array_notification,$notification);
                $notifications_count++;
            }elseif(!in_array($userAuth->id, unserialize($notification->read))){
                array_push($array_notification,$notification);
                $notifications_count++;
            }

        }



        $view->with(array(
                'packages' => $packages,
                'userAuth' => $userAuth,
                'alerts'   =>$array_alert,
                'alerts_count' => $alerts_count,
                 'notifications' => $array_notification,
                'notifications_count' => $notifications_count,
                'tasks' => $array_task,
                'tasks_count' => $tasks_count
        ));


    }




}