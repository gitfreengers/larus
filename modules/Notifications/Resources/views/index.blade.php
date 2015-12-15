@extends('layout.master')
@section('css')
	<link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
	<h1>Notificaciones</h1>
@endsection
@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="box">
				<div class="box-header">
					<div class="col-lg-12">
						@include('flash::message')
					</div>
					<div class="btn-group btn-group-sm pull-right">
						<a href="{{route('notifications.create')}}" class="btn btn-success btn-flat"><i class="fa fa fa-envelope-o"></i> Crear notificación</a>
					</div>
				</div><!-- /.box-header -->
				<div class="box-body">
					<table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
						<thead>
						<tr>
							<th>Nombre</th>
							<th>Descripción</th>
							<th>url</th>
							<th>Accion</th>
						</tr>
						</thead>
						<tbody>
						@foreach($notifications as $notification)
							<tr>
								<td>{{$notification->name}}</td>
								<td>{{$notification->description}}</td>
								<td>{{$notification->url}}</td>
								<td>
									<div class="btn-group">
										<a href="{{route('notifications.edit',$notification->id)}}" class="btn btn-default btn-flat" title="Editar usuario"
												><i class="fa fa-edit"></i> Editar</a>
										<button class="btn btn-danger "
												data-toggle="confirmation"
												data-singleton="true"
												data-btn-type="delete"
												data-url="{{route('notifications.destroy',$notification->id)}}">
											<i class="fa fa-trash"></i> Eliminar</button>
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
	@include('tasks::layouts.modal-note')
	@endsection
	@section('scripts')
			<!-- DATA TABES SCRIPT -->
	<script src="{{asset('bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
	<script src="{{asset('bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
	<!-- confirmation -->
	<script src="{{asset('js/ajax.js')}}"></script>
	<script src="{{asset('bower_components/admin-lte/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
@endsection
