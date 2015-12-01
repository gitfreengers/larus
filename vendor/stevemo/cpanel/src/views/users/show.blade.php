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
<li class="active">Mostrar</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Perfil de {{ $user->first_name }} {{ $user->last_name }}
                </h3>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="tabbable">

                    <ul class="nav nav-tabs" id="myTab">
                        <li class="active">
                            <a href="#info" data-toggle="tab">Info Usuario</a>
                        </li>
                        <li>
                            <a href="#permissions" data-toggle="tab">Permisos de usuario</a>
                        </li>
                        <li>
                            <a href="#status" data-toggle="tab">Estatus de usuario</a>
                        </li>
                    </ul>

                    <div class="tab-content">

                        <div class="tab-pane active" id="info">
                            <table class="table table-striped">
                                <tbody>
                                <tr>
                                    <td><strong>Nombre</strong></td>
                                    <td>{{ $user->first_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Apellido</strong></td>
                                    <td>{{ $user->last_name }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Groupo</strong></td>
                                    <td>
                                        @foreach($user->getGroups() as $group)
                                        <span class="label label-primary">{{ $group->getName() }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="tab-pane" id="permissions">
                            @if(count($permissions) > 0)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>Este usuario tiene acceso a lo siguiente</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($permissions as $name => $value)
                                @if($value == 1)
                                <tr>
                                    <td>{{ $name }}</td>
                                </tr>
                                @endif
                                @endforeach
                                </tbody>
                            </table>
                            @else
                            <div class="alert alert-info">
                                Este usuario no tiene ningun permiso.
                            </div>
                            @endif
                        </div>

                        <div class="tab-pane" id="status">
                            <table class="table-striped table">
                                <tbody>
                                <tr>
                                    <td><strong>Baneado</strong></td>
                                    <td>
                                        {{ $throttle->isBanned() ? 'Si' : 'No' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Suspendido</strong></td>
                                    <td>
                                        {{ $throttle->isSuspended() ? 'Si' : 'No' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Activo</strong></td>
                                    <td>{{ ($user->activated) ? 'Si' : 'No' }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Fecha activacion</strong></td>

                                    <td>
                                        @if(is_null($user->activated_at))
                                        Not Activated
                                        @else
                                        {{ $user->activated_at->diffForHumans() }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>Ultimo login</strong></td>
                                    <td>
                                        @if(is_null($user->last_login))
                                        Never Visited
                                        @else
                                        {{ $user->last_login->diffForHumans() }}
                                        @endif
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>

                </div>
            </div>
        </div>

    </div>
</div>
@stop