@extends('layout.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Usuarios
                <small>Nuevo usuario</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li><a href="{{url('users')}}">Usuarios</a></li>
                <li class="active">Nuevo usuario</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-primary">
                        <div class="box-body">
                            {!! Form::open(['route' => 'users.store',
                                            'files'=>'true',
                                            'method'=>'POST',
                                            'id'=>'form_users',
                                            'class'=> 'form-horizontal',
                                            'parsley-validate novalidate' ]  ) !!}
                            <div class="box-body">
                                @include('users.partials.form')
                                </div>
                            <div class="form-group">
                                <div class="col-sm-offset-10 col-sm-2">
                                    <button type="submit" class="btn btn-primary" id="enviar">Guardar</button>
                                    <a href="{{url('users')}}" class="btn btn-default" >Cancelar</a>

                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>   <!-- /.row -->
        </section>
    </div>
@endsection
