@extends('layout.master')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tareas
                <small>inicio</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li>Notificaciones</li>
                <li class="active"> Tareas</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class=" col-md-12 text-center">
                    <!-- general form elements disabled -->
                    <div class="box box-primary">
                        <div class="box-header">
                            <h1>{{$task->title}}</h1>
                        </div>
                        <div class="box-body ">
                            <p>{{$task->description}}</p>
                            <div class="col-md-6">
                                <label>Fecha de inicio: </label>
                                {{ $task->start_time }}
                            </div>
                            <div class="col-md-6">
                                <label>Fecha de expiración: </label>
                                {{ $task->expire_time }}
                            </div>
                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-sm-offset-10 col-sm-2 btn-group">
                                <a href="{{route('tasks.complete',$task->id)}}"
                                   class="btn {{$btn}}" {{$disabled}}>{{$txt}}</a>
                                <a href="{{route('tasks.getindex')}}" class="btn btn-default" >Regresar</a>
                            </div>
                        </div>
                    </div><!-- /.box -->
                </div>
            </div>   <!-- /.row -->
        </section>
    </div><!-- /.content-wrapper -->
@endsection