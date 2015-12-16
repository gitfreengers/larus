<div class="form-group @if ($errors->has('image')) has-error @endif">
    {!! Form::label('image','Avatar',['class' =>'col-xs-2 control-label']) !!}

    <div class="col-xs-8">
        @if ($errors->has('image'))
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('image') }}</label>
        @endif
            @if(isset($users->id))
            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px;">
                <img src="{{ url('img/users/'.$users->image) }}"></div>
            @endif

        {!! Form::file('image')!!}
    </div>
</div>


<div class="form-group @if ($errors->has('first_name')) has-error @endif">

    {!! Form::label('first_name','Nombre',['class' =>'col-xs-2 control-label']) !!}
    <div class="col-xs-8">
        @if ($errors->has('first_name'))
            <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i> {{ $errors->first('first_name') }}</label>
        @endif
        {!! Form::text('first_name',null,['class' => 'form-control','placeholder' => 'Ingrese un nombre']) !!}
    </div>
</div>
<div class="form-group @if ($errors->has('last_name')) has-error @endif">
    {!! Form::label('last_name','Apellido',['class' =>'col-xs-2 control-label']) !!}
    <div class="col-xs-8">
        @if ($errors->has('last_name')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
            {{ $errors->first('last_name') }}</label>
        @endif
        {!! Form::text('last_name',null,['class' => 'form-control','placeholder' => 'Ingrese un apellido']) !!}
    </div>

</div>
<div class="form-group @if ($errors->has('position')) has-error @endif">
    {!! Form::label('position','Puesto',['class' =>'col-xs-2 control-label']) !!}
    <div class="col-xs-8">
        @if ($errors->has('position')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
            {{ $errors->first('position') }}</label>
        @endif
        {!! Form::text('position',null,['class' => 'form-control','placeholder' => 'Ingrese un puesto']) !!}
    </div>

</div>
<div class="form-group @if ($errors->has('email')) has-error @endif">
    {!! Form::label('email','Correo eléctronico',['class' =>'col-xs-2 control-label']) !!}
    <div class="col-xs-8">
        @if ($errors->has('email')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
            {{ $errors->first('email') }}</label>
        @endif
        {!! Form::email('email',null,['class' => 'form-control','placeholder' => 'example@dominio.com']) !!}
    </div>

</div>
@if(!isset($users->id))
    <div class="form-group @if ($errors->has('password')) has-error @endif">
        {!! Form::label('password','Contraseña',['class' =>'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            @if ($errors->has('password')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                {{ $errors->first('password') }}</label>
            @endif
            {!! Form::password('password',['class' => 'form-control','placeholder' => 'Contraseña']) !!}
        </div>

    </div>

    <div class="form-group @if ($errors->has('retype_password')) has-error @endif">
        {!! Form::label('password','Repetir contraseña',['class' =>'col-xs-2 control-label']) !!}
        <div class="col-xs-8">
            @if ($errors->has('retype_password')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
                {{ $errors->first('retype_password') }}</label>
            @endif
            {!! Form::password('retype_password',['class' => 'form-control','placeholder' => 'Repetir contraseña']) !!}
        </div>

    </div>
@endif
<div class="form-group @if ($errors->has('roles')) has-error @endif">
    {!! Form::label('roles','Rol',['class' =>'col-xs-2 control-label']) !!}
    <div class="col-xs-8">
        @if ($errors->has('roles')) <label class="control-label" for="inputError"><i class="fa fa-times-circle-o"></i>
            {{ $errors->first('roles') }}</label>
        @endif
            @if(isset($users->id))
                {!! Form::select('roles',$roles, $rolUser[0]->slug,['class' => 'form-control'] ) !!}
            @else
                {!! Form::select('roles',$roles, null,['class' => 'form-control'] ) !!}
            @endif
    </div>

</div>


