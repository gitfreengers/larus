@extends('layout.master')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
             Alertas
                <small>inicio</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li>Inicio</li>
                <li class="active"></li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class=" col-md-12 text-center">
                    <div class="callout callout-danger">
                        <h1>TAREA NO CONCLUIDA :(</h1>
                        <p>LA tarea <b>{{$task->title}}</b> no se termino a tiempo.</p>
                    </div>
                </div>
            </div>   <!-- /.row -->
        </section>
    </div><!-- /.content-wrapper -->

@endsection