@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("bower_components/admin-lte/plugins/select2/select2.css")}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset("bower_components/admin-lte/plugins/datepicker/datepicker3.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Depositos</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
        	<div class="box-header">
            	{!! Form::open(['route' => 'contabilidad.depositos.store','method'=>'POST','id'=>'DepositosForm','parsley-validate novalidate' ]) !!}
        	    <div class="form-group col-md-3 col-xs-12" >
				    {!! Form::label('banco','Banco: ',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-12 @if ($errors->has('banco')) has-error @endif ">
				        @if (!isset($deposito->id))
				        	{!! Form::text('banco', $deposito->banco,['class' => 'form-control','placeholder' => 'Ingrese el banco']) !!}
				        @else	
				        	{!! Form::label('banco', $deposito->banco,['class' => 'control-label','placeholder']) !!}
				        @endif
				        @if ($errors->has('banco'))
				            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('banco') }}</label>
				        @endif
				    </div>
				</div>
        	 	<div class="form-group col-md-3 col-xs-12" >
				    {!! Form::label('fecha','Fecha: ',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-12 @if ($errors->has('fecha')) has-error @endif">
				        @if (!isset($deposito->id))
					        {!! Form::text('fecha', $deposito->fecha,['class' => 'form-control','placeholder' => 'Ingrese la fecha', 'id'=>'fecha']) !!}
				        @else	
				        	{!! Form::label('fecha', $deposito->fecha,['class' => 'control-label','placeholder']) !!}
				        @endif
				        @if ($errors->has('fecha'))
				            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('fecha') }}</label>
				        @endif
				    </div>
				</div>
				<div class="form-group col-md-3 col-xs-12" >
				    {!! Form::label('referencia','Referencia: ',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-12 @if ($errors->has('referencia')) has-error @endif ">
				        @if (!isset($deposito->id))
					        {!! Form::text('referencia', $deposito->referencia,['class' => 'form-control','placeholder' => 'Ingrese un referenciae']) !!}
				        @else	
				        	{!! Form::label('referencia', $deposito->referencia,['class' => 'control-label','placeholder']) !!}
				        @endif				        
				        @if ($errors->has('referencia')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('referencia') }}</label>
				        @endif
				    </div>
				</div>
				<div class="form-group col-md-3 col-xs-12" >
				    {!! Form::label('monto','Monto: ',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-12 @if ($errors->has('monto')) has-error @endif ">
				        @if (!isset($deposito->id))
					        {!! Form::text('monto', $deposito->monto,['class' => 'form-control','placeholder' => 'Ingrese una cantidad']) !!}
				        @else	
				        	{!! Form::label('monto', $deposito->monto,['class' => 'control-label','placeholder']) !!}
				        @endif
				        @if ($errors->has('monto')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('monto') }}</label>
				        @endif
				    </div>
				</div>
				<div class="form-group col-md-3 col-xs-12" >
				    {!! Form::label('moneda','Moneda: ',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-12 @if ($errors->has('moneda')) has-error @endif ">
				        @if (!isset($deposito->id))
					        {!! Form::select('moneda', array('1'=>'DOLAR', 2=>'MXN'), $deposito->moneda,['class' => 'form-control','placeholder' => 'Ingrese una moneda']) !!}
				        @else	
				        	{!! Form::label('moneda', $deposito->moneda,['class' => 'control-label','placeholder']) !!}
				        @endif
				        @if ($errors->has('moneda')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('moneda') }}</label>
				        @endif
				    </div>
				</div>
				<div class="form-group col-md-3 col-xs-12" >
        		    {!! Form::label('cuenta_contable','Cuenta contable: ',['class' =>'col-xs-12 control-label']) !!}
				    <div class="col-xs-12 @if ($errors->has('cuenta_contable')) has-error @endif ">
				        @if (!isset($deposito->id))
				        	{!! Form::text('cuenta_contable', $deposito->cuenta_contable,['class' => 'form-control','placeholder' => 'Ingrese la cuenta contable']) !!}
				        @else	
				        	{!! Form::label('cuenta_contable', $deposito->cuenta_contable,['class' => 'control-label','placeholder']) !!}
				        @endif	
				        @if ($errors->has('cuenta_contable')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('cuenta_contable') }}</label>
				        @endif
				    </div>
				</div>
				<div class="form-group col-md-3 col-xs-12" >
				    {!! Form::label('complementaria','Complementaria: ',['class' =>'col-xs-6 control-label']) !!}
				    <div class="col-xs-12 @if ($errors->has('complementaria')) has-error @endif ">
				        @if (!isset($deposito->id))
				        	{!! Form::text('complementaria', $deposito->complementaria,['class' => 'form-control','placeholder' => 'Ingrese complemantaria']) !!}
				        @else	
				        	{!! Form::label('complementaria', $deposito->complementaria,['class' => 'control-label','placeholder']) !!}
				        @endif
				        @if ($errors->has('complementaria')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('complementaria') }}</label>
				        @endif
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
					<br>
	                <table id="depositosTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                    <thead>
		                    <tr>
		                    	<th>Id</th>
		                        <th>Fecha</th>
		                        <th>Orden</th>
		                        <th>MontoO</th>
		                        <th>Monto</th>
		                        <th></th>
		                    </tr>
	                    </thead>
	                    <tbody></tbody>
	                    <tfoot>
		                    <tr>
		                    	<th></th>
		                        <th></th>
		                        <th style='text-align:right !important'>Suma aplicada</th>
		                        <th></th>
		                        <th id='total' data-suma='0'></th>
		                        <th></th>
		                    </tr>
	                    </tfoot>
	                </table>
					<br>
	                <div class="row ">
						<div class="col-lg-12">
			            	<div class="btn-group pull-right ">
			                	<a href="#" id="guardarReferencias" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Guardar referencias</a>
							</div>
						</div>
					</div>
					
					{!! Form::open(['route' => 'contabilidad.depositos.guardarReferencias','method'=>'POST','id'=>'referenciasForm','parsley-validate novalidate' ]) !!}
            			{!! Form::hidden('referencias', $deposito->depositosaplicados, ['id' => 'referencias']) !!}	
            			{!! Form::hidden('deposito_id', $deposito->id, ['id' => 'deposito_id']) !!}	
            		{!! Form::close() !!}
				
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
				<button type="button" id="addBtn" class="btn btn-success">Agregar</button>
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
	<script src="{{ asset ("bower_components/admin-lte/plugins/moment/moment-with-locales.js") }}" type="text/javascript" ></script>
	
	<script>
	$(document).ready(function(){
		$('#guardarReferencias').hide();
	 	$("#fecha").datepicker({
			language: 'es',
			format:'yyyy-mm-dd',
			todayHighlight: true
		});
		// data tables
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
	           	{"data": "fecha"},
	        	{"data": "orden"},
	        	{"data": "monto"},
	        	{"data": "montoF"},
	        	{"data": "isNew"},
	        ],
	        'columnDefs': [
				{
					'targets': [0, 3],
					"visible": false,
				}, {	
                	'targets': 5,
                    'searchable':false,
                    'orderable':false,
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta){
                    	return 	'<div class="pull-right btn-group"><a  href="#" class="btn btn-info btn-flat" title="Editar"><i class="fa fa-check-square-o "></i> Editar</a>'+
 								'<a  href="#" class="btn btn-danger btn-flat" title="Borrar"><i class="fa fa-trash "></i> Borrar</a></div>';
					}
            	},   	
          	],
	    });
		referenciasVal = $("#referencias").val() == "" ? null : JSON.parse($("#referencias").val());
		suma = $("th#total").data('suma');
	    if(referenciasVal){
		    $.each(referenciasVal, function(k1, v1){
	    		tabla.row.add({
					id: v1.venta_id, 
					fecha: v1.created_at, 
					orden: "Referencia: "+v1.venta.reference + " Factura: " + v1.venta.factura_number + " Fecha: " + v1.venta.date + " $" + $.number(v1.venta.ammount, 2, ".", ","),
					monto: v1.cantidad,
					montoF: "$ " + $.number(v1.cantidad, 2, ".", ","),
					isNew: false
				}).draw();
				suma += v1.cantidad;
				tabla.columns.adjust().draw();
	    	});
	    	$("th#total").html("$ " + $.number(suma, 2, ".", ",")).data('suma', suma);		    
		}
	    
	   $("#agregarReferencia").on('click', function(){
			$("#ventasModal").modal();
			$("#ventasModal #error").hide();
			$("#ventasModal #cantidad").val('');

			$.get('{{route("contabilidad.ventas.obtenerVentas")}}', function(res){
				$("#selectVenta").html("<option value=''>Seleccione...</option>");
				$.each(res.items, function(i,v){
					$("#selectVenta").append("<option value='"+v.id+"' data-cantidad='"+v.ammount+"'>"+"Referencia: "+v.reference + " Factura: " + v.factura_number + " Fecha: " + v.date + " $" + $.number(v.ammount, 2, ".", ",")+"</option>");
				});
				$(".select2").select2();
			});

			$("#selectVenta").on("change", function(){
				$("#ventasModal #cantidad").val($("#selectVenta :selected").data('cantidad'));
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
						tabla.row.add({
							id: $("#ventasModal #selectVenta :selected").val(), 
							fecha: moment().format('l'), 
							orden: $("#ventasModal #selectVenta :selected").text(),
							monto: $("#ventasModal #cantidad").val(),
							montoF: "$ " + $.number($("#ventasModal #cantidad").val(), 2, ".", ","),
							isNew: true
						}).draw();
						tabla.columns.adjust().draw();
						$("#ventasModal").modal('hide');

						$('#guardarReferencias').show();
					}  
				}  	
	        });

			$("#referenciasForm").submit( function(e){
		    	var currentForm = this;
		    	e.preventDefault();
		    	var data = [];
		    	$.each(tabla.rows().data(), function(k, v){
		    		data.push(v);
		    	});
		    	$("#referencias").val(JSON.stringify(data));
		    	currentForm.submit();
		    });
		    
			$('#guardarReferencias').on("click", function(){
				$("#referenciasForm").submit();
			});
		});
	});
	</script>
@endsection