<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>LARUS 2.0</title>
        <link rel="icon" href="{{url('img/national.ico')}}">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <!-- Bootstrap 3.3.4 -->
        {!! Html::style('bootstrap/css/bootstrap.min.css') !!}
        <!-- FontAwesome 4.3.0 -->
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons 2.0.0 -->
        <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- Theme style -->
        {!! Html::style('css/AdminLTE.min.css') !!}
        <!-- AdminLTE Skins. Choose a skin from the css/skins
           folder instead of downloading all of them to reduce the load. -->
        {!! Html::style('css/skins/_all-skins.min.css') !!}
        @yield('css')
        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="skin-green sidebar-mini">
        <div class="wrapper">
            <!-- header -->
            @include('layout.header')
            <!-- Left side column. contains the logo and sidebar -->
            @include('layout.sidebar')
            <!-- Content Wrapper. Contains page content -->
            @yield('content')
            <!-- footer -->
            @include('layout.footer')
            <!-- Control Sidebar -->
            @include('layout.control-sidebar')
            <!-- Add the sidebar's background. This div must be placed
                 immediately after the control sidebar -->
            <div class='control-sidebar-bg'></div>
            @include('layout.modals.access')
        </div><!-- end wrapper -->

        <!-- jQuery 2.1.4 -->
        {!!Html::script('plugins/jQuery/jQuery-2.1.4.min.js')!!}

        <!-- jQuery UI 1.11.2 -->
        <script src="http://code.jquery.com/ui/1.11.2/jquery-ui.min.js" type="text/javascript"></script>
        <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
        <script>
            $.widget.bridge('uibutton', $.ui.button);
        </script>
        <!-- Bootstrap 3.3.2 JS -->
        {!!Html::script('bootstrap/js/bootstrap.min.js')!!}

        @yield('scripts')

        <!-- AdminLTE App -->
        {!!Html::script('js/app.min.js')!!}
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <!-- {!!Html::script('js/pages/dashboard.js')!!} -->
        <!-- AdminLTE for demo purposes -->
        <!--{!!Html::script('js/demo.js')!!} -->
        <script type="text/javascript">
            function eliminar(){
                var url= "{!!URL::to('/')!!}" ;
                var token = "{!!  csrf_token()   !!}";
                $.ajax({
                    type: "POST",
                    url: "/"+route+"/"+id,
                    data: { _method: 'DELETE', _token :token},
                    success: function(affectedRows) {
                        if(affectedRows == 1)
                        {
                            window.location = url+"/"+route;
                        }
                        if(affectedRows == 0){
                            alert("¡Error!, " +
                            "No se pudo eliminar el rol, esta asigando a un usuario.");
                        }

                    }
                });
            }
            $(".helpModal").click(function () {
                id = $(this).data("id");
                route = $(this).data("path")

            })
            $(document).ready(function () {
                @if($errors->any())
                $('#md-acceso').modal('show');
                @endif
            });
        </script>

    </body>