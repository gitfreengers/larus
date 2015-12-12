<?php
/**
 * Created by PhpStorm.
 * User: ekontiki89
 * Date: 02/11/15
 * Time: 11:34 AM
 */

namespace Modules\User\Widgets;


class TestAdvancedWidget
{
    public function register()
    {
        $number = "41,130";
        $text = "Widget Advanced";
        $bgcolor = "bg-yellow";
        $faicon = "fa fa-shopping-cart";
        $url = "#";
        return view('dashboard::widgets.widget-advanced', compact('number','text','bgcolor','faicon','url'))->render();
    }
}