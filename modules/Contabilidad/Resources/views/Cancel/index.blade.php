@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Cancelaciones</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
        	<div class="box-header">
        		
           	</div><!-- /.box-header -->
            <div class="box-body">
            	 <div class="form-group @if ($errors->has('view')) has-error @endif col-xs-3">
				    {!! Form::label('place','Plaza',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('plaza')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('plaza') }}</label>
				        @endif
				        {!! Form::select('plaza', $plazas, null,['class' => 'form-control','placeholder' => 'Ingrese la plaza', 'id' =>'plaza']) !!}
				    </div>
				</div>
        	
        	 	<div class="form-group @if ($errors->has('bank')) has-error @endif col-xs-3" >
				    {!! Form::label('ammount', 'Importe', ['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('ammount'))
				            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('ammount') }}</label>
				        @endif
				        {!! Form::text('ammount',null,['class' => 'form-control','placeholder' => 'Ingrese la cantidad']) !!}
				    </div>
				</div>
				
        	 	<div class="form-group @if ($errors->has('date')) has-error @endif col-xs-3" >
				    {!! Form::label('date','Fecha',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('date'))
				            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('date') }}</label>
				        @endif
				        {!! Form::text('date',null,['class' => 'form-control','placeholder' => 'Ingrese la fecha', 'id'=>'fecha']) !!}
				    </div>
				</div>
				
				<div class="form-group @if ($errors->has('reference')) has-error @endif col-xs-3">
				    {!! Form::label('reference','Referencia',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('reference')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('reference') }}</label>
				        @endif
				        {!! Form::text('reference',null,['class' => 'form-control','placeholder' => 'Ingrese un referencee']) !!}
				    </div>
				</div>   
                
                <div class="row ">
					<div class="col-lg-12">
		            	<div class="btn-group pull-right ">
		                	<a href="{{route('contabilidad.cancelaciones.create')}}" class="btn btn-success btn-flat"><i class="fa fa-search"></i> Buscar</a>
						</div>
					</div>
				</div>
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