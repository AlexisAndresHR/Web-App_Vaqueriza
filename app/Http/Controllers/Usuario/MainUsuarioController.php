<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\UsuarioCompras;
use App\UsuarioNegocios;
use App\UsuarioProductos;
use App\Usuario;
use App\Producto;
use Validator;// Clase para la validación de formularios
use App\VentasPendientes;

use Auth; // Para funcionamiento del middleware y funciones de autenticación

use RealRashid\SweetAlert\Facades\Alert;// Para el uso de sweetalert2 (alerts JS responsivos)


class MainUsuarioController extends Controller
{
    // Crear el constructor ...
    public function __Construct() {
    	// middleware's (pendientes)
        $this->middleware('auth');
        $this->middleware('isusuario');
        // Si no existe la variable de sesión cart, entonces la crea con un array vacío
        if(!\Session::has('cart')) \Session::put('cart', array());
    }

	// Funciones para llamar a las Vistas (Usuario)
    public function getMainUsuario(Request $request) {

        $id_current_user = Auth::user()->_id;
        $usuario = Usuario::where('_id', $id_current_user)->first();
        $data = ['usuario' => $usuario];
        
        //Obtener los productos segun el _Id del usuario
        //$productos = UsuarioCompras::where('marca', 'SOLLA')->get();
        //$data2 = ['productos' => $productos];
        $compras = UsuarioCompras::where('id_usuario', $id_current_user)->namep($request->get('name'))->paginate(3);
        $data2 = ['compras' => $compras];

        $ids_producto = UsuarioCompras::all('ids_productos');
        $ids = ['ids_productos' => $ids_producto];



        //$productos = Producto::where('', 'SOLLA')->get();
        //$data3 = ['productos' => $productos];
        return view('usuario.MainUsuarioView', $data, $data2);
        //return ($res);
    }


    // Funciones para ver y editar el perfil del Usuario
    public function getPerfilUsuario($_id) {

        // Ejecuta la consulta para obtener los datos del Usuario, en base al _id
        $usuario = Usuario::where('_id', $_id)->first();
        $data = ['usuario' => $usuario];

    	return view('usuario.PerfilUsuarioView', $data);
    }
    public function postPerfilUsuario(Request $request) {

        // Reglas para validación de los campos
        $rules = [
            'nombre' => 'required',
            'apellidos' => 'required',
            'contrasena' => 'required',
            'nueva_contrasena' => 'required | min:8',
        ];
        // Reglas para mostrar mensajes de error en idioma Español
        $messages_es = [
            'nombre.required' => 'Ingrese su nombre.',
            'apellidos.required' => 'Ingrese su apellido(s).',
            'contrasena.required' => 'Introduzca su contraseña actual.',
            // Pendiente validar que la contraseña ingresada sea igual a la que está en la BD...
            'nueva_contrasena.required' => 'Introduzca una nueva contraseña.',
            'nueva_contrasena.min' => 'Su nueva contraseña debe tener al menos 8 caracteres.',
        ];

        // Asigna los valores a la clase Validator para crear las reglas de validación
        $validator = Validator::make($request->all(), $rules, $messages_es);
        if ($validator->fails()):
            //return "Error de llenado";
            return back()->withErrors($validator) -> with('message', 'Error en el llenado del formulario.')->with('typealert', 'danger');
        else:
            // Código comentado para posterior inserción de imágen de perfil del usuario...
            $path = '/imgs_usuarios';// Define la ruta relativa en la que se almacenarán las imágenes de perfil de los Negocios
            $fileExt = trim($request->file('img_usuario')->getClientOriginalExtension());// Verifica que la extensión del archivo tenga una estructura correcta
            $upload_path = Config::get('filesystems.disks.uploads.root');//Define la ruta absoluta en la que se almacenarán las imágenes de perfil de los Negocios
            $nombre = Str::slug(str_replace(' ', '', $request->file('img_usuario')->getClientOriginalName()));// Verifica que el nombre del archivo no tenga espacios en blanco ni caracteres especiales (antes de almacenarlo en el servidor)
            $nuevo_nombre_img = Auth::user()->_id . '.' . $fileExt;

            $id_current_user = Auth::user()->_id;// Obtiene el _id del usuario autenticado
            $usuario = Usuario::find($id_current_user);
            $usuario->nombre  = e($request->input('nombre'));
            $usuario->apellidos = e($request->input('apellidos'));
            // Pendiente actualización de la contraseña...
            // Pendiente inserción de imágen de perfil...
            $usuario->img_usuario = $nuevo_nombre_img;

            // Si la actualización se hace correctamente: 
            if ($usuario->save()):
                if ($request->hasFile('img_usuario')):
                    $fl = $request->img_negocio->storeAs($path, $nuevo_nombre_img, 'uploads');// Almacena el archivo de imágen del producto en el servidor
                endif;
                //return "Correcto";
                Alert::success("Modificación realizada", "Su información de perfil ha sido actualizada");// Muestra alert con información para el usuario
                return back() -> with('message', 'Su información se actualizó correctamente.')->with('typealert', 'success');
            endif;
        endif;
    }



