@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Usuarios</h1>
@endsection
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header">
                <div class="btn-group btn-group-sm pull-right">
                    <a href="{{route('users.create')}}" class="btn btn-success btn-flat"><i class="fa fa-user-plus"></i> Añadir Usuario</a>
                </div>
                <div class="col-lg-12">
                    @include('flash::message')
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Correo eléctronico</th>
                        <th>Ultima conexíon</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->last_login }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-info btn-flat" title="Editar usuario"
                                            ><i class="fa fa-edit"></i> Editar</a>
                                    <button class="btn btn-danger "
                                            data-toggle="confirmation"
                                            data-singleton="true"
                                            data-btn-type="delete"
                                            data-url="{{route('users.destroy',$user->id)}}}">
                                            <i class="fa fa-trash"></i> Eliminar</button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
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