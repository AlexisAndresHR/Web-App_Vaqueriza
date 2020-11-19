<?php

namespace App\Http\Controllers\Negocio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Negocio; // Para utilizar el Model (datos) Negocio.php
use App\Producto; // Para utilizar el Model (datos) Producto.php
use Auth; // Para funcionamiento del middleware y funciones de autenticación
use Validator, Hash;
use Config, Str;
use App\VentasPendientes; // Para utilizar el Model (datos) VentasPendientes.php
use App\Usuario; //*
use App\Ventas; // Para utilizar el Model (datos) Ventas.php

use RealRashid\SweetAlert\Facades\Alert;// Para el uso de sweetalert2 (alerts JS responsivos)
use Intervention\Image\Facades\Image;// Alias para el uso de Intervention Image en la app


class MainNegocioController extends Controller
{
    // Crear el constructor ...
    public function __Construct() {
    	// middleware's (pendientes)
        $this->middleware('auth');
        $this->middleware('isnegocio');
    }

    // Funciones para llamar a las Vistas (Negocio)
    public function getMainNegocio(Request $request) {
        //$negocio = Negocio::where('correo_electronico', "comercio-01@mail.com")->pluck('nombre_tienda')->first();
        $id_current_user = Auth::user()->_id;
        $negocio = Negocio::where('_id', $id_current_user)->first();
        //$u = Usuario::findOrFail($_id);
        $data = ['negocio' => $negocio];
        //$id_comercio = strval($negocio['_id']);//prueba...
        $productos = Producto::where('id_comercio', $id_current_user)->namep($request->get('name'))->paginate(3);
        $data2 = ['productos' => $productos];
        
    	return view('negocio.MainNegocioView', $data, $data2);
    }

    
    // Funciones para mostrar y editar la información de perfil del Negocio
    public function getPerfilNegocio($_id) {
        
        // Ejecuta la consulta para obtener los datos del Comercio, en base al _id
        $negocio = Negocio::where('_id', $_id)->first();
        $data = ['negocio' => $negocio];
        
    	return view('negocio.PerfilNegocioView', $data);
    	//return 'Alexis is here !';
    }
    public function postPerfilNegocio(Request $request) {

        // Reglas para validación de los campos
        $rules = [
            'rfc' => 'required | min:13',
            'correo' => 'required | email',
            'nombre_negocio' => 'required',
            'telefono' => 'required | min:10',
            //'contrasena' => 'required | min:8',
            //'nueva_contrasena' => 'required | min:8',
        ];
        // Reglas para mostrar mensajes de error en idioma Español
        $messages_es = [
            'rfc.required' => 'Introducir el RFC de su negocio.',
            'rfc.min' => 'Su RFC debe tener 13 caracteres.',
            'nombre_negocio.required' => 'Introducir el nombre del negocio.',
            'correo.required' => 'Es necesario introducir un correo electrónico.',
            'correo.email' => 'El formato de su correo electrónico no es válido.',
            //'correo.unique' => 'Ya existe un usuario registrado con este correo electrónico.',
            'telefono.required' => 'Introduzca un número de teléfono.',
            'telefono.min' => 'El número de teléfono debe tener 10 dígitos.',
            //'contrasena.required' => 'Para el cambio de contraseña debe introducir su contraseña.',
            //'contrasena.min' => 'Su contraseña debería tener al menos 8 caracteres.',
            //'nueva_contrasena.required' => 'Introduzca una contraseña.',
            //'nueva_contrasena.min' => 'Su nueva contraseña debe tener al menos 8 caracteres.',
        ];

        // Asigna los valores a la clase Validator para crear las reglas de validación
        $validator = Validator::make($request->all(), $rules, $messages_es);
        if ($validator->fails()):
            //return "Error de llenado";
            return back()->withErrors($validator) -> with('message', 'Error en el llenado del formulario.')->with('typealert', 'danger');
        else:

            /*$path = '/imgs_negocios';// Define la ruta relativa en la que se almacenarán las imágenes de perfil de los Negocios
            $fileExt = trim($request->file('img_negocio')->getClientOriginalExtension());// Verifica que la extensión del archivo tenga una estructura correcta
            $upload_path = Config::get('filesystems.disks.uploads.root');//Define la ruta absoluta en la que se almacenarán las imágenes de perfil de los Negocios
            $nombre = Str::slug(str_replace(' ', '', $request->file('img_negocio')->getClientOriginalName()));// Verifica que el nombre del archivo no tenga espacios en blanco ni caracteres especiales (antes de almacenarlo en el servidor)
            $nuevo_nombre_img = Auth::user()->_id . '.' . $fileExt;*/

            /*
              Código para almacenar la imágen del producto, con Intervention Image
            */
            if ($request->file('img_negocio')) {
                // Comprueba si una imágen se agregó al formulario (para evitar errores)
                $image_resize = Image::make($request->file('img_negocio')->getRealPath());
                $image_resize->resize(800, null, function($constraint) {
                     $constraint->aspectRatio();
                     $constraint->upsize();
                });
                $image_resize->orientate();
                //$nombre_img = time() . "." . $request->file('img_negocio')->extension();
                $nombre_img = Auth::user()->_id . '_' . time() . '.' . $request->file('img_negocio')->extension();
                //return $nombre_img;
            }
            /*$image_resize = Image::make($request->file('img_negocio')->getRealPath());
            $image_resize->resize(800, null, function($constraint) {
                 $constraint->aspectRatio();
                 $constraint->upsize();
            });
            $image_resize->orientate();
            //$nombre_img = time() . "." . $request->file('img_negocio')->extension();
            $nombre_img = Auth::user()->_id . '_' . time() . '.' . $request->file('img_negocio')->extension();
            //return $nombre_img;*/

            $id_current_user = Auth::user()->_id;// Obtiene el _id del negocio autenticado
            $negocio = Negocio::find($id_current_user);
            $negocio->rfc  = e($request->input('rfc'));
            //$negocio->correo_electronico = e($request->input('email'));
            $negocio->email = e($request->input('correo'));
            //$negocio->clave = Hash::make($request->input('password'));
            //$negocio->password = Hash::make($request->input('password'));
            $negocio->nombre_tienda = e($request->input('nombre_negocio'));        
            $negocio->numero_telefono = e($request->input('telefono'));
            $negocio->descripcion = e($request->input('descripcion'));
            $negocio->tipo = "1";
            // Nuevos datos del domicilio...
            $negocio->domicilio = [
                'ciudad' => e($request->input('ciudad')),
                'colonia' => e($request->input('colonia')),
                'calle' => e($request->input('calle')),
                'numero_calle' => e($request->input('num_calle')),
                'codigo_postal' => e($request->input('cod_postal')),
                'referencias' => e($request->input('referencias_dom')),
            ];
            if ($request->file('img_negocio')) {
                // Comprueba si una imágen se agregó al formulario (para evitar errores)
                $negocio->imagen_negocio = $nombre_img;// Imágen del Negocio
            }
            //$negocio->imagen_negocio = $nombre_img;// Imágen del Negocio
            /*$negocio->prueba_activa = true;
            $negocio->dias_prueba = 60;
            $negocio->licencia_activa = false;
            $negocio->dias_licencia = 0;
            $negocio->codigo_recuperacion = "";*/

            // Si la actualización se hace correctamente... 
            if ($negocio->save()):
                if ($request->hasFile('img_negocio')):
                    //$fl = $request->img_negocio->storeAs($path, $nuevo_nombre_img, 'uploads');// Almacena el archivo de imágen del producto en el servidor
                    $image_resize->save(public_path('static/images/uploads/imgs_negocios/' . $nombre_img));
                endif;
                //return "Correcto";
                Alert::success("Modificación realizada", "Su información de perfil ha sido actualizada");// Muestra alert con información para el negocio
                return back() -> with('message', 'Su información se actualizó correctamente.')->with('typealert', 'success');
            endif;
        endif;
    }


