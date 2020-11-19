@extends('usuario.MasterTemplate')

@section('title', 'Detalle de Compra')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<div class="container-fluid">
	<div class="panel shadow">
		<div class="encabezado">
			<h3 class="title"> Detalle de compra</h3>
			<div class="d-flex bd-highlight mb-3" style="margin-left: 5%; margin-right: 5%;">
			  <div class="p-2 bd-highlight">C&oacutedigo de compra: <span style="color: blue;">{{$datac->_id}}</span> </div>
			  <div class="ml-auto p-2 bd-highlight">Fecha de compra: {{ $datac->fecha_venta->toDateTime()->format("d-m-Y H:i:s") }}</div>
			</div>
			<div class="d-flex flex-column bd-highlight mb-3" style="margin-left: 5%; margin-right: 5%;">
				<?php
					// Muestra el valor en texto de las categorías (mejor presentación para el usuario)
					if($datac->status == "0"):
						$estado_comp = "En espera de entrega";
					elseif($datac->status == "1"):
						$estado_comp = "Pendiente de envío";
					elseif($datac->status == "2"):
						$estado_comp = "Pendiente de pago";
					elseif($datac->status == "3"):
						$estado_comp = "No es posible hacer el envío";
					elseif($datac->status == "4"):
						$estado_comp = "Completada";
					endif;
				?>
				<div class="p-2 bd-highlight"> Estado de la compra: <?php echo $estado_comp; ?> </div>
			</div>
			<div class="d-flex bd-highlight mb-3" style="margin-left: 5%; margin-right: 5%;">
			  <div class="p-2 bd-highlight"> Fecha de entrega: {{$datac->fecha_entrega->toDateTime()->format("d-m-Y H:i:s")}} </div>
			  <div class="ml-auto p-2 bd-highlight">
			  	<a href="{{ url('/usuario/carrito-compra') }}" style="color: white"><input class="btn btn-primary" type="submit" value="Volver a comprar"></a>
			  </div>
			</div>
		</div>

		<div class="cuerpo_contenedor" style="padding: 3%">
			<table class="table" style="margin: 0 auto; width: 80%">
			  <tbody>

			    @foreach($data3 as $producto)
				    <tr> <!--Fila-->
				      <td>
				      	<center>
				      	<img src="{{ url('static/images/uploads/imgs_productos/'.$producto->imagen_producto.'/') }}" class="img-thumbnail" alt="Responsive image" style="width:100px"> <br> Nombre del producto: {{$producto->nombre_producto}}</center><br>
				      	
				      </td>
				      
				      <td style="width: 30%">
						<p>Descripci&oacuten: <br>
							{{$producto->descripcion}}
				    	</p>
				      </td>
				      <td>
				      	Cantidad: {{$datac->cantidades[array_search($producto, $data3)]}} pzas <br>
				      	Precio unitario: ${{$datac->precios_unitarios[array_search($producto, $data3)]}}
				      </td>
				      <td>Total: ${{$datac->subtotales_productos[array_search($producto, $data3)]}}</td>
				    </tr><!--Fin Fila-->
				@endforeach

			  </tbody>
			</table>


			<div  style="margin: 0 auto; width: 80%">
				<div class="d-flex flex-row-reverse bd-highlight">
					<div class="p-2 bd-highlight"> <h5>Total de la compra: ${{$datac->total_venta}}</h5></div>
				</div>
			</div>
			<br>
			<!--Seccion de comentarios por parte del negocio-->
	  		<div class="d-flex p-2 bd-highlight comentarios"  style="margin: 0 auto; width: 50%">
			  	<i class="fas fa-comments"></i><p> Comentario(s) del vendedor</p>
		  		<div class="contenidoComentarios">
	  			<div class="d-flex flex-row-reverse bd-highlight">
					  <div class="p-2 bd-highlight">
					  	<!--<p>$datac->comentarios_adicionales['fecha']->toDateTime()->format("d-m-Y H:i:s")}}</p>-->
					  	<!-- Modificación provisional para evitar error al mostrar la fecha del comentario (se debe corregir de manera óptima) -->
					  	<p>{{ $datac->fecha_venta->toDateTime()->format("d-m-Y H:i:s") }}</p>
					  </div>
				  </div>
				  <p>
					 {{$datac->comentarios_adicionales['comentario']}}
				  </p> 			
	  		</div>
	  </div>
		</div>

	</div>
</div>
<br>
<br>
<footer class="card-footer">&copy; 2020 Vaqueriza</footer>
@endsection <!-- Cierra la sección "content" -->
