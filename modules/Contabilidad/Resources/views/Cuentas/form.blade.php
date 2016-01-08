<div class="form-group @if ($errors->has('NUMERO')) has-error @endif">
	{!! Form::label('NUMERO', 'Numero:', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-xs-8">
		{!! Form::text('NUMERO', null, ['class' =>'form-control', 'placeholder' => 'Ingrese un numero']) !!}
		@if ($errors->has('NUMERO'))
	    	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('NUMERO') }}</label>
		@endif
	</div>
</div>
<div class="form-group @if ($errors->has('BANCO')) has-error @endif">
	{!! Form::label('BANCO', 'Banco:', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-xs-8">
		{!! Form::select('BANCO', $bancos, null, ['class' => 'form-control', 'placeholder' => 'Seleccione el BANCO']) !!}
		@if ($errors->has('BANCO'))
	    	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('BANCO') }}</label>
		@endif
	</div>
</div>
<div class="form-group @if ($errors->has('SUCURSAL')) has-error @endif">
	{!! Form::label('SUCURSAL', 'Sucursal:', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-xs-8">
		{!! Form::text('SUCURSAL', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la sucursal']) !!}
		@if ($errors->has('SUCURSAL'))
	    	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('SUCURSAL') }}</label>
		@endif		
	</div>
</div>
<div class="form-group @if ($errors->has('EJECUTIVO')) has-error @endif">
	{!! Form::label('EJECUTIVO', 'Ejecutivo:', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-xs-8">
		{!! Form::text('EJECUTIVO', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el ejecutivo']) !!}
		@if ($errors->has('EJECUTIVO'))
	    	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('EJECUTIVO') }}</label>
		@endif
	</div>
</div>
<div class="form-group @if ($errors->has('TIPO')) has-error @endif">
	{!! Form::label('TIPO', 'Tipo:', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-xs-8">
		{!! Form::text('TIPO', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el tipo']) !!}
		@if ($errors->has('TIPO'))
	    	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('TIPO') }}</label>
		@endif
	</div>
</div>
<div class="form-group @if ($errors->has('DESCRIPCION')) has-error @endif">
	{!! Form::label('DESCRIPCION', 'Descripción:', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-xs-8">
		{!! Form::text('DESCRIPCION', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la descripcion']) !!}
		@if ($errors->has('DESCRIPCION'))
	    	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('DESCRIPCION') }}</label>
		@endif
	</div>
</div>
<div class="form-group @if ($errors->has('CC_CUENTA')) has-error @endif">
	{!! Form::label('CC_CUENTA', 'Cc Cuenta:', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-xs-8">
		{!! Form::text('CC_CUENTA', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la cc cuenta']) !!}
		@if ($errors->has('CC_CUENTA'))
	    	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('CC_CUENTA') }}</label>
		@endif
	</div>
</div>
<div class="form-group @if ($errors->has('TIPOCHEQUE')) has-error @endif">
	{!! Form::label('TIPOCHEQUE', 'Tipo de cheque:', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-xs-8">
		{!! Form::text('TIPOCHEQUE', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el tipo de cheque']) !!}
		@if ($errors->has('TIPOCHEQUE'))
	    	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('TIPOCHEQUE') }}</label>
		@endif
	</div>
</div>
<div class="form-group @if ($errors->has('CUENTACOMPLEMENTARIA')) has-error @endif">
	{!! Form::label('CUENTACOMPLEMENTARIA', 'Cuenta complementaria:', ['class' => 'col-md-2 control-label']) !!}
	<div class="col-xs-8">
		{!! Form::text('CUENTACOMPLEMENTARIA', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la cuenta complementaria']) !!}
		@if ($errors->has('CUENTACOMPLEMENTARIA'))
	    	<label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('CUENTACOMPLEMENTARIA') }}</label>
		@endif
	</div>
</div>