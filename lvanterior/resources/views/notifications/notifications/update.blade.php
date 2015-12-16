@extends('layout.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Notificaciones
                <small>Actualizar notificación</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li><a href="#">Notificación</a></li>
                <li class="active">Actualizar notificación</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-primary">

                            {!! Form::model($notification,
                            ['route' => ['notifications.update', $notification->id],
                            'method'=>'PUT',
                            'class'=> 'form-horizontal',
                            'files'=>'true',
                            'id'=>'form_notification']  ) !!}
                        <div class="box-body">
                            <div class="form-group  @if ($errors->has('optionsRadios')) has-error @endif">
                                <div class="col-xs-8 col-xs-offset-2">
                                    @if ($errors->has('optionsRadios')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                                        {{ $errors->first('optionsRadios') }}</label>
                                    @endif
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios"  value="roles" {{(is_null($notification->role_id))? '' : 'checked'}}>
                                            Seleccionar por roles
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="optionsRadios"  value="users" {{(is_null($notification->user_id))? '' : 'checked'}}>
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
                                        <option disabled value="" {{(is_null($notification->role_id))? 'selected': ''}}>- Seleccione un rol -</option>
                                        @foreach($roles as $rol)
                                            <option value="{{$rol->id}}" {{($rol->id == $notification->role_id )? 'selected': ''}}>{{$rol->name}}</option>
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
                                        <option disabled value="" {{(is_null($notification->user_id))? 'selected': ''}}>- Seleccione un usuario -</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{($user->id == $notification->user_id)? 'selected': ''}}>{{$user->full_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-xs-8 col-xs-offset-2">
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="email"  value="1" >
                                            Enviar vía e-mail
                                        </label>
                                    </div>
                                </div>
                            </div>
                            @include('notifications.notifications.partials.fields')
                            <div class="form-group">
                                <div class="col-sm-offset-10 col-sm-2">
                                    <button type="submit" class="btn btn-primary" id="enviar">Actualizar</button>
                                    <a href="{{route('notifications.index')}}" class="btn btn-default" >Cancelar</a>
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
    <script type="text/javascript">
        $(document).ready(function() {
            if($("input:checked").val() == 'roles'){
                $('#divUser').css('display', 'none');
                $('#divRol').css('display', 'block');
            }else{
                $('#divUser').css('display', 'block');
                $('#divRol').css('display', 'none');
            }
        });
    </script>
    {!!Html::script('js/notification-option.js')!!}
@endsection