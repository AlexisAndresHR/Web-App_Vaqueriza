<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UsuarioProductos extends Eloquent
{
    // 
    protected $connection = 'mongodb';
    protected $collection = 'PRODUCTOS';
    
    protected $fillable = [
        'nombre_producto', 'categoria', 'cantidad_disponible', 'precio', 'precio_mayoreo', 'limite_mayoreo', 'marca', 'descripcion', 'unidad_medida', 'peso_por_unidad', 'id_comercio'
    ];
}
