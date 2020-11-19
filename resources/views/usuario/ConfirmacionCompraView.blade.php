@extends('usuario.MasterTemplate')

@section('title', 'Confirmación Compra')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')

<div class="container-fluid">
	<div class="panel shadow">

		@if (session('message_pago'))
			<div style="width: 100%; background-color: #5fff9e; text-align: center;">
				<br>
				<p> <b> {{session('message_pago')}} </b> </p>
				<br>
			</div>
		@elseif (session('message_info'))
			<div style="width: 100%; background-color: #5fff9e; text-align: center;">
				<br>
				<p> <b> {{session('message_info')}} </b> </p>
				<br>
			</div>
		@endif

		<div class="container11">
			<div class="row">
				<div class="col-md-4" style="text-align: center;">
					<img src="{{url('static/images/venta_realizada.png')}}" alt="Responsive image" height="256px">
				</div>

				<div class="col-md-8" style="text-align: center;">
				  <p class="text11"> ¡ Pedido realizado con éxito ! <br> Gracias por su compra </p>
				  <center> <h5> Número de compra: <samp style="color: #3BBF8F"> 1247896541 </samp></h5> </center> <br><br>
				</div>
			</div>
		</div>

		<div style="color: transparent;">
			Icons made by <a href="https://www.flaticon.com/free-icon/shopping-bag_2898484" title="itim2101" style="color: transparent;">itim2101</a> from <a href="https://www.flaticon.com/" title="Flaticon" style="color: transparent;">www.flaticon.com</a>
		</div>

		<center>
			<a href="{{ url('/index') }}">
				<button type="button" class="btn btn-primary btn-lg btn-block" style=" background:#3BBF8F; width: 70%;"> Seguir comprando </button>
			</a>
		</center> <br>
	</div>
	
</div>
<br><br>
<div class="row align-items-end">
	<footer class="card-footer" style="width: 100%">&copy; 2020 Vaqueriza</footer>
</div>

@endsection <!-- Cierra la sección "content" -->
