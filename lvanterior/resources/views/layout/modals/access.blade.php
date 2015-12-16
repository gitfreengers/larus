<!-- acceso denegado -->
<div class="modal fade modal-danger" id="md-acceso" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="memberModalLabel">Acceso denegado</h4>

            </div>
            <div class="modal-body">
                @if($errors->has('NoAccess'))
                    {{ $errors->first('NoAccess')}}
                @else
                    No tiene permisos para acceder a esta area.
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>