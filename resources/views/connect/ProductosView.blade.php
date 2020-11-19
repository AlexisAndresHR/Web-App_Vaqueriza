@extends('connect.MasterTemplate')

@section('title', 'Productos')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<h1><p>Productos</p></h1>
  <div class="row justify-content-md-center">
    <div class="col">
    </div>
    <div class="col-lg">
    </div>
    <div class="col">
    </div>
    <div class="col">
    </div>
    <div class="col">
    </div>
  </div>
       <nav class="navbar navbar-light ">
       <form class="form-inline" style="margin-left: 980px;">
        <input name= "namep" class="form-control mr-sm-2" type="search" placeholder="Nombre del Producto" aria-label="Search" lef>
         <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Buscar</button>
        </form>
       </nav>
<div class="container">
  <div class="row justify-content-md-center">
    <div class="col-md-3">
       <div class="card">
       <nav class="navbar navbar-light ">
       <form class="form-inline" >
        <p>Buscar por Localidad:</p>
          <select  name= "locp" type="search"  style="width: 140px" > 
          <option>Tulancingo</option>
          <option>Santiago</option>
          <option>Ventoquipa</option>
          <option>Cuautepec</option>
        </select>
         <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-left: 6px">Aplicar</button>
        </form>
       </nav>
        <nav class="navbar navbar-light ">
       <form class="form-inline" >
          <p>Ordenar por abecedario:</p>
          <select name= "firstap" type="search"  style="width: 140px"> 
          <option>A - Z</option>
          </select>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-left: 6px">Aplicar</button>
        </form>
        </nav>
        <nav class="navbar navbar-light ">
        <form class="form-inline" >
          <select  name= "lastzp" type="search" style="width: 140px"> 
          <option>Z - A</option>
        </select>
         <button class="btn btn-outline-success my-2 my-sm-0" type="submit"style="margin-left: 6px">Aplicar</button>
        </form>
       </nav>

       </div>
    </div>
    @foreach($Producto as $item)
      <div class="col-md-3">
        <div class="card">
        <div class="card-body">
          <center>
            <h5 class="card-title">{{$item->nombre_producto}}</h5>
            <img src="static/images/uploads/imgs_productos/{{ $item->imagen_producto}}" class="img-fluid" alt="Responsive image" width="80%">
            <br><br><p> ${{ $item->precio }} </p>
            <a href="{{ route('detallep', $item->nombre_producto) }}" class="btn btn-primary">Ver Producto</a>
            <a href="{{ route('agregar_carrito', $item->_id) }}" class="btn btn-primary" style="background-color: #A9D9C7; color: #3BB38D;"> Agregar a mi carrito </a>
          </center>
        </div>
        </div>
      </div>
    @endforeach
    </div>
        <p>
        {{$Producto->appends(['firstap' =>Request('firstap')])->appends(['namep' =>Request('namep')])->appends(['lastzp' =>Request('lastzp')])->total() }} Productos |
        pagina {{$Producto->appends(['namep' =>Request::get('namep')])->currentPage() }}
        de {{$Producto->appends(['namep' =>Request::get('namep')])->lastPage()}}
        </p>
        {!!$Producto->appends(['namep' =>Request::get('namep')])->render()!!}
  </div>
 </div>
@endsection <!-- Cierra la sección "content" -->

