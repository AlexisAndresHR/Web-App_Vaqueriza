@extends('connect.MasterTemplate')

@section('title', 'Registro de Usuarios')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<!-- Contenedor para el formulario de Registro de Usuarios -->
<div class="boxusuario box_usuario shadow" style="margin: 0 auto;" >
	<h4 class="mtop16 login_titles"> Registro de Usuarios </h4>
	
<!-- Abre un formulario con HTML Collective -->
	{!! Form::open(['url' => '/registro-usuario']) !!}

	<div class="row mtop16">
		<div class="col-md-6">
			<label for="nombre"> Nombre: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">
						 <i class="fas fa-edit"></i>
					</span>
				</div>
				{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
			</div>
		</div>
		
		<div class="col-md-6">
			<label for="apellidos"> Apellido(s): </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text">  <i class="fas fa-edit"></i> </div>
				</div>
				{!! Form::text('apellidos', null, ['class' => 'form-control', 'placeholder' => 'Apellido(s)', 'required']) !!}
			</div>
		</div>
	</div>

	<div class="row mtop16">
		<div class="col-md-6">
			<label for="email"> Correo Electrónico: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">
					 	<i class="fas fa-envelope"></i> 
					</span>
				</div>
				{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'usuario@correo.com', 'required']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<label for="telefono"> Teléfono: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">
					 	<i class="fas fa-mobile-alt"></i>
					</span>
				</div>
				{!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => '10 digitos', 'required']) !!}
			</div>
		</div>
	</div>

	<div class="row mtop16">
		<div class="col-md-6">
			<label for="fecha_nac"> Fecha de nacimiento: </label>
			<div class="input-group">
				<input type="date" id="fecha_nac" name="fecha_nac" class="form-control">
			</div>
		</div>
	</div>

	<div class="row mtop16">
		<div class="col-md-6">
			<label for="password"> Contraseña: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text"> <i class="fas fa-key"></i> </div>
				</div>
				{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'required']) !!}
			</div>
		</div>
		<div class="col-md-6">
			<label for="r_password"> Repetir contraseña: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text"> <i class="fas fa-key"></i> </div>
				</div>
				{!! Form::password('r_password', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'required']) !!}
			</div>
		</div>
	</div>



	<div class="row mtop16">
		<div class="col-md-4">
			<div>
				<div>
					<div class="a_recovery mtop16">
						<button type="button" class="btn btn-primary "><a href="{{
			             url('/login')}}" style="color: white"> Regresar</a></button>
					</div>
				</div>
			</div>
		</div>
		
		<div class="col-md-4">
			<div>
				<div>
				</div> 
			</div>
		</div>
		
		<div class="col-md-4">
	
			<div class="mtop16">
				<div class="input-group-prepend">
				</div>
         		{!! Form::submit('Registrar Usuario', ['class' => 'btn btn-primary', 'style' => 'color: white; margin-left: 0px; padding-top: 0.375rem;']) !!}
			</div>
		</div>
	</div>

    {!! Form::close() !!}
   
</div>

@stop <!-- Cierra la sección "content" -->
