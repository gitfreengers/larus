@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Pendientes por conciliar</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
        
        	<div class="box-header">
            	<div class="btn-group pull-right">
                	<a href="{{route('contabilidad.depositos.index')}}" class="btn btn-success btn-flat"><i class="fa fa-money"></i> Depositos</a>
				</div>
                <div class="col-lg-10">
                	@include('flash::message')
				</div>
           	</div><!-- /.box-header -->
            <div class="box-body">
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Referencia</th>
                        <th>Factura UUID</th>
                        <th>Monto</th>
                        <th>Monto aplicado</th>
                    </tr>
                    </thead>
                    <tbody>
                    	@foreach($ventasPendientes as $ventas)
                    		<tr>
                    			<td> {{$ventas->date}} </td>
                    			<td> {{$ventas->reference}} </td>
                    			<td> {{$ventas->factura_uuid}} </td>
                    			<td align="right"> $ {{number_format($ventas->ammount, 2)}} </td>
                    			<td align="right"> $ {{number_format($ventas->ammount_applied, 2)}} </td>
								<!--	
                    			<td align="center"> 
		                        	<div class="btn-group">
										<a  href="#" class="btn btn-info btn-flat" title="Conciliar"><i class="fa fa-check-square-o "></i> Conciliar</a>
	                                </div>
								</td>
								-->
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
    
    <script src="{{asset('bower_components/admin-lte/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
	<script>
	tabla = $("#datatable").DataTable({
        "language": {
            "url": '{!! asset("bower_components/admin-lte/plugins/datatables/lang/spanish.json") !!}'
        },
	});
	</script>
@endsection