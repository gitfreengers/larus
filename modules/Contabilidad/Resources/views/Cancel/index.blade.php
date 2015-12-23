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
        		<form id='depositosForm'>
	        		<div class="form-group @if ($errors->has('view')) has-error @endif col-md-3 col-xs-12">
					    {!! Form::label('place','Plaza',['class' =>'col-xs-4 control-label']) !!}
					    <div class="col-xs-12">
					        @if ($errors->has('plaza')) 
					        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('plaza') }}</label>
					        @endif
					        {!! Form::select('plaza', $plazas, null,['class' => 'form-control','placeholder' => 'Ingrese la plaza', 'id' =>'plaza']) !!}
					    </div>
					</div>
	        	
	        	 	<div class="form-group @if ($errors->has('bank')) has-error @endif col-md-3 col-xs-12" >
					    {!! Form::label('monto', 'Importe', ['class' =>'col-xs-4 control-label']) !!}
					    <div class="col-xs-12">
					        @if ($errors->has('monto'))
					            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('monto') }}</label>
					        @endif
					        {!! Form::text('monto',null,['class' => 'form-control','placeholder' => 'Ingrese la cantidad']) !!}
					    </div>
					</div>
					
	        	 	<div class="form-group @if ($errors->has('date')) has-error @endif col-md-3 col-xs-12" >
					    {!! Form::label('fecha','Fecha',['class' =>'col-xs-4 control-label']) !!}
					    <div class="col-xs-12">
					        @if ($errors->has('fecha'))
					            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('fecha') }}</label>
					        @endif
					        {!! Form::text('fecha',null,['class' => 'form-control','placeholder' => 'Ingrese la fecha', 'id'=>'fecha']) !!}
					    </div>
					</div>
					
					<div class="form-group @if ($errors->has('reference')) has-error @endif col-md-3 col-xs-12">
					    {!! Form::label('referencia','Referencia',['class' =>'col-xs-4 control-label']) !!}
					    <div class="col-xs-12">
					        @if ($errors->has('referencia')) 
					        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('referencia') }}</label>
					        @endif
					        {!! Form::text('referencia',null,['class' => 'form-control','placeholder' => 'Ingrese una referencia']) !!}
					    </div>
					</div>   
	                <div class="row ">
						<div class="col-lg-12">
			            	<div class="btn-group pull-right ">
			                	<a href="#" class="btn btn-success btn-flat" id='buscarBtn'><i class="fa fa-search"></i> Buscar</a>
							</div>
						</div>
					</div>
				</form>	
           	</div><!-- /.box-header -->
            <div class="box-body">
            	<div class='row'>
					<div class="col-lg-12">
			    		@include('flash::message')
					</div>
            	</div>
            	<div class='row'>
	        		<table id="depositosTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                    <thead>
		                    <tr>
		                    	<th>Id</th>
		                        <th>Banco</th>
		                        <th>Referencia</th>
		                        <th>Monto</th>
		                        <th>Moneda</th>
		                        <th>Cuenta contable</th>
		                        <th>Complementaria</th>
		                        <th></th>
		                    </tr>
	                    </thead>
	                    <tbody></tbody>
	                </table>
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
    <script src="{{asset('bower_components/admin-lte/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('js/ajax.js')}}"></script>
    <script src="{{ asset ("bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>
	<script src="{{ asset ("/bower_components/admin-lte/plugins/datepicker/locales/bootstrap-datepicker.es.js") }}" type="text/javascript"></script>
	
	<script>
	$(document).ready(function(){
		$("#fecha").datepicker({
			language: 'es'
		});

		tabla = $("#depositosTable").DataTable({
	        "language": {
	            "url": '{!! asset("bower_components/admin-lte/plugins/datatables/lang/spanish.json") !!}'
	        },
	        "bPaginate": false,
	        "bLengthChange": true,
	        "bFilter": false,
	        "bSort": false,
	        "bInfo": false,
	        "bAutoWidth": false,
	        "autoWidth": true,
	        "columns": [
				{"data": "id"},
	           	{"data": "banco"},
	        	{"data": "referencia"},
	        	{"data": "monto"},
	        	{"data": "moneda"},
	        	{"data": "cuenta_contable"},
	        	{"data": "complementaria"},
	        	{"data": "estatus"}
	        ],
	        'columnDefs': [
				{	
                	'targets': 7,
                	'searchable':false,
                    'orderable':false,
                    'render': function (data, type, full, meta){
                        if (full.estatus==0){
                            url = "{{route('contabilidad.cancelaciones.destroy', 0)}}";
                            return "<button class='btn btn-danger' data-toggle='confirmation' data-singleton='true' data-btn-type='delete' data-url='" + url.replace('/0', '/'+full.id) + "'> <i class='fa fa-trash'></i> Eliminar</button>";
                        }else{
                            return '<div class="form-group has-error"><label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> Cancelado</label></div>';
                        }
       				}
				},   	
			],
	    });

	    $("#buscarBtn").on("click", function(){
			tabla.rows().remove().draw();
			$.get('{{route("contabilidad.cancelaciones.obtenerDepositos")}}', $("#depositosForm").serializeArray(), function(res){
				$.each(res, function(i,v){
					tabla.row.add({
						id: v.id, 
						banco: v.banco, 
						referencia: v.referencia,
						monto: v.monto,
						moneda: v.moneda,
						cuenta_contable: v.cuenta_contable,
						complementaria: v.complementaria,
						estatus: v.estatus
					}).draw();
					tabla.columns.adjust().draw();
				});
				apps.setup();
			});		    
		});
	});
	</script>
@endsection