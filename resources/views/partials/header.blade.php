<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>L</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>L A R U S</b> 2.0</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        @if($alertsCount > 0)
                            <span class="label label-primary">{{$alertsCount}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Tienes ({{$alertsCount}}) alerta(s)</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                @foreach($tasks as $task)
                                    <li><!-- start notification -->
                                        <a href="#">
                                            La tarea "<i>{{$task->name}}" </i><small class="label pull-right bg-red"> expiró</small></h4>
                                        </a>
                                    </li><!-- end notification -->
                                @endforeach
                            </ul>
                        </li>
                    </ul>
                </li>

                <!-- Notifications Menu -->
                <li class="dropdown notifications-menu">
                    <!-- Menu toggle button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa fa-envelope-o"></i>
                        @if($notificationsCount > 0)
                            <span class="label label-warning">{{$notificationsCount}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Tienes ({{$notificationsCount}}) notificación(es)</li>
                        <li>
                            <!-- Inner Menu: contains the notifications -->
                            <ul class="menu">
                                @foreach($notifications as $notification)
                                <li><!-- start notification -->
                                    <a href="#">
                                        <i class="fa {{$notification->icon}} text-aqua"></i> {{$notification->name}}
                                    </a>
                                </li><!-- end notification -->
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer"><a href="{{url('/my-notifications')}}">Ver todas</a></li>
                    </ul>
                </li>
                <!-- Tasks Menu -->
                <li class="dropdown tasks-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-tasks"></i>
                        @if($tasksCount > 0)
                            <span class="label label-danger">{{$tasksCount}}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu">

                        <li class="header">Tienes {{$tasksCount}} tarea(s)</li>
                        <li>
                            <!-- Inner menu: contains the tasks -->
                            <ul class="menu">
                                @foreach($tasks as $task)
                                <li><!-- Task item -->
                                    <a href="#">
                                        <!-- Task title and progress text -->
                                        <h3>
                                            {{$task->name}}

                                            <small class="pull-right">{{$task->progress}}%</small>

                                        </h3>
                                        <!-- The progress bar -->
                                        <div class="progress xs">
                                            <!-- Change the css width attribute to simulate progress -->
                                            <div class="progress-bar progress-bar-aqua" style="width: {{$task->progress}}%" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
                                                <span class="sr-only">0%</span>
                                            </div>
                                        </div>
                                    </a>
                                </li><!-- end task item -->
                                @endforeach
                            </ul>
                        </li>
                        <li class="footer">
                            <a href="{{url('/my-tasks')}}">Ver todas mis tareas</a>
                        </li>
                    </ul>
                </li>
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{url('img/users/'.$getUser->image)}}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{ $getUser->first_name." ".$getUser->last_name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{url('img/users/'.$getUser->image)}}" class="img-circle" alt="User Image" />
                            <p>
                                {{ $getUser->first_name." ".$getUser->last_name." - ".$getUser->position }}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{url('/my-tasks')}}" class="btn btn-default btn-xs btn-flat">Mis tareas</a>
                            </div>
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