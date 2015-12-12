@extends('layout.master')
@section('css')
    <link href="{{ asset("bower_components/admin-lte/plugins/datatables/dataTables.bootstrap.css")}}" rel="stylesheet" type="text/css" />
@endsection
@section('content-header')
    <h1>Roles</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <div class="btn-group pull-right">
                        <a href="{{route('roles.create')}}" class="btn btn-success btn-flat"><i class="fa fa fa-plus"></i> Añadir Rol</a>
                    </div>
                    <div class="col-lg-10">
                        @include('flash::message')
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <table id="datatable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <td>#</td>
                            <th>Nombre</th>
                            <th>Acciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($roles as $rol)
                            <tr>
                                <td>{{$rol->id}}</td>
                                <td>{{ $rol->name }}</td>
                                <td>
                                    <div class="btn-group">
                                        <a  href="{{route('roles.edit',$rol->id)}}" class="btn btn-info btn-flat" title="Editar rol"><i class="fa fa-edit"></i> Editar</a>
                                        <a href="{{route('permissions.edit',$rol->id)}}" class="btn btn-default btn-flat" ><i class="fa fa-pencil"></i> Asignar permisos</a>

                                        <button class="btn btn-danger "
                                                data-toggle="confirmation"
                                                data-singleton="true"
                                                data-btn-type="delete"
                                                data-url="{{route('roles.destroy',$rol->id)}}">
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