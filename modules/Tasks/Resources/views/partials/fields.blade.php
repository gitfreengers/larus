<div class="col-md-6">
    <div class="form-group @if ($errors->has('name')) has-error @endif">
        <label for="name">Nombre *</label>
        {!! Form::text('name',null,['class' => 'form-control']) !!}
    </div>

    <div class="form-group @if ($errors->has('start_date')) has-error @endif">
        <label for="start_date">Fecha de inicio *</label>
        {!! Form::text('start_date',null,['class' => 'form-control','id' => 'start_date']) !!}
    </div>
</div>
<div class="col-md-6">
    <div class="form-group @if ($errors->has('status')) has-error @endif">
        <label for="status">Estado *</label>
        <select class="form-control" name="status" id="status">
            <option value="" disabled="disabled" selected>- Por favor seleccione un estado -</option>
            <option value="pending" >Pendiente</option>
        </select>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group @if ($errors->has('due_date')) has-error @endif">
        <label for="due_date">Fecha de vencimiento</label>
        {!! Form::text('due_date',null,['class' => 'form-control','id' => 'due_date']) !!}
    </div>
</div>