@extends('cpanel::layouts')

@section('header')
    <h1>Usuarios</h1>
@stop

@section('breadcrumb')
    @parent
    <li class="active"><i class="fa fa-user"></i> Usuarios </li>
@stop

@section('content')

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <div class="btn-toolbar">
                            <a href="{{ route('cpanel.users.create') }}" class="btn btn-primary"
                               data-toggle="tooltip" title="Crear nuevo usuario">
                                <i class="fa fa-plus"></i>
                                Nuevo Usuario
                            </a>
                        </div>
                    </h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th class="hidden-xs">Email</th>
                            <th class="hidden-xs">Activo</th>
                            <th class="hidden-xs">Agregado</th>
                            <th class="hidden-xs">Ultima visita</th>
                            <th>Acción</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($users as $user)
                        <tr>
                            <td>{{ HTML::linkRoute('cpanel.users.show',$user->first_name.' '.$user->last_name, array($user->id)) }}</td>
                            <td class="hidden-xs">{{{ $user->email }}}</td>
                            <td class="hidden-xs">{{{ ($user->activated) ? 'Si' : 'No' }}}</td>
                            <td class="hidden-xs">{{{ $user->activated_at }}}</td>
                            <td class="hidden-xs">{{{ is_null($user->last_login) ? 'Never Visited' : $user->last_login }}}</td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
                                        Acción
                                        <span class="caret"></span>
                                    </a>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a href="{{ route('cpanel.users.show', array($user->id)) }}">
                                                <i class="fa fa-info-circle"></i>&nbsp;Detalles Usuario
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.users.edit', array($user->id)) }}">
                                                <i class="fa fa-edit"></i>&nbsp;Editar Usuario
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.users.permissions', array($user->id)) }}">
                                                <i class="fa fa-ban"></i>&nbsp;Permisos
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('cpanel.users.destroy', array($user->id)) }}"
                                               data-method="delete"
                                               data-message="eliminar este usuario?">
                                                <i class="fa fa-trash-o"></i>&nbsp;Eliminar Usuario
                                            </a>
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            @if ($user->isActivated())
                                            <a href="{{ route('cpanel.users.deactivate', array($user->id)) }}"
                                               data-method="put"
                                               data-message="Desactivar este usuario?">
                                                <i class="fa fa-minus-circle"></i>&nbsp;Desactivar
                                            </a>
                                            @else
                                            <a href="{{ route('cpanel.users.activate', array($user->id)) }}"
                                               data-method="put"
                                               data-message="Activar este usuario?">
                                                <i class="fa fa-check"></i>&nbsp;Activar
                                            </a>
                                            @endif
                                        </li>
                                        <li class="divider"></li>
                                        <li>
                                            <a href="{{ route('cpanel.users.throttling', array($user->id)) }}">
                                                <i class="fa fa-key"></i>&nbsp;Throttling
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@stop
