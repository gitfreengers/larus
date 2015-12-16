<div class="modal fade" id="task-modal" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"></h4>
            </div> <!-- /.modal-header -->
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#task" data-toggle="tab" aria-expanded="true"><i class="fa fa-tasks"></i> Tarea</a></li>
                                    <li class=""><a href="#notes" data-toggle="tab" aria-expanded="false"><i class="fa fa-file-text-o"></i> Notas</a></li>

                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="task">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Nombre</label>
                                                    <p class="form-control-static" id="name"></p>

                                                </div>
                                                <div class="form-group">
                                                    <label for="start_date">Fecha de inicio</label>

                                                    <p class="form-control-static" id="start_date"></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name">Estado</label>
                                                    <p class="form-control-static" id="status"></p>
                                                </div>

                                                <div class="form-group">
                                                    <label for="due_date">Fecha de vencimiento</label>
                                                    <p class="form-control-static" id="due_date"></p>

                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label for="description">Descripción</label>
                                                   <p class="form-control-static" id="description"></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane" id="notes">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="notes"></div>
                                                {!! Form::open(['route' => 'tasks.savenote','method'=>'POST','id'=>'task-update','accept-charset'=> 'UTF-8' ]) !!}
                                                <input type="hidden" name="task_id">
                                                <div class="form-group" id="comment">
                                                        <label for="note">Nota</label>
                                                        <textarea name="comment" id="note" class="form-control"></textarea>
                                                    </div>
                                                {!! Form::close() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- /.modal-body -->
            <div class="modal-footer">
                <div class="btn-group btn-group-xs">
                    <button type="button" class="btn btn-success btn-flat" data-toggle="task-complete"><i class="fa fa-check"></i> Terminar </button>
                    <button type="button" class="btn btn-primary btn-flat" data-toggle="task-note-save"><i class="fa fa-save"></i> Guardar </button>
                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal"><i class="fa fa-remove"></i> Cerrar </button>
                </div>
            </div><!-- /.modal-footer -->
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
