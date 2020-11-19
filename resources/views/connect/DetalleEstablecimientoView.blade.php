@extends('connect.MasterTemplate')

@section('title', 'Detalle establecimiento')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content') 
<h1><p>Detalles de establecimiento</p></h1>

<div class="container">

  <div class="row justify-content-md-center">
    <div class="col-xl-3">
       <div class="card">
        <center><h5 class="card-title">{{ $negocio->nombre_tienda }}</h5>
        <img src="{{ url('static/images/uploads/imgs_negocios/'.$negocio->imagen_negocio.'/') }}" class="img-fluid" width="60%">
      <div class="card-body">
        <a href="{{url('/productos/detalle') }}" class="btn btn-primary ">Calificar negocio</a>
      </div></center>
      </div>
    </div>
    <div class="col-xl-4">
      <div class="card">
      <center><h5 class="card-title">Información</h5></center>
      <div class="card-body">

        <p class="card-text"><b>Nombre:</b> {{ $negocio->nombre_tienda }}</p>
        <p class="card-text"><b>Descripción:</b> {{$negocio->descripcion}}</p>
        <p class="card-text"><b>Teléfono:</b> {{$negocio->numero_telefono}}</p>
        <p class="card-text"><b>Dirección:</b> {{$negocio->correo_electronico}}</p>
      </div>
       </div>
    </div>
    <div class="col">
        <div class="card">
      <center><h5 class="card-title">Producto en tienda</h5></center> 
      <img src="{{ url('static/images/uploads/imgs_productos/producto_icono.jpg') }}" class="img-fluid" alt="Responsive image">
      <div class="card-body">
        <a href="{{url('/productos/') }}" class="btn btn-primary ">Ver producto</a>
      </div>
       </div>
    </div>
    <div class="col">
        <div class="card">
      <center><h5 class="card-title">Producto en tienda</h5></center> 
      <img src="{{ url('static/images/uploads/imgs_productos/producto_icono.jpg') }}" class="img-fluid" alt="Responsive image">
      <div class="card-body">
        <a href="{{url('/productos/') }}" class="btn btn-primary ">Ver producto</a>
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
        <a href="{{url('/productos/') }}" class="btn btn-primary ">Enviar comentarios</a>
      </div>
       </div>
    </div>
    <div class="col-xl-4">
       <div class="card">
        <br>
        <center><h5 class="card-title">Ubicación</h5></center>
      <img src="{{ url('static/images/maps.jpg') }}" class="img-fluid" alt="Responsive image">
      <div class="card-body">
        <a href="{{url('/productos/') }}" class="btn btn-primary ">Ver ubicación en mapa</a>
      </div>
       </div>
    </div>
    <div class="col">
        <div class="card">
      <center><h5 class="card-title">Producto en tienda</h5></center> 
      <img src="{{ url('static/images/uploads/imgs_productos/producto_icono.jpg') }}" class="img-fluid" alt="Responsive image">
      <div class="card-body">
        <a href="{{url('/productos/detalle') }}" class="btn btn-primary ">Ver producto</a>
      </div>
       </div>
    </div>
        <div class="col">
        <div class="card">
      <center><h5 class="card-title">Producto en tienda</h5></center> 
      <img src="{{ url('static/images/uploads/imgs_productos/producto_icono.jpg') }}" class="img-fluid" alt="Responsive image">
      <div class="card-body">
        <a href="{{url('/productos/detalle') }}" class="btn btn-primary ">Ver producto</a>
      </div>
       </div>
    </div>
  </div>
 </div>
@endsection <!-- Cierra la sección "content" -->
