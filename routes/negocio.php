<?php

// Define un prefijo para todas las URL's de Negocios
Route::prefix('/negocio')->group(function(){

	// Ruta para la interfaz Principal del Negocio
	Route::get('/', 'Negocio\MainNegocioController@getMainNegocio');
	// Ruta para interfaz "Perfil del Negocio"
	Route::get('/perfil-negocio/{_id}', 'Negocio\MainNegocioController@getPerfilNegocio');
	Route::post('/perfil-negocio', 'Negocio\MainNegocioController@postPerfilNegocio');// Actualización de datos de perfil del Negocio
	
	// Ruta para interfaz "Publicar producto"
	Route::get('/publicar-producto/{_id}', 'Negocio\MainNegocioController@getPublicarProducto');
	Route::post('/publicar-producto', 'Negocio\MainNegocioController@postPublicarProducto');

	// Ruta para interfaz "Detalle Producto"
	Route::get('/detalle-producto/{_id}', 'Negocio\MainNegocioController@getDetalleProducto');
	Route::post('/detalle-producto/{_id}', 'Negocio\MainNegocioController@postDetalleProducto');


	// Ruta para interfaz "Ventas Pendientes"
	Route::get('/ventas-pendientes/{_id}', 'Negocio\MainNegocioController@getVentasPendientes');
	Route::post('/ventas-pendientes/actualizar', 'Negocio\MainNegocioController@postVentasPendientes');// URL para actualizar el status de las Ventas

	// Ruta para interfaz "Detalle de venta pendiente"
	Route::get('/ventas-pendientes/detalle/{_id}', 'Negocio\MainNegocioController@getDetalleVentaPendiente');

	// Ruta para interfaz "Historial Ventas"
	//Route::get('/ventas', 'Negocio\MainNegocioController@getHistorialVentas');
	Route::get('/ventas/{_id}', 'Negocio\MainNegocioController@getHistorialVentas');

});

?>