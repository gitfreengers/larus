<?php

namespace Modules\User\Widgets;


use Modules\User\Entities\User;

/**
 * Class TotalUsersWidget
 * Display Total Users Statistics
 * @package Modules\Users\Widgets
 */
class TotalUsersWidget {

    /**
     * @return string
     */
    public function register()
    {
        $number = User::count();
        $text = "Widget basic";
        $bgcolor = "bg-green";
        $faicon = "fa-users";
        return view('dashboard::widgets.widget-basic', compact('number','text','bgcolor','faicon'))->render();
    }

}