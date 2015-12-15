<div class="form-group @if ($errors->has('title')) has-error @endif">
    {!! Form::label('titulo','Título',['class' =>'col-xs-2 control-label']) !!}
    <div class="col-xs-8">
        @if ($errors->has('title')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
            {{ $errors->first('title') }}</label>
        @endif
        {!! Form::text('title',null,['class' => 'form-control','placeholder' => 'Ingrese un título']) !!}
    </div>
</div>
<div class="form-group @if ($errors->has('description')) has-error @endif">
    {!! Form::label('descripcion','Descripción',['class' =>'col-xs-2 control-label']) !!}
    <div class="col-xs-8">
        @if ($errors->has('description')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
            {{ $errors->first('description') }}</label>
        @endif
        {!! Form::textarea('description',null,['class' => 'form-control','placeholder' => 'Ingrese una descripción']) !!}
    </div>
</div>


<div class="form-group @if ($errors->has('url')) has-error @endif">
    {!! Form::label('url','URL',['class' =>'col-xs-2 control-label']) !!}
    <div class="col-xs-8">
        @if ($errors->has('url')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
            {{ $errors->first('url') }}</label>
        @endif
        {!! Form::text('url',null,['class' => 'form-control','placeholder' => 'www.ejemplo.com']) !!}
    </div>
</div>


