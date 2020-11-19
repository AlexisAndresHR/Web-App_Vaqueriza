@extends('negocio.MasterTemplate')

@section('title', 'Detalle Producto')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<!-- Contenido único del archivo DetalleProductoView.php<br><br> -->
<div class="container-fluid">
	<div class="panel shadow">
		<div class="encabezado">
			<h3 class="title"> Ver/Modificar datos del producto </h3>
		</div>

		<div class="cuerpo_contenedor">
			<!-- Aquí se coloca el código para el contenido variable de cada interfaz -->

			{!! Form::open(['url' => '/negocio/detalle-producto/'.$producto->_id.'/']) !!} <!-- Abre un formulario con HTML Collective -->

			<div class="info_negocio_2"> <!-- Sección para los datos del negocio -->
				<!--<div class="row"> <img src="static/images/uploads/imgs_negocios/$negocio->imagen_negocio" class="img-fluclass" alt="" style="width: 55%;"> </div>-->
				<div class="row"> <img src="{{ url('static/images/uploads/imgs_negocios/'.$negocio->imagen_negocio.'/') }}" class="img-fluclass" alt="" style="width: 55%;"> </div>
				<!--<p>/uploads/imgs_negocios/{{$negocio->imagen_negocio}}</p>-->
				<p> <b>¡Negocio Registrado <br> Vaqueriza!</b> </p>
				<br>
				<p style="margin-top: 10px"> {{ $negocio->nombre_tienda }} </p>
				<p> {{ $negocio->email }} </p>
			</div>

			<div class="editar_datos_prod"> <!-- Sección para la lista de productos publicados -->
				
				<div class="row mtop16">
					<div class="col-md-4 mleft32">
						<label for="nombre_producto"> Nombre del producto: </label>
						<div class="input-group">
							{!! Form::text('nombre_producto', $producto->nombre_producto, ['class' => 'form-control', 'placeholder' => 'Nombre']) !!}
						</div>
					</div>
					<div class="col-md-4 mleft32">
						<label for="marca"> Marca: </label>
						<div class="input-group">
							{!! Form::text('marca', $producto->marca, ['class' => 'form-control', 'placeholder' => 'Marca']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16">
					<div class="col-md-4 mleft32">
						<label for="precio"> Precio: </label>
						<div class="input-group">
							{!! Form::text('precio', $producto->precio, ['class' => 'form-control', 'placeholder' => 'Ej: $120.00']) !!}
						</div>
					</div>
					
					<div class="col-md-4 mleft32">
						<label for="precio_envio"> Precio de envío: * </label>
						<div class="input-group">
							{!! Form::text('precio_envio', '0', ['class' => 'form-control', 'placeholder' => 'Ej: $89.000']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16">
					<div class="col-md-4 mleft32">
						<label for="unidad_medida"> Unidad de medida: </label>
						<div class="input-group">
							<?php
								$arrayUnidadMedida = array('0' => 'Kilogramos', '1' => 'Gramos', '2' => 'Mililitros');
							?>
							{!! Form::select('unidad_medida', $arrayUnidadMedida, $producto->unidad_medida999999, ['class' => 'form-control']) !!}
						</div>
					</div>
					
					<div class="col-md-4 mleft32">
						<label for="num_unidades"> Contenido del empaque (unidades): </label>
						<div class="input-group">
							{!! Form::text('num_unidades', $producto->peso_por_unidad, ['class' => 'form-control', 'placeholder' => 'Ej: 2.5']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16">
					<div class="col-md-4 mleft32">
						<label for="stock"> Cantidad disponible (piezas): </label>
						<div class="input-group">
							{!! Form::text('stock', $producto->cantidad_disponible, ['class' => 'form-control', 'placeholder' => 'Ej: 40']) !!}
						</div>
					</div>
					
					<div class="col-md-4 mleft32">
						<label for="categoria"> Categoría: </label>
						<div class="input-group">
							<?php
								$arrayCategoria = array('0' => 'Nutrición', 
								'1' => 'Higiene y Cuidado', 
								'2' => 'Equipamiento Establo',
								'3' => 'Bioseguridad',
								'4' => 'Plagas',
								'5' => 'Maternidad',
								'6' => 'Salud',
								'7' => 'Equipo de manejo',
								'8' => 'Herramientas de Captura y Juguetes');
							?>
							{!! Form::select('categoria',$arrayCategoria, $producto->categoria, ['class' => 'form-control']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16">
					<div class="col-md-4 mleft32">
						<label for="precio_mayoreo"> Precio por mayoreo: * </label>
						<div class="input-group">
							{!! Form::text('precio_mayoreo', $producto->precio_mayoreo, ['class' => 'form-control', 'placeholder' => 'Ej: $105.00']) !!}
						</div>
					</div>
					
					<div class="col-md-4 mleft32">
						<label for="minimo_piezas"> Mínimo de piezas (precio de mayoreo): * </label>
						<div class="input-group">
							{!! Form::text('minimo_piezas', $producto->limite_mayoreo, ['class' => 'form-control', 'placeholder' => 'Ej: 20']) !!}
						</div>
					</div>
				</div>

				<div class="row mtop16">
					<div class="col-md-5 mleft32">
						<label for="descripcion"> Descripción del producto: </label>
						<div class="input-group">
							{!! Form::textarea('descripcion', $producto->descripcion, ['class' => 'form-control', 'placeholder' => 'Descripción del producto', 'rows' => '5']) !!}
						</div>
					</div>
					<img src="{{ url('static/images/uploads/imgs_productos/'.$producto->imagen_producto.'/') }}" alt="" class="img-fluclass mleft32">
					<p> <a href="{{ url('/negocio') }}"> <i class="fa fa-plus mtop16"></i> Cambiar imágen </a> </p>
				</div>

				<div class="row mtop16 mleft32">
					<p> * Opcional </p>
				</div>
				<div class="row">
					<div class="btn_detalle_prod">
						{!! Form::submit('Actualizar información', ['class' => 'btn btn-primary']) !!}
					</div>
				</div>

			</div>

			{!! Form::close() !!}

		</div>
	</div>
</div>

@endsection <!-- Cierra la sección "content" -->
