<?php namespace App\Http\ViewComposers;
/**
 * Created by PhpStorm.
 * User: ekontiki89
 * Date: 19/10/15
 * Time: 5:46 PM
 */



use Cartalyst\Sentinel\Native\Facades\Sentinel;
use Illuminate\View\View;

class ProfileComposer{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */

    
    public function compose(View $view)
    {
        $getUser = Sentinel::getUser();

        $view->with('getUser', $getUser);
    }
}