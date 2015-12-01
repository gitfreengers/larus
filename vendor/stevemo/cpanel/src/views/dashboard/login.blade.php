<!DOCTYPE html>
<html class="bg-black">
<head>
    <meta charset="UTF-8">
    <title>{{ $cpanel['title'] }} | Log in</title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- bootstrap 3.1.0 -->
    {{ HTML::style('packages/stevemo/cpanel/adminlte/css/bootstrap.min.css') }}
    <!-- font Awesome -->
    {{ HTML::style('packages/stevemo/cpanel/adminlte/css/font-awesome.min.css') }}
    <!-- Theme style -->
    {{ HTML::style('packages/stevemo/cpanel/adminlte/css/adminlte.css') }}

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>
<body class="bg-black">

<div class="form-box" id="login-box">
    <img class="logo" alt="Logo larus" src="http://localhost/larus_laravel/public/packages/stevemo/cpanel/adminlte/img/logo-national-car-rental-mexico-tiny.png">
    <div class="header">Inicie sesión</div>
    <form action="{{ route('cpanel.login') }}" method="post">
        <div class="body bg-gray">
            @if (  Session::has('login_error') )
            <div class="alert alert-danger">
                {{ Session::get('login_error') }}
            </div>
            @endif
            @if (  Session::has('success') )
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
            @endif
            <div class="form-group">
                <!--<input type="text" name="login_attribute" class="form-control" placeholder="{{{ ucfirst($login_attribute) }}}"/>-->
                <input type="text" name="login_attribute" class="form-control" placeholder="Usuario"/>
            </div>
            <div class="form-group">
                <input type="password" name="password" class="form-control" placeholder="Contraseña"/>
            </div>
            <div class="form-group">
                <input type="checkbox" name="remember_me" value="true"/> Recordarme
            </div>
        </div>
        <div class="footer">
             <button type="submit" class="btn bg-olive btn-block">Entrar</button>
            <p><a href="{{route('cpanel.password.forgot')}}">Olvide mi contraseña</a></p>
            <!-- <a href="{{route('cpanel.register')}}" class="text-center">Registrar un nuevo usuario</a> -->
        </div>
    </form>
</div>

<!-- jQuery 1.10.2 -->
{{ HTML::script('packages/stevemo/cpanel/adminlte/js/jquery-1.10.2.js') }}
<!-- Bootstrap -->
{{ HTML::script('packages/stevemo/cpanel/adminlte/js/bootstrap.min.js') }}

</body>
</html>