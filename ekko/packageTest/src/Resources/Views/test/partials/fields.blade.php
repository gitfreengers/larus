<div class="form-group @if ($errors->has('name')) has-error @endif">
    {!! Form::label('name','Nombre',['class' =>'col-xs-2 control-label']) !!}
    <div class="col-xs-8">
        @if ($errors->has('name')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
            {{ $errors->first('name') }}</label>
        @endif
        {!! Form::text('name',null,['class' => 'form-control','placeholder' => 'Ingrese un nombre']) !!}
    </div>
</div>





