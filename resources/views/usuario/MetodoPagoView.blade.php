@extends('usuario.MasterTemplate')

@section('title', 'Pago')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<!--seccion de carrito de compra--->
<div class="carrito">
	<i class="fas fa-shopping-cart" align="right"></i>
</div> <br>

<div class="container-fluid">
		<div class="panel shadow">
		<div class="encabezado">
			<h3 class="title"> Detalles de la compra / Carrito </h3>
		</div>

		<div class="cuerpo_contenedor">

			@if (session('message_pago'))
				<div style="width: 100%; background-color: #ff9090; text-align: center;">
					<br>
					<p> {{session('message_pago')}} </p>
					<br>
				</div>
			@endif

			<div class="container">
			  <div class="row">

			  	<!--Seccion de detalle Envio-->
			    <div class="col-sm-6" style="width: 50%;">
					<h5>Detalles de env&iacute;o</h5>
					<nav class="navbar navbar-light bg-light">

						<div class="d-flex flex-row-reverse bd-highlight">
							<div class="form-check">
								<input class="form-check-input" type="radio" name="opciones_envio" id="recoger_tienda" value="0" checked>
							    <label class="form-check-label" for="recoger_tienda">
									Recoger en tienda &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							  	</label>

							    <input class="form-check-input" type="radio" name="opciones_envio" id="envio_domicilio" value="1">
							    <label class="form-check-label" for="envio_domicilio">
									Env&iacute;o a domicilio &nbsp;&nbsp;
							    </label>
							</div>
							<p> <b>Opciones de envío:</b>&nbsp;&nbsp;&nbsp;&nbsp; </p>
						</div>

					<!-- Verifica si el Usuario tiene una dirección de envío ya registrada en la BD -->
					@if ($datos_envio != NULL)
					
						{!! Form::open(['url' => '/usuario/pago/datos-envio']) !!} <!-- Abre un formulario con HTML Collective -->
						<form style="width: 100%">
						  <fieldset id="form_datos_envio" disabled> <!-- Encierra los componentes que estarán deshabilitados (funciones de radio buttons) -->
						  <div class="form-group">
							<label for="nombre_envio">Nombre:</label>
							{!! Form::text('nombre_envio', $datos_envio->domicilio['nombre_receptor'], ['class' => 'form-control', 'placeholder' => 'Nombre completo', 'required']) !!}
						  </div>
						  <div class="form-group">
							<label for="apellidos_envio">Apellido(s):</label>
							{!! Form::text('apellidos_envio', $datos_envio->domicilio['apellidos_receptor'], ['class' => 'form-control', 'placeholder' => 'Apellido(s)', 'required']) !!}
						  </div>
						  <div class="form-group">
							<label for="calle_envio">Calle:</label>
							{!! Form::text('calle_envio', $datos_envio->domicilio['calle'], ['class' => 'form-control', 'placeholder' => 'Calle', 'required']) !!}
						  </div>
						  <div class="form-group">
							<label for="referencias_envio">Referencias:</label>
							{!! Form::text('referencias_envio', $datos_envio->domicilio['referencias'], ['class' => 'form-control', 'placeholder' => 'Entre calles, color casa, etc.', 'required']) !!}
						  </div>
						  <div class="row">
							<div class="col-6">
								<div class="form-group">
									<label for="num_ext_envio">Num. Exterior:</label>
									{!! Form::text('num_ext_envio', $datos_envio->domicilio['numero_calle'], ['class' => 'form-control', 'placeholder' => 'Num. Exterior', 'required']) !!}
								</div>
								<div class="form-group">
									<label for="colonia_envio">Colonia:</label>
									{!! Form::text('colonia_envio', $datos_envio->domicilio['colonia'], ['class' => 'form-control', 'placeholder' => 'Colonia', 'required']) !!}
								</div>
								<div class="form-group">
									<label for="ciudad_envio">Ciudad (Municipio):</label>
									<select id="ciudad_envio" class="form-control">
										<option selected>Tulancingo</option>
										<option>Santiago</option>
										<option>Cuautepec</option>
										<option>Singuilucan</option>
									 </select>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="num_int_envio">Num. Interior *:</label>
									<input type="text" class="form-control" id="num_int_envio" placeholder="Num. Interior* ">
								</div>
								<div class="form-group">
									<label for="cp_envio">Código Postal:</label>
									{!! Form::text('cp_envio', $datos_envio->domicilio['codigo_postal'], ['class' => 'form-control', 'placeholder' => 'Código Postal', 'required', 'maxlength' => '5']) !!}
								</div>
								<div class="form-group">
									<label for="estado_envio">Estado:</label>
									<select id="estado_envio" class="form-control">
										<option selected>Hidalgo</option>
										<option>Puebla</option>
										<option>Tlaxcala</option>
									 </select>
								</div>
							</div>
						  </div>

							<div class="form-group">
								<label for="telefono_envio">Tel&eacute;fono:</label>
								{!! Form::text('telefono_envio', $datos_envio->domicilio['telefono_receptor'], ['class' => 'form-control', 'placeholder' => 'Teléfono', 'maxlength' => '10', 'required']) !!}
							</div>

							<div style="width: 70%; margin: 0 auto">
								{!! Form::submit('Guardar dirección', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
							</div>

							</fieldset>
						</form>
						{!! Form::close() !!}
					
					@else
						{!! Form::open(['url' => '/usuario/pago/datos-envio']) !!} <!-- Abre un formulario con HTML Collective -->
						<form style="width: 100%">
						  <fieldset id="form_datos_envio" disabled> <!-- Encierra los componentes que estarán deshabilitados (funciones de radio buttons) -->
						  <div class="form-group">
							<label for="nombre_envio">Nombre:</label>
							<!--<input type="text" class="form-control" id="nombre_envio" placeholder="Nombre completo" required>-->
							{!! Form::text('nombre_envio', '', ['class' => 'form-control', 'placeholder' => 'Nombre completo', 'required']) !!}
						  </div>
						  <div class="form-group">
							<label for="apellidos_envio">Apellido(s):</label>
							<!--<input type="text" class="form-control" id="apellidos_envio" placeholder="Apellido(s)" required>-->
							{!! Form::text('apellidos_envio', '', ['class' => 'form-control', 'placeholder' => 'Apellido(s)', 'required']) !!}
						  </div>
						  <div class="form-group">
							<label for="calle_envio">Calle:</label>
							<!--<input type="text" class="form-control" id="calle_envio" placeholder="Calle" required>-->
							{!! Form::text('calle_envio', '', ['class' => 'form-control', 'placeholder' => 'Calle', 'required']) !!}
						  </div>
						  <div class="form-group">
							<label for="referencias_envio">Referencias:</label>
							<!--<input type="text" class="form-control" id="referencias_envio" placeholder="Entre calles" required>-->
							{!! Form::text('referencias_envio', '', ['class' => 'form-control', 'placeholder' => 'Entre calles, color casa, etc.', 'required']) !!}
						  </div>
						  <div class="row">
							<div class="col-6">
								<div class="form-group">
									<label for="num_ext_envio">Num. Exterior:</label>
									<!--<input type="text" class="form-control" id="num_ext_envio" placeholder="Num. Exterior" required>-->
									{!! Form::text('num_ext_envio', '', ['class' => 'form-control', 'placeholder' => 'Num. Exterior', 'required']) !!}
								</div>
								<div class="form-group">
									<label for="colonia_envio">Colonia:</label>
									<!--<input type="text" class="form-control" id="colonia_envio" placeholder="Colonia" required>-->
									{!! Form::text('colonia_envio', '', ['class' => 'form-control', 'placeholder' => 'Colonia', 'required']) !!}
								</div>
								<div class="form-group">
									<label for="ciudad_envio">Ciudad (Municipio):</label>
									<select id="ciudad_envio" class="form-control">
										<option selected>Tulancingo</option>
										<option>Santiago</option>
										<option>Cuautepec</option>
										<option>Singuilucan</option>
									 </select>
								</div>
							</div>
							<div class="col-6">
								<div class="form-group">
									<label for="num_int_envio">Num. Interior *:</label>
									<input type="text" class="form-control" id="num_int_envio" placeholder="Num. Interior* ">
								</div>
								<div class="form-group">
									<label for="cp_envio">Código Postal:</label>
									<!--<input type="text" class="form-control" id="municipio_envio" placeholder="Municipio" required>-->
									{!! Form::text('cp_envio', '', ['class' => 'form-control', 'placeholder' => 'Código Postal', 'required', 'maxlength' => '5']) !!}
								</div>
								<div class="form-group">
									<label for="estado_envio">Estado:</label>
									<select id="estado_envio" class="form-control">
										<option selected>Hidalgo</option>
										<option>Puebla</option>
										<option>Tlaxcala</option>
									 </select>
								</div>
							</div>
						  </div>

							<div class="form-group">
								<label for="telefono_envio">Tel&eacute;fono:</label>
								<!--<input type="text" class="form-control" id="telefono_envio" placeholder="Teléfono" maxlength="10" required>-->
								{!! Form::text('telefono_envio', '', ['class' => 'form-control', 'placeholder' => 'Teléfono', 'maxlength' => '10', 'required']) !!}
							</div>

							<div style="width: 70%; margin: 0 auto">
								<!--<a href="/usuario/pago/datos-envio"><button type="submit" class="btn btn-primary btn-lg btn-block"> Guardar dirección </button></a>-->
								{!! Form::submit('Guardar dirección', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
							</div>

							</fieldset>
						</form>
						{!! Form::close() !!}

					@endif

					<!-- Función JavaScript para habilitar el formulario si el usuario elige la opción de envío "Envío a domicilio" -->
					<script>
						var recoger_tienda = document.getElementById('recoger_tienda');// Radio button
						var envio_domicilio = document.getElementById('envio_domicilio');// Radio button
						var form_datos_envio = document.getElementById('form_datos_envio');

						function updateStatus() {
						  if (recoger_tienda.checked) {
						    form_datos_envio.disabled = true;
						  } else {
						    form_datos_envio.disabled = false;
						  }
						}

						recoger_tienda.addEventListener('change', updateStatus);
						envio_domicilio.addEventListener('change', updateStatus);
					</script>
						
			    </div>
				<!--Fin de Seccion de detalle envío-->


				<!--Seccion de detalle pago-->
			    <div class="col-sm-6" style="width: 50%;">
			    	<h5>Método de pago</h5>
					<nav class="navbar navbar-light bg-light">
					<div class="d-flex flex-row-reverse bd-highlight">
						<div class="form-check">
						  <input class="form-check-input" type="radio" name="opciones_pago" id="contraentrega" value="0" checked>
						  <label class="form-check-label" for="contraentrega">
						    Pago contra entrega &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						  </label>

						  <input class="form-check-input" type="radio" name="opciones_pago" id="online" value="1">
						  <label class="form-check-label" for="online">
						    En línea &nbsp;&nbsp;
						  </label>
						</div>
						<p> <b>Opciones de pago:</b>&nbsp;&nbsp;&nbsp;&nbsp; </p>
					</div>

					<div class="container" style="padding: 30px;">
					  <fieldset id="form_datos_pago" disabled> <!-- Encierra los componentes que estarán deshabilitados (funciones de radio buttons) -->
					  	<div class="form-check">
							<input class="form-check-input" type="radio" name="pago_online" id="tarjeta" value="0">
							<p class="form-check-label" for="tarjeta">
							    Tarjeta de crédito
							</p>
						</div>
					    <form style="width: 100%">
							<div class="form-group">
							    <input type="text" class="form-control" id="formGroupExampleInput" placeholder="Número de tarjeta *">
							</div>
							<div class="form-group">
							    <input type="text" class="form-control" id="formGroupExampleInput2" placeholder="Nombre del titular de la tarjeta *">
							</div>
							<p>Fecha de vencimiento *</p>
							<div class="row">
							    <div class="col-6">
							    	<div class="form-group">
									    <select id="inputState" class="form-control">
										    <option selected>Mes</option>
										    <option>01</option>
										    <option>02</option>
										    <option>03</option>
										    <option>04</option>
										    <option>05</option>
										    <option>06</option>
										    <option>07</option>
										    <option>08</option>
										    <option>09</option>
										    <option>10</option>
										    <option>11</option>
										    <option>12</option>
										 </select>
									</div>
									<div class="form-group">
									    <input type="password" class="form-control" id="cvv" placeholder="CVV *" maxlength="3">
									</div>
							    </div>
							    <div class="col-6">
							    	<div class="form-group">
									    <select id="inputState" class="form-control">
										    <option selected>Año</option>
										    <option>2020</option>
										    <option>2021</option>
										    <option>2022</option>
										    <option>2023</option>
										    <option>2024</option>
										    <option>2025</option>
										    <option>2026</option>
										    <option>2027</option>
										    <option>2028</option>
										    <option>2029</option>
										    <option>2030</option>
										 </select>
									</div>
							    </div>
							    
								
							</div>
						</form>

						<div class="form-check">
						    <input class="form-check-input" type="radio" name="pago_online" id="paypal" value="1" checked>
						    <p class="form-check-label" for="paypal">
						    	PayPal®
						    </p>
						</div>
						<p> Será redirigido al sitio seguro de PayPal® para ingresar sus datos y realizar el pago. </p>
					    <div style="width: 100%;">
					    	<a href="{{ url('usuario/pago/paypal') }}"><button type="button" class="btn  btn-block" style="background-color: #3b7bbf; color: white;"> Pagar con PayPal </button></a> <br>
						</div>

					  </fieldset>
					</div>

					<div class="container">
						<div style="width: 100%;">
							<a href="{{ url('/usuario/registro-venta') }}"><button type="button" class="btn btn-primary btn-lg btn-block" id="btn_fin_compra"> Finalizar compra </button></a>
						</div> <br>
					</div>

					</nav> <br>

					<!-- Función JavaScript para habilitar el formulario si el usuario elige la opción de pago "En línea" -->
					<script>
						var contraentrega = document.getElementById('contraentrega');// Radio button
						var online = document.getElementById('online');// Radio button
						var form_datos_pago = document.getElementById('form_datos_pago');
						var btn_fin_compra = document.getElementById('btn_fin_compra');

						var envio_domicilio = document.getElementById('envio_domicilio');// Radio button
						var recoger_tienda = document.getElementById('recoger_tienda');// Radio button

						function updateStatus() {
							// Si el usuario elige "envío a domicilio", solo podrá pagar por método "en línea"
							if (envio_domicilio.checked) {
								online.checked = true;
								contraentrega.disabled = true;
							}
							if (recoger_tienda.checked) {
								contraentrega.disabled = false;
								online.disabled = false;
							}

						    if (contraentrega.checked) {
						        form_datos_pago.disabled = true;
						        btn_fin_compra.disabled = false;
						    } else {
						        form_datos_pago.disabled = false;
						        btn_fin_compra.disabled = true;// Deshabilita el botón "Finalizar compra" para evitar que el usuario compre sin pagar (método de pago online)
						    }
						}

						contraentrega.addEventListener('change', updateStatus);
						online.addEventListener('change', updateStatus);
						envio_domicilio.addEventListener('change', updateStatus);
						recoger_tienda.addEventListener('change', updateStatus);
					</script>

			    </div>
			    <!--Fin Seccion de detalle pago-->

			  </div>
			</div>
		</div>
	</div>


</div>
<footer class="card-footer">&copy; 2020 Vaqueriza</footer>
@endsection <!-- Cierra la sección "content" -->
