<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
//pruebas...
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
//pruebas...
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

//use Jenssegers\Mongodb\Eloquent\Model as MongoModel;
 
 //class User extends Authenticatable
//class User extends MongoModel
class User extends Eloquent implements AuthenticatableContract, CanResetPasswordContract
{
    use Notifiable;
    //pruebas...
    use AuthenticatableTrait;
    use Notifiable;
    use CanResetPassword;

    // Definen el método o vía de conexión de BD y el nombre de la tabla (colección)
    protected $connection = 'mongodb';
    protected $collection = 'USUARIOS';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

}// Cierre de la clase principal
