<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Usuario extends Eloquent
{

    // Definen el método o vía de conexión de BD y el nombre de la tabla (colección)
    protected $connection = 'mongodb';
    protected $collection = 'USUARIOS';
    
    protected $fillable = [
        'email', 'password', 'nombre', 'apellidos', 'fecha_nacimiento', 'numero_telefono', 'tipo', 'codigo_recuperacion'
    ];

}// Cierre de la clase principal
