<?php namespace Modules\Notifications\Http\ViewComposers;
/**
 * Created by PhpStorm.
 * User: ekontiki89
 * Date: 05/11/15
 * Time: 5:11 PM
 */
use Illuminate\View\View;
use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Modules\User\Entities\User;

class NotificationComposer{

    protected $model;
    protected $user_auth;

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
        $notifications = $user->notifications()->noread()->get();

        $notificationsCount = $notifications->count();
        $view->with([
            'notifications' => $notifications,
            'notificationsCount' => $notificationsCount
        ]);
    }

}