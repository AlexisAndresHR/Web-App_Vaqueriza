@extends('connect.MasterTemplate')

@section('title', 'Inicio de Sesión')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<!-- Contenedor para el formulario de Inicio de Sesión -->
<div class="box box_login shadow" style="margin: 0 auto;">
	<h4 class="mtop16 login_titles"> Iniciar Sesión </h4>
	<!-- Abre un formulario con HTML Collective -->
	{!! Form::open(['url' => '/login']) !!}
	
	<label for="email"> Correo electrónico: </label>
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"> <i class="fas fa-envelope"></i> </div>
		</div>
		{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'usuario@correo.com']) !!}
	</div>

	<label for="password" class="mtop16"> Contraseña: </label>
	<div class="input-group">
		<div class="input-group-prepend">
			<div class="input-group-text"> <i class="fas fa-key"></i> </div>
		</div>
		{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'contraseña']) !!}
	</div>

	<!-- Contenedor para el apartado con botones de Registro -->
	<div class="a_recovery mtop16">
		<a href="{{ url('/pass-recovery') }}"> Olvidé mi contraseña </a>
	</div>
	
	<!-- Botón "Acceder" -->
	{!! Form::submit('Acceder', ['class' => 'btn btn-success mtop16 mbottom16']) !!}

	{!! Form::close() !!}


	<!-- Apartado con los botones de Registro -->
	<h4 class="mtop16 login_titles"> <br> Registrarse </h4>
	<!-- Botón "Registro de Negocio" -->
           <button type="button" class="btn btn-primary"><a href="{{
             url('/registro-negocio')}}" style="color: white"> Negocio</a></button>

	<!-- Botón "Registro de Usuario" -->
           <button type="button" class="btn btn-primary"  style="margin-left: 170px"><a href="{{
             url('/registro-usuario')}}" style="color: white"> Usuario</a></button>
</div>

@stop <!-- Cierra la sección "content" -->
