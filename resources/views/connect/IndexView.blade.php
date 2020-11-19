@extends('connect.MasterTemplate')

@section('title', 'Bienvenido')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->

@section('content')
<div class="d-flex flex-column bd-highlight mb-3">
  <div class="p-2 bd-highlight">
    <!--Contenido del Slider-->
    <div class="bd-example">
      <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
          <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
          <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img src="{{ url('static/images/images_slider/slide1.jpeg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5 >Variedad en productos y negocios</h5>
              <p >Encuentre productos para la alimentación y cuidado de sus animales, en Tulancingo y sus alrededores</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{ url('static/images/images_slider/slide2.jpeg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Variedad de productos</h5>
              <p>Encuentre la variedad de productos que le <br> ofrecen los negocios de la región</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="{{ url('static/images/images_slider/slide3.jpeg') }}" class="d-block w-100" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5>Vaqueriza</h5>
              <p>Une a ganaderos de la región con negocios, <br> que ofrecen productos para el cuidado y alimentación de sus animales</p>
            </div>
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>
    </div> 
    <!--Fin de Slider-->
    <br>
    <!--Seccion de productos-->
       <div class="p-2 bd-highlight">
      <div class="container">
        <h5>Productos <a href="{{url('/productos') }}" style="color: #5E210E">Ver todos</a></h5>
        <div class="row">
        @foreach($index_producto as $item)
       <div class="col-md-3">
        <div class="card">
        <div class="card-body">
          <center>
            <h5 class="card-title">{{$item->nombre_producto}}</h5>
            <img src="static/images/uploads/imgs_productos/{{ $item->imagen_producto}}" class="img-fluid" alt="Responsive image" width="80%">
            <br><br><p> {{ $item->descripcion }} </p>
            <a href="{{ route('detallep', $item->nombre_producto) }}" class="btn btn-primary">Ver Producto</a>
          </center>
        </div>
        </div>
      </div>
    @endforeach
        </div>
    </div>
    </div>
    <!--Fin de seccion de produtos-->
    <br>
    <br>
    <img src="{{ url('static/images/banner.jpg') }}" class="img-fluid" alt="Responsive image">
    <br>
    <br>

        <!--Seccion de Negocios-->
       <div class="p-2 bd-highlight">
      <div class="container">
        <h5>Negocios <a href="{{url('/establecimientos') }}" style="color: #5E210E">Ver todos</a></h5>
        <div class="row">
        @foreach($index_establecimiento as $item)
        <div class="col-md-3">
        <div class="card">
        <div class="card-body">
        <center><h5 class="card-title">{{$item->nombre_tienda}}</h5>
        <img src="static/images/uploads/imgs_negocios/{{ $item->imagen_negocio}}" class="img-fluid" alt="Responsive image" width="100%">
        <br><br><p> {{ $item->descripcion }} </p>
        <a href="{{ route('detalle', $item->_id) }} " class="btn btn-primary">Ver negocio</a></center>
        </div>
        </div>
      </div>
    @endforeach
    </div>
    </div>
    </div>
    <!--Fin de seccion de Negocios-->

  </div>





</div>

@endsection <!-- Cierra la sección "content" -->
