@extends('layout.master')
@section('css')
	<link href="{{ asset("bower_components/admin-lte/plugins/datepicker/datepicker3.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Polizas <small> </small></h1>
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
                    <div class="box-header">
                      	<div class="form-group @if ($errors->has('date')) has-error @endif col-md-3 col-xs-12 " >
						    {!! Form::label('date','Fecha polizas',['class' =>'col-md-6 col-xs-12 control-label']) !!}
						    <div class="col-md-12 col-xs-12">
						        @if ($errors->has('date'))
						            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('date') }}</label>
						        @endif
						        {!! Form::text('date',$fechaAyer,['class' => 'form-control','placeholder' => 'Ingrese la fecha', 'id'=>'fecha']) !!}
						    </div>
						</div>
						<div class="form-group @if ($errors->has('type')) has-error @endif col-md-3 col-xs-12 ">
						    {!! Form::label('type','Tipo de poliza',['class' =>'col-md-6 col-xs-12 control-label']) !!}
						    <div class="col-md-12 col-xs-12">
						        @if ($errors->has('type')) 
						        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('type') }}</label>
						        @endif
						        {!! Form::select('type',array('1'=>'Diario', 2=>'Ingresos', 3=>'Prepago'), null,['class' => 'form-control','placeholder' => 'Ingrese el tipo de poliza']) !!}
						    </div>
						
						</div>
 						<div class="form-group @if ($errors->has('view')) has-error @endif col-md-3 col-xs-12 ">
						    {!! Form::label('place','Plaza',['class' =>'col-md-1 col-xs-12 control-label']) !!}
						    <div class="col-md-12 col-xs-12">
						        @if ($errors->has('plaza')) 
						        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('plaza') }}</label>
						        @endif
						        {!! Form::select('plaza', $plazas, null,['class' => 'form-control','placeholder' => 'Ingrese la plaza', 'id' =>'plaza']) !!}
						    </div>
						</div>
						
						<div class="row ">
							<div class="col-lg-12">
				            	<div class="btn-group pull-right ">
		                            <button type="submit" class="btn btn-primary" id="enviar">Generar</button>
								</div>
							</div>
						</div>
					</div>                       
					
					<div class="box-body">
					
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
			language: 'es',
			format: 'yyyy/mm/dd'
		});
	});
	</script>
@endsection
