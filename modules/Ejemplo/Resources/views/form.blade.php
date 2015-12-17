@extends('layout.master')
@section('content-header')
    <h1>Ejemplo
        <small><h1>{{ $mode == 'create' ? 'Crear' : 'Actualizar' }} <small></small>
    </h1>
@endsection
@section('content')
<div class="page-header">
	{{ $mode === 'update' ? $example->name : null }}</small><span class="pull-right"><a href="{{ route('ejemplo.index') }}" class="btn btn-default">Regresar</a></span></h1>
</div>

{!! Form::open(['route' => [$example->id > 0 ? 'ejemplo.update' : 'ejemplo.store', isset($example->id) ? $example->id : 0], 'method'=>isset($example->id) ? 'PUT' : 'POST', 'class' => 'form']) !!}

	<div class="form-group{{ $errors->first('user_id', ' has-error') }}">
		<label for="user_id">Usuario</label>
		{!! Form::select('user_id', array('1' => 'usuario 1', '2' => 'usuario 2'), $example->user_id, ['class'=> 'form-control', 'placeholder'=>'Ingrese el usuario']) !!}
		<span class="help-block">{{{ $errors->first('user_id', ':message') }}}</span>
	</div>

	<div class="form-group{{ $errors->first('todo', ' has-error') }}">
		<label for="todo">Todo </label>
		{!! Form::input('text', 'todo', $example->todo, ['class'=> 'form-control', 'placeholder'=>'Ingrese el todo']) !!}
		<span class="help-block">{{{ $errors->first('todo', ':message') }}}</span>
	</div>
	
	<div class="form-group{{ $errors->first('completed', ' has-error') }}">
		<label for="completed">Completada</label>
		{!! Form::checkbox('completed', $example->completed) !!}
		<span class="help-block">{{{ $errors->first('completed', ':message') }}}</span>
	</div>

	<button type="submit" class="btn btn-default">Guardar</button>

</form>

@endsection