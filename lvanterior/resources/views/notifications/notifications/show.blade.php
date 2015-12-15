@extends('layout.master')
@section('content')

    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Notificaciones
                <small>inicio</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li>Inicio</li>
                <li class="active">Notificaciones</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class=" col-md-12 text-center">
                    <!-- general form elements disabled -->
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class=" col-md-offset-2 col-md-9">
                                <h1>{{$notification->title}}</h1>

                                <p>{{$notification->description}}</p>
                                <a href="{{ $notification->url }}" target="_blank">{{ $notification->url }}</a>

                            </div>

                        </div><!-- /.box-body -->
                        <div class="box-footer">
                            <div class="col-sm-offset-10 col-sm-2">
                                <a href="{{url('notifications/notifications')}}" class="btn btn-default" >Regresar</a>
                            </div>
                        </div>
                    </div><!-- /.box -->
                </div>
            </div>   <!-- /.row -->
        </section>
    </div><!-- /.content-wrapper -->

@endsection