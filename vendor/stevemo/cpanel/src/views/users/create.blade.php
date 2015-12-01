@extends('cpanel::layouts')

@section('header')
<h1>Usuarios</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.users.index')}}">
        <i class="fa fa-user"></i>
        Usuarios
    </a>
</li>
<li class="active">Crear</li>
@stop

@section('content')
    <div class="row">
        <div class="col-lg-12">
            <?php
            $option = array(
                'route' => 'cpanel.users.store',
                'class' => 'form-horizontal'
            );
            ?>
            {{ Form::open($option) }}

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Crear un nuevo usuario</h3>
                </div>
                <div class="panel-body">
                    <div class="tabbable">

                        <ul class="nav nav-tabs" id="myTab">
                            <li class="active">
                                <a href="#credentials" data-toggle="tab">Credenciales de usuario</a>
                            </li>
                            <li>
                                <a href="#permissions" data-toggle="tab">Permisos de usuario</a>
                            </li>
                        </ul>

                        <div class="tab-content">

                            <div class="tab-pane active" id="credentials">
                                <legend class="margin-top-10">Informacion de usuarios</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="first_name">Nombre</label>
                                    <div class="col-md-4">
                                        {{ Form::text('first_name',null,array('class'=>'form-control','placeholder'=>'Nombre')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="last_name">Apellido</label>
                                    <div class="col-md-4">
                                        {{ Form::text('last_name',null,array('class'=>'form-control','placeholder'=>'Apellido')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="email">Email</label>
                                    <div class="col-md-4">
                                        {{ Form::email('email',null,array('class'=>'form-control','placeholder'=>'Email')) }}
                                    </div>
                                </div>

                                <legend>Password</legend>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="password">Contraseña</label>
                                    <div class="col-md-4">
                                        {{ Form::password('password',array('class'=>'form-control','placeholder'=>'Password')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="password_confirmation">Confirmar contraseña</label>
                                    <div class="col-md-4">
                                        {{ Form::password('password_confirmation',array('class'=>'form-control','placeholder'=>'Confirmar Password')) }}
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="groups[]" class="col-sm-2 control-label">Grupos</label>
                                    <div class="col-md-4">
                                        <select id="groups" name="groups[]" class="select2 form-control" multiple="true">
                                            @foreach($groups as $group)
                                            @if( in_array( $group->id, Input::old('groups', array())) )
                                            <option selected="selected" value="{{ $group->id }}">{{ $group->name }}</option>
                                            @else
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                            @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <legend>Opciones</legend>
                                <div class="form-group">
                                    <label for="activate" class="col-sm-2 control-label">Activar</label>
                                    <div class="col-md-2">
                                        {{
                                        Form::select(
                                        'permissions[superuser]',
                                        array('0' => 'No','1' => 'Si'),
                                        null,
                                        array('class'=>'select2 form-control'))
                                        }}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-offset-2 col-sm-10">
                                        <button type="submit" class="btn btn-primary">Enviar</button>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="permissions">
                                <p class="lead margin-top-10">Permisos aqui establecidos sobreescriben los permisos de grupo</p>
                                @include('cpanel::users.permissions_form')
                            </div>

                        </div>

                    </div>
                </div>
            </div>



            {{Form::close()}}
        </div>
    </div>
@stop
