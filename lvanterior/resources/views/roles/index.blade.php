@extends('layout.master')
@section('css')
    <!-- DATA TABLES -->
    {!! Html::style('plugins/datatables/dataTables.bootstrap.css') !!}
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Roles
                <small>Inicio</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li class="active">Roles</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">

                        <div class="box-header">
                            @include('layout.messages')
                            <div class="btn-group col-xs-offset-10">
                                <a href="{{route('roles.create')}}" class="btn btn-success" title="Añadir nuevo rol"><i class="fa fa-user-plus"></i></a>
                            </div>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $rol)
                                    <tr>
                                        <td>{{ $rol->name }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a  href="{{route('roles.edit',$rol->id)}}" class="btn btn-info btn-flat" title="Editar rol"><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="btn btn-danger helpModal"  data-id="{{ $rol->id }}" data-path="roles"
                                                   data-toggle="modal" data-target="{{ (\Cartalyst\Sentinel\Native\Facades\Sentinel::hasAccess(['role.delete']))? '#md-default': '#md-acceso'}}" title="Eliminar rol"><i class="fa fa-times"></i></a>
                                                <a href="{{route('permissions.edit',$rol->id)}}" class="btn btn-info btn-flat" ><i class="fa fa-pencil"></i> Asignar permisos</a>
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
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
    @include('layout.modals.modal')
@endsection
@section('scripts')
    <!-- DATA TABES SCRIPT -->
    {!! Html::script('plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('plugins/datatables/dataTables.bootstrap.min.js') !!}
    <!-- page script -->
    <script type="text/javascript">
        $(function () {
            $("#example1").dataTable();
        });
    </script>

@endsection