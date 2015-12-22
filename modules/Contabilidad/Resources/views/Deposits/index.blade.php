@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("bower_components/admin-lte/plugins/select2/select2.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Depositos</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
        	<div class="box-header">
            	{!! Form::open(['route' => 'contabilidad.depositos.store','method'=>'POST','id'=>'form_task','parsley-validate novalidate' ]) !!}
        	    
        	 	<div class="form-group @if ($errors->has('banco')) has-error @endif col-xs-3" >
				    {!! Form::label('banco','Banco',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('banco'))
				            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('banco') }}</label>
				        @endif
				        {!! Form::text('banco', $deposito->banco,['class' => 'form-control','placeholder' => 'Ingrese el banco']) !!}
				    </div>
				</div>
        	 	<div class="form-group @if ($errors->has('fecha')) has-error @endif col-xs-3" >
				    {!! Form::label('fecha','Fecha',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('fecha'))
				            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('fecha') }}</label>
				        @endif
				        {!! Form::text('fecha', $deposito->fecha,['class' => 'form-control','placeholder' => 'Ingrese la fecha', 'id'=>'fecha']) !!}
				    </div>
				</div>
				<div class="form-group @if ($errors->has('referencia')) has-error @endif col-xs-3">
				    {!! Form::label('referencia','Referencia',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('referencia')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('referencia') }}</label>
				        @endif
				        {!! Form::text('referencia', $deposito->referencia,['class' => 'form-control','placeholder' => 'Ingrese un referenciae']) !!}
				    </div>
				</div>
				<div class="form-group @if ($errors->has('cantidad')) has-error @endif col-xs-3">
				    {!! Form::label('monto','Monto',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('monto')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('monto') }}</label>
				        @endif
				        {!! Form::text('monto', $deposito->monto,['class' => 'form-control','placeholder' => 'Ingrese un monto']) !!}
				    </div>
				</div>
				<div class="form-group @if ($errors->has('moneda')) has-error @endif col-xs-3">
				    {!! Form::label('moneda','Moneda',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('moneda')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('moneda') }}</label>
				        @endif
				        {!! Form::select('moneda',array('1'=>'DOLAR', 2=>'MXN'), $deposito->moneda,['class' => 'form-control','placeholder' => 'Ingrese una moneda']) !!}
				    </div>
				</div>
        		<div class="form-group @if ($errors->has('cuenta_contable')) has-error @endif col-xs-3">
				    {!! Form::label('cuenta_contable','Cuenta contable',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('cuenta_contable')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('cuenta_contable') }}</label>
				        @endif
				        {!! Form::text('cuenta_contable', $deposito->cuenta_contable,['class' => 'form-control','placeholder' => 'Ingrese la cuenta contable']) !!}
				    </div>
				</div>
        		<div class="form-group @if ($errors->has('complementaria')) has-error @endif col-xs-3">
				    {!! Form::label('complementaria','Complementaria',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('complementaria')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('complementaria') }}</label>
				        @endif
				        {!! Form::text('complementaria', $deposito->complementaria,['class' => 'form-control','placeholder' => 'Ingrese complemantaria']) !!}
				    </div>
				</div>
				@if (!isset($deposito->id))
					<div class="row ">
						<div class="col-lg-12">
			            	<div class="btn-group pull-right ">
			                	<button type="submit" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Guardar</button>
							</div>
						</div>
					</div>
				@endif	
				<br>     
				<br>        		
                <div class="col-lg-12">
                	@include('flash::message')
				</div>
				{!! Form::close() !!}
			</div><!-- /.box-header -->
            <div class="box-body">
				@if (isset($deposito->id))
					<div class="row ">
						<div class="col-lg-12">
			            	<div class="btn-group pull-right ">
			                	<a href="#" id="agregarReferencia" class="btn btn-success btn-flat"><i class="fa fa-money"></i> Agregar referencia de venta</a>
							</div>
						</div>
					</div>
	                <table id="depositosTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                    <thead>
	                    <tr>
	                        <th>Fecha</th>
	                        <th>Orden</th>
	                        <th>Monto</th>
	                        <th></th>
	                    </tr>
	                    </thead>
	                    <tbody>
	                        
	                    </tbody>
	                </table>
				@endif	
                
              
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->


<!-- modal -->
<div class="modal fade" id="ventasModal" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="modalTitle">Seleccione la venta</h4>
			</div>
			<div class="modal-body">
				<span id="error">
					<div class="alert alert-danger }}" >
            			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			            <span id="msg"></span>
        			</div>
				</span>
				<span id="content">
					<form>
						<div class="form-group">
							<label>Venta</label>
							<select class="form-control select2" name="ventas_id" id="selectVenta" >
								<option value="" disabled="disabled" >- Seleccione una venta -</option>
                            </select>
						</div>
						<div class="form-group">
							<label>Cantidad</label>
							<input id="cantidad" class="form-control">
						</div>
					</form>
				</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cerrar</button>
				<button type="button" id="addBtn" class="btn btn-default btn-success">Agregar</button>
			</div>
		</div>
	</div>
</div>

