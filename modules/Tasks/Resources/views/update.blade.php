@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("bower_components/admin-lte/plugins/bootstrap-datatimepicker/css/bootstrap-datetimepicker.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("bower_components/admin-lte/plugins/select2/select2.css")}}" rel="stylesheet" type="text/css" />

@endsection
@section('content-header')
    <h1>Tareas</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-default">
                {!! Form::model($task,['route' => ['tasks.update', $task->id],'method'=>'PUT','id'=>'form_tasks']  ) !!}
                <div class="box-body">
                    <div class="container-fluid">
                        <div class="row">

                            @include('tasks::partials.fields')
                            <div class="col-md-6">
                                <div class="form-group  @if ($errors->has('optionsRadios')) has-error @endif">
                                    <div class="col-xs-8 col-xs-offset-2">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" {{is_null($task->role_id)? '': 'checked'}}  value="roles">
                                                Seleccionar por roles
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" {{is_null($task->role_id)? 'checked': ''}} value="users" >
                                                Seleccionar por usuarios
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('roles')) has-error @endif" id="divRol" style="display: none">
                                {!! Form::label('roles','Rol *',['class' =>'col-xs-2 control-label']) !!}
                                <div class="col-xs-6">
                                    @if ($errors->has('roles')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                                        {{ $errors->first('roles') }}</label>
                                    @endif
                                    <select class="form-control select3 select2-hidden-accessible" name="role_id" id="selectRol" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option value=""  {{(is_null($task->role_id))? 'selected': ''}}>- Seleccione un rol -</option>
                                        @foreach($roles as $rol)
                                            <option value="{{$rol->id}}"  {{($task->role_id == $rol->id)? 'selected': ''}}>{{$rol->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('users')) has-error @endif" id="divUser" style="display: none;">
                                {!! Form::label('usuarios','Usuarios *',['class' =>'col-xs-2 control-label']) !!}
                                <div class="col-xs-6">
                                    @if ($errors->has('users')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                                        {{ $errors->first('users') }}</label>
                                    @endif
                                    <select class="form-control select2 select2-hidden-accessible" name="user_id" id="selectUser" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                        <option value=""  {{(!is_null($task->role_id))? 'selected': ''}}>- Seleccione un usuario -</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{($user->id == $task->users->first()->id)? 'selected': '' }} >{{$user->full_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                {!! Form::textarea('description', null, ['class'=> 'textarea','style'=>'width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;']) !!}
                            </div>

                        </div>
                    </div>
                </div>
                <div class="box-footer">
                    <div class="form-group">
                        <div class="col-sm-offset-10 col-sm-2">
                            <button type="submit" class="btn btn-primary" id="enviar">Guardar</button>
                            <a href="{{url('tasks')}}" class="btn btn-default" >Cancelar</a>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script src="{{asset('bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}" type="text/javascript"></script>
    <script src="{{asset('bower_components/admin-lte/plugins/moment/moment-with-locales.js') }}" type="text/javascript"></script>
    <!-- <script src="{{asset('bower_components/admin-lte/plugins/daterangepicker/moment.js')}}"></script> -->
    <script src="{{asset('bower_components/admin-lte/plugins/bootstrap-datatimepicker/js/bootstrap-datetimepicker.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('bower_components/admin-lte/plugins/select2/select2.full.js') }}" type="text/javascript"></script>
    <script>
        $(document).ready(function() {
            if ($("input:checked").val() == 'roles') {
                $("#selectUser").find('option:selected').removeAttr("selected");
                $('#selectUser').find('option:first-child').attr("selected", "selected");
                $('#selectUser').find('option:first-child').attr("disabled", "disabled");
                $('#divUser').css('display', 'none');
                $('#divRol').css('display', 'block');
            }
            if ($("input:checked").val() == 'users') {
                $("#selectRol").find('option:selected').removeAttr("selected");
                $('#selectRol').find('option:first-child').attr("selected", "selected");
                $('#selectRol').find('option:first-child').attr("disabled", "disabled");
                $('#divUser').css('display', 'block');
                $('#divRol').css('display', 'none');
            }
        });
    </script>
    <script src="{{asset('modules/tasks/js/notification-option.js')}}"></script>

@endsection