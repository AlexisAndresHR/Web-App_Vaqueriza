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
	<link rel="stylesheet" href="{{ url('/static/css/perfilUsuario.css?v='.time()) }}">
	<link rel="stylesheet" href="{{ url('/static/css/usuario.css?v='.time()) }}">
	<link rel="stylesheet" href="{{ url('/static/css/negocio.css?v='.time()) }}">


	<link rel="icon" type="image/png" href="{{ url('static/images/logo_vaqueriza.jpeg') }}" sizes="16x16">
	<!-- Para la fuente de la página (fuentes) -->
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,700&display=swap" rel="stylesheet" href="">

	<!-- Librería JS para los íconos y tipografías -->
    <script src="https://kit.fontawesome.com/05e396472b.js" crossorigin="anonymous"></script>

    <!-- Para uso de ventanas responsivas de sweetalert2 -->
    <!-- ... -->
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
		</ul>
	</nav>
	<hr class="hr_menu" /> <!--Fin de encabezado de pagina-->
	
	<!-- Div para el contenido del resto de la interfaz -->
	<div class="pagina">

		@include('sweetalert::alert') <!-- Para usar sweetalert2 (alerts JS responsivos) -->

		<!-- Sección que se sobrescribirá en las demás interfaces para Usuarios -->
		@section('content')
		@show
	</div>


	<!--<footer class="card-footer">&copy; 2020 Vaqueriza</footer>-->
</body>
</html>