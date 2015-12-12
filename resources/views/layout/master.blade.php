<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title></title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.2 -->
    <link href="{{ asset("/bower_components/admin-lte/bootstrap/css/bootstrap.min.css") }}" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="http://code.ionicframework.com/ionicons/2.0.0/css/ionicons.min.css" rel="stylesheet" type="text/css" />
   @yield('css')
    <!-- Theme style -->
    <link href="{{ asset("bower_components/admin-lte/dist/css/AdminLTE.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- all skings AdminLTE -->
    <link href="{{ asset("bower_components/admin-lte/dist/css/skins/_all-skins.min.css")}}" rel="stylesheet" type="text/css" />
    <!-- sweet alert -->
    <link href="{{ asset("bower_components/admin-lte/plugins/sweetalert/dist/sweetalert.css")}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="sidebar-mini skin-green">
<div class="wrapper">
    <!-- Main Header -->
    @include('partials.header')
    <!-- Left side column. contains the logo and sidebar -->
    @include('partials.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            @yield('content-header')
        </section>
        <!-- Main content -->
        <section class="content">
            <!-- Your Page Content Here -->
            @yield('content')
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    <!-- Main Footer -->
    @include('partials.footer')
            <!-- Control Sidebar -->
    @include('partials.control-sidebar')
</div><!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.3 -->
<script src="{{ asset ("bower_components/admin-lte/plugins/jQuery/jQuery-2.1.4.min.js") }}"></script>

<!-- Bootstrap 3.3.2 JS -->
<script src="{{ asset ("bower_components/admin-lte/bootstrap/js/bootstrap.min.js") }}" type="text/javascript"></script>
<!-- admin-lte App -->
<script src="{{ asset ("bower_components/admin-lte/dist/js/app.min.js") }}" type="text/javascript"></script>
<!-- sweetalert -->
<script src="{{ asset ("bower_components/admin-lte/plugins/sweetalert/dist/sweetalert.min.js") }}" type="text/javascript"></script>
@include('sweet::alert')
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- {!!Html::script('bower_components/admin-lte/dist/js/pages/dashboard.js')!!} -->
<!-- AdminLTE for demo purposes -->
<!--{!!Html::script('bower_components/admin-lte/dist/js/demo.js')!!} -->
@yield('scripts')


<!-- Optionally, you can add Slimscroll and FastClick plugins.
      Both of these plugins are recommended to enhance the
      user experience -->
</body>
</html>