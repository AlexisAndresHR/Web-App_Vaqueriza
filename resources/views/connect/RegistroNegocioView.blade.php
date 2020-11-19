@extends('connect.MasterTemplate')

@section('title', 'Registro de Negocio')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<!-- Contenedor para el formulario de Registro de Negocio -->
	<div class="boxregistro box_registro shadow" style="margin: 0 auto;">
	<h4 class="mtop16 login_titles"> Registro de Negocio </h4>
	<!-- Abre un formulario con HTML Collective -->
	{!! Form::open(['url' => '/registro-negocio']) !!}

	<div class="row mtop16">
		<div class="col-md-4">
			<label for="rfc"> RFC: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">
						<i class="fas fa-edit"></i>
					</span>
				</div>
				{!! Form::text('rfc', null, ['class' => 'form-control', 'placeholder' => 'VECJ880326XXX', 'required']) !!}
			</div>
		</div>
		
		<div class="col-md-4">
			<label for="nombre"> Nombre del negocio: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">
						 <i class="fas fa-edit"></i>
					</span>
				</div>
				{!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Nombre', 'required']) !!}
			</div>
		</div>
		
		<div class="col-md-4">
			<label for="email"> Correo Electrónico: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">
					 	<i class="fas fa-envelope"></i> 
					</span>
				</div>
				{!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'usuario@correo.com', 'required']) !!}
			</div>
		</div>
	</div>
	<div class="row mtop16">
		<div class="col-md-4">
			<label for="telefono"> Teléfono: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">
					 	<i class="fas fa-mobile-alt"></i>
					</span>
				</div>
				{!! Form::text('telefono', null, ['class' => 'form-control', 'placeholder' => '10 digitos', 'required']) !!}
			</div>
		</div>
		<div class="col-md-4">
			<label for="localidad"> Localidad: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<span class="input-group-text" id="basic-addon1">
						<i class="fas fa-map-marker-alt"></i>
					</span>
				</div>
			{!! Form::select('localidad', ['0' => 'Tulancingo', '1' => 'Santiago', '2' => 'Cuautepec'], 0,['class' => 'form-control', 'required']) !!}
			</div>
		</div>
		
		<div class="col-md-4">
			<label for="password"> Contraseña: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text"> <i class="fas fa-key"></i> </div>
				</div>
				{!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'Contraseña', 'required']) !!}
			</div>
		</div>
	</div>
	<div class="row mtop16">
		<div class="col-md-4">
			<label for="descripcion"> Descripción: </label>
			<div class="input-group">
				<div class="input-group-prepend">
					<div class="input-group-text"> <i class="fas fa-edit"></i> </div>
				</div>
				{!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Descripcion del negocio', 'required']) !!}
			</div>
		</div>
		<div class="col-md-4">
			<label for="ubicacion"> </label>
			<div class="input-group">
<!--Google Mpas Api-->
<!--AIzaSyDtLtS5e2puQxjAAtFp4TdwdFe9QuRePLM
				<div class="form-group">
    			<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtLtS5e2puQxjAAtFp4TdwdFe9QuRePLM&callback=initMap&libraries"defer></script>
    			<style type="text/css">
     			#map {
       			height: 280px;
        		width: 540px
      			}
    			</style>
   				<script>
      				let map;
     				 function initMap() {
        			map = new google.maps.Map(document.getElementById("map"), {
          			center: {
          			  lat: -34.397,
         			   lng: 150.644
         			 },
         			 zoom: 8
       				 });
     				}
   					</script>
  					<body>
   					 <div id="map"></div>
  					</body>
				</div>-->
			</div>
		</div>
	</div>
<div class="row mtop16">
		<div class="col-md-4">
			<div>
				<div>
			<button type="button" class="btn btn-primary "><a href="{{
             url('/login')}}" style="color: white"> Regresar </a></button>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div>
				<div>
				</div> 
			</div>
		</div>
		<div class="col-md-4">
	
			<div>
				<div class="input-group-prepend">
				</div>
           {!! Form::submit('Registrar Negocio', ['class' => 'btn btn-primary', 'style' => 'color: white; margin-left: 0px; padding-top: 0.375rem;']) !!}
			</div>

		</div>
	</div>

</div>

    {!! Form::close() !!}
   
		<!-- Sección que se sobrescribirá en las demás interfaces para Usuarios -->

@endsection <!-- Cierra la sección "content" -->













