@extends('negocio.MasterTemplate')

@section('title', 'Perfil Negocio')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<!-- Contenido único del archivo PerfilNegocioView.php<br><br> -->
<div class="container-fluid">
	<div class="panel shadow">
		<div class="encabezado">
			<h3 class="title"> Editar perfil del Negocio </h3>
		</div>

		<div class="cuerpo_contenedor">
			<!-- Aquí se coloca el código para el contenido variable de cada interfaz -->

			{!! Form::open(['url' => '/negocio/perfil-negocio', 'files' => true]) !!} <!-- Abre un formulario con HTML Collective -->

			<div class="row mtop16">
				<div class="col-md-3 mleft32">
					<label for="rfc"> RFC: </label>
					<div class="input-group">
						{!! Form::text('rfc', $negocio->rfc, ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
				
				<div class="col-md-3 mleft32">
					<label for="nombre_negocio"> Nombre del negocio: </label>
					<div class="input-group">
						{!! Form::text('nombre_negocio', $negocio->nombre_tienda, ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
				
				<div class="col-md-3 mleft32">
					<label for="correo"> Correo Electrónico: </label>
					<div class="input-group">
						{!! Form::email('correo', $negocio->email, ['class' => 'form-control', 'placeholder' => '', 'readonly' => true]) !!}
					</div>
				</div>
			</div>

			<div class="row mtop16">
				<div class="col-md-3 mleft32">
					<label for="telefono"> Teléfono: </label>
					<div class="input-group">
						{!! Form::text('telefono', $negocio->numero_telefono, ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
				<div class="col-md-3 mleft32">
					<label for="contrasena"> Contraseña actual: </label>
					<div class="input-group">
						{!! Form::password('contrasena', ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
				
				<div class="col-md-3 mleft32">
					<label for="nueva_contrasena"> Nueva contraseña: </label>
					<div class="input-group">
						{!! Form::password('nueva_contrasena', ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
			</div>

			<div class="row mtop16">
				<div class="col-md-3 mleft32">
					<label for="ciudad"> Ciudad/Localidad: </label>
					<div class="input-group">
						{!! Form::text('ciudad', $negocio->domicilio['ciudad'], ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
				
				<div class="col-md-3 mleft32">
					<label for="colonia"> Colonia: </label>
					<div class="input-group">
						{!! Form::text('colonia', $negocio->domicilio['colonia'], ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>

				<div class="col-md-3 mleft32">
					<label for="calle"> Calle: </label>
					<div class="input-group">
						{!! Form::text('calle', $negocio->domicilio['calle'], ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
			</div>

			<div class="row mtop16">
				<div class="col-md-2 mleft32">
					<label for="num_calle"> Número: </label>
					<div class="input-group">
						{!! Form::text('num_calle', $negocio->domicilio['numero_calle'], ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>

				<div class="col-md-2 mleft32">
					<label for="cod_postal"> Código Postal: </label>
					<div class="input-group">
						{!! Form::text('cod_postal', $negocio->domicilio['codigo_postal'], ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
				
				<div class="col-md-5 mleft32">
					<label for="referencias_dom"> Referencias: </label>
					<div class="input-group">
						{!! Form::text('referencias_dom', $negocio->domicilio['referencias'], ['class' => 'form-control', 'placeholder' => '']) !!}
					</div>
				</div>
			</div>

			<div class="row mtop16">
				<div class="col-md-3 mleft32">
					<label for="descripcion"> Descripción del negocio: </label>
					<div class="input-group">
						{!! Form::textarea('descripcion', $negocio->descripcion, ['class' => 'form-control', 'placeholder' => '', 'rows' => '6']) !!}
					</div>
				</div>
				<div class="col-md-3 mleft32">
					<label for="ubicacion_negocio"> Ubicación: </label>
					<div class="input-group">
						<img src="{{ url('static/images/ubicacion_diseno.jpg') }}" width="100%" class="img-fluclass">
					</div>
				</div>
				<div class="col-md-3 mleft32">
					<br>
					<p><i class="fas fa-plus"></i> Agregue una imágen de su negocio </p>
					{!! Form::file('img_negocio', ['id' => 'img_negocio', 'accept' => 'image/*']) !!}
				</div>
			</div>

			<div class="row mtop16">
				<div class="btn_guardar_cambios">
					{!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary mtop16']) !!}
				</div>
			</div>

			{!! Form::close() !!}

		</div>
	</div>
</div>

@endsection <!-- Cierra la sección "content" -->
