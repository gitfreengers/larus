@extends('layout.master')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Widgets</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Widgets</li>
            </ol>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                @if(isset($widget))
                    @foreach($widget->render() as $widget)
                        @if((\Cartalyst\Sentinel\Native\Facades\Sentinel::hasAccess(["$widget[0]"])))
                            {!! $widget[1] !!}
                        @endif
                    @endforeach
                @endif
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection
@section('scripts')
    <!-- FastClick -->
    {!! Html::script('plugins/fastclick/fastclick.min.js') !!}
    <!-- ChartJS 1.0.1 -->
    {!! Html::script('plugins/chartjs/Chart.min.js') !!}
@endsection