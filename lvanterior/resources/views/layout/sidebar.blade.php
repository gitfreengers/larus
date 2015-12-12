<?php
/**
 * Created by PhpStorm.
 * User: ekontiki89
 * Date: 08/07/15
 * Time: 10:49 AM
 */
?>
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar" style="height: auto;">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{url('img/user_img/'. $userAuth->image)}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $userAuth->first_name." ".$userAuth->last_name }}</p>
            </div>
        </div>

        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MENU</li>
            @foreach($packages as $package)
                <li class="treeview">
                    <a href="{{ ($package->id == 1)? url('/') : '#'  }}">
                        <i class="fa {{ $package->icon }}"></i> <span>{{ $package->package_name }}</span> <i class="fa fa-angle-left pull-right"></i>
                        @if(isset($package->modules))
                            <ul class="treeview-menu">
                            @foreach($package->modules as $modules)
                                <li>
                                    <a href="{{ url($modules->route) }}">
                                        <i class="fa fa-circle-o"></i> {{ $modules->module_name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        @endif
                    </a>
                </li>
            @endforeach
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>
