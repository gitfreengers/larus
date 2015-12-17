<?php
/**
 * Created by PhpStorm.
 * User: ekontiki89
 * Date: 09/10/15
 * Time: 1:38 PM
 */

namespace App\Presenters;

use Pingpong\Menus\Presenters\Presenter;

class SidebarMenuPresenter extends Presenter
{
    /**
     * {@inheritdoc }
     */
    public function getOpenTagWrapper()
    {
        return '<ul class="sidebar-menu">';
    }

    /**
     * {@inheritdoc }
     */
    public function getCloseTagWrapper()
    {
        return '</ul>';
    }

    /**
     * {@inheritdoc }
     */
    public function getMenuWithoutDropdownWrapper($item)
    {
        return '<li'.$this->getActiveState($item).'>
        <a href="'. $item->getUrl() .'">'
        .$item->getIcon().' <span>'.$item->title.'</span></a></li>';
    }

    /**
     * {@inheritdoc }
     */
    public function getActiveState($item)
    {
        return \Request::is($item->getRequest()) ? ' class="active"' : null;
    }

    /**
     * {@inheritdoc }
     */
    public function getDividerWrapper()
    {
        return '<li class="divider"></li>';
    }

    /**
     * {@inheritdoc }
     */
    public function getMenuWithDropDownWrapper($item)
    {
        return '<li class="treeview">
                <a href="#">
                 ' . $item->getIcon() . '
                <span>
                 '.$item->title.'
                </span>
                 <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                  '.$this->getChildMenuItems($item).'
                </ul>
              </li>' . PHP_EOL;
        ;
    }
    
    public function getMultiLevelDropdownWrapper($item)
    {
    	return $this->getMenuWithDropDownWrapper($item);
    }
}