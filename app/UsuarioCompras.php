<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class UsuarioCompras extends Eloquent
{

    // 
    protected $connection = 'mongodb';
    protected $collection = 'VENTAS';
    
    protected $fillable = [
    'ids_productos','cantidades','precios_unitarios','subtotales_productos','subtotal_venta','costo_envio','total_venta','fecha_venta','id_usuario','id_comercio','forma_pago','status','fecha_entrega','comentarios_adicionales'
    ];

        public function scopeNamep($query, $nameP){
		if ($nameP != "")
		{
    	return $query->where('nombre_producto', "LIKE", "%$nameP%");
    }

    }
}
