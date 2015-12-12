@extends('layout.master')
@section('content')
<div class="col-xs-2 success"  style="display: none; z-index:999; right: 0; position: fixed">
    <div class="alert alert-success alert-dismissable" style="opacity: 0.8">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="icon fa fa-check"></i> <b>Actualización exitosa</b>
    </div>
</div>
<div class="row">
    {!! Form::model($roles, ['route' => ['permissions.update', $roles->id], 'method'=>'PUT','id'=>'form_permission']  ) !!}
    @include('permissions::partials.table')
    {!! Form::close() !!}
</div><!-- /.row -->
@endsection
@section('scripts')
    <!-- permissions script -->
    <script src="{{asset('modules/permissions/js/permissions.js')}}"></script>
@endsection