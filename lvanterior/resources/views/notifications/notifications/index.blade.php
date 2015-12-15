@extends('layout.master')
@section('css')
    <!-- DATA TABLES -->
    {!! Html::style('plugins/datatables/dataTables.bootstrap.css') !!}
    <!-- Font Awesome Icons -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
    <!-- Ionicons -->
    <link href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css" rel="stylesheet" type="text/css" />
    <!-- iCheck -->
    <link href="../../plugins/iCheck/flat/blue.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Notificaciones
                <small>inicio</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-cog"></i> Administración</a></li>
                <li class="active">Notificaciones</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box">
                        <div class="box-body">
                            <div class="mailbox-messages">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Título</th>
                                        <th>Descripción</th>
                                        <th>Tiempo</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($array_notification as $notification)
                                        <tr style=" {{ (is_null($notification->read) || !in_array($user_id,unserialize($notification->read)))? 'font-weight: bold;  ': 'background-color: #F1F0F0;' }} ">
                                            <td class="text-center"><input type="checkbox" value="{{$notification->id}}" /></td>
                                            <td><a href="{{route('notifications.show', $notification->id)}}"> {{ $notification->title}}</a></td>
                                            <td>{{ \Illuminate\Support\Str::limit($notification->description , 30) }}</td>
                                            <td>{{ $notification->created_at->diffForHumans() }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th colspan="4">
                                            <div class="mailbox-controls">
                                                <!-- Check all button -->
                                                <button class="btn btn-default btn-sm checkbox-toggle" title="Seleccionar"><i class="fa fa-square-o"></i></button>
                                                <div class="btn-group">
                                                    <button class="btn btn-default btn-sm" title="Eliminar" onclick="eliminarTest()"><i class="fa fa-trash-o"></i></button>
                                                </div><!-- /.btn-group -->
                                           </div>
                                        </th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
@endsection
@section('scripts')
    <!-- DATA TABES SCRIPT -->
    {!! Html::script('plugins/datatables/jquery.dataTables.min.js') !!}
    {!! Html::script('plugins/datatables/dataTables.bootstrap.min.js') !!}
    {!! Html::script('plugins/iCheck/icheck.min.js') !!}
    <!-- page script -->
    <script>
        $(function () {
            //datable
            $("#example1").dataTable();
            //Enable iCheck plugin for checkboxes
            //iCheck for checkbox and radio inputs
            $('.mailbox-messages input[type="checkbox"]').iCheck({
                checkboxClass: 'icheckbox_flat-blue',
                radioClass: 'iradio_flat-blue'
            });

            //Enable check and uncheck all functionality
            $(".checkbox-toggle").click(function () {
                var clicks = $(this).data('clicks');
                if (clicks) {
                    //Uncheck all checkboxes
                    $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                    $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
                } else {
                    //Check all checkboxes
                    $(".mailbox-messages input[type='checkbox']").iCheck("check");
                    $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
                }
                $(this).data("clicks", !clicks);
            });

        });
        function eliminarTest(){
            var url= "{!!URL::to('/notifications/delete/')!!}" ;
            var token = "{!!  csrf_token()   !!}";
            var array_id = [];


            $("input[type='checkbox']:checked").each(function(){
                array_id.push($(this).val());
            });

            $.ajax({
                type: "POST",
                url: url+'/'+array_id.join(),
                data: {  _token :token},
                success: function( msg ) {

                    setInterval(function() {
                        window.location.reload(true);
                    }, 5000);
                }
            });

        }

    </script>
@endsection