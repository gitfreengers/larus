@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
<div class="page-header">
	<h1>Listado  <span class="pull-right"><a href="{{ route('ejemplo.create') }}" class="btn btn-warning">Crear</a></span></h1>
</div>
@endsection
@section('content')

<table class="table">
	<thead>
		<th>Id usuario</th>
		<th>Descripcion</th>
		<th>Completada</th>
		<th>Acciones</th>
	</thead>
	<tbody>	
	    @foreach ($examples as $example)
		<tr>
			<td>{{$example->user_id}}</td>
			<td>{{$example->todo}}</td>
			<td>{{$example->completed}}</td>
			<td>
				<a class="btn btn-warning" href="{{ route('ejemplo.edit', $example->id) }}") }}">Editar</a>
				<a class="btn btn-danger" href="{{ URL::to("ejemplo/{$example->id}/delete") }}">Borrar</a>
			</td>
		</tr>	
		@endforeach
		
	</tbody>
</table>
@endSection