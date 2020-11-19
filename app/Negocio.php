<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Negocio extends Eloquent
{
    
    // Definen el método o vía de conexión de BD y el nombre de la tabla (colección)
    protected $connection = 'mongodb';
    //protected $collection = 'COMERCIOS';
    protected $collection = 'USUARIOS';
    
    protected $fillable = [
        'rfc', 'email', 'password', 'nombre_tienda', 'numero_telefono', 'descripcion', 'imagen_negocio', 'tipo', 'prueba_activa', 'dias_prueba', 'licencia_activa', 'dias_licencia', 'codigo_recuperacion', 'domicilio'
    ];

    // Funciónes para el input de búsqueda de establecimientos (Negocios) del 'Catálogo de establecimientos'
    public function scopeName($query, $name){
		if ($name != "")
		{
    	return $query->where('nombre_tienda', "LIKE", "%$name%");
    }

    }

    public function scopeLoc($query, $loc){
        if ($loc != "")
        {
        return $query->where('domicilio', 0);
        //return $query->belongsTo('App\Controllers\ConnectController','domicilio')->where('domicilio', 0);//
    }

    }

    public function scopeFirsta($query, $firsta){
        if ($firsta != "")
        {
        return $query->orderBy('nombre_tienda', 'asc', "%$firsta%");
    }

    }

    public function scopeLastz ($query, $lastz){
        if ($lastz != "")
        {
        return $query->orderBy('nombre_tienda', 'desc',"%$lastz%");
    }

    }
}// Cierre de la clase principal
