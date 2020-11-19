@extends('usuario.MasterTemplate')

@section('title', 'Perfil')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')

<div class="container-fluid">
	<div class="contenido">
		<div >
			<div class="encabezado">
				<center><h3 class="title"> Editar Perfil Usuario </h3></center>
			</div><br>

			{!! Form::open(['url' => '/usuario/perfil-usuario']) !!} <!-- Abre un formulario con HTML Collective -->
	        	<div class="container">
				  <div class="row">
				    <div class="col-sm" >
				       <div class="form-group">
					    <label for="nombre">Nombre:</label>
					    {!! Form::text('nombre', $usuario->nombre, ['class' => 'form-control', 'placeholder' => '']) !!}
					  </div>
					  <div >
					      <label for="contrasena">Contraseña actual:</label>
							{!! Form::password('contrasena', ['class' => 'form-control', 'placeholder' => '']) !!}
					   </div>
					   <div>
							<br>
							<p><i class="fas fa-plus"></i> Agregue una imágen de perfil </p>
							{!! Form::file('img_usuario', ['id' => 'img_usuario', 'accept' => 'image/*']) !!}
					 </div>
				    </div>
				    <div class="col-sm" >
				      <div class="form-group">
					    <label for="apellidos">Apellido(s):</label>
					    {!! Form::text('apellidos', $usuario->apellidos, ['class' => 'form-control', 'placeholder' => '']) !!}
					  </div>
					  <div >
					      <label for="nueva_contrasena">Nueva contraseña:</label>
							{!! Form::password('nueva_contrasena', ['class' => 'form-control', 'placeholder' => '']) !!}
					    </div>
				    </div>
				    <div class="col-sm" >
				      <div class="col-md-auto">
					      <label for="email">Email:</label>
	  					  {!! Form::email('email', $usuario->email, ['class' => 'form-control', 'placeholder' => '', 'readonly' => true]) !!}
					    </div>
				    </div>
				  </div>
				</div>
			{!! Form::close() !!}
		</div>
		<br><br>
		<div class="row justify-content-md-center" style="margin-bottom: 16px;">
		    <div class="col-md-auto">
		      <!--<button type="submit" class="btn btn-primary btn-lg btn-block"> Guardar cambios </button>-->
		      {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary btn-block']) !!}
		    </div>
	  </div>
	</div>
	
</div>
<br>
<br>

<footer class="card-footer">&copy; 2020 Vaqueriza</footer>



@endsection <!-- Cierra la sección "content" -->