    // Función para acceder a la interfaz "Publicar nuevo producto"
    public function getPublicarProducto() {
    	return view('negocio.PublicarProductoView');
    }
    public function postPublicarProducto(Request $request) {

        // Reglas para validación de los campos (formulario para publicar un nuevo producto)
        $rules = [
            'nombre_producto' => 'required',
            'marca' => 'required',
            'precio' => 'required',
            'precio_envio' => 'required',
            //'unidad_medida' => 'required',
            'num_unidades' => 'required',
            'stock' => 'required',
            //'categoria' => 'required',
            'precio_mayoreo' => 'required',
            'minimo_piezas' => 'required',
            'descripcion' => 'required',
        ];
        // Reglas para mostrar mensajes de error en idioma Español
        $messages_es = [
            'nombre_producto.required' => 'Debe introducir el nombre del producto.',
            'marca.required' => 'Debe introducir la marca del producto.',
            'precio.required' => 'Debe introducir el precio del producto.',
            'precio_envio.required' => 'Debe introducir el costo de envío (poner 0 en caso de no tenerlo).',
            //'unidad_medida.required' => 'Debe seleccionar la unidad de medida.',
            'num_unidades.required' => 'Debe introducir el contenido por empaque del producto.',
            'stock.required' => 'Debe introducir la cantidad disponible.',
            //'categoria.required' => 'Debe seleccionar una categoría.',
            'precio_mayoreo.required' => 'Debe introducir el precio de mayoreo o poner el mismo precio unitario.',
            'minimo_piezas.required' => 'Debe introducir el mínimo de piezas para precio por mayoreo.',
            'descripcion.required' => 'Debe introducir la descripción del producto.',
        ];

        // Asigna los valores a la clase Validator para crear las reglas de validación
        $validator = Validator::make($request->all(), $rules, $messages_es);
        if ($validator->fails()):
            //return "Error de llenado";
            return back()->withErrors($validator) -> with('message', 'Error en el llenado del formulario.')->with('typealert', 'danger');
        else:

            /*$path = '/imgs_productos';// Define la ruta relativa en la que se almacenarán las imágenes de los Productos
            $fileExt = trim($request->file('imagen_prod')->getClientOriginalExtension());// Verifica que la extensión del archivo tenga una estructura correcta
            $upload_path = Config::get('filesystems.disks.uploads.root');//Define la ruta absoluta en la que se almacenarán las imágenes de los Productos
            $nombre = Str::slug(str_replace(' ', '', $request->file('imagen_prod')->getClientOriginalName()));// Verifica que el nombre del archivo no tenga espacios en blanco ni caracteres especiales (antes de almacenarlo en el servidor)
            $nuevo_nombre_img = Auth::user()->_id . '_' . rand(0,999) . '.' . $fileExt;*/

            /*
              Código para almacenar la imágen del producto, con Intervention Image
            */
            if ($request->file('imagen_prod')) {
                // Comprueba si una imágen se agregó al formulario (para evitar errores)
                $image_resize = Image::make($request->file('imagen_prod')->getRealPath());
                $image_resize->resize(800, null, function($constraint) {
                     $constraint->aspectRatio();
                     $constraint->upsize();
                });
                $image_resize->orientate();
                //$nombre_img = time() . "." . $request->file('imagen_prod')->extension();
                $nombre_img = Auth::user()->_id . '_' . time() . '.' . $request->file('imagen_prod')->extension();
                //return $nombre_img;
            }

            // Acciones con el Model para publicar un nuevo producto
            $producto = new Producto;
            $producto->nombre_producto  = e($request->input('nombre_producto'));
            $producto->categoria = e($request->input('categoria'));
            $producto->cantidad_disponible = e($request->input('stock'));
            $producto->precio = e($request->input('precio'));        
            $producto->precio_mayoreo = e($request->input('precio_mayoreo'));
            $producto->limite_mayoreo = e($request->input('minimo_piezas'));
            $producto->marca  = e($request->input('marca'));
            $producto->descripcion = e($request->input('descripcion'));
            $producto->unidad_medida  = e($request->input('unidad_medida'));
            $producto->peso_por_unidad = e($request->input('num_unidades'));
            if ($request->file('imagen_prod')) {
                // Comprueba si una imágen se agregó al formulario (para evitar errores)
                $producto->imagen_producto = $nombre_img;// Almacena el nombre generado de la imágen
            }
            $id_current_user = Auth::user()->_id;// Obtiene el _id del negocio autenticado
            $producto->id_comercio  = $id_current_user;

            // Si el registro se hace correctamente... 
            if ($producto->save()):
                if ($request->hasFile('imagen_prod')):
                    //$fl = $request->imagen_prod->storeAs($path, $nuevo_nombre_img, 'uploads');// Almacena el archivo de imágen del producto en el servidor
                    $image_resize->save(public_path('static/images/uploads/imgs_productos/' . $nombre_img));// Almacena el archivo de imágen del producto en el servidor
                endif;

                Alert::success("¡Nuevo producto!", "Producto registrado correctamente");// Muestra alert con información para el negocio
                return redirect('/negocio') -> with('message', 'Su producto se registró correctamente.')->with('typealert', 'success');
            else:
                return back() -> with('message', 'Error al registrar el producto...')->with('typealert', 'danger');
            endif;

        endif;
    }


    public function getDetalleProducto($_id) {

        // Ejecuta la consulta para obtener los datos de un Producto, en base al _id
        $producto = Producto::where('_id', $_id)->first();
        $data = ['producto' => $producto];
        //return $data;
        $id_current_user = Auth::user()->_id; // Variable para obtener el id del Negocio autenticado...
        $negocio = Negocio::where('_id', $id_current_user)->first();
        $data2 = ['negocio' => $negocio];

        return view('negocio.DetalleProductoView', $data, $data2);
        //return 'Alexis is here !';
    }
    public function postDetalleProducto(Request $request, $_id) {

        /*
        $path = '/imgs_negocios';// Define la ruta relativa en la que se almacenarán las imágenes de perfil de los Negocios
        $fileExt = trim($request->file('img_negocio')->getClientOriginalExtension());// Verifica que la extensión del archivo tenga una estructura correcta
        $upload_path = Config::get('filesystems.disks.uploads.root');//Define la ruta absoluta en la que se almacenarán las imágenes de perfil de los Negocios
        $nombre = Str::slug(str_replace(' ', '', $request->file('img_negocio')->getClientOriginalName()));// Verifica que el nombre del archivo no tenga espacios en blanco ni caracteres especiales (antes de almacenarlo en el servidor)
        $nuevo_nombre_img = Auth::user()->_id . '.' . $fileExt;
        */

        //$id_current_user = Auth::user()->_id;// Obtiene el _id del negocio autenticado
        $producto = Producto::find($_id);
        $producto->nombre_producto  = e($request->input('nombre_producto'));
        $producto->categoria = e($request->input('categoria'));
        $producto->cantidad_disponible = e($request->input('stock'));
        $producto->precio = e($request->input('precio'));        
        $producto->precio_mayoreo = e($request->input('precio_mayoreo'));
        $producto->limite_mayoreo = e($request->input('minimo_piezas'));
        $producto->marca  = e($request->input('marca'));
        $producto->descripcion = e($request->input('descripcion'));
        $producto->unidad_medida  = e($request->input('unidad_medida'));
        $producto->peso_por_unidad = e($request->input('num_unidades'));
        //$producto->imagen_producto = $nuevo_nombre_img;

        // Si la actualización se hace correctamente... 
        if ($producto->save()):
            /*if ($request->hasFile('img_negocio')):
                $fl = $request->img_negocio->storeAs($path, $nuevo_nombre_img, 'uploads');// Almacena el archivo de imágen del producto en el servidor
            endif;
            */
            Alert::success("Modificación realizada", "Producto actualizado correctamente");// Muestra alert con información para el negocio
            return back() -> with('message', 'Su información se actualizó correctamente.')->with('typealert', 'success');
        endif;
    }



    // Función para la interfaz de "Ventas Pendientes" del Negocio
    public function getVentasPendientes($_id) {

        //$id_current_user = Auth::user()->_id;// Obtiene el _id del negocio autenticado
        // ...
        $venta_pendiente = VentasPendientes::where('id_comercio', $_id)->where('status', '!=', '4')->get();//$venta_pendiente = VentasPendientes::where('id_comercio', $_id)->where('status', '!=', 'Completada')->get();
        $data = ['ventas_p' => $venta_pendiente];
        //return $data;
        //$array2 = [$venta_pendiente];
        //$id_usuario = $array2[0]["id_usuario"];
        //return $id_usuario;
        //$comprador = Usuario::where('_id', $id_usuario)->pluck('nombre')->first();
        //$comprador = Usuario::where('_id', $id_usuario)->first();
        //$data_comprador = ['compradores' => $comprador];
        //return $data_comprador;

    	return view('negocio.VentasPendientesView', $data);
    }

    public function getDetalleVentaPendiente($_id) {

        //datos de la venta
        $venta = Ventas::where('_id', $_id)->first();
        $data = ['venta' => $venta];

        //datos del comprador
        $comprador = Usuario::where('_id', $venta->id_usuario)->first();
        $data2 = ['comprador' => $comprador];

        //datos de los productos 
        $productos = Producto::all();
        //$data3 = ['productos' => $productos];

        //obtener los productos de la compra

        $data3 = array();
        $cantidades = array();
        $precios = array();
        foreach ($venta->ids_productos as $id_producto) {
            //$productos = Producto::where('_id',$id_producto)->get();
            foreach ($productos as $producto) {
                if ($id_producto == $producto->_id) {


                   array_push($data3,$producto);
                    //echo implode("", $data3)

                }
            }
        }
        foreach ($venta->cantidades as $cantidad) {
            $c = ['cantidadv' => $cantidad];
            array_push($cantidades,$c );

        }
        foreach ($venta->precios_unitarios as $precio) {
            $p = ['preciov' => $precio];
            array_push($precios, $p);        
        }

        $res = array_merge($data3,$cantidades,$precios);
        $datap = ["data3" => $data3];

        //return($datap);
      
    	return view('negocio.DetalleVentaPendienteView',$data,$data2)->with($datap);
    }
    // Función para actualizar el status de una Venta ...
    public function postVentasPendientes(Request $request) {
        
        $venta = Ventas::find(e($request->input('id_venta')));//$venta = Ventas::find($_id);
        $venta->status = e($request->input('status_venta'));
        //$venta->fecha_entrega = e($request->input('fecha_envio'));

        //Comprueba si el status de la venta es "Completada", para mostrar alert específico
        if (e($request->input('status_venta')) == "4"):
            // Si la actualización del status de la Venta se hace correctamente: 
            if ($venta->save()):
                Alert::success("Venta completada", "Consulte la información en su Historial de Ventas");// Muestra alert con información para el negocio
                return back() -> with('message', 'Venta marcada como completada.')->with('typealert', 'success');
            endif;
        else:
            // Si la actualización del status de la Venta se hace correctamente: 
            if ($venta->save()):
                Alert::success("Información actualizada", "Se cambió el estado de su venta");// Muestra alert con información para el negocio
                return back() -> with('message', 'Su información se actualizó correctamente.')->with('typealert', 'success');
            endif;
        endif;

        // Si la actualización del status de la Venta se hace correctamente: 
        /*if ($venta->save()):
            Alert::success("Información actualizada", "Se cambió el estado de su venta");// Muestra alert con información para el negocio
            return back() -> with('message', 'Su información se actualizó correctamente.')->with('typealert', 'success');
        endif;*/
    }


    // Función para la interfaz "Historial de Ventas" del Negocio
    public function getHistorialVentas($_id) {

        $ventas = Ventas::where('id_comercio', $_id)->where('status', '4')->get();//$ventas = Ventas::where('id_comercio', $_id)->where('status', 'Completada')->get();
        $data_ventas = ['ventas' => $ventas];
        //return $data_ventas;

    	return view('negocio.HistorialVentasView', $data_ventas);
    }


}// Cierre de la clase principal
