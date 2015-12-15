@extends('layout.master')
@section('css')

@endsection
@section('content-header')
    <h1>Mis tareas</h1>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="nav-tabs-custom">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#my_tasks" data-toggle="tab">Mis tareas</a></li>
                    <li><a href="#completed_tasks" data-toggle="tab">Tareas Completadas</a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active" id="my_tasks">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover task-table">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Fecha de inicio</th>
                                            <th>Fecha de vencimiento</th>
                                            <th>Etatus</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($mytasks as $mytask)
                                        <tr data-toggle="modal"  data-id="{{$mytask->id}}" data-url="{{route('tasks.showtask',$mytask->id)}}" style="text-decoration: {{(is_null($mytask->user_complete_id))?'': 'line-through'}}">
                                            <td>{{$mytask->name}}</td>
                                            <td>{{$mytask->start_date}}</td>
                                            <td>{{$mytask->due_date}}</td>
                                            <td>{{trans('tasks::translations.'.$mytask->status)}}</td>
                                        </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="completed_tasks">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table table-hover task-table">
                                        <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Fecha de inicio</th>
                                            <th>Fecha de vencimiento</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($completedtasks as $completedtask)
                                            <tr data-toggle="modal"  data-id="{{$completedtask->id}}" data-url="{{route('tasks.showtask',$completedtask->id)}}">
                                                <td>{{$completedtask->name}}</td>
                                                <td>{{$completedtask->start_date}}</td>
                                                <td>{{$completedtask->due_date}}</td>
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
    @include('tasks::layouts.modal-my-task')
    @endsection
    @section('scripts')
        <script src="{{asset('modules/tasks/js/mytask.js')}}"></script>
    @endsection
