@extends('layout.master')
@section('css')
    <style>
        .todo-list > li .tools a{
            color: #dd4b39;
        }
    </style>
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tareas
                <small>inicio</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li class="active">Tareas</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <i class="fa fa-check sign"></i><strong>¡Éxito!</strong> {{ Session::get('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box box-default">
                            <div class="box-header">
                                <i class="ion ion-clipboard"></i>
                                <h3 class="box-title">Lista de tareas</h3>
                            </div><!-- /.box-header -->
                            <div class="box-body">
                                <ul class="todo-list">
                                    @foreach($array_task as $task)
                                        <li class="{{(is_null($task->user_complete_id))?'': 'done success'}}{{ ($task->expire_time < $now)?'done danger': ''}} ">
                                            <!-- drag handle -->
                                        <span class="handle">
                                            <i class="fa fa-ellipsis-v"></i>
                                            <i class="fa fa-ellipsis-v"></i>
                                        </span>
                                            <!-- checkbox -->
                                            <input type="checkbox" value="" name=""{{(is_null($task->user_complete_id))?'': 'checked disabled'}}/>
                                            <!-- todo text -->
                                            <span class="text">{{ $task->title }}</span>
                                            <!-- Emphasis label -->
                                            <small class="label label-success"><i class="fa fa-clock-o"></i>{{ $task->created_at->diffForHumans() }}</small>
                                            <!-- General tools such as show or delete-->
                                            <div class="tools">
                                                <a href="{{route('tasks.show', $task->id)}}"><i class="fa fa-eye"></i></a>
                                                <a href="{{ route('tasks.remove',$task->id)}}"><i class="fa fa-trash-o"></i></a>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div><!-- /.box-body -->
                            <div class="box-footer clearfix no-border">
                                <div class="box-tools pull-right">
                                    <!-- pagination -->
                                    {!! $task_paginate->render() !!}
                                </div>
                            </div>
                        </div><!-- /.box -->
                    </div>
                </div>
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection
@section('scripts')
    <script>
        $(function () {
            /* The todo list plugin */
            $(".todo-list").todolist({
                onCheck: function (ele) {
                   // console.log("The element has been checked")
                },
                onUncheck: function (ele) {
                   // console.log("The element has been unchecked")
                }
            });
        });
    </script>
@endsection