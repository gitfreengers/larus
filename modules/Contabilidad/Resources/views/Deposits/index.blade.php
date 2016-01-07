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
            	<div class="row">
    				<div class="col-md-12">
		            	<div class="form-group col-md-3 col-xs-12" >
						    {!! Form::label('banco','Banco: ',['class' =>'col-xs-4 control-label']) !!}
						    <div class="col-xs-12 @if ($errors->has('banco')) has-error @endif ">
						        @if (!isset($deposito->id))
						        	{!! Form::select('banco', $cuentas, null,['class' => 'form-control','placeholder' => 'Seleccione la cuenta','id'=>'bancoSel']) !!}
						        	{!! Form::select('banco', $cuentasDls, null,['class' => 'form-control','placeholder' => 'Seleccione la cuenta','id'=>'bancoSelDls', 'style'=>'display:none']) !!}
						        @else	
						        	{!! $deposito->banco !!}
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
						        	{!! $deposito->fecha !!}
						        @endif
						        @if ($errors->has('fecha'))
						            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('fecha') }}</label>
						        @endif
						    </div>
						</div>
						<div class="form-group col-md-3 col-xs-12" >
						    {!! Form::label('monto','Monto: ',['class' =>'col-xs-4 control-label']) !!}
						    <div class="col-xs-12 @if ($errors->has('monto')) has-error @endif ">
						        @if (!isset($deposito->id))
							        {!! Form::text('monto', $deposito->monto,['class' => 'form-control','placeholder' => 'Ingrese una cantidad']) !!}
						        @else	
						        	{!! '$ '.number_format($deposito->monto, 2) !!}
						        	{!! Form::hidden('monto', $deposito->monto,['class' => 'form-control','placeholder' => 'Ingrese una cantidad']) !!}
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
							        {!! Form::select('moneda', array('1'=>'MXN', 2=>'DOLAR'), $deposito->moneda,['class' => 'form-control','placeholder' => 'Ingrese una moneda', 'id'=>'monedaSel']) !!}
						        @else	
						        	{!! $deposito->moneda == 1? 'MXN' : 'DOLAR' !!}
						        @endif
						        @if ($errors->has('moneda')) 
						        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('moneda') }}</label>
						        @endif
						    </div>
						</div>
					</div>
				</div>
				<div class="row">
    				<div class="col-md-12">
						<div class="form-group col-md-3 col-xs-12" >
		        		    {!! Form::label('cuenta_contable','Cuenta contable: ',['class' =>'col-xs-12 control-label']) !!}
						    <div class="col-xs-12 @if ($errors->has('cuenta_contable')) has-error @endif ">
						        @if (!isset($deposito->id))
						        	{!! Form::text('cuenta_contable', $deposito->cuenta_contable,['readonly'=>'readonly','class' => 'form-control','placeholder' => 'Ingrese la cuenta contable','id'=>'cuentacontable']) !!}
						        @else	
						        	{!! $deposito->cuenta_contable!!}
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
						        	{!! Form::text('complementaria', $deposito->complementaria,['class' => 'form-control','placeholder' => 'Ingrese complementaria', 'id'=>'complementaria']) !!}
						        @else	
						        	{!! $deposito->complementaria!!}
						        @endif
						        @if ($errors->has('complementaria')) 
						        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('complementaria') }}</label>
						        @endif
						    </div>
						</div>
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
			            		{!! Form::text('referencia', null,['class' => 'form-control', 'placeholder' => 'Ingrese referencia', 'id'=>'buscarReferencia']) !!}
			            		<!-- 
			                	<a href="#" id="agregarReferencia" class="btn btn-success btn-flat"><i class="fa fa-money"></i> Agregar referencia de venta</a>
			            		 -->
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12" >
							<span id="errorReferencia" style="display:none">
								<div class="alert alert-danger" >
			            			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						            <span id="msg"></span>
			        			</div>
							</span>
						</div>
		            </div>	
					<br>
	                <table id="depositosTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
	                    <thead>
		                    <tr>
		                    	<th rowspan="2">Id</th>
		                        <th rowspan="2">Fecha</th>
				                <th rowspan="2">MontoO</th>
				                <th colspan="6" align="center">Orden</th>
				                <th rowspan="2">Saldo pendiente por aplicar <br>(<span id='montoTotal' data-monto='{{$deposito->monto}}'>$ {{number_format ($deposito->monto, 2)}}</span>)</th>
		                        <th rowspan="2"></th>
				            </tr>
		                    <tr>
		                        <th>Referencia</th>
		                        <th>Plaza Origen</th>
		                        <th>Plaza Destino</th>
		                        <th>Factura</th>
		                        <th>Fecha</th>
		                        <th>Saldo Original</th>
		                    </tr>
	                    </thead>
	                    <tbody></tbody>
	                     
	                    <tfoot>
	                    	<tr>
		                    	<th colspan='9' style='text-align:right !important'>Suma aplicada</th>
		                        <th id='total' data-suma='0' style='text-align:right !important'></th>
				                <th ></th>		                        
		                    </tr>
	                    </tfoot>
	                    
	                    
	                </table>
					<br>
	                <div class="row ">
						<div class="col-lg-12">
			            	<div class="btn-group pull-right ">
			                	<a href="#" id="guardarReferencias" disabled='disabled' class="btn btn-success btn-flat"><i class="fa fa-save"></i> Guardar referencias</a>
							</div>
						</div>
					</div>
					
					{!! Form::open(['route' => 'contabilidad.depositos.guardarReferencias','method'=>'POST','id'=>'referenciasForm','parsley-validate novalidate' ]) !!}
            			{!! Form::hidden('referencias', $deposito->depositosaplicados, ['id' => 'referencias']) !!}	
            			{!! Form::hidden('deposito_id', $deposito->id, ['id' => 'deposito_id']) !!}	
            			@if (isset($deposito->id))
            				{!! Form::hidden('deposito', $deposito) !!}
            			@endif
            		{!! Form::close() !!}
				
				@endif	
            </div><!-- /.box-body -->
        </div><!-- /.box -->
    </div><!-- /.col -->
</div><!-- /.row -->


<!-- modal referencias-->
<div class="modal fade" id="ventasModal" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="modalTitle">Seleccione la venta</h4>
			</div>
			<div class="modal-body">
				<span id="error">
					<div class="alert alert-danger" >
            			<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			            <span id="msg"></span>
        			</div>
				</span>
				<span id="content">
					<form>
						<div class="form-group">
							<label>Cantidad</label>
							<input id="cantidad" class="form-control">
						</div>
					</form>
				</span>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default btn-flat" data-dismiss="modal">Cerrar</button>
				<button type="button" id="addBtn" class="btn btn-success">Guardar</button>
			</div>
		</div>
	</div>
</div>

<!-- modal advertencia -->
<div class="modal fade modal-danger" id="exitModal" tabindex="-1" role="basic" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title" id="modalTitle">Cancelar deposito</h4>
			</div>
			<div class="modal-body">
				Aun no se ha guardado los datos del deposito, si sale se cancelara toda la información registrada <br>¿Esta seguro de salir?
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Continuar en depositos</button>
				<button type="button" id="exitBtn" class="btn btn-outline">Salir</button>
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
    <script src="{{asset('bower_components/admin-lte/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js') }}" type="text/javascript"></script>
    <script src="{{asset('bower_components/admin-lte/plugins/select2/select2.full.js') }}" type="text/javascript"></script>
    
    <script src="{{ asset ("bower_components/admin-lte/plugins/datepicker/bootstrap-datepicker.js") }}" type="text/javascript"></script>
	<script src="{{ asset ("bower_components/admin-lte/plugins/datepicker/locales/bootstrap-datepicker.es.js") }}" type="text/javascript"></script>
	
	<script src="{{ asset ("bower_components/admin-lte/plugins/jquery-number/jquery.number.min.js") }}" type="text/javascript" ></script>
	<script src="{{ asset ("bower_components/admin-lte/plugins/moment/moment-with-locales.js") }}" type="text/javascript" ></script>
		
