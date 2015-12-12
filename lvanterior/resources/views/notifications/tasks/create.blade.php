@extends('layout.master')
@section('css')
    <!-- daterange picker -->
    {!! Html::style('plugins/daterangepicker/daterangepicker-bs3.css') !!}
    @endsection
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tareas
                <small>Nueva tarea</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li><a href="#">Notificaciones</a></li>
                <li><a href="#">Tareas</a></li>
                <li class="active">Nueva tarea</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-primary">
                        <div class="box-body">
                            {!! Form::open(['route' => 'tasks.store',
                                            'files'=>'true',
                                            'method'=>'POST',
                                            'id'=>'form_task',
                                            'class'=> 'form-horizontal',
                                            'parsley-validate novalidate' ]  ) !!}
                                <div class="form-group  @if ($errors->has('optionsRadios')) has-error @endif">
                                    <div class="col-xs-8 col-xs-offset-2">
                                        @if ($errors->has('optionsRadios')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                                            {{ $errors->first('optionsRadios') }}</label>
                                        @endif
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios"  value="roles" >
                                                Seleccionar por roles
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios"  value="users" >
                                                Seleccionar por usuarios
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group @if ($errors->has('roles')) has-error @endif" id="divRol" style="display: none">
                                    {!! Form::label('roles','Rol',['class' =>'col-xs-2 control-label']) !!}
                                    <div class="col-xs-8">
                                        @if ($errors->has('roles')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                                            {{ $errors->first('roles') }}</label>
                                        @endif
                                        <select class="form-control" name="role_id" id="selectRol">
                                            <option value="" disabled="disabled">- Seleccione un rol -</option>
                                            @foreach($roles as $rol)
                                                <option value="{{$rol->id}}" >{{$rol->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group @if ($errors->has('users')) has-error @endif" id="divUser" style="display: none;">
                                    {!! Form::label('usuarios','Usuarios',['class' =>'col-xs-2 control-label']) !!}
                                    <div class="col-xs-8">
                                        @if ($errors->has('users')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                                            {{ $errors->first('users') }}</label>
                                        @endif
                                        <select class="form-control" name="user_id" id="selectUser">
                                            <option value="" disabled="disabled">- Seleccione un usuario -</option>
                                            @foreach($users as $user)
                                                <option value="{{$user->id}}">{{$user->full_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                @include('notifications.tasks.partials.fields')

                                <div class="form-group">
                                    <div class="col-sm-offset-10 col-sm-2">
                                        <button type="submit" class="btn btn-primary" id="enviar">Guardar</button>
                                        <a href="{{route('tasks.index')}}" class="btn btn-default" >Cancelar</a>

                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>   <!-- /.row -->
        </section>
    </div>
@endsection
@section('scripts')
    <!-- date-range-picker -->
    {!! Html::script('plugins/daterangepicker/moment.js') !!}
    {!! Html::script('plugins/daterangepicker/locale/es.js') !!}
    {!! Html::script('plugins/daterangepicker/daterangepicker.js') !!}
    {!! Html::script('js/config-daterange.js') !!}
    {!! Html::script('js/notification-option.js')!!}
@endsection
