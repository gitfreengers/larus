<?php

namespace Modules\Dashboard\Repositories;

use Illuminate\Support\Collection;
use Widget;

/**
 * Class WidgetsRegister
 * Register the widgets to be call in the dashboard Module
 * @package Modules\Dashboard\Repositories
 */
class Widgets {

    /**
     * Class Name of the Widgets
     * @var array
     */
    public $widgets = [];

    /**
     * Add a Widget to the list
     * @param Array $widget
     */
    public function registerWidget(array $widgets)
    {
        foreach($widgets as $widget)
        {
            $this->widgets[] = $widget;
            Widget::register($widget['name'], $widget['class']);
        }
    }

    /**
     * Display a group of widgets
     * @param string $group
     * @return string
     */
    public function getWidgets($group = 'demo')
    {
        $collection = new Collection($this->widgets);
        $widgets = $collection->where('group', $group)->sortBy('order');
        $output = "";
        foreach($widgets as $widget)
        {
            $params = isset($widget['params']) ? $widget['params'] : [];
            $output .= Widget::call($widget['name'], $params);
        }
        return $output;
    }

}