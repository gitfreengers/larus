@extends('layout.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Usuarios
                <small>Actualizar usuario</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li><a href="{{url('admin/users')}}">Usuarios</a></li>
                <li class="active">Actualizar usuario</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-primary">
                        <div class="box-body">
                            {!! Form::model($users,
                                            ['route' => ['users.update', $users->id],
                                             'method'=>'PUT',
                                            'class'=> 'form-horizontal',
                                             'files'=>'true',
                                             'id'=>'form_user']  ) !!}
                            @include('users.partials.form')
                            <div class="form-group">
                                <div class="col-sm-offset-10 col-sm-2">
                                    <button type="submit" class="btn btn-primary" id="enviar">Actualizar</button>
                                    <a href="{{url('users')}}" class="btn btn-default" >Cancelar</a>

                                </div>
                            </div>
                            {!! Form::close() !!}
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>   <!-- /.row -->
        </section><!-- /.content -->
    </div>
@endsection
