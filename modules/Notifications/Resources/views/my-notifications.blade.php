@extends('layout.master')
@section('css')
@endsection
@section('content-header')
    <h1>Mis Notificaciones</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#noread" data-toggle="tab">No leidos</a></li>
                    <li><a href="#reads" data-toggle="tab">Leidas</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="noread">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover task-table">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($noread as $notification)
                                            <tr style="cursor: pointer">
                                                <td data-toggle="notification-modal"  data-id="" data-url="{{route('notifications.loadJsModal',$notification->id)}}">{{$notification->name}}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="reads">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover task-table">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Acciones</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($read as $notification)
                                            <tr style="cursor: pointer">
                                                <td data-toggle="notification-modal"  data-id="" data-url="{{route('notifications.loadJsModal',$notification->id)}}">{{$notification->name}}</td>
                                                <td><button class="btn btn-danger "
                                                            data-toggle="delete"
                                                            data-url="{{route('notifications.delete',$notification->id)}}">
                                                        <i class="fa fa-trash"></i> Eliminar</button></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- /.tab-content -->
            </div>
        </div><!-- /.col -->
    </div><!-- /.row -->
    @include('notifications::modals.notification-modal')
    @endsection
    @section('scripts')
        <script>
            $('[data-toggle="notification-modal"]').click(function(e) {
                var modal = $('#notification-modal');
                $.get($(this).attr('data-url')).success(function (data) {
                    modal.find('.modal-body').append(data.view);
                    modal.modal('show');
                });
            });
            $("#notification-modal").on("hidden.bs.modal", function(e) {
                $("#notification-modal").find('.modal-body').html("");
                window.location.reload();
            });
            $('[data-toggle="delete"]').click(function(e) {
                $.get($(this).attr('data-url')).success(function (data) {
                    window.location.reload();
                });
            });
        </script>
    @endsection
