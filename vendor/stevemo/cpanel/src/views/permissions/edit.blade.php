@extends('cpanel::layouts')

@section('header')
<h1>Permisos</h1>
@stop

@section('breadcrumb')
@parent
<li>
    <a href="{{route('cpanel.permissions.index')}}">
        <i class="fa fa-ban"></i> Permisos
    </a>
</li>
<li class="active">Crear</li>
@stop

@section('content')
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Crear nuevos permisos para un modulo</h3>
            </div>
            <div class="panel-body">
                <?php
                $option = array(
                    'route' => array('cpanel.permissions.update',$permission->id),
                    'class' => 'form-horizontal',
                    'method' => 'put'
                );
                ?>
                {{ Form::model($permission,$option) }}
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Nombre del modulo</label>
                    <div class="col-md-4">
                        {{ Form::text('name',null,array('class'=>'form-control','placeholder'=>'Nombre del modulo')) }}
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-2 control-label" for="name">Permisos del modulo</label>
                    <div class="col-md-4">
                        {{ Form::text('permissions',$permission->getRules(),
                        array('class'=>'form-control','placeholder'=>'Permisos del modulo','id'=>'permission-tags')) }}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@stop