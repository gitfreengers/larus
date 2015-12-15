@if(Session::has('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <i class="fa fa-check sign"></i><strong>¡Éxito!</strong> {{ Session::get('success') }}
    </div>
@endif





