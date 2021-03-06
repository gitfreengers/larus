@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Ventas</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <div class="col-lg-12">
                    @include('flash::message')
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
	                    <tr>
	                        <th>#</th>
	                        <th>Fecha</th>
	                        <th>Archivo procesado</th>
	                        <th>Cantidad de registros</th>
	                        <th>Detalles</th>
	                        <th>Oficina de apertura</th>
	                        <th>Oficina de cierre</th>
	                    </tr>
                    </thead>
                    <tbody>
                    @foreach($salesLogs as $sale)
                        <tr>
	                        <td>{{$sale->id}}</td>
	                        <td>{{$sale->created_at}}</td>
	                        <td>{{$sale->file_name}}</td>
	                        <td>{{$sale->process}}</td>
	                        <td>{{$sale->description}}</td>
	                        <td>{{$sale->op_location}}</td>
	                        <td>{{$sale->cl_location}}</td>   
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
	<script type="text/javascript">
	<!--
	$(document).ready(function(){
		$("#datatable").DataTable({
			"language": {
	            "url": '{!! asset("bower_components/admin-lte/plugins/datatables/lang/spanish.json") !!}'
	        }
		});
	});
	//-->
	</script>
@endsection