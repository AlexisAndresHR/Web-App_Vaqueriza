<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Producto extends Eloquent
{

    // 
    protected $connection = 'mongodb';
    protected $collection = 'PRODUCTOS';
    
    protected $fillable = [
        'nombre_producto', 'categoria', 'cantidad_disponible', 'precio', 'precio_mayoreo', 'limite_mayoreo', 'marca', 'descripcion','imagen_producto', 'unidad_medida', 'peso_por_unidad', 'id_comercio'
    ];

    public function scopeNamep($query, $nameP){
		if ($nameP != "")
		{
    	return $query->where('nombre_producto', "LIKE", "%$nameP%");
    }

    }

   public function scopeLocp($query, $locp){
        if ($locp != "")
        {
        return $query->where('domicilio{ciudad}', "LIKE", "%$locp%");
    }

    }

    public function scopeFirstap($query, $firstap){
        if ($firstap != "")
        {
        return $query->orderBy('nombre_producto', 'asc', "%$firstap%");
    }

    }

    public function scopeLastzp ($query, $lastzp){
        if ($lastzp != "")
        {
        return $query->orderBy('nombre_producto', 'desc',"%$lastzp%");
    }

    }

}// Cierre de la clase principal
