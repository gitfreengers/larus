@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Ventas</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <div class="col-lg-12">
                    @include('flash::message')
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Fecha</th>
                        <th>Orden</th>
                        <th>Cliente</th>
                        <th>Monto</th>
                        <th>Detalles</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
	                        <td>1</td>
	                        <td>15/12/2015</td>
	                        <td>Orden 1</td>
	                        <td>Cliente 1</td>
	                        <td>$ 1,000.00</td>
	                        <td>Detalles 1</td>   
                        </tr>
                        <tr>
	                        <td>2</td>
	                        <td>15/12/2015</td>
	                        <td>Orden 2</td>
	                        <td>Cliente 1</td>
	                        <td>$ 1,450.00</td>
	                        <td>Detalles 3</td>   
                        </tr>
                        <tr>
	                        <td>3</td>
	                        <td>14/12/2015</td>
	                        <td>Orden 2</td>
	                        <td>Cliente 3</td>
	                        <td>$ 44,450.00</td>
	                        <td>Detalles 90990</td>   
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