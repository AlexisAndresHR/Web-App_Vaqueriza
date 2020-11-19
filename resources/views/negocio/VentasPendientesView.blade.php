@extends('negocio.MasterTemplate')

@section('title', 'Ventas Pendientes')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<!-- Contenido único del archivo VentasPendientesView.php<br><br> -->
<div class="container-fluid">
	<div class="panel shadow">
		<div class="encabezado">
			<h3 class="title"> Ventas Pendientes </h3>
		</div>

		<div class="cuerpo_contenedor">
			<!-- Aquí se coloca el código para el contenido variable de cada interfaz -->

			<div class="filtros_ventas_pend"> <!--  -->
				<div class="row"> <b>Filtros</b> <br><br> </div>
				<div class="row">
					<div class="col-md-4">
					    <div class="input-group">
					      <input type="text" class="form-control" placeholder="Número de orden">
					      <span class="input-group-btn">
					        <button class="btn btn-default" type="button"> <i class="fa fa-search" aria-hidden="true"></i> </button>
					      </span>
					    </div>
					</div>
					<div class="col-md-2"> Ordenar por:  </div>
					<div class="col-md-3">
						{!! Form::select('filtro_vp', ['0' => 'Más recientes', '1' => 'Más antigüas'], 0, ['class' => 'form-control']) !!}
					</div>
					<div class="col-md-3">
						<button class="btn btn-primary" type="button"> Aplicar </button>
					</div>
				</div>
			</div>

			<!-- Ciclo para el llenado dinámico de la vista de ventas pendientes -->
			@foreach($ventas_p as $venta_p)
				<div class="panel_venta mtop16"> <!-- Sección para listar las ventas pendientes -->
					<div class="imagen_venta">
						<img src="{{ url('static/images/venta_pendiente.png') }}" alt="" class="img-fluclass" style="width: 55%;">
					</div>

					<div class="info_venta">
						<div class="row mtop16">
							<div class="col-md-4 mleft32">
								<p> <b>Número de Orden:</b> </p>
								<p> &nbsp;&nbsp;{{ $venta_p->_id }} </p>
							</div>
							<div class="col-md-3 mleft32">
								<p> <b>Importe (total):</b> </p>
								<p>   &nbsp;&nbsp;${{ $venta_p->total_venta }} </p>
							</div>
							<div class="col-md-4 mleft32">
								<p> <b>Nombre del comprador:</b> </p>
								<p>   &nbsp;&nbsp;John Paul Jones </p>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 mleft32">
								<p> <b>Fecha:</b> </p>
								<p>   &nbsp;&nbsp;{{ $venta_p->fecha_venta }} </p>
							</div>
							<div class="col-md-3 mleft32">
								<p> <b>Método de pago:</b> </p>
								<p>   &nbsp;&nbsp;{{ $venta_p->forma_pago }} </p>
							</div>
							<div class="col-md-4 mleft32">
								<?php
									// Muestra el valor en texto de las categorías (mejor presentación para el usuario)
									if($venta_p->status == "0"):
										$estado_vta = "En espera de entrega";
									elseif($venta_p->status == "1"):
										$estado_vta = "Pendiente de envío";
									elseif($venta_p->status == "2"):
										$estado_vta = "Pendiente de pago";
									elseif($venta_p->status == "3"):
										$estado_vta = "No es posible hacer el envío";
									elseif($venta_p->status == "4"):
										$estado_vta = "Completada";
									endif;
								?>
								<p> <b>Estado:</b> </p>
								<p>   &nbsp;&nbsp;<?php echo $estado_vta; ?> </p>
							</div>
						</div>
						<div class="row mtop16">
							<!-- Botón para ver el detalle de la venta pendiente -->
							<div class="btn_registrar_prod">
								<button type="button" class="btn btn-primary"> <a href="{{ url('/negocio/ventas-pendientes/detalle/'.$venta_p->_id.'/') }}" style="color: white"> Ver Detalle </a> </button>
							</div>
						</div>
					</div>
				</div>
			@endforeach

		</div>
	</div>
</div>

@endsection <!-- Cierra la sección "content" -->
