@extends('layout.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Roles
                <small>Nuevo test</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li><a href="{{url('test')}}">test</a></li>
                <li class="active">Nuevo test</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <!-- general form elements disabled -->
                    <div class="box box-default">
                        <div class="box-body">
                            @if(isset($test))
                                {!! Form::model($test,
                                ['route' => ['test.update', $test->id],
                                'method'=>'PUT',
                                'class'=> 'form-horizontal',
                                'id'=>'form_test']  ) !!}
                            @else
                                {!! Form::open(['route' => 'test.store',
                                'method'=>'POST',
                                'class'=> 'form-horizontal',
                                'id'=>'form_test']  ) !!}
                                @endif
                            @include('PackageTest::test.partials.fields')
                            <div class="form-group">
                                <div class="col-sm-offset-10 col-sm-2">
                                    <button type="submit" class="btn btn-primary" id="enviar">Guardar</button>
                                    <a href="{{url('test')}}" class="btn btn-default" >Cancelar</a>
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
