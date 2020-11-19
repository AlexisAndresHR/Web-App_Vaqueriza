@extends('connect.MasterTemplate')

@section('title', 'Establecimientos')

<!-- Sobreescribe la sección "content" del MasterTemplate (contenido del body) -->
@section('content')
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<h1><p>Establecimientos</p></h1>
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
        <input name= "name" class="form-control mr-sm-2" type="search" placeholder="Nombre del Negocio" aria-label="Search" lef>
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
          <select  name= "loc" type="search"  style="width: 140px" > 
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
          <select name= "firsta" type="search"  style="width: 140px"> 
          <option>A - Z</option>
          </select>
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit" style="margin-left:6px">Aplicar</button>
        </form>
        </nav>
        <nav class="navbar navbar-light ">
        <form class="form-inline" >
          <select  name= "lastz" type="search" style="width: 140px"> 
          <option>Z - A</option>
        </select>
         <button class="btn btn-outline-success my-2 my-sm-0" type="submit"style="margin-left: 6px">Aplicar</button>
        </form>
       </nav>

       </div>
    </div>
    @foreach($establecimiento as $item)
      <div class="col-md-3">
        <div class="card">
        <div class="card-body">
          <center><h5 class="card-title">{{$item->nombre_tienda}}  {{Request::get('')}}</h5>
        <img src="static/images/uploads/imgs_negocios/{{ $item->imagen_negocio}}" class="img-fluid" alt="Responsive image" width="100%">
          <a href="{{ route('detalle', $item->_id) }} " class="btn btn-primary">Ver negocio</a></center>
        </div>
        </div>
      </div>
    @endforeach
    </div>
        <p>
        {{$establecimiento->appends(['firsta' =>Request('firsta')])->appends(['name' =>Request('name')])->appends(['lastz' =>Request('lastz')])->total() }} Negocios |
        pagina {{$establecimiento->appends(['name' =>Request::get('name')])->currentPage() }}
        de {{$establecimiento->appends(['name' =>Request::get('name')])->lastPage()}}
        </p>
        {!!$establecimiento->appends(['name' =>Request::get('name')])->render()!!}
      </div>
    </div>
@endsection <!-- Cierra la sección "content" -->

