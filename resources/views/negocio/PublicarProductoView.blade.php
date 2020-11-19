@extends('negocio.MasterTemplate')

@section('title', 'Publicar Producto')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<!-- Contenido único del archivo PublicarProductoView.php<br><br> -->
<div class="container-fluid">
	<div class="panel shadow">
		<div class="encabezado">
			<h3 class="title"> Publicar un nuevo producto </h3>
		</div>

		<div class="cuerpo_contenedor">
			<!-- Aquí se coloca el código para el contenido variable de cada interfaz -->

			{!! Form::open(['url' => '/negocio/publicar-producto', 'files' => true]) !!} <!-- Abre un formulario con HTML Collective -->

			<div class="div1_nuevo_prod">
				<img src="{{ url('static/images/icono_imagen.png') }}" alt="" class="img-fluclass">
				<p><i class="fas fa-plus"></i> Subir imágen</p>
				{!! Form::file('imagen_prod', ['id' => 'imagen_prod', 'accept' => 'image/*']) !!}
				<div class="row mtop16">
					<div class="col-md-8 mleft32">
						<label for="nombre_producto"> Nombre del producto: </label>
						<div class="input-group">
							{!! Form::text('nombre_producto', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
						</div>
					</div>
				</div>
				<div class="row mtop16">
					<div class="col-md-8 mleft32">
						<label for="marca"> Marca: </label>
						<div class="input-group">
							{!! Form::text('marca', null, ['class' => 'form-control', 'placeholder' => 'Marca', 'required']) !!}
						</div>
					</div>
				</div>
			</div>

			<div class="div2_nuevo_prod">
				<div class="row mtop16">
					<div class="col-md-4 mleft32">
						<label for="precio"> Precio: </label>
						<div class="input-group">
							{!! Form::number('precio', null, ['class' => 'form-control', 'placeholder' => 'Ej: $120.00', 'required', 'step' => 'any']) !!}
						</div>
					</div>
					
					<div class="col-md-4 mleft32">
						<label for="precio_envio"> Precio de envío: * </label>
						<div class="input-group">
							{!! Form::number('precio_envio', null, ['class' => 'form-control', 'placeholder' => 'Ej: $89.000', 'required', 'step' => 'any']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16">
					<div class="col-md-4 mleft32">
						<label for="unidad_medida"> Unidad de medida: </label>
						<div class="input-group">
							{!! Form::select('unidad_medida', ['0' => 'Kilogramos', '1' => 'Gramos', '2' => 'Mililitros'], 0, ['class' => 'form-control']) !!}
						</div>
					</div>
					
					<div class="col-md-4 mleft32">
						<label for="num_unidades"> Peso por empaque (unidades): </label>
						<div class="input-group">
							{!! Form::number('num_unidades', null, ['class' => 'form-control', 'placeholder' => 'Ej: 2.5', 'required', 'step' => 'any']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16">
					<div class="col-md-4 mleft32">
						<label for="stock"> Cantidad disponible (piezas): </label>
						<div class="input-group">
							{!! Form::number('stock', null, ['class' => 'form-control', 'placeholder' => 'Ej: 40', 'required']) !!}
						</div>
					</div>
					
					<div class="col-md-4 mleft32">
						<label for="categoria"> Categoría: </label>
						<div class="input-group">
							{!! Form::select('categoria', [
								'0' => 'Nutrición', 
								'1' => 'Higiene y Cuidado', 
								'2' => 'Equipamiento Establo',
								'3' => 'Bioseguridad',
								'4' => 'Plagas',
								'5' => 'Maternidad',
								'6' => 'Salud',
								'7' => 'Equipo de manejo',
								'8' => 'Herramientas de Captura y Juguetes'], 0, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16">
					<div class="col-md-4 mleft32">
						<label for="precio_mayoreo"> Precio por mayoreo: * </label>
						<div class="input-group">
							{!! Form::number('precio_mayoreo', null, ['class' => 'form-control', 'placeholder' => 'Ej: $105.00', 'required', 'step' => 'any']) !!}
						</div>
					</div>
					
					<div class="col-md-4 mleft32">
						<label for="minimo_piezas"> Mínimo de piezas para precio de mayoreo: * </label>
						<div class="input-group">
							{!! Form::number('minimo_piezas', null, ['class' => 'form-control', 'placeholder' => 'Ej: 20', 'required']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16">
					<div class="col-md-5 mleft32">
						<label for="descripcion"> Descripción del producto: </label>
						<div class="input-group">
							{!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripción del producto', 'rows' => '5', 'required']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16 mleft32">
					<p> * Opcional </p>
				</div>
				<div class="row">
					<div class="btn_registrar_prod">
						{!! Form::submit('Registrar producto', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>
			</div>

			{!! Form::close() !!}
			
		</div>
	</div>
</div>

@endsection <!-- Cierra la sección "content" -->
