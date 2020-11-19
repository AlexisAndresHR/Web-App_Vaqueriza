@extends('connect.MasterTemplate')

@section('title', 'Bienvenido')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->

@section('content')
<h1><p>Nosotros</p></h1>
<div class="container">
  <div class="row justify-content-md-center" style="margin: 10px">
    <div class="col-xl-4">
       <div class="card"> 
       <center><h4 class="card-title" style="color: #3BB38D; margin: 10px;">¿Qué es Vaqueriza?</h4></center>
       <p style="margin: 10px">
        Vaqueriza es una plataforma digital dedicada a la compra-venta de productos para el cuidado y el mantenimiento de animales del sector ganadero, ofreciendo productos para alimentación, limpieza, entre otras categorías.
       </p>
       <img src="{{ url('static/images/Interrogacion.jpg') }}" style="margin: 10%" class="img-fluid" alt="Responsive image" width="80%">
       </div>
    </div>

    <div class="col-xl-4">
      <div class="card"> 
      <center><h4 class="card-title" style="color: #3BB38D; margin: 10px;">Objetivo</b></center>
      <p style="margin: 10px">
        Proporcionar información acerca de lugares (comercios) del sector ganadero, creando una vía de comercio electrónico para los vendedores y compradores en la cual los negocios de dicha categoría comercialicen sus productos y realicen ventas en línea.
      </p>
      <img src="{{ url('static/images/Objetivo.jpg') }}" style="margin: 10%" class="img-fluid" alt="Responsive image" width="80%">
      </div>
    </div>

    <div class="col-xl-4">
      <div class="card"> 
     <center><h4 class="card-title" style="color: #3BB38D; margin: 10px;">Beneficios</b></center>
      <p style="margin: 10px">
        <ul>
          <li>Funcionalidades para negocios del sector ganadero, los cuales podrán publicar sus productos para promocionarlos y venderlos vía online.</li>
          <li>Usuarios interesados en el sector ganadero pueden realizar compras a diversos negocios y buscar de una manera más sencilla los productos que necesitan.</li>
          <li>Así mismo ofrece distintas formas de entrega y pago para las compras/ventas.</li>
        </ul>
      </p>
      <img src="{{ url('static/images/Beneficios.jpg') }}" style="margin-left: 10%; margin-right: 10%; margin-bottom: 10%;" class="img-fluid" alt="Responsive image" width="80%">
      </div>
    </div>
</div> 


@endsection <!-- Cierra la sección "content" -->