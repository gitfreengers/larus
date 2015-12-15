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
                Tareas
                <small>inicio</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li class="active">Tareas</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-header">
                            @include('layout.messages')

                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <div class="btn-group col-xs-offset-10">
                                <a href="{{route('tasks.create')}}" class="btn btn-success" title="Añadir nueva notificación"><i class="fa fa-bell-o"></i></a>
                            </div>
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Título</th>
                                    <th>Descripción</th>
                                    <th>Fecha de creación</th>
                                    <th>Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tasks as $task)
                                    <tr>
                                        <td>{{ $task->title}}</td>
                                        <td>{{ str_limit($task->description, 30) }}</td>
                                        <td>{{ $task->created_at }}</td>
                                        <td>
                                            <div class="btn-group">
                                                <a href="{{route('tasks.edit',$task->id)}}" class="btn btn-info btn-flat" title="Editar usuario"
                                                        ><i class="fa fa-pencil"></i></a>
                                                <a href="#" class="btn btn-danger helpModal"  data-id="{{ $task->id }}" data-path="tasks" data-toggle="modal"
                                                   data-target="{{ (\Cartalyst\Sentinel\Native\Facades\Sentinel::hasAccess(['task.delete']))? '#md-default': '#md-acceso'}}" title="Eliminar notificación"><i class="fa fa-times"></i></a>
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
            $("#example1").dataTable({
                "order": [[ 3, "desc" ]]
            });

        });
    </script>
@endsection