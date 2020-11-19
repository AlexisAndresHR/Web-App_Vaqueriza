<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UsuarioNegocios extends Eloquent
{
    // 
    protected $connection = 'mongodb';
    protected $collection = 'COMERCIOS';
    
    protected $fillable = [
        'rfc', 'correo_electronico', 'clave', 'nombre_tienda', 'numero_telefono', 'descripcion', 'tipo', 'prueba_activa', 'dias_prueba', 'licencia_activa', 'dias_licencia', 'codigo_recuperacion'
    ];
}
