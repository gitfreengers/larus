@extends('auth.layout')
<?php $title = 'Registration Page'; $class = 'register-page'; ?>
@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{url('/login')}}"><b>LARUS</b> 2.0</a>
        </div>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Ooops!</strong> Problemas al registrarse.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>
            <form action="{{url('/register')}}" method="post">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <!-- first name -->
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="First name" name="first_name" value="{{old('first_name')}}"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <!-- last name -->
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" placeholder="Last name" name="last_name" value="{{old('last_name')}}"/>
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <!-- email -->
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{old('email')}}"/>
                    <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
                </div>
                <!-- password -->
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <!-- retype password -->
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" placeholder="Retype password" name="retype_password"/>
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>

                <div class="row">
                    <div class="col-xs-8">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox"> I agree to the <a href="#">terms</a>
                            </label>
                        </div>
                    </div><!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div><!-- /.col -->
                </div>
            </form>

            <div class="social-auth-links text-center">
                <p>- OR -</p>
                <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign up using Facebook</a>
                <a href="#" class="btn btn-block btn-social btn-google-plus btn-flat"><i class="fa fa-google-plus"></i> Sign up using Google+</a>
            </div>

            <a href="{{url('/login')}}" class="text-center">I already have a membership</a>
        </div><!-- /.form-box -->
    </div><!-- /.register-box -->
    @endsection