@endsection
@section('scripts')
    <!-- DATA TABES SCRIPT -->
    <script src="{{asset('bower_components/admin-lte/plugins/datatables/jquery.dataTables.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.min.js') }}" type="text/javascript"></script>
    <!-- confirmation -->
    <script src="{{asset('js/ajax.js')}}"></script>
    <script src="{{asset('bower_components/admin-lte/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('bower_components/admin-lte/plugins/select2/select2.full.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset ("bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>
	<script src="{{ asset ("bower_components/admin-lte/plugins/datepicker/locales/bootstrap-datepicker.es.js") }}" type="text/javascript"></script>
	
	<script src="{{ asset ("bower_components/admin-lte/plugins/jquery-number/jquery.number.min.js") }}" type="text/javascript" ></script>
	
	<script>
	$(document).ready(function(){
		// data tables
	    tabla = $("#depositosTable").DataTable({
	        "language": {
	            "url": '{!! asset("bower_components/admin-lte/plugins/datatables/lang/spanish.json") !!}'
	        },
	        "columns": [
	           	{"data": "id"},
	        	{"data": "name"},
	        ],
	        'columnDefs': [
           			{
                       'targets': 0,
                       'searchable':false,
                       'orderable':false,
                       'className': 'dt-body-center',
                       'render': function (data, type, full, meta){
                           	return '<input type="checkbox">';
					}
            	},   	
          	],
	    });

	    $("#fecha").datepicker({
			language: 'es',
			format:'yyyy-mm-dd'
		});

	    function formatRepo (repo) {
	        if (repo.loading) return repo.text;
	        markup = "Referencia: "+repo.reference + " Factura: " + repo.factura_number + " Fecha: " + repo.date + " $" + $.number(repo.ammount, 2, ".", ",");
	        return markup;
	      }

		$("#agregarReferencia").on('click', function(){
			$("#ventasModal").modal();
			$("#ventasModal #error").hide();
// 			ajax: {
//     		    url: '{{route("contabilidad.obtenerVentas")}}',
//     		    dataType: 'json',
//     		    processResults: function (data) {
//     		    	return {
// 	    		    	results: data.items
//     		    	}
//     		    },
    		   
// 		    },
// 		    templateResult: formatRepo,

			$.get('{{route("contabilidad.obtenerVentas")}}', function(res){
				
				$("#selectVenta").html("<option value=''>Seleccione...</option>");
				$.each(res.items, function(i,v){
					$("#selectVenta").append("<option value='"+v.id+"' data-cantidad='"+v.ammount+"'>"+"Referencia: "+v.reference + " Factura: " + v.factura_number + " Fecha: " + v.date + " $" + $.number(v.ammount, 2, ".", ",")+"</option>");
				});
				$(".select2").select2();
			});

			$("#ventasModal #addBtn").off();
			$("#ventasModal #addBtn").on("click", function() {
				var cantidad = $("#ventasModal #selectVenta :selected").data('cantidad');
				var montoD = $("#monto").val();
				var suma = 0;
		        if ($("#ventasModal #selectVenta").val() == "" || $("#ventasModal #cantidad").val() == "" ){
		        	$("#ventasModal #msg").html("Ingrese todos los datos");
		        	$("#ventasModal #error").show();
				}else{
					suma += parseFloat($("#ventasModal #cantidad").val());
					if (montoD < suma){
						$("#ventasModal #msg").html("El monto no puede ser mayor al deposito");
			        	$("#ventasModal #error").show();
					} else if ($("#ventasModal #cantidad").val() > cantidad && monto > suma) {
						$("#ventasModal #msg").html("El monto no puede ser mayor a la venta");
			        	$("#ventasModal #error").show();
					} else {
						//tabla.destroy();
						tabla.row.add({id: v1.catalogs_id, name: v1.name}).draw();
// 						tabla.append('<tr>'+ 
// 							'<td>'+moment().format('l')+'</td>'+
// 							'<td data-id="'+$("#ventasModal #selectVenta :selected").val()+'">'+$("#ventasModal #selectVenta :selected").text()+'</td>'+
// 							'<td>'+"$ " + $.number($("#ventasModal #cantidad").val(), 2, ".", ",")+'</td>'+
// 	                        '<td align="center"> '+
// 	                        '	<div class="btn-group">'+
// 							'		<a  href="#" class="btn btn-info btn-flat" title="Editar"><i class="fa fa-check-square-o "></i> Editar</a>'+
// 							'		<a  href="#" class="btn btn-danger btn-flat" title="Borrar"><i class="fa fa-check-square-o "></i> Borrar</a>'+
// 	                        '   </div>'+
// 							'</td>'+     
// 	                    	'</tr>');
// 						tabla = $("#depositosTable").DataTable({
// 					        "language": {
// 					            "url": '{!! asset("bower_components/admin-lte/plugins/datatables/lang/spanish.json") !!}',
// 					            'columnDefs': [
// 				                  			{
// 				                              'targets': 0,
// 				                              'searchable':false,
// 				                              'orderable':false,
// 				                              'className': 'dt-body-center',
// 				                              'render': function (data, type, full, meta){
// 				                                  	return '<input type="checkbox">';
// 				       					}
// 				                   	},   	
// 			                 	],
// 					        }
// 						});
						$("#ventasModal").modal('hide');
					}  
				}  	
	        });
		});
	});
	</script>
@endsection