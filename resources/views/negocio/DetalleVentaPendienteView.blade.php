@extends('negocio.MasterTemplate')

@section('title', 'Detalle venta pendiente')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')

<div class="container-fluid">
	<div class="panel shadow">
		<div class="encabezado">
			<h3 class="title"> Detalle de la venta </h3>
			<div class="d-flex bd-highlight mb-3" style="margin-left: 5%; margin-right: 5%;">
			  <div class="p-2 bd-highlight">Venta No. <span style="color: blue">{{$venta->_id}}</span></div>
			  <div class="ml-auto p-2 bd-highlight">Fecha de venta: {{$venta->fecha_venta->toDateTime()->format("d-m-Y H:i:s") }}</div>
			</div>
			<div class="d-flex flex-column bd-highlight mb-3" style="margin-left: 5%; margin-right: 5%;">
				<div class="p-2 bd-highlight">Nombre del cliente:<strong> {{$comprador->nombre}} {{$comprador->apellidos}}</strong>
				</div>
				<?php
					// Muestra el valor en texto de las categorías (mejor presentación para el usuario)
					if($venta->status == "0"):
						$estado_vta = "En espera de entrega";
					elseif($venta->status == "1"):
						$estado_vta = "Pendiente de envío";
					elseif($venta->status == "2"):
						$estado_vta = "Pendiente de pago";
					elseif($venta->status == "3"):
						$estado_vta = "No es posible hacer el envío";
					elseif($venta->status == "4"):
						$estado_vta = "Completada";
					endif;
				?>
			    <div class="p-2 bd-highlight"> Estado de la venta: <?php echo $estado_vta; ?> </div>
			</div>
			
		</div>

		<div class="cuerpo_contenedor" style="padding: 3%;">

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
				      	Cantidad: {{$venta->cantidades[array_search($producto, $data3)]}} pzas <br>
				      	Precio unitario: ${{$venta->precios_unitarios[array_search($producto, $data3)]}}
				      </td>
				      <td>Total: ${{$venta->subtotales_productos[array_search($producto, $data3)]}}</td>
				    </tr><!--Fin Fila-->
				@endforeach
			
			  </tbody>
			</table>
		<div style="margin: 0 auto; width: 70%">
		{!! Form::open(['url' => '/negocio/ventas-pendientes/actualizar']) !!} <!-- Abre un formulario con HTML Collective -->
			<div class="d-flex flex-row-reverse bd-highlight">
				<div class="p-2 bd-highlight"> <h5>Total de la venta: ${{$venta->total_venta}}</h5></div>
			</div>
			<div class="d-flex flex-column bd-highlight mb-3">
			    <div class="p-2 bd-highlight">
			    	{!! Form::hidden('id_venta', $venta->_id, ['class' => 'form-control']) !!}
				  	<label for="fecha_nac">Estado de la venta:</label>
					<div class="form-group">
						<?php
							$arrayStatus = array('0' => 'En espera de entrega',
							'1' => 'Pendiente de envío',
							'2' => 'Pendiente de pago',
							'3' => 'No es posible hacer el envío',
							'4' => 'Completada');
						?>
						{!! Form::select('status_venta', $arrayStatus, $venta->status, ['class' => 'form-control']) !!}
					</div>
				</div >
				<div class="p-2 bd-highlight">
				  	<label for="fecha_nac">Fecha de entrega</label>
					<div class="input-group">
						<input type="date" id="fecha_envio" name="Fecha_entrega" class="form-control">
					</div>
				</div>
			</div>
			<div class="container">
			  <div class="row justify-content-md-center">
			    <div class="col-md-auto">
			       <!--<a href="#" class="btn btn-primary" style="color: white; margin-left: 0px; padding-top: 0.375rem;">  Actualizar información</a>-->
			       {!! Form::submit('Actualizar información', ['class' => 'btn btn-primary']) !!}
			    </div>
			  </div>
			</div>
		{!! Form::close() !!}
		</div>
		<br>
	</div>

	  <!--Seccion de comentarios por parte del negocio-->
	  <div class="d-flex p-2 bd-highlight comentarios"  style="margin: 0 auto; width: 80%">
		  	<i class="fas fa-comments"></i><p>Realizar comentarios</p>
	  		<div class="contenidoComentarios">
	  			<div class="d-flex flex-row-reverse bd-highlight">
				  <div class="p-2 bd-highlight">
				      <!--<p>$venta->comentarios_adicionales['fecha']->toDateTime()->format("d-m-Y H:i:s")}}</p>-->
				  	  <!-- Modificación provisional para evitar error al mostrar la fecha del comentario (se debe corregir de manera óptima) -->
					  <p>{{ $venta->fecha_venta->toDateTime()->format("d-m-Y H:i:s") }}</p>
				  </div>
			  </div>
			  <p>
					{{$venta->comentarios_adicionales['comentario']}}
			  </p>
			  <div class="form-group">
			    <label for="exampleFormControlTextarea1">Realizar comentario</label>
			    <textarea class="form-control" id="comentariosNegocio" rows="3"></textarea>
			    <div class="d-flex flex-row-reverse bd-highlight">
					<div class="p-2 bd-highlight">
						<button class="btn btn-primary" type="submit">Enviar comentario</button>
					</div>
				</div>
			  		
			  </div>
			  	
	  		</div>
	  </div>
</div>
<br>
<br>
@endsection <!-- Cierra la sección "content" -->
