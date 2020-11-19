<?php

// Define un prefijo para todas las URL's de Usuarios
Route::prefix('/usuario')->group(function(){

	// Ruta para interfaz Principal del Usario/Comprador
	Route::get('/', 'Usuario\MainUsuarioController@getMainUsuario');
	// Ruta para interfaz "Perfil del Usuario"
	Route::get('/perfil-usuario/{_id}', 'Usuario\MainUsuarioController@getPerfilUsuario');
	Route::post('/perfil-usuario', 'Usuario\MainUsuarioController@postPerfilUsuario');
	
	// Ruta para interfaz "Detalle compra"
	Route::get('/detalle-compra/{_id}', 'Usuario\MainUsuarioController@getDetalleCompra');


	// Ruta para interfaz "Detalles/carrito de compra"
	Route::get('/carrito-compra', 'Usuario\MainUsuarioController@getCarritoCompra');
	Route::get('/carrito-compra/agregar/{_id}',[
		'as' => 'agregar_carrito',
		'uses' => 'Usuario\MainUsuarioController@agregarCarrito'
	]);
	Route::get('/carrito-compra/eliminar/{_id}',[
		'as' => 'eliminar_carrito',
		'uses' => 'Usuario\MainUsuarioController@eliminarCarrito'
	]);
	Route::get('/carrito-compra/actualizar/{_id}/{quantity}',[
		'as' => 'actualizar_carrito',
		'uses' => 'Usuario\MainUsuarioController@actualizarCarrito'
	]);


	// Ruta para interfaz "Método de pago"
	Route::get('/pago', 'Usuario\MainUsuarioController@getMetodoPago');

	// Ruta que redirige al método para registrar los datos de envío del Usuario
	Route::post('/pago/datos-envio', 'Usuario\MainUsuarioController@postDatosEnvio');


	//prueba...(implementación PayPal)
	Route::get('/pago/paypal', 'PaymentController@payWithPayPal');
	Route::get('/pago/paypal/status', 'PaymentController@payWithPayPalStatus');

	// Ruta para interfaz "Confirmación de compra"
	Route::get('/confirmacion-compra', 'Usuario\MainUsuarioController@getConfirmacionCompra');
	// Ruta que redirige al método para registrar una nueva Venta en la BD
	Route::get('/registro-venta', 'Usuario\MainUsuarioController@getRegistroVenta');

});

?>