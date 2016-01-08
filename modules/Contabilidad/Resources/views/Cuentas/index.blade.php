@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("bower_components/admin-lte/plugins/select2/select2.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("bower_components/admin-lte/plugins/datepicker/datepicker3.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Cuentas</h1>
@endsection
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <div class="btn-group btn-group-sm pull-right">
                    <a href="{{route('contabilidad.cuentas.create')}}" class="btn btn-success btn-flat"><i class="fa fa-plus"></i> Añadir Cuenta</a>
                </div>
                <div class="col-lg-12">
                    @include('flash::message')
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
				<table class="table table-stripped table-bordered" id="tablaCuentas">
					<thead>
						<th>Numero</th>
						<th>Banco</th>
						<th>Sucursal</th>
						<th>Ejecutivo</th>
						<th>Tipo</th>
						<th>Descripción</th>
						<th>CC Cuenta</th>
						<th>Tipo de cheque</th>
						<th>Cuenta complementaria</th>
			
						<th class="text-center" style="min-width:80px !important"></th>
					</thead>
					<tbody>
						@foreach ($cuentas as $cuenta)
							<tr>
								<td class="text-center">{!! $cuenta->NUMERO !!}</td>
								<td>{!! $cuenta->bancoM['Nombre'] !!}</td>
								<td>{!! $cuenta->SUCURSAL !!}</td>
								<td>{!! $cuenta->EJECUTIVO !!}</td>
								<td>{!! $cuenta->TIPO !!}</td>
								<td>{!! $cuenta->DESCRIPCION !!}</td>
								<td>{!! $cuenta->CC_CUENTA !!}</td>
								<td>{!! $cuenta->TIPOCHEQUE !!}</td>
								<td>{!! $cuenta->CUENTACOMPLEMENTARIA !!}</td>
					
								<td class="text-center">
									<div class="btn-group">
										<a href="{!! route('contabilidad.cuentas.edit', $cuenta->NUMERO) !!}" class="btn btn-info btn-flat" title="Editar" data-toggle="tooltip"><i class="glyphicon glyphicon-edit"></i></a>
										<button class="btn btn-danger "
                                            data-toggle="confirmation"
                                            data-singleton="true"
                                            data-btn-type="delete"
                                            data-url="{{route('contabilidad.cuentas.destroy', $cuenta->NUMERO)}}">
											<i class="glyphicon glyphicon-trash"></i></button>										
									</div>
								</td>
							</tr>
						@endforeach
					</tbody>
				</table>
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->
@endsection
@section('scripts')
    <!-- DATA TABES SCRIPT -->
    <script src="{{asset('bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- confirmation -->
    <script src="{{asset('js/ajax.js')}}"></script>
    <script src="{{asset('bower_components/admin-lte/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
	<script>
		$(document).ready(function(){
			$("#tablaCuentas").DataTable({
				"language": {
		            "url": '{!! asset("bower_components/admin-lte/plugins/datatables/lang/spanish.json") !!}'
		        }
			});
			
		});
		
	</script>
@endsection