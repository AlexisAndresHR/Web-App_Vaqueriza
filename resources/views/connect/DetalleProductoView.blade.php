@extends('connect.MasterTemplate')

@section('title', 'Detalle producto')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content') 
<h1><p>Detalles de productos</p></h1>

<div class="container">

  <div class="row justify-content-md-center">
    <div class="col-xl-3">
       <div class="card">
        <center><h5 class="card-title">{{ $pro->nombre_producto}}</h5>
        <img src="{{ url('static/images/uploads/imgs_productos/'.$pro->imagen_producto.'/') }}" class="img-fluid" width="60%">
      <div class="card-body">
        <a href="{{url('/productos/detalle') }}" class="btn btn-primary ">Calificar producto</a>
      </div>
       </div>
    </div>

    <div class="col-xl-4">
       <div class="card">
        <center><h5 class="card-title">Información</h5></center>
      <div class="card-body">
        <p class="card-text"><b>Nombre:</b> {{ $pro->nombre_producto}}</p>
        <p class="card-text"><b>Descripción:</b> {{ $pro->descripcion}}</p>
        <p class="card-text"><b>Costo por unidad:</b> ${{ $pro->precio}}</p>
        <p class="card-text"><b>Costo por mayoreo:</b> ${{ $pro->precio_mayoreo}}</p>
        <p class="card-text"><b>Disponibilidad:</b> {{ $pro->cantidad_disponible}} unidades</p>
        <a href="{{url('/usuario/pago') }}" class="btn btn-primary"> Comprar ahora </a>
      </div>
       </div>
    </div>
    <div class="col">
        <div class="card">
      <center><h5 class="card-title">Otros productos</h5></center> 
      <img src="{{ url('static/images/uploads/imgs_productos/5f00ab80cc0b0000b6003de6_664.jpg') }}" class="img-fluid" alt="Responsive image">
      <div class="card-body">
        <a href="{{url('/productos/') }}" class="btn btn-primary ">Buscar mas</a>
      </div>
       </div>
    </div>
    <div class="col">
        <div class="card">
      <center><h5 class="card-title">Otros productos</h5></center> 
      <img src="{{ url('static/images/uploads/imgs_productos/alimento3.jpg') }}" class="img-fluid" alt="Responsive image">
      <div class="card-body">
        <a href="{{url('/productos/') }}" class="btn btn-primary ">Buscar mas</a>
      </div>
       </div>
    </div>
  </div>


  <div class="row justify-content-md-center">
    <div class="col-xl-3">
       <div class="card">
        <center><h5 class="card-title">Comentarios</h5></center>
        <textarea name="textarea" rows="8" cols="10"></textarea>
      <div class="card-body">
        <a href="#" class="btn btn-primary ">Enviar comentario</a>
      </div>
       </div>
    </div>
    <div class="col-xl-4">
       <div class="card"> 
        <center><h5 class="card-title">Más establecimientos</h5></center>
      <img src="{{ url('static/images/uploads/imgs_negocios/negocio_icono.png') }}" class="img-fluid" alt="Responsive image" width="60%" style="margin-left: 20%;">
      <div class="card-body">
        <a href="{{url('/establecimientos') }}" class="btn btn-primary ">Ver más establecimiento</a>
      </div>
       </div>
    </div>
    <div class="col">
        <div class="card">
      <center><h5 class="card-title">Otros productos</h5></center> 
      <img src="{{ url('static/images/uploads/imgs_productos/alimento_01.jpg') }}" class="img-fluid" alt="Responsive image">
      <div class="card-body">
        <a href="{{url('/productos/') }}" class="btn btn-primary ">Buscar mas</a>
      </div>
       </div>
    </div>
        <div class="col">
        <div class="card">
      <center><h5 class="card-title">Otros productos</h5></center> 
      <img src="{{ url('static/images/uploads/imgs_productos/5f00ab80cc0b0000b6003de6_50.png') }}" class="img-fluid" alt="Responsive image">
      <div class="card-body">
        <a href="{{url('/productos/') }}" class="btn btn-primary ">Buscar mas</a>
      </div>
       </div>
    </div>
  </div>
 </div> 

@endsection <!-- Cierra la sección "content" -->