<script>
	var reDrawTable = function(api){

		$( '[data-toggle="confirmation"]').confirmation({
            title:'¿Esta seguro que desea eliminar este registro.?',
            popout:true,
            singleton:true,
            btnOkClass: 'btn-xs btn-success ',
            btnOkIcon: 'fa fa-check',
            btnOkLabel: 'Si',
            btnCancelClass: 'btn-xs btn-danger',
            btnCancelIcon: 'fa fa-times',
            btnCancelLabel: 'No',
            onConfirm: function () {
                if( $(this).data('btn-type') && $(this).data('btn-type') === 'delete' ) {
                    tabla.row( $(this).parents('tr') ).remove().draw();
                }
            }
        });
		suma = 0;
		tabla.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
		    var data = this.data();
			if (parseFloat(data.monto) >= 0){
				suma += parseFloat(data.monto);
			}
		} );

		$("span#montoTotal").html("$ " + $.number(($("#monto").val() - suma), 2, ".", ",")).data('monto', ($("#monto").val() - suma));
		
		$("th#total").html("$ " + $.number(suma, 2, ".", ",")).data('suma', suma);

		if (suma == $("#monto").val()){
			$('#guardarReferencias').removeAttr('disabled');
		} else {
			$('#guardarReferencias').attr('disabled', true);
		}
	};

	var abreModal = function(isNew, rowEdicion) {
		var objEdicion = null;
		var references = [];
		if (!isNew){
			objEdicion = rowEdicion.data();
		}
		
		$("#ventasModal").modal();
		$("#ventasModal #error").hide();
		$("#ventasModal #cantidad").val('');
		
		tabla.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
		    var data = this.data();
			references.push(data.id);
		} );	

		if (!isNew){
			$("#ventasModal #cantidad").val(objEdicion.monto);
		}

		$("#ventasModal #addBtn").off();
		$("#ventasModal #addBtn").on("click", function() {
			verificaReferencia(isNew, rowEdicion, references);
        });
	    
	}

	var verificaReferencia = function(isNew, rowEdicion, references){

		var cantidadMax = parseFloat((rowEdicion.data().cantidad == "---")? $("#monto").val() : rowEdicion.data().monto);
		console.log(cantidadMax);
		var cantidad = parseFloat($("#ventasModal #cantidad").val());
		var total = parseFloat($("th#total").data('suma'));
		var monto = parseFloat($("#monto").val());
		var id = -1;

		errores = '';

		if (!isNew){
			var suma = 0;
			tabla.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
			    var data = this.data();
				suma += parseFloat(data.monto);
			} );
			total = suma - parseFloat(rowEdicion.data().monto);
		}

		if ($("#ventasModal #cantidad").val() == "" ){
			errores = "Ingrese todos los datos";
		}else{
			
			if (!$.isNumeric($("#ventasModal #cantidad").val())){
				errores = "El monto solo puede ser numerico";
	        }

	        if ($("#ventasModal #cantidad").val() <= 0){
	        	errores = "El monto debe ser mayor a 0"
	        }
					
			if (errores == ''){
				if (cantidad > cantidadMax) {
					errores = "El monto a aplicar no puede exceder a la cantidad de la venta";
				} else if ((parseFloat(cantidad) + parseFloat(total)) > monto) {
					errores = "El monto para aplicar no puede ser mayor al deposito";
				} else {
					var data = rowEdicion.data(); 
					data.monto = cantidad;
					data.montoF = "$ " + $.number($("#ventasModal #cantidad").val(), 2, ".", ",");
					rowEdicion.data(data).draw();
					
					tabla.columns.adjust().draw();
					$("#ventasModal").modal('hide');				
				}
			}  
		}

		if (errores != ''){
			$("#ventasModal #msg").html(errores);
	    	$("#ventasModal #error").show();
	    }
		
	};
	
	$(document).ready(function(){

		//desactivar enter
		$(document).keypress(function(e) {
	        if (e.which == 13) {
	            return false;
	        }
	    });

	    //preguntar si desea cancelar depositos
	    var url = "";
	    $("a:not(.content)").on("click", function (e) {
			e.preventDefault(); 
			url = $(this).attr('href');
			if (url != '#'){
				$("#exitModal").modal();
				return false;
			}
	    });

	    $("#exitBtn").on("click", function(){
		    window.location = url;
		});

	    //eventos de depositos
	    $("#fecha").datepicker({
			language: 'es',
			format:'yyyy-mm-dd',
			todayHighlight: true
		});

		$("#bancoSel").on("change", function(){
			var data = $(this).val().split("|");
			$("#cuentacontable").val(data[1]);
			$("#complementaria").val(" ");
		});
		
		$("#bancoSelDls").on("change", function(){
			var data = $(this).val().split("|");
			$("#cuentacontable").val(data[1]);
			$("#complementaria").val(data[2]);
		});

		$("#monedaSel").on("change", function(){
			if ($(this).val() == 1){//MXN
			    $("#bancoSelDls").hide().attr("name", "");
			    $("#bancoSel").show().trigger("change").attr("name", "banco");
			    $("#complementaria").val("").attr("readonly", "readonly");
				
			}else{
			    $("#bancoSelDls").show().trigger("change").attr("name", "banco");
			    $("#bancoSel").hide().attr("name", "");
			    $("#complementaria").removeAttr("readonly");
			}
		});
	    $("#monedaSel").trigger("change");

	    $("#buscarReferencia").on("keypress", function(e){
		    if (e.which == 13) {
		    	var valor = $("#buscarReferencia").val();
    			$("#errorReferencia").hide();
	    		var references = [];
	    		var salesReference = [];
	    		tabla.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
	    		    var data = this.data();
	    			references.push(data.id);
	    			references.push(data.referencia);
	    		} );
	    		
	    		if (references.indexOf(valor) >= 0){
	    			$("#errorReferencia").show();
	    			$("#errorReferencia #msg").html("Esta referencia ya ha sido ingresada en la tabla ");
	    		}else{
	    			$.get('{{route("contabilidad.ventas.obtenerVentas")}}', {'referencia': $("#buscarReferencia").val()}, function(res){
		    			if (res.items.length == 0){
		    				salesReference = {
									id: valor, 
									fecha: moment().format('YYYY-MM-DD'), 
									referencia: "Nueva referencia: " + valor,
						        	plazaOrigen: "---",
						        	plazaDestino: "---",
						        	factura: "---",
						        	fechaO: "----",
						        	cantidad: "---",
									monto: 0,
									montoF: "$ " + $.number('0', 2, ".", ","),
									isNew: true
							};
				    	} else {
			    			$.each(res.items, function(i, v1){
				    			salesReference = {
									id: v1.reference, 
									fecha: moment().format('YYYY-MM-DD'),
									referencia: v1.reference,
						        	plazaOrigen: v1.op_location,
						        	plazaDestino: v1.cl_location ,
						        	factura: v1.factura_number,
						        	fechaO: v1.date,
						        	cantidad: "$ " + $.number(v1.ammount, 2, ".", ","),
									monto: (v1.ammount - v1.ammount_applied),
									montoF: "$ " + $.number((v1.ammount - v1.ammount_applied), 2, ".", ","),
									isNew: true
								};
			    			});					    	
					    }
			    		
		    			tabla.row.add(salesReference).draw();
		    		});	
		    	}
		    	
	    		$("#buscarReferencia").val("");
	    		$("#buscarReferencia").focus();	
	        }
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
	        	{"data": "monto"},
	        	{"data": "referencia"},
	        	{"data": "plazaOrigen"},
	        	{"data": "plazaDestino"},
	        	{"data": "factura"},
	        	{"data": "fechaO"},
	        	{"data": "cantidad"},
	        	{"data": "montoF"},
	        	{"data": "isNew"},
	        ],
	        'columnDefs': [
				{
					'targets': [0, 2],
					"visible": false,
				}, {
					'targets': 1,
					'render': function (data, type, full, meta){
						return moment(data, 'YYYY-MM-DD').format('L');
					}
				}, {
					'targets': 9,
					'className': 'text-right'
				}, {	
                	'targets': 10,
                    'render': function (data, type, full, meta){
                            return 	'<div class="pull-right btn-group">'+
                            			'<a href="#" class="btn btn-info btn-flat" title="Editar" data-toggle="edit" data-id="'+ full.id +'"><i class="fa fa-check-square-o "></i> Editar</a>'+
                            			"<button class='btn btn-danger' data-toggle='confirmation' data-singleton='true' data-btn-type='delete' data-url='" + full.id + "'> <i class='fa fa-trash'></i> Eliminar</button>"
									'</div>';                        
					}
            	},   	
          	],          	
	    });
	    
		referenciasVal = $("#referencias").val() == null ? null : JSON.parse($("#referencias").val());
	    if(referenciasVal){
		    $.each(referenciasVal, function(k1, v1){
			    tabla.row.add({
					id: v1.venta.reference, 
					fecha: v1.created_at, 
					orden: "Referencia: "+v1.venta.reference + " Plaza Origen: " + v1.venta.op_location+ " Plaza destino: " + v1.venta.cl_location + "  Factura: " + v1.venta.factura_number + " Fecha: " + v1.venta.date + " $" + $.number(v1.venta.ammount, 2, ".", ","),
					monto: v1.cantidad,
					montoF: "$ " + $.number(v1.cantidad, 2, ".", ","),
					isNew: false
				}).draw();
				
				tabla.columns.adjust().draw();
	    	});          
		}
		
	    tabla.on( 'draw.dt', function () {
	    	reDrawTable(tabla);
	    } );

		//boton guardar
		$('#guardarReferencias').on("click", function(){
			if ($('#guardarReferencias').attr('disabled') == undefined) // si esta activo
				$("#referenciasForm").submit();
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
	    
	   	$(document).on('click','[data-toggle="edit"]', function(){
	    	abreModal(false, tabla.row( $(this).parents('tr') ));
	    });
		
	});
	</script>
@endsection