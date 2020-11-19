<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Ventas extends Eloquent
{
    
    // Definen el método o vía de conexión de BD y el nombre de la tabla (colección)
    protected $connection = 'mongodb';
    protected $collection = 'VENTAS';
    
    protected $fillable = [
        'ids_productos', 'cantidades', 'precios_unitarios', 'subtotales_productos', 'subtotal_venta', 'costo_envio', 'total_venta', /*'fecha_venta',*/ 'id_usuario', 'id_comercio', 'forma_pago', 'status', /*'fecha_entrega',*/ 'comentarios_adicionales'
    ];

    // Define los atributos que en la BD son tipo nativo Date() para MongoDB
    protected $dates = [
    	'fecha_venta', 'fecha_entrega'
    ];


}// Cierre de la clase principal
