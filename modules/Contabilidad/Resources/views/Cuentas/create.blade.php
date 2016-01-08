@extends('layout.master')
@section('content-header')
    <h1>Cuentas
        <small>Crear cuenta</small>
    </h1>
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="box">
                <div class="box-body">
                    {!! Form::open(['route' => 'contabilidad.cuentas.store',
                                    'method'=>'POST',
                                    'id'=>'form_users',
                                    'class'=> 'form-horizontal',
                                    'parsley-validate novalidate' ]  ) !!}
                    <div class="box-body">
			            @include('contabilidad::Cuentas.form')
			        </div>    
                    <div class="form-group">
                        <div class="col-sm-offset-9 col-sm-3">
	                    	<div class="btn-group">
	                            <button type="submit" class="btn btn-primary" id="enviar">Guardar</button>
	                            <a href="{{route('contabilidad.cuentas.index')}}" class="btn btn-default" >Cancelar</a>
							</div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>   <!-- /.row -->
@endsection
