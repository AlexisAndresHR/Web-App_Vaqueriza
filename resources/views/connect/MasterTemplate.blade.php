<!DOCTYPE html>
<html>
<head>
	<title> @yield('title') - Vaqueriza </title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<meta name="routeName" content="{{ Route::currentRouteName() }}">
	
	<!-- Links para las hojas de estilos con Bootstrap -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('/static/css/encabezadoMaster.css?v='.time()) }}">
    <link rel="stylesheet" href="{{ url('/static/css/connect.css?v='.time()) }}">

    <link rel="icon" type="image/png" href="{{ url('static/images/logo_vaqueriza.jpeg') }}" sizes="16x16">
    <!-- Para la fuente de la página (fuentes) -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet" href="">

	<!-- Para usar jQuery en las interfaces de Connect -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<!-- Librería JS para las tipografías (fuentes) -->
    <script src="https://kit.fontawesome.com/05e396472b.js" crossorigin="anonymous"></script>

    <!-- Para uso de la API de Google Maps (funciones de ubicación del Negocio) -->
	<!-- API_KEY Maps: AIzaSyBgk5jHlYDfCYHQZyVZmeY0zT3FmGkvf80 -->
	<script async defer
	  	src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgk5jHlYDfCYHQZyVZmeY0zT3FmGkvf80&callback=initMap">
	</script>
    
</head>

<body>
<!--Encabezado de pagina-->
	<nav class="navbar navbar-light bg-light">
	  <a class="navbar-brand" href="{{ url('/index') }}">
	    <img src="{{ url('static/images/logo_vaqueriza.jpeg') }}" width="70" height="70" alt="" class="img-fluclass">
	  </a>
	  <ul class="nav justify-content-end">
		  <li class="nav-item">
		    <a class="badge nav-link" href="{{url('/index') }}">Inicio </a>
		  </li>
		  <li class="nav-item">
		    <a class="badge nav-link" href="{{url('/nosotros') }}">Nosotros</a>
		  </li>
		  <li class="nav-item">
		    <a class="badge nav-link" href="{{url('/establecimientos') }}">Establecimientos</a>
		  </li>
		  <li class="nav-item">
		    <a class="badge nav-link" href="{{url('/productos') }}">Productos</a>
		  </li>
		  <?php
		  	if(Auth::user()) {
		  		?>
		  		<li class="nav-item">
				    <a class="badge nav-link" href="{{url('/usuario/carrito-compra') }}">
				    	Carrito
				    	<i class="fas fa-shopping-cart"></i>
					</a>
				</li>
				<li class="nav-item">
				    <a class="badge nav-link" href="{{url('/usuario') }}"> {{ Auth::user()->nombre }} <i class="fas fa-user"></i></a> <!-- Se agrega ícono -->
				</li>
				<li class="nav-item">
				    <a class="badge nav-link" href="{{url('/logout') }}"> Cerrar sesión <i class="fas fa-sign-out-alt"></i></a>
				</li>
				<?php
		  	}
		  	else {
		  		?>
		  		<li class="nav-item">
				    <a class="badge nav-link" href="{{url('/login') }}"> Iniciar Sesión <i class="fas fa-sign-in-alt"></i></a> <!-- Se agrega ícono -->
				</li>
		  		<?php
		  	}
		  ?>
		</ul>
	</nav>
	<hr class="hr_menu" /> <!--Fin de encabezado de pagina-->


	<!-- Condicional para mensajes de error y variables de sesión -->
	@if(Session::has('message'))
		<div class="container">
			<div class="alert alert-{{ Session::get('typealert') }}" style="display:none;">
				{{ Session::get('message') }}
				@if ($errors->any())
				<ul>
					@foreach ($errors->all() as $error)
					<li> {{ $error }} </li>
					@endforeach
				</ul>
				@endif
				<script>
					$('.alert').slideDown();
					setTimeout(function(){ $('.alert').slideUp(); }, 10000);
				</script>
			</div>
		</div>
	@endif

	
	<!-- Div para el contenido del resto de la interfaz -->
	<div class="pagina">


		<!-- Sección que se sobrescribirá en las demás interfaces para Usuarios -->
		@section('content')
		@show
	</div>

	<footer class="card-footer">&copy; 2020 Vaqueriza</footer>

	<!--Librerias Java Script para el funcionamiento del Slider-->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>
</html>