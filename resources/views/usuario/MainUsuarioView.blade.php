@extends('usuario.MasterTemplate')

@section('title', 'Usuario')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')

<div class="cuerpo">
	<div class="container-fluid">
	<div class="panel shadow">
		<div class="encabezado">
			<h3 class="title"> Página de inicio del Usuario </h3>
		</div>

		<div class="cuerpo_contenedor">
			<!-- Aquí se coloca el código para el contenido variable de cada interfaz -->
			
			<div class="row no-gutters">
			  <div class="col-6 col-md-4">
			  	<center>	
				<div> <!-- Sección para los datos del negocio -->
					<div class="info_usuario">
						<!--<img  src="{{ url('static/images/uploads/imgs_usuarios/'.$usuario->img_usuario.'/') }}" class="img-fluid imagen" alt="Responsive image"><br>-->
						<img src="{{ url('static/images/usuario.png') }}" class="img-fluid imagen" alt="Responsive image"><br>

						<!--
						<p><i class="fas fa-plus"></i> Subir imágen</p>
			
						<input type="file" name="" alt="Subir imagen" style="font-size: 13px" id="img_perfil">
						-->
					</div>
					<p style="margin-top: 20px;"> <b>¡Bienvenido!</b> </p>
					<p>{{$usuario->nombre}} {{$usuario->apellidos}} </p>
					<p style="margin-bottom: 30px;"> {{$usuario->email}} </p>
					<button type="button" class="btn btn-primary"><a href="{{ url('/usuario/perfil-usuario/'.$usuario->_id.'/') }}" style="color: white">Editar perfil</a></button>
				</div>
			  	</center>
			  	
			  </div> <!--Seccion de productos publicados-->
			  <div class="col-sm-6 col-md-8">
				  	
				<!--Contenido-->
				<div class="encabezado">
					<h3 class="title"> Compras</h3>
				</div>
			
			<!--Contiene las compras realizadas por el usuario-->
			<!--<div class="container">
				<nav class="navbar navbar-light bg-light">
				    <a class="navbar-brand">Filtros</a>
					<form class="form-inline"   style="margin-left:60%;">
						<input name= "name" class="form-control mr-sm-2" type="search" placeholder="Nombre producto" aria-label="Search" lef>
						<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
	        		</form>
				</nav>
				<br>
				<div class="container">
					<div class="row">
					  	<p>Ordenar por:</p>
					    <div class="col-sm">
					        <input type="date" id="start" name="fecha" value="2020-06-21" min="2020-01-01" max="2020-12-31">
					    </div>
					    <div class="col-sm">
					        <select name="lugar" id="lugar" class="form-control">
							    <option value="Tulancingo">Tulancingo</option>
							    <option value="Santiago">Santiago</option>
							    <option value="Cuautepec">Cuautepec</option>
							</select>
					    </div>
					    <div class="col-sm">
					    </div>
					</div>
				</div>
				<br>--> <!--Fin de filtros-->

				<!-- Comprueba si el Usuario ya ha realizado alguna compra (para mostrar distinto) -->
				<?php
					$bandera_compras = false;
					foreach ($compras as $comprobacion) {
						$bandera_compras = true;
					}

					if ($bandera_compras == true) {
						$bandera_compras = true;
					}
					else {
						$bandera_compras = false;
					}
				?>
				@if($bandera_compras == false)
					<div class="sin_compras">
						<h4> Aún no has realizado compras... </h4>
						<img src="static/images/venta_realizada.png" class="img-fluclass" alt="" width="40%">
						<h4> ¿Qué esperas? Aprovecha los beneficios que Vaqueriza tiene para ti </h4>
					</div>

				@else
				<!--Contiene las compras realizadas por el usuario-->
				<div class="container">
					<nav class="navbar navbar-light bg-light">
					    <a class="navbar-brand">Filtros</a>
						<form class="form-inline"   style="margin-left:60%;">
							<input name= "name" class="form-control mr-sm-2" type="search" placeholder="Nombre producto" aria-label="Search" lef>
							<button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
		        		</form>
					</nav>
					<br>
					<div class="container">
						<div class="row">
						  	<p>Ordenar por:</p>
						    <div class="col-sm">
						        <input type="date" id="start" name="fecha" value="2020-06-21" min="2020-01-01" max="2020-12-31">
						    </div>
						    <div class="col-sm">
						        <select name="lugar" id="lugar" class="form-control">
								    <option value="Tulancingo">Tulancingo</option>
								    <option value="Santiago">Santiago</option>
								    <option value="Cuautepec">Cuautepec</option>
								</select>
						    </div>
						    <div class="col-sm">
						    </div>
						</div>
					</div>
					<br> <!--Fin de filtros-->

				<!--Muestra de los datos de compras del usuario con la BD-->
					@foreach($compras as $compra)
						<table class="table">
						  <tbody>
						    <tr> <!--Fila-->
						     <!-- <td>
						      	<center>
						      		<img src="{{url('static/images/carrito.jpg')}}" class="img-fluid" alt="Responsive image" style="width: 80px">
						      	</center>-->
						      </td>
						      <td>
						      	C&oacutedigo de compra:<br>
						      	<samp style="color: blue">{{ $compra->_id}}</samp> <br>
						      	
						      </td>
						      <td>
						      	Fecha: {{ $compra->fecha_venta->toDateTime()->format("d-m-Y") }} <br> 
								Hora: {{ $compra->fecha_venta->toDateTime()->format("H:i") }}
						      	<br><br>
								
								<?php
									// Muestra el valor en texto de las categorías (mejor presentación para el usuario)
									if($compra->status == "0"):
										$estado_compra = "En espera de entrega";
									elseif($compra->status == "1"):
										$estado_compra = "Pendiente de envío";
									elseif($compra->status == "2"):
										$estado_compra = "Pendiente de pago";
									elseif($compra->status == "3"):
										$estado_compra = "No es posible hacer el envío";
									elseif($compra->status == "4"):
										$estado_compra = "Completada";
									endif;
								?>
						      	<strong>Status: <?php echo $estado_compra; ?></strong>
						      	
						      </td>
						      <td>
						      	Pago: ${{ $compra->total_venta}}<br><br>
						      	Forma de pago: {{$compra->forma_pago}}
						      </td>
						      <td>
						      	<a href="{{ url('/usuario/detalle-compra/'.$compra->_id.'/') }}" style="color: white;"><input class="btn btn-primary" type="submit" value="Ver detalle compra"></a>
						      </td>
						    </tr><!--Fin Fila-->
						</table>
					@endforeach
				@endif

				
		        	</div>
					</div>
				 	</div>
					</div>
				<!-- Comprueba si el usuario tiene compras para mostrar o no la sección de paginación -->
				@if($bandera_compras == true)
				<!--Paginacion-->
					<div class="row row-derecha">
			        	<p style="margin-left: 80%">
			        	<!--{{$compras->total() }} Productos Comprados |-->
			        	Página {{$compras->currentPage() }}
			        	de {{$compras->lastPage()}} &nbsp;&nbsp;
			        	</p>
			        	{!!$compras->render()!!}
					</div>
				@endif
			</div>
		</div>
	</div>
<!--Fin Contenido-->
</div>


@endsection <!-- Cierra la sección "content" -->
