<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class UsuarioPerfil extends Eloquent
{
    //
    protected $connection = 'mongodb';
    protected $collection = 'USUARIOS';
    
    protected $fillable = [
        'email','password':,'nombre','apellidos','fecha_nacimiento','numero_telefono','codigo_recuperacion','imagen_usuario'
    ];
}
