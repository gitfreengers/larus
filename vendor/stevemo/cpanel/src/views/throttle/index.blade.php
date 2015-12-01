@extends('cpanel::layouts')

@section('header')
<h1> Usuarios Throttling</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.users.index')}}">
        <i class="fa fa-user"></i>
        Usuarios
    </a>
</li>
<li class="active">Throttling</li>
@stop

@section('content')

<div class="row">
    <div class="col-lg-12">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">{{ $user->first_name }}&nbsp; {{ $user->last_name }} Estatus Throttling</h3>
            </div>
            <div class="panel-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>Caracteristica</th>
                        <th>Estatus</th>
                        <th>Accion</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if ($throttle->isBanned())
                    <tr>
                        <td><strong>Estatus de baneo</strong></td>
                        <td>Este usuario esta baneado</td>
                        <td>
                            <a href="{{ route('cpanel.users.throttling.update',array($user->id,'unban')) }}"
                               class="btn btn-primary" rel="tooltip" title="UnBan User"
                               data-method="put" data-message="Desbanear este usuario?">
                                <i class="fa fa-check"></i>
                                Desbanear usuario
                            </a>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td><strong>Estatus de baneo</strong></td>
                        <td>Este usuario no esta baneado</td>
                        <td>
                            <a href="{{ route('cpanel.users.throttling.update',array($user->id,'ban')) }}"
                               class="btn btn-danger" rel="tooltip" title="Banear Usuario"
                               data-method="put" data-message="Banear este usuario?">
                                <i class="fa fa-ban"></i>
                                Banear usuario
                            </a>
                        </td>
                    </tr>
                    @endif

                    @if ($throttle->isSuspended())
                    <tr>
                        <td><strong>Estatus de suspension</strong></td>
                        <td>Este usuario esta suspendido</td>
                        <td>
                            <a href="{{ route('cpanel.users.throttling.update',array($user->id,'unsuspend')) }}"
                               class="btn btn-primary" rel="tooltip" title="UnBan User"
                               data-method="put" data-message="Reanudar este usuario?">
                                <i class="fa fa-check"></i>
                                Reanudar este usuario
                            </a>
                        </td>
                    </tr>
                    @else
                    <tr>
                        <td><strong>Estatus de suspension</strong></td>
                        <td>Este usuario no esta suspendido</td>
                        <td>
                            <a href="{{ route('cpanel.users.throttling.update',array($user->id,'suspend')) }}"
                               class="btn btn-danger" rel="tooltip" title="Ban User"
                               data-method="put" data-message="Suspender este usuario?">
                                <i class="fa fa-ban"></i>
                                Suspender usuario
                            </a>
                        </td>
                    </tr>
                    @endif

                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@stop