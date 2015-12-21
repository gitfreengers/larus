@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Pendientes por conciliar</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
        
        	<div class="box-header">
            	<div class="btn-group pull-right">
                	<a href="{{route('contabilidad.pendientes.create')}}" class="btn btn-success btn-flat"><i class="fa fa-money"></i> Depositos</a>
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
                        <th>Tipo de movimiento</th>
                        <th>Persona</th>
                        <th>Referencia</th>
                        <th>Conciliar</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
	                        <td>15/12/2015</td>
	                        <td>Factura: xxxx</td>
	                        <td>Cliente 1</td>
	                        <td>TXC0900990</td>
	                        <td align="center"> 
	                        	<div class="btn-group">
									<a  href="#" class="btn btn-info btn-flat" title="Conciliar"><i class="fa fa-check-square-o "></i> Conciliar</a>
                                </div>
							</td>   
                        </tr>
                        <tr>
	                        <td>15/12/2015</td>
	                        <td>Deposito </td>
	                        <td>Bancomer</td>
	                        <td>Aut. 445</td>
	                        <td align="center"> 
	                        	<div class="btn-group">
									<a  href="#" class="btn btn-info btn-flat" title="Conciliar"><i class="fa fa-check-square-o "></i> Conciliar</a>
                                </div>
							</td>   
                        </tr>
                        <tr>
	                        <td>15/12/2015</td>
	                        <td>Factura: xxxx</td>
	                        <td>Cliente B</td>
	                        <td>TAC90843</td>
	                        <td align="center"> 
	                        	<div class="btn-group">
									<a  href="#" class="btn btn-info btn-flat" title="Conciliar"><i class="fa fa-check-square-o "></i> Conciliar</a>
                                </div>
							</td>     
                        </tr>
                    </tbody>
                </table>
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