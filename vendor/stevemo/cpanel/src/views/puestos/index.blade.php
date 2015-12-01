@extends('cpanel::layouts')

@section('header')
<h1>Puestos</h1>
@stop

@section('breadcrumb')
@parent
<li class="active"><i class="fa fa-users"></i> Puestos</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <div class="btn-toolbar">
                        <a href="{{ URL::route('cpanel.puestos.create') }}" class="btn btn-primary" data-toggle="tooltip" title="Crear nuevo puesto">
                            <i class="fa fa-plus"></i>
                            Nuevo Puesto
                        </a>
                    </div>
                </h3>
            </div>
            <div class="panel-body">
                @if (count($puestos) == 0)
                    <div class="alert alert-info">
                        {{ Lang::get('cpanel::puestos.no_group') }}
                    </div>
                @else
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th>Nombre</th>
                            <th class="span4"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($puestos as $puesto)
                        <tr>
                            <td>{{{ $puesto->name }}}</td>
                            <td>
                                <a href="{{ route('cpanel.puestos.edit', array($puesto->id)) }}"
                                   class="btn btn-warning" data-toggle="tooltip" title="Editar Puesto">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="{{ route('cpanel.puestos.destroy', array($puesto->id)) }}"
                                   class="btn btn-danger" data-toggle="tooltip" title="Eliminar Puesto" data-method="delete"
                                   data-message="eliminar este puesto?">
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
