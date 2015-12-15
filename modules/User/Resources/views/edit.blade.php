@extends('layout.master')
@section('content-header')
    <h1>Usuarios
        <small>Editar usuario</small>
    </h1>
@endsection
@section('content')
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
                    @include('user::partials.form')
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

@endsection
