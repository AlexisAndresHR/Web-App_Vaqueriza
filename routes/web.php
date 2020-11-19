<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route para la página principal (índex)
Route::get('/index', 'ConnectController@getIndex')->name('index');
// Route informacion sobre sitio web (nosotros)
Route::get('/nosotros', 'ConnectController@getNosotros')->name('nosotros');
// Routes para Autenticación (Inicio de Sesión)
Route::get('/login', 'ConnectController@getLogin')->name('login');
Route::post('/login', 'ConnectController@postLogin');
Route::get('/logout', 'ConnectController@getLogout')->name('logout'); // Route para cerrar sesión

// Routes para formularios de Registro
Route::get('/registro-negocio', 'ConnectController@getRegistroNegocio')->name('registro-negocio');
Route::post('/registro-negocio', 'ConnectController@postRegistroNegocio');
Route::get('/registro-usuario', 'ConnectController@getRegistroUsuario')->name('registro-usuario');
Route::post('/registro-usuario', 'ConnectController@postRegistroUsuario');

// Routes para catálogos (Establecimientos y Productos)
Route::get('/establecimientos/', 'ConnectController@getEstablecimientos')->name('establecimientos');
Route::get('/establecimientos/{_id}',[
	'as' => 'detalle',
	'uses' => 'ConnectController@getDetalleEstablecimiento'
]);

Route::get('/productos', 'ConnectController@getProductos')->name('productos');
Route::get('/productos/{nombre_producto}',[
	'as' => 'detallep',
 	'uses' => 'ConnectController@getDetalleProducto'
]);
