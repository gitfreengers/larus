@extends('layout.master')
<link href="{{ asset("bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.css")}}" rel="stylesheet" type="text/css" />
<link href="{{ asset("bower_components/admin-lte/plugins/select2/select2.css")}}" rel="stylesheet" type="text/css" />
@section('content-header')
    <h1>Notificaciones</h1>
@endsection
@section('content')

            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-default">

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
                                            <input type="radio" name="optionsRadios"  value="users" {{(is_null($notification->role_id))? 'checked' : ''}}>
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
                                        <select class="form-control select3 select2-hidden-accessible" name="role_id" id="selectRol" style="width: 100%;" tabindex="-1" aria-hidden="true">
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
                                        <select class="form-control select2 select2-hidden-accessible" name="user_id" id="selectUser" style="width: 100%;" tabindex="-1" aria-hidden="true">
                                            <option disabled value="" {{(!is_null($notification->role_id))? 'selected': ''}}>- Seleccione un usuario -</option>
                                        @foreach($users as $user)
                                            <option value="{{$user->id}}" {{($user->id == $notification->users->first()->id)? 'selected': ''}}>{{$user->full_name}}</option>
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
                            @include('notifications::partials.fields')
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


@endsection
@section('scripts')
    <script src="{{asset('bower_components/admin-lte/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.js') }}" type="text/javascript"></script>
    <script src="{{asset('bower_components/admin-lte/plugins/select2/select2.full.js') }}" type="text/javascript"></script>
    <script type="text/javascript">
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
        $(function () {

            //bootstrap WYSIHTML5 - text editor
            $(".textarea").wysihtml5();
            $(".select2").select2();
            $(".select3").select2();
        $('input:radio[name="optionsRadios"]').change(
                function () {
                    if (this.checked && this.value == 'roles' ) {
                        $("#selectUser").find('option:selected').removeAttr("selected");
                        $('#selectUser').find('option:first-child').attr("selected", "selected");
                        $('#selectUser').find('option:first-child').attr("disabled", "disabled");
                        $('#divUser').css('display', 'none');
                        $('#divRol').css('display', 'block');

                    } else {
                        $("#selectRol").find('option:selected').removeAttr("selected");
                        $('#selectRol').find('option:first-child').attr("selected", "selected");
                        $('#selectRol').find('option:first-child').attr("disabled", "disabled");
                        console.log('user')
                        $('#divUser').css('display', 'block');
                        $('#divRol').css('display', 'none');

                    }

                });
        });

    </script>

@endsection