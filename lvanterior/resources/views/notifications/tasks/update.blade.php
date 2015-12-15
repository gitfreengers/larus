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
                Tarea
                <small>Actualizar tarea</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li><a href="#">Tareas</a></li>
                <li class="active">Actualizar Tarea</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-primary">

                            {!! Form::model($task,
                            ['route' => ['tasks.update', $task->id],
                            'method'=>'PUT',
                            'class'=> 'form-horizontal',
                            'files'=>'true',
                            'id'=>'form_tasks']  ) !!}
                        <div class="box-body">
                            <div class="form-group  @if ($errors->has('optionsRadios')) has-error @endif">
                                <div class="col-xs-8 col-xs-offset-2">
                                    @if ($errors->has('optionsRadios')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                                        {{ $errors->first('optionsRadios') }}</label>
                                    @endif
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios"  value="roles" {{(is_null($task->role_id))? '' : 'checked'}}>
                                            Seleccionar por roles
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios"  value="users" {{(is_null($task->user_id))? '' : 'checked'}}>
                                            Seleccionar por usuarios
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group @if ($errors->has('roles')) has-error @endif" id="divRol">
                                {!! Form::label('roles','Rol',['class' =>'col-xs-2 control-label']) !!}
                                <div class="col-xs-8">
                                    @if ($errors->has('roles')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                                        {{ $errors->first('roles') }}</label>
                                    @endif
                                    <select class="form-control" name="role_id" id="selectRol">
                                        <option disabled value="" {{(is_null($task->role_id))? 'selected': ''}}>- Seleccione un rol -</option>
                                        @foreach($roles as $rol)
                                            <option value="{{$rol->id}}" {{($rol->id == $task->role_id )? 'selected': ''}}>{{$rol->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group @if ($errors->has('users')) has-error @endif" id="divUser">
                                {!! Form::label('usuarios','Usuarios',['class' =>'col-xs-2 control-label']) !!}
                                <div class="col-xs-8">
                                    @if ($errors->has('users')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                                        {{ $errors->first('users') }}</label>
                                    @endif
                                    <select class="form-control" name="user_id" id="selectUser">
                                        <option disabled value="" {{(is_null($task->user_id))? 'selected': ''}} >- Seleccione un usuario -</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{($user->id == $task->user_id)? 'selected': ''}}>{{$user->full_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            @include('notifications.tasks.partials.fields')
                            <div class="form-group">
                                <div class="col-sm-offset-10 col-sm-2">
                                    <button type="submit" class="btn btn-primary" id="enviar">Actualizar</button>
                                    <a href="{{route('tasks.index')}}" class="btn btn-default" >Cancelar</a>
                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div>
@endsection
@section('scripts')
    {!! Html::script('plugins/daterangepicker/moment.js') !!}
    {!! Html::script('plugins/daterangepicker/locale/es.js') !!}
    {!! Html::script('plugins/daterangepicker/daterangepicker.js') !!}
    {!! Html::script('js/config-daterange.js') !!}
    {!! Html::script('js/notification-option.js')!!}
    <script type="text/javascript">
        $(document).ready(function() {
            moment.locale('es');
            //Date range picker with time picker
            $('#reservationtime').daterangepicker({
                timePicker: true,
                timePickerIncrement: 1,
                timePicker12Hour: false,
                format: 'YYYY/MM/DD H:mm',
                startDate: "{{$task->start_time}}",
                endDate: "{{$task->expire_time}}",
                "locale": {
                    "applyLabel": "Aplicar",
                    "cancelLabel": "Cancelar",
                    "fromLabel": "Desde",
                    "toLabel": "Hasta"
                }
            });
            if($("input:checked").val() == 'roles'){
                $('#divUser').css('display', 'none');
                $('#divRol').css('display', 'block');
            }else{
                $('#divUser').css('display', 'block');
                $('#divRol').css('display', 'none');
            }
        });
    </script>

@endsection