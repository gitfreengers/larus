@extends('user::auth.layout')
@section('content')
    <div class="login-box">
        <div class="login-logo">
            <a href="#"><b>LARUS</b> 2.0</a>
        </div><!-- /.login-logo -->
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Ooops!</strong> Problemas al iniciar sesión.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="login-box-body">
            <p class="login-box-msg">Inicia sesión para acceder al portal Larus</p>
            <form action="{{ url('/login') }}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="example@dominio.com" name="email" value="{{old('email')}}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>

                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="contraseña" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-success btn-block btn-flat"><b>Iniciar sesión</b></button>
                    </div><!-- /.col -->
                </div>
            </form>
        </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    @endsection

