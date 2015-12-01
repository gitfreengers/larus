@extends('cpanel::layouts')

@section('header')
<h1>Permisos</h1>
@stop

@section('breadcrumb')
@parent
<li class="active"><i class="fa fa-ban"></i> Permisos</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <div class="btn-toolbar">
                        <a href="{{ URL::route('cpanel.permissions.create') }}" class="btn btn-primary"
                           data-toggle="tooltip" title="Crear nuevos permisos">
                            <i class="fa fa-plus"></i>
                            Nuevos permisos
                        </a>
                    </div>
                </h3>
            </div>
            <div class="panel-body">
                @if($permissions->isEmpty())
                    <div class="alert alert-info">
                        {{ Lang::get('cpanel::permissions.no_found') }}
                    </div>
                @else
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Modulo</th>
                            <th>Roles</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($permissions as $permission)
                        <tr>
                            <td><h4>{{{ $permission->name }}}</h4></td>
                            <td>
                                <h4>
                                    @foreach ($permission->permissions as $role)
                                    <span class="label label-primary">{{{ $role }}}</span>
                                    @endforeach
                                </h4>
                            </td>
                            <td>
                                <a href="{{ route('cpanel.permissions.edit', array($permission->id)) }}"
                                   class="btn btn-warning" data-toggle="tooltip" title="Editar permisos">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('cpanel.permissions.destroy', array($permission->id)) }}"
                                   class="btn btn-danger" data-toggle="tooltip" title="Eliminar Permisos" data-method="delete"
                                   data-message="eliminar este permiso?">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</div>
@stop
