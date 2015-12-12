@extends('layout.master')
@section('content')
    <div class="content-wrapper ">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                {{ $roles->name }}
                <small>Permisos</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li>Permisos</li>
            </ol>
        </section>
        <div class="col-xs-2 success"  style="display: none; z-index:999; right: 0; position: fixed">
            <div class="alert alert-success alert-dismissable" style="opacity: 0.8">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <i class="icon fa fa-check"></i> <b>Actualización exitosa</b>
            </div>
        </div>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                {!! Form::model($roles, ['route' => ['permissions.update', $roles->id], 'method'=>'PUT','id'=>'form_permission']  ) !!}
                @include('permissions.partials.table')
                {!! Form::close() !!}
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div>
@endsection
@section('scripts')
    <!-- permissions script -->
    {!!Html::script('js/permissions.js')!!}
@endsection