    public function getDetalleCompra($_id) {

        $id_current_user = Auth::user()->_id;
        $usuario = Usuario::where('_id', $id_current_user)->first();
        $datau = ['usuario' => $usuario];

        $datac = UsuarioCompras::where('_id', $_id)->first();
        $data2 = ['datac' => $datac];

        
         //datos de los productos 
        $productos = UsuarioProductos::all();
        //$data3 = ['productos' => $productos];

        //obtener los productos de la compra

        $data3 = array();
        $cantidades = array();
        $precios = array();
        foreach ($datac->ids_productos as $id_producto) {
            //$productos = Producto::where('_id',$id_producto)->get();
            foreach ($productos as $producto) {
                if ($id_producto == $producto->_id) {


                   array_push($data3,$producto);
                    //echo implode("", $data3)

                }
            }
        }
        foreach ($datac->cantidades as $cantidad) {
            $c = ['cantidadv' => $cantidad];
            array_push($cantidades,$c );

        }
        foreach ($datac->precios_unitarios as $precio) {
            $p = ['preciov' => $precio];
            array_push($precios, $p);        
        }

        $res = array_merge($data3,$cantidades,$precios);
        $datap = ["data3" => $data3];

        return view('usuario.DetalleCompraView',$datau, $data2)->with($datap);


    }



    /*
      Métodos para el funcionamiento del Carrito de Compra (exclusivo para Usuarios registrados)
    */
    // Función para mostrar el contenido del Carrito de Compra
    public function getCarritoCompra() {

        $cart = \Session::get('cart');// Obtiene la variable de sesión del Carrito de Compra
        $total_carrito = $this->getTotal();// Accede al método para obtener el total actual del Carrito
        $array_total = ['importe_total' => $total_carrito];
        //return $cart;
        return view('usuario.CarritoCompraView', compact('cart'), $array_total);// El método compact() envía a la vista los valores "internos" del arreglo 'cart'
    	//return view('usuario.CarritoCompraView');
    }

    // Función para agregar un Producto al Carrito de Compra
    public function agregarCarrito($_id){
        
        $cart = \Session::get('cart');// Obtiene la variable de sesión para operaciones dentro de esta función
        $producto = Producto::where('_id', $_id)->first();// Consulta los datos del producto (basado en ID)
        $array_data = [$producto];// Ingresa el resultado de la consulta en un arreglo para poder acceder a sus valores con la key (identificador del campo)
        $nombre_prod = $array_data[0]["nombre_producto"];
        $precio_prod = $array_data[0]["precio"];
        $imagen_prod = $array_data[0]["imagen_producto"];
        $comercio_prod = $array_data[0]["id_comercio"];

        $product = new Producto;// Crea una instancia de la "clase" Producto
        // Asigna a la varible-objeto los datos del producto a agregar (6 líneas)
        $product->id = $_id;
        $product->nombre = $nombre_prod;
        $product->precio = $precio_prod;
        $product->cantidad = 1;
        $product->imagen = $imagen_prod;
        $product->comercio = $comercio_prod;

        $cart[$_id] = $product;// Asigna los datos a un arreglo clave-valor por medio de una key para posteriores operaciones

        \Session::put('cart', $cart);// Agrega los nuevos valores a la variable de sesión (Carrito Compra)
        $carrito = \Session::get('cart');// 
        Alert::success("Producto agregado al carrito", "Continúe comprando");// Muestra alert con información para el usuario
        //return $carrito;// prueba...
        return redirect('usuario/carrito-compra');// Envía al usuario a la vista del Carrito

    }

    // Función para actualizar la cantidad de un Producto en el Carrito
    public function actualizarCarrito($_id, $quantity){
        
        $cart = \Session::get('cart');
        $cart[$_id]->cantidad = $quantity;// Se modifica la cantidad del producto seleccionado
        \Session::put('cart', $cart);// Actualiza el Carrito después de la modificación
        Alert::info("Cantidad actualizada", "Continúe su compra");// Muestra alert con información para el usuario
        return redirect('usuario/carrito-compra');// Envía al usuario a la vista del Carrito
    }

    // Función para eliminar un Producto del Carrito
    public function eliminarCarrito($_id){
        
        $cart = \Session::get('cart');// Obtiene el contenido del carrito de compra
        unset($cart[$_id]);// A través de unset() se elimina el Producto del carrito
        \Session::put('cart', $cart);// Actualiza el contenido del carrito posterior a la eliminación
        Alert::info("Producto eliminado del carrito", "Continúe comprando");// Muestra alert con información para el usuario
        //return "AA!! ".$_id;
        return redirect('usuario/carrito-compra');// Envía al usuario a la vista del Carrito
    }

    // Función para eliminar todo el contenido del Carrito
    public function vaciarCarrito(){
        \Session::forget('cart'); // Elimina todo el contenido del carrito a través de forget()
        return redirect('usuario/carrito-compra');// Envía al usuario a la vista del Carrito
    }


    // Funcion privada para calcular el total $$ del Carrito
    private function getTotal(){
        $cart = \Session::get('cart');
        $total = 0.00;
        foreach($cart as $importe_producto){
            $total += $importe_producto->precio * $importe_producto->cantidad;// Almacena el total del Carrito de Compra utilizando un acumulador
        }
        return number_format($total, 2);
    }

    /*
    public function orderDetail(){
        if(count(\Session::get('cart')) <= 0) return redirect()->url('/');//si no hay productos en el carrito
        $cart = \Session::get('cart');
        $total = $this->getTotal();
        return view('user.producto.order-detail', compact('cart', 'total'));
    }
    */


    // Función para el proceso de Pago
    public function getMetodoPago() {

        $id_current_user = Auth::user()->_id;// Obtiene el _id del usuario autenticado
        $usuario = Usuario::where('_id', $id_current_user)->first();
        //return $usuario;
        $array_data = [$usuario];// Ingresa el resultado de la consulta en un arreglo para poder acceder a sus valores con una key (identificador del campo)
        
        if ($data_domicilio = $array_data[0]["domicilio"] != NULL):
            //$data_domicilio = $array_data[0]["domicilio"];
            //$array_data2 = [$data_domicilio];
            //return $array_data2;
            $datos_envio = ['datos_envio' => $usuario];
            //return $datos_envio;

            return view('usuario.MetodoPagoView', $datos_envio);
        else:
            //return "condición funcionando";
            $datos_envio = ['datos_envio' => ''];
            return view('usuario.MetodoPagoView', $datos_envio);
        endif;

    	//return view('usuario.MetodoPagoView');
    }


    // Función para registrar los datos de envío del Usuario
    public function postDatosEnvio(Request $request) {

        // Reglas para validación de los campos
        $rules = [
            'nombre_envio' => 'required',
            'apellidos_envio' => 'required',
            'calle_envio' => 'required',
            'referencias_envio' => 'required',
            'num_ext_envio' => 'required',
            'colonia_envio' => 'required',
            //'ciudad_envio' => 'required',
            //'num_int_envio' => 'required',
            'cp_envio' => 'required',
            //'estado_envio' => 'required',
            'telefono_envio' => 'required',
        ];
        // Reglas para mostrar mensajes de error en idioma Español
        $messages_es = [
            'nombre_envio.required' => 'Debe ingresar un nombre de referencia.',
            'apellidos_envio.required' => 'Debe ingresar un apellido de referencia.',
            'calle_envio.required' => 'Introduzca su calle.',
            'referencias_envio.required' => 'Introduzca alguna referencia de su domicilio.',
            'num_ext_envio.required' => 'Introduzca el número exterior de su domicilio.',
            'colonia_envio.required' => 'Introduzca su colonia.',
            //'ciudad_envio.required' => 'Seleccione su ciudad.',
            //'num_int_envio.required' => 'Introduzca ...',
            'cp_envio.required' => 'Introduzca su código postal.',
            //'estado_envio.required' => 'Seleccione su estado.',
            'telefono_envio.required' => 'Introduzca un número telefónico de referencia.',
        ];

        // Asigna los valores a la clase Validator para crear las reglas de validación
        $validator = Validator::make($request->all(), $rules, $messages_es);
        if ($validator->fails()):
            //return "Error de llenado";
            return back()->withErrors($validator) -> with('message', 'Error en el llenado del formulario.')->with('typealert', 'danger');
        else:
            $id_current_user = Auth::user()->_id;// Obtiene el _id del usuario autenticado
            $usuario = Usuario::find($id_current_user);
            //return $usuario;

            // Asigna los datos del domicilio (dirección de entrega), en un documento anidado MongoDB
            if ($request->input('num_int_envio') != NULL):
                $usuario->domicilio = [
                    //'ciudad' => e($request->input('ciudad_envio')),
                    'estado' => "Hidalgo",
                    'ciudad' => "Tulancingo",
                    'colonia' => e($request->input('colonia_envio')),
                    'calle' => e($request->input('calle_envio')),
                    'numero_calle' => e($request->input('num_ext_envio')),
                    'numero_interior' => e($request->input('num_int_envio')),
                    'codigo_postal' => e($request->input('cp_envio')),
                    'referencias' => e($request->input('referencias_envio')),
                    'nombre_receptor' => e($request->input('nombre_envio')),
                    'apellidos_receptor' => e($request->input('apellidos_envio')),
                    'telefono_receptor' => e($request->input('telefono_envio')),
                ];
            else:
                $usuario->domicilio = [
                    //'ciudad' => e($request->input('ciudad_envio')),
                    'estado' => "Hidalgo",
                    'ciudad' => "Tulancingo",
                    'colonia' => e($request->input('colonia_envio')),
                    'calle' => e($request->input('calle_envio')),
                    'numero_calle' => e($request->input('num_ext_envio')),
                    'codigo_postal' => e($request->input('cp_envio')),
                    'referencias' => e($request->input('referencias_envio')),
                    'nombre_receptor' => e($request->input('nombre_envio')),
                    'apellidos_receptor' => e($request->input('apellidos_envio')),
                    'telefono_receptor' => e($request->input('telefono_envio')),
                ];
            endif;
            /*$usuario->domicilio = [
                //'ciudad' => e($request->input('ciudad_envio')),
                'estado' => "Hidalgo",
                'ciudad' => "Tulancingo",
                'colonia' => e($request->input('colonia_envio')),
                'calle' => e($request->input('calle_envio')),
                'numero_calle' => e($request->input('num_ext_envio')),
                'numero_interior' => e($request->input('num_int_envio')),
                'codigo_postal' => e($request->input('cp_envio')),
                'referencias' => e($request->input('referencias_envio')),
                'nombre_receptor' => e($request->input('nombre_envio')),
                'apellidos_receptor' => e($request->input('apellidos_envio')),
                'telefono_receptor' => e($request->input('telefono_envio')),
            ];*/

            // Si la actualización se hace correctamente: 
            if ($usuario->save()):
                Alert::info("Dirección guardada correctamente", "Continúe con su compra");
                return back() -> with('message', 'Dirección guardada correctamente.')->with('typealert', 'success');
            endif;
        endif;
    }



    public function getConfirmacionCompra() {
    	return view('usuario.ConfirmacionCompraView');
    }

    // Función para registrar una Venta en la BD cuando el Usuario (comprador) ha elegido "Pago contra entrega"
    public function getRegistroVenta() {
        
        $message_info = "Venta registrada. Su pedido está siendo procesado";
        /*
          Código para registrar una nueva Venta (pendiente para el negocio)
        */
        $venta = new VentasPendientes;
        $cart = \Session::get('cart');// Obtiene la variable de sesión del Carrito de Compra
        $ids_prod = array();// Se crea un arreglo para almacenar los ID de los productos del Carrito de Compra
        $cantidades_prod = array();// Arreglo para almacenar las cantidades de los productos del Carrito
        $precios_u_prod = array();// Se crea un arreglo para almacenar los precios unitarios de los productos del Carrito
        $subtotales_prod = array();// Arreglo para almacenar los subtotales de los productos del Carrito
        $subt_venta = 0.0;
        $envio_venta = 0.0;
        $ref_comercio = "";
        // Recorre los elementos del Carrito de Compra para agregarlos a los Conceptos del pago en Paypal
        foreach ($cart as $elemento) {
            // Se agrega el ID de cada producto al arreglo (4)
            $ids_prod[] = $elemento->id;
            $cantidades_prod[] = $elemento->cantidad;
            $precios_u_prod[] = $elemento->precio;
            $subtotales_prod[] = $elemento->precio * $elemento->cantidad;
            $subt_venta += $elemento->precio * $elemento->cantidad;// Se suma el subtotal de la venta con un acumulador
            $ref_comercio = $elemento->comercio;// ID del comercio al que le será registrada la venta
        }
        $venta->ids_productos = $ids_prod;// Tipo array MongoDB
        $venta->cantidades = $cantidades_prod;// Tipo array MongoDB
        $venta->precios_unitarios = $precios_u_prod;// Tipo array MongoDB
        $venta->subtotales_productos = $subtotales_prod;// Tipo array MongoDB
        $venta->subtotal_venta = $subt_venta;
        $venta->costo_envio = $envio_venta;// Consideración pendiente...
        $venta->total_venta = $subt_venta + $envio_venta;
        $venta->fecha_venta = now();// Tipo date Mongo
        $venta->id_usuario = Auth::user()->_id;// Agrega a la venta el ID del usuario/comprador
        $venta->id_comercio = $ref_comercio;// Agrega el ID del comercio/vendedor
        $venta->forma_pago = "Contra Entrega";
        $venta->status = "2";//$venta->status = "Pendiente de pago";
        $venta->fecha_entrega = now();// Tipo date Mongo
        $venta->comentarios_adicionales = [
            'fecha' => now(),// Tipo date Mongo
            'comentario' => "Pedido en preparación.",
        ];

        // Inserta el registro y verifica que se haga correctamente
        if ($venta->save()) {
            \Session::forget('cart');// Una vez insertada la Venta, se vacía el Carrito de Compra
            // Redirige al usuario a la página con información de su compra
            return redirect('/usuario/confirmacion-compra')->with(compact('message_info'));
        }
        //return view('usuario.ConfirmacionCompraView');
    }


}// Cierre de la clase principal
