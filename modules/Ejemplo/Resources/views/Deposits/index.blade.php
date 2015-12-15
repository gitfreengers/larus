@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Depositos</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
        	<div class="box-header">
        	
        	 	<div class="form-group @if ($errors->has('bank')) has-error @endif col-xs-3" >
				    {!! Form::label('bank','Banco',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('bank'))
				            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('bank') }}</label>
				        @endif
				        {!! Form::text('bank',null,['class' => 'form-control','placeholder' => 'Ingrese el banco']) !!}
				    </div>
				</div>
        	 	<div class="form-group @if ($errors->has('date')) has-error @endif col-xs-3" >
				    {!! Form::label('date','Fecha',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('date'))
				            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('date') }}</label>
				        @endif
				        {!! Form::text('date',null,['class' => 'form-control','placeholder' => 'Ingrese la fecha']) !!}
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
				<div class="form-group @if ($errors->has('amount')) has-error @endif col-xs-3">
				    {!! Form::label('amount','Monto',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('amount')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('amount') }}</label>
				        @endif
				        {!! Form::text('amount',null,['class' => 'form-control','placeholder' => 'Ingrese un monto']) !!}
				    </div>
				</div>
				<div class="form-group @if ($errors->has('currency')) has-error @endif col-xs-3">
				    {!! Form::label('currency','Moneda',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('currency')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('currency') }}</label>
				        @endif
				        {!! Form::select('currency',array('1'=>'DOLAR', 2=>'MXN'), null,['class' => 'form-control','placeholder' => 'Ingrese una moneda']) !!}
				    </div>
				</div>
        		<div class="form-group @if ($errors->has('amount')) has-error @endif col-xs-3">
				    {!! Form::label('ledger_account','Cuenta contable',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('ledger_account')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('ledger_account') }}</label>
				        @endif
				        {!! Form::text('ledger_account',null,['class' => 'form-control','placeholder' => 'Ingrese la cuenta contable']) !!}
				    </div>
				</div>
        		<div class="form-group @if ($errors->has('amount')) has-error @endif col-xs-3">
				    {!! Form::label('additional','Complementaria',['class' =>'col-xs-4 control-label']) !!}
				    <div class="col-xs-8">
				        @if ($errors->has('additional')) 
				        	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('additional') }}</label>
				        @endif
				        {!! Form::text('additional',null,['class' => 'form-control','placeholder' => 'Ingrese complemantaria']) !!}
				    </div>
				</div>
				<br>        		
				<br>        		
				<div class="row ">
					<div class="col-lg-12">
		            	<div class="btn-group pull-right ">
		                	<a href="{{route('earrings.create')}}" class="btn btn-success btn-flat"><i class="fa fa-money"></i> Agregar referencia de venta</a>
						</div>
					</div>
				</div>
                <div class="col-lg-10">
                	@include('flash::message')
				</div>
           	</div><!-- /.box-header -->
            <div class="box-body">
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>Fecha</th>
                        <th>Orden</th>
                        <th>Monto</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
	                        <td>15/12/2015</td>
	                        <td>Orden 1</td>
	                        <td>$ 1,000</td>
	                        <td align="center"> 
	                        	<div class="btn-group">
									<a  href="#" class="btn btn-info btn-flat" title="Editar"><i class="fa fa-check-square-o "></i> Editar</a>
									<a  href="#" class="btn btn-danger btn-flat" title="Borrar"><i class="fa fa-check-square-o "></i> Borrar</a>
                                </div>
							</td>   
                        </tr>
                        <tr>
	                        <td>15/12/2015</td>
	                        <td>Orden 2</td>
	                        <td>$ 3,000</td>
	                        <td align="center"> 
	                        	<div class="btn-group">
									<a  href="#" class="btn btn-info btn-flat" title="Editar"><i class="fa fa-check-square-o "></i> Editar</a>
									<a  href="#" class="btn btn-danger btn-flat" title="Borrar"><i class="fa fa-check-square-o "></i> Borrar</a>
                                </div>
							</td> 
                        </tr>
                        <tr>
	                        <td>15/12/2015</td>
	                        <td>Orden 1</td>
	                        <td>$ 5,000</td>
	                        <td align="center"> 
	                        	<div class="btn-group">
									<a  href="#" class="btn btn-info btn-flat" title="Editar"><i class="fa fa-check-square-o "></i> Editar</a>
									<a  href="#" class="btn btn-danger btn-flat" title="Borrar"><i class="fa fa-check-square-o "></i> Borrar</a>
                                </div>
							</td>     
                        </tr>
                    </tbody>
                </table>
                
                <div class="row ">
					<div class="col-lg-12">
		            	<div class="btn-group pull-right ">
		                	<a href="{{route('earrings.create')}}" class="btn btn-success btn-flat"><i class="fa fa-save"></i> Guardar</a>
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

@endsection