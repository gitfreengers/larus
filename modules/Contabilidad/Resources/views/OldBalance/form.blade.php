@extends('layout.master')
@section('css')
	<link href="{{ asset("bower_components/admin-lte/plugins/datepicker/datepicker3.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Antigüedad de saldos <small>Generar</small></h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements disabled -->
            <div class="box">
                <div class="box-body">
                    {!! Form::open(['route' => 'users.store',
                                    'files'=>'true',
                                    'method'=>'POST',
                                    'id'=>'form_users',
                                    'class'=> 'form-horizontal',
                                    'parsley-validate novalidate' ]  ) !!}
                    <div class="box-body">
                      <div class="form-group @if ($errors->has('date')) has-error @endif col-xs-3" >
						    {!! Form::label('date','Fecha',['class' =>'col-xs-4 control-label']) !!}
						    <div class="col-xs-8">
						        @if ($errors->has('date'))
						            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('date') }}</label>
						        @endif
						        {!! Form::text('date',null,['class' => 'form-control','placeholder' => 'Ingrese la fecha', 'id'=>'fecha']) !!}
						    </div>
						</div>
						<div class="form-group @if ($errors->has('client')) has-error @endif col-xs-3">
						    {!! Form::label('client','Cliente',['class' =>'col-xs-4 control-label']) !!}
						    <div class="col-xs-8">
						        @if ($errors->has('client')) 
						        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('client') }}</label>
						        @endif
						        {!! Form::text('client',null,['class' => 'form-control','placeholder' => 'Ingrese un cliente']) !!}
						    </div>
						
						</div>
						<div class="form-group @if ($errors->has('view')) has-error @endif col-xs-3">
						    {!! Form::label('view','Vista',['class' =>'col-xs-4 control-label']) !!}
						    <div class="col-xs-8">
						        @if ($errors->has('view')) 
						        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('view') }}</label>
						        @endif
						        {!! Form::select('view',array('1'=>'PDF', 2=>'Excel'), null,['class' => 'form-control','placeholder' => 'Ingrese la vista']) !!}
						    </div>
						</div>
						
						<div class="form-group @if ($errors->has('client')) has-error @endif col-xs-3">
						    {!! Form::label('days','Días',['class' =>'col-xs-4 control-label']) !!}
						    <div class="col-xs-8">
						        @if ($errors->has('days')) 
						        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('days') }}</label>
						        @endif
						        {!! Form::text('days', 30, ['class' => 'form-control','placeholder' => 'Ingrese los días']) !!}
						    </div>
						</div>
						
				.       <div class="form-group @if ($errors->has('view')) has-error @endif col-xs-3">
						    {!! Form::label('place','Plaza',['class' =>'col-xs-4 control-label']) !!}
						    <div class="col-xs-8">
						        @if ($errors->has('plaza')) 
						        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('plaza') }}</label>
						        @endif
						        {!! Form::select('plaza',array('1'=>'Plaza 1', 2=>'Plaza 2'), null,['class' => 'form-control','placeholder' => 'Ingrese la plaza']) !!}
						    </div>
						</div>
						 <div class="form-group @if ($errors->has('view')) has-error @endif col-xs-3">
						    {!! Form::label('account_user','Propietario de cuenta',['class' =>'col-xs-4 control-label']) !!}
						    <div class="col-xs-8">
						        @if ($errors->has('account_user')) 
						        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('account_user') }}</label>
						        @endif
						        {!! Form::select('account_user',array('1'=>'Plaza 1', 2=>'Plaza 2'), null,['class' => 'form-control','placeholder' => 'Seleccione el propietario de cuenta']) !!}
						    </div>
						</div>
						<div class="row">
							<div class="col-xs-12">
								<h4>Metodos de pago</h4>
							</div>
							@foreach($payment_methods as $pm)
								<div class="form-group @if ($errors->has('client')) has-error @endif col-xs-4">
							        <input type="checkbox"> {{ $pm->payment_method }}
								</div>
							@endforeach
						</div>
						
						                        
	                    <div class="form-group col-xs-3">
	                        <div class="col-sm-offset-2 col-sm-2">
	                            <button type="submit" class="btn btn-primary" id="enviar">Generar</button>
	                        </div>
	                    </div>
                    </div>
                    {!! Form::close() !!}
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>
    </div>   <!-- /.row -->
@endsection


@section('scripts')
	<script src="{{ asset ("bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>
	<script src="{{ asset ("/bower_components/admin-lte/plugins/datepicker/locales/bootstrap-datepicker.es.js") }}" type="text/javascript"></script>
	
	<script>
	$(document).ready(function(){
		$("#fecha").datepicker({
			language: 'es'
		});
	});
	</script>
@endsection
