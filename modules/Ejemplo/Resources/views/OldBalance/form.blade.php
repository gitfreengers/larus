@extends('layout.master')
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
						        {!! Form::text('date',null,['class' => 'form-control','placeholder' => 'Ingrese la fecha']) !!}
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


