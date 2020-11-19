@extends('usuario.MasterTemplate')

@section('title', 'Carrito de Compra')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<!--seccion de carrito de compra--->
<div class="carrito">
	<i class="fas fa-shopping-cart" align="right"></i>
</div> <br>

<div class="container-fluid">
	<div class="encabezado">
		<h3 class="title"> Carrito de Compra </h3>
	</div>
		<div class="panel shadow">
			<div class="panel2">
				
				<!-- Verifica si el carrito tiene productos agregados (validación anti-errores) -->
				@if($cart != NULL)
					<!-- Llenado dinámico del listado de productos que se agreguen al Carrito de Compra -->
					@foreach($cart as $producto)
						<table class="table" >
							  <tbody>
							  	<tr>
								<th rowspan="3">
									<center>
							      	<img src="{{ url('static/images/uploads/imgs_productos/'.$producto->imagen.'/') }}" class="img-thumbnail" alt="Responsive image" style="width:100px"> <br>
							      	<strong> {{$producto->nombre}} </strong>
							        </center>

								</th>
								<th>Costo por unidad: ${{$producto->precio}}</th>
								<td rowspan="3" align="center">
									<p> <strong>Importe:</strong> $<?php echo number_format($producto->precio * $producto->cantidad, 2); ?> </p>
								</td>
								<td rowspan="3" align="center">
									<a href="{{ route('actualizar_carrito', [$producto->id, $producto->cantidad]) }}" type="button" class="btn btn-outline-info" id="link_actualizar_{{$producto->id}}"><i class="far fa-trash-alt"></i> Actualizar </a>
								</td>
								<td rowspan="3" align="center">
									<a href="{{ route('eliminar_carrito', $producto->id) }}" type="button" class="btn btn-outline-danger"><i class="far fa-trash-alt"></i> Eliminar </a>
								</td>
								</tr>
								<tr>
								<th>
									<p>Cantidad:&nbsp; <input type="number" id="quantity_{{$producto->id}}" name="quantity" min="1" max="1000" style="width:50%;" value="<?php echo $producto->cantidad ?>">
								</th>
								</tr> 

								<!-- Función JavaScript para envíar la cantidad ingresada (modificada) del producto a actualizar -->
								<script>
									var id_input_q = "<?php echo $producto->id; ?>";
									input_quantity = document.getElementById("quantity_" + id_input_q);

									input_quantity.addEventListener('input', updateValue);
									function updateValue(e) {
										var id_input_q1 = "<?php echo $producto->id; ?>";
										var link_actualizar = document.getElementById("link_actualizar_" + id_input_q1);
										var quantity = document.getElementById("quantity_" + id_input_q1).value;
										var uno = "/usuario/carrito-compra/actualizar/";
										var dos = "<?php echo $producto->id; ?>";
										var tres = "/" + quantity;
										var nuevo_link = uno + dos + tres;

										link_actualizar.setAttribute("href", nuevo_link);
									}
								</script>

							  </tbody>
						</table>
					@endforeach

					<div style="margin: 0 auto; width: 80%">
					<div class="d-flex flex-row-reverse bd-highlight">
						<div class="p-2 bd-highlight">
							<h5> Total de la compra: ${{ $importe_total }} </h5>
						</div>
					</div>
					</div>
					<center>
						<a href="{{ url('/usuario/pago') }}" style="color: white;"><input class="btn btn-primary" type="submit" value="Realizar compra"></a>
					</center> <br>

				@else
				<!-- Para mostrar imágen de carrito de compra vacío -->
					<table class="table" >
						  <tbody>
						  	<tr>
							<th rowspan="3">
								<center>
						      	<img src="{{url('static/images/carrito_vacio.jpg')}}" alt="Responsive image" style="width:550px"> <br> 
						  </tbody>
					</table>

					<center>
						<a href="{{ url('/productos') }}" style="color: white;"><input class="btn btn-primary" type="submit" value="Ver productos"></a>
					</center> <br>
				@endif
		    	
			</div>
		</div>
			    	
		<!--Fin de sección para el contenido del carrito de compra-->
</div>


<!--<footer class="card-footer">&copy; 2020 Vaqueriza</footer>-->

@endsection <!-- Cierra la sección "content" -->
