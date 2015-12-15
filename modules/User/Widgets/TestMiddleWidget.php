<?php
/**
 * Created by PhpStorm.
 * User: ekontiki89
 * Date: 02/11/15
 * Time: 10:44 AM
 */

namespace Modules\User\Widgets;


class TestMiddleWidget
{
    /**
     * @return string
     */
    public function register()
    {
        $text = "Widget Middle";
        $bgcolor = "bg-aqua";
        $faicon = "fa-thumbs-o-up";
        $progress = "80";
        $description = "Incremento en 30 días";
        $number = "4,510";
        return view('dashboard::widgets.widget-middle',compact('text','bgcolor','faicon','progress','description','number'))->render();
    }

}