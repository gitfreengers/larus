@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            Show Cuenta
            <div class="panel-nav pull-right" style="margin-top: -7px;">
                <a href="{!! route('cuentas.edit', $cuentum->id) !!}" class="btn btn-default">Edit</a>
                <a href="{!! route('cuentas.index') !!}" class="btn btn-default">Back</a>
            </div>
        </div>
        <table class="table table-stripped table-bordered">
            <tr>
                <td><b>ID</b></td>
                <td>{!! $cuentum->id !!}</td>
            </tr>

			<tr>
                <td><b>Numero</b></td>
                <td>{!! $cuenta->numero !!}</td>
            </tr>			<tr>
                <td><b>Banco</b></td>
                <td>{!! $cuenta->banco !!}</td>
            </tr>			<tr>
                <td><b>Sucursal</b></td>
                <td>{!! $cuenta->sucursal !!}</td>
            </tr>			<tr>
                <td><b>Ejecutivo</b></td>
                <td>{!! $cuenta->ejecutivo !!}</td>
            </tr>			<tr>
                <td><b>Tipo</b></td>
                <td>{!! $cuenta->tipo !!}</td>
            </tr>			<tr>
                <td><b>Descripcion</b></td>
                <td>{!! $cuenta->descripcion !!}</td>
            </tr>			<tr>
                <td><b>Cc_cuenta</b></td>
                <td>{!! $cuenta->cc_cuenta !!}</td>
            </tr>			<tr>
                <td><b>Tipocheque</b></td>
                <td>{!! $cuenta->tipocheque !!}</td>
            </tr>			<tr>
                <td><b>Cuentacomplementaria</b></td>
                <td>{!! $cuenta->cuentacomplementaria !!}</td>
            </tr>

            <tr>
                <td><b>Created At</b></td>
                <td>{!! $cuentum->created_at !!}</td>
            </tr>
        </table>
    </div>
@stop