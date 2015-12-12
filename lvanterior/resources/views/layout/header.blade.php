<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>L</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>L A R U S</b> 2.0</span>

    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Alerts: style can be found in dropdown.less-->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-flag-o"></i>
                        @if($alerts_count > 0)
                            <span class="label label-info">{{$alerts_count }}</span>
                         @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Tienes {{ $alerts_count }} alerta(s)</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach($alerts as $alert)
                                    <li><!-- start message -->
                                        <a href="{{route('alerts.show', $alert->id)}}">

                                            <!-- el periodo de tiempo de e ejecucion de la tarea ha expirado -->
                                            <h4>La tarea<b>{{ Illuminate\Support\Str::limit($alert->title,30) }}</b> <small class="label pull-right bg-red">expiró</small></h4>
                                        </a>
                                    </li><!-- end message -->
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        @if($notifications_count > 0)
                        <span class="label label-warning">{{$notifications_count}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Tienes {{$notifications_count}} notificación(es)</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach($notifications as $notification)
                                <li>
                                    <a href="{{route('notifications.show',$notification->id)}}">
                                        <h4>
                                            {{ Illuminate\Support\Str::limit($notification->title,30)}}
                                            <small><i class="fa fa-clock-o"></i>{{ $notification->created_at->diffForHumans() }}</small>
                                        </h4>
                                        <p>{{ Illuminate\Support\Str::limit($notification->description,30 )}}</p>

                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer"><a href="{{route('notifications.getindex')}}">Ver todas</a></li>
                    </ul>
                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-tasks"></i>
                        @if($tasks_count > 0)
                        <span class="label label-danger">{{$tasks_count}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Tienes {{$tasks_count}} tarea(s)</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">
                                @foreach($tasks as $task)
                                    <li><!-- Task item -->
                                        <a href="{{ route('tasks.show', $task->id) }}">
                                            <h4>
                                                {{  Illuminate\Support\Str::limit($task->title,30) }}
                                                <small><i class="fa fa-clock-o"></i>{{ $task->created_at->diffForHumans() }}</small>
                                            </h4>
                                            <!--<div class="progress xs">
                                                <div class="progress-bar progress-bar-aqua" style="width: 0%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                    <span class="sr-only"> 0% Completado</span>
                                                </div>
                                            </div>-->
                                        </a>
                                    </li><!-- end task item -->
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer">

                            <a href="{{route('tasks.getindex')}}">Ver todas las tareas</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{url('img/user_img/'. $userAuth->image)}}" class="user-image" alt="User Image"/>
                        <span class="hidden-xs">
                            {{ $userAuth->first_name." ".$userAuth->last_name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{url('img/user_img/'.$userAuth->image)}}" class="img-circle" alt="User Image" />
                            <p>
                                {{ $userAuth->first_name." ".$userAuth->last_name." - ".$userAuth->position }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-right">
                                <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Cerrar sessión</a>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>
</header>

