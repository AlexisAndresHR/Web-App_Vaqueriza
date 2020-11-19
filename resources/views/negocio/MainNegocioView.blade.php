@extends('negocio.MasterTemplate')

@section('title', 'Negocio')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<!-- Contenido único del archivo MainNegocioView.php<br><br> -->
<div class="container-fluid">
	<div class="panel shadow">
		<div class="encabezado">
			<h3 class="title"> Página de inicio del Negocio </h3>
		</div>

		<div class="cuerpo_contenedor">
			<!-- Aquí se coloca el código para el contenido variable de cada interfaz -->
			
			<div class="row no-gutters">
			    <div class="col-6 col-md-4" >
				  	<div class="info_negocio"> <!-- Sección para los datos del negocio -->
				  		@if($negocio->imagen_negocio)
				  			<div class="row"> <img src="static/images/uploads/imgs_negocios/{{$negocio->imagen_negocio}}" class="img-fluclass" alt="" style="width: 55%;"> </div>
				  		@else
				  			<div class="row"> <img src="static/images/negocio_icono.png" class="img-fluclass" alt="" style="width: 55%;"> </div>
				  		@endif
						<br>
						<p> <b>¡Negocio Registrado <br> Vaqueriza!</b> </p>
						<p style="margin-top: 10px;"> {{ $negocio->nombre_tienda }} </p>
						<p> {{ $negocio->email }} </p>
						<button type="button" class="btn btn-primary"> <a href="{{ url('/negocio/perfil-negocio/'.$negocio->_id.'/') }}" style="color: white;"> Editar perfil </a> </button> <br> <!-- Enlace a la interfaz "Editar perfil del Negocio" -->
						<br>
						<br>
						<button type="button" class="btn btn-primary"> <a href="{{ url('/negocio/ventas-pendientes/'.$negocio->_id.'/') }}" style="color: white;"> Ventas Pendientes </a> </button> <br> <!-- Enlace a la interfaz "Ventas pendientes" --> <br>
						<button type="button" class="btn btn-primary"> <a href="{{ url('/negocio/ventas/'.$negocio->_id.'/') }}" style="color: white;"> Historial de Ventas </a> </button> <br> <!-- Enlace a la interfaz "Historial de ventas realizadas" --> <br>

						<button class="btn btn-primary">
							<a href="{{ url('/negocio/publicar-producto/'.$negocio->_id.'/') }}" style="color:white;"> Publicar nuevo producto </a>
						</button> <br>
						<br>
						<br>
					</div>
			    </div>

			    <!--Seccion de productos publicados-->
			    <div class="col-sm-6 col-md-8" >
				    <div class="productos_publicados"> <!-- Sección para la lista de productos publicados -->
						<div class="row">
							<h5> Productos publicados </h5>
						</div>
						<br>
						<!--Buscador de productos publicados-->
						<div class="row ">
							<form class="form-inline"   style="margin-left:60%;">
								<input name= "name" class="form-control mr-sm-2" type="search" placeholder="Nombre del Producto" aria-label="Search" lef>
								<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
		        			</form>
						</div>

						<?php
						// Comprueba si el Negocio ya tiene productos publicados en la plataforma
							$bandera_productos = false;
							foreach ($productos as $comprobacion) {
								$bandera_productos = true;
							}

							if ($bandera_productos == true) {
								$bandera_productos = true;
							}
							else {
								$bandera_productos = false;
							}
						?>
						@if($bandera_productos == true)
						<!-- Tabla con llenado dinámico (basado en los registros de Productos del Negocio) -->
							<table class="table">
								<thead>
									<tr>
										<td><b>Nombre</b></td>
										<td><b>Marca</b></td>
										<td><b>Precio</b></td>
										<td><b>Cantidad disponible</b></td>
										<td><b>Imágen</b></td>
									</tr>
								</thead>
								<tbody>
									<!-- Ciclo para el llenado dinámico de productos del Negocio -->
									@foreach($productos as $producto)
										<tr>
											<td> <br><b>{{ $producto->nombre_producto }}</b> </td>
											<td> <br><b>{{ $producto->marca }}</b> </td>
											<td> <br>${{ $producto->precio }} </td>
											<td> <br>{{ $producto->cantidad_disponible }} </td>
											@if($producto->imagen_producto)
												<th> <img src="static/images/uploads/imgs_productos/{{$producto->imagen_producto}}" class="img-fluclass" alt=""> </th>
											@else
												<th> <img src="static/images/icono_imagen.png" class="img-fluclass" alt=""> </th>
											@endif
										</tr>
										<tr>
											<th></th>
											<th></th>
											<th> <a href="{{ url('/negocio/detalle-producto/'.$producto->_id.'/') }}" class="btn btn-primary boton_editarp"> Editar </a> </th>
											<th></th>
											<th></th>
										</tr>
									@endforeach
								</tbody>
							</table>
						@else
							<div class="sin_productos">
								<h4> Los usuarios de Vaqueriza están listos para comprar... </h4>
								<img src="static/images/carrito.jpg" class="img-fluclass" alt="" width="40%">
								<h4> ¡Publique su primer producto! </h4>
							</div>
						@endif

						<div class="row row_derecha">
		        			<p>
		        			{{$productos->total() }} Productos Publicados |
		        			pagina {{$productos->currentPage() }}
		        			de {{$productos->lastPage()}}
		        			</p>
		        			{!!$productos->render()!!}
						</div>

			  		</div>
			    </div>
			</div>
		</div>
	</div>
</div>

@endsection <!-- Cierra la sección "content" -->
