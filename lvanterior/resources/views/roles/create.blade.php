@extends('layout.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Roles
                <small>Nuevo rol</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{url('roles')}}">Roles</a></li>
                <li class="active">Nuevo rol</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-default">
                        <div class="box-body">
                            @if(isset($roles))
                                {!! Form::model($roles,
                                ['route' => ['roles.update', $roles->id],
                                'method'=>'PUT',
                                'class'=> 'form-horizontal',
                                'id'=>'form_roles']  ) !!}
                            @else
                                {!! Form::open(['route' => 'roles.store',
                                'files'=>'true',
                                'method'=>'POST',
                                'class'=> 'form-horizontal',
                                'id'=>'form_roles']  ) !!}
                                @endif
                            @include('roles.partials.fields')
                            <div class="form-group">
                                <div class="col-sm-offset-10 col-sm-2">
                                    <button type="submit" class="btn btn-primary" id="enviar">Guardar</button>
                                    <a href="{{url('roles')}}" class="btn btn-default" >Cancelar</a>
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
