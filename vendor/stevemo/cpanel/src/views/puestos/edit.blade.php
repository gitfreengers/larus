@extends('cpanel::layouts')

@section('header')
<h1>Puestos <small>Crear nuevo puesto</small></h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.puestos.index')}}">
        <i class="fa fa-users"></i>
        Puestos
    </a>
</li>
<li class="active">Editar</li>
@stop

@section('content')
<?php
$option = array(
    'route' => array('cpanel.puestos.update',$puesto->id),
    'class' => 'form-horizontal',
    'method' => 'put'
);
?>
{{ Form::model($puesto,$option) }}
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Informacion de puestos</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Nombre</label>
                    <div class="col-md-4">
                        {{Form::text('name',null,array('class'=>'form-control','placeholder'=>'Nombre del puesto'))}}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Permisos del puesto</h3>
            </div>
            <div class="panel-body">
                @include('cpanel::puestos.permissions_form')
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}
@stop