@extends('cpanel::layouts')

@section('header')
<h1>Groups <small>Crear un nuevo grupo</small></h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.groups.index')}}">
        <i class="fa fa-users"></i>
        Grupos
    </a>
</li>
<li class="active">Editar</li>
@stop

@section('content')
<?php
$option = array(
    'route' => array('cpanel.groups.update',$group->id),
    'class' => 'form-horizontal',
    'method' => 'put'
);
?>
{{ Form::model($group,$option) }}
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Informacion de los grupos</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Nombre</label>
                    <div class="col-md-4">
                        {{Form::text('name',null,array('class'=>'form-control','placeholder'=>'Nombre del grupo'))}}
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
                <h3 class="panel-title">Permisos del grupo</h3>
            </div>
            <div class="panel-body">
                @include('cpanel::groups.permissions_form')
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