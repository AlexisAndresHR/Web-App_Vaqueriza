<?php

namespace App\Http\Controllers;

Use Illuminate\Http\Request;
Use Validator, Hash; // Para hacer uso de la clase de validación de Laravel; Hash se encarga de encriptar datos para no almacenarse en texto plano (contraseñas).
Use App\Usuario; // Asigna el Modelo a este controlador para trabajar con la BD.
use App\Negocio; // Asigna el Modelo a este controlador para trabajar con la BD.
use App\Producto; // Asigna el Modelo a este controlador para trabajar con la BD.
Use Auth; // Clase para los métodos de autenticación.
Use App\Image;

class ConnectController extends Controller
{

    public function __construct() {
        /*
         El middleware 'guest' establece que los métodos de este controlador se ejecutarán cuando el usuario es un "Invitado".
         except() Determina los métodos a los que se podrá acceder cuando el usuario ya ha iniciado sesión.
        */
        $this->middleware('guest')->except(['getLogout', 'getIndex', 'getEstablecimientos', 'getProductos', 'getDetalleEstablecimiento', 'getDetalleProducto', 'getNosotros']);
    }

    // Función para las acciones de Inicio de Sesión
    public function getLogin() {
    	return view('connect.LoginView');
    }



    public function postLogin(Request $request) {
        // // Reglas para validación de los datos de inicio de sesión
        $rules = [
            'email' => 'required | email',
            'password' => 'required | min:8'
        ];
        // Reglas para mostrar mensajes de error en idioma Español
        $messages_es = [
            'email.required' => 'Introduzca su correo electrónico.',
            'email.email' => 'El formato del correo electrónico no es válido.',
            'password.required' => 'Introduzca su contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.'
        ];

        // Asigna los valores a la clase Validator para crear las reglas de validación
        $validator = Validator::make($request->all(), $rules, $messages_es);
        if ($validator->fails()):
            return back()->withErrors($validator) -> with('message', 'Error en el llenado del formulario.')->with('typealert', 'danger');
        else:
            // Código para autenticar al usuario, si los datos de acceso son correctos
            if (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'tipo' => '1'], true)):
                return redirect('/negocio');
            elseif (Auth::attempt(['email' => $request->input('email'), 'password' => $request->input('password'), 'tipo' => '2'], true)):
                return redirect('/usuario');
            else:
                return back()->withErrors($validator) -> with('message', 'El correo electrónico y/o la contraseña son incorrectos.')->with('typealert', 'danger');
            endif;
        endif;
    }

    public function getLogout() { // Método para finalizar/cerrar la sesión del usuario
        Auth::logout();
        return redirect('/index');
    }


    // Función para la interfaz "Pantalla Principal"
    public function getIndex(Request $request) {
        $index_establecimientos = Negocio::where('tipo', '1')->name($request->get('name'))->paginate(4);
        $data_establecimientos = ['index_establecimiento' => $index_establecimientos];

        $index_producto= Producto::namep($request->get('name'))->paginate(4);
        $data_producto= ['index_producto' => $index_producto];

        return view('connect.IndexView', $data_establecimientos, $data_producto);
    }


    // Funciones para la interfaz "Nosotros"
    public function getNosotros() { 
        return view('connect.NosotrosView');
    }


    // Funciones para la interfaz "Registro de Negocios"
    public function getRegistroNegocio() {
        return view('connect.RegistroNegocioView');
    }
    public function postRegistroNegocio(Request $request) {
        // Reglas para validación de los campos
        $rules = [
            'rfc' => 'required | min:13',
            'email' => 'required | email | unique:USUARIOS,email',
            'nombre' => 'required',
            'telefono' => 'required | min:10',
            'password' => 'required | min:8',

        ];
        // Reglas para mostrar mensajes de error en idioma Español
        $messages_es = [
            'rfc.required' => 'Debe introducir el RFC de su negocio.',
            'rfc.min' => 'Su RFC debe tener 13 caracteres.',
            'nombre.required' => 'Debe introducir el nombre del negocio.',
            'email.required' => 'Es necesario introducir un correo electrónico.',
            'email.email' => 'El formato de su correo electrónico no es válido.',
            'email.unique' => 'Ya existe un usuario registrado con este correo electrónico.',
            'telefono.required' => 'Introduzca un número de teléfono.',
            'telefono.min' => 'El número de teléfono debe tener 10 dígitos.',
            'password.required' => 'Introduzca una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',

        ];

        // Asigna los valores a la clase Validator para crear las reglas de validación
        $validator = Validator::make($request->all(), $rules, $messages_es);
        if ($validator->fails()):
            return back()->withErrors($validator) -> with('message', 'Error en el llenado del formulario.')->with('typealert', 'danger');
        else:
            $negocio = new Negocio;
            $negocio->rfc  = e($request->input('rfc'));
            //$negocio->correo_electronico = e($request->input('email'));
            $negocio->email = e($request->input('email'));
            //$negocio->clave = Hash::make($request->input('password'));
            $negocio->password = Hash::make($request->input('password'));
            $negocio->nombre_tienda = e($request->input('nombre'));        
            $negocio->numero_telefono = e($request->input('telefono'));
            $negocio->descripcion = e($request->input('descripcion'));
            $negocio->tipo = "1";
            $negocio->prueba_activa = true;
            $negocio->dias_prueba = 60;
            $negocio->licencia_activa = false;
            $negocio->dias_licencia = 0;
            $negocio->codigo_recuperacion = "";
            // Si el registro se hace correctamente... 
            if ($negocio->save()):
                return redirect('/login') -> with('message', 'El registro de negocio se realizó con éxito, ahora inicie sesión.')->with('typealert', 'success');
            endif;
        endif;
    }


    // Funciones para la interfaz "Registro de Usuario"
    public function getRegistroUsuario() {
        return view('connect.RegistroUsuarioView');
    }
    public function postRegistroUsuario(Request $request) {
        // Reglas para validación de los campos
        $rules = [
            'nombre' => 'required',
            'apellidos' => 'required',
            'email' => 'required | email | unique:USUARIOS,email',
            'telefono' => 'required | min:10',
            // fecha_nac...
            'password' => 'required | min:8',
            'r_password' => 'required | min:8 | same:password'
        ];
        // Reglas para mostrar mensajes de error en idioma Español
        $messages_es = [
            'nombre.required' => 'Debe introducir su nombre.',
            'apellidos.required' => 'Debe introducir su apellido.',
            'email.required' => 'Es necesario introducir un correo electrónico.',
            'email.email' => 'El formato de su correo electrónico no es válido.',
            'email.unique' => 'Ya existe un usuario registrado con este correo electrónico.',
            'telefono.required' => 'Introduzca un número de teléfono.',
            'telefono.min' => 'El número de teléfono debe tener 10 dígitos.',
            'password.required' => 'Introduzca una contraseña.',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
            'r_password.same' => 'La contraseña debe coincidir en ambos campos.'
        ];

        // Asigna los valores a la clase Validator para crear las reglas de validación
        $validator = Validator::make($request->all(), $rules, $messages_es);
        if ($validator->fails()):
            return back()->withErrors($validator) -> with('message', 'Error en el llenado del formulario.')->with('typealert', 'danger');
        else:
            $usuario = new Usuario;
            //$usuario->correo_electronico = e($request->input('email'));
            $usuario->email = e($request->input('email'));
            //$usuario->clave = Hash::make($request->input('password'));
            $usuario->password = Hash::make($request->input('password'));
            $usuario->nombre = e($request->input('nombre')); // La función e() de Laravel evita la inserción de código maligno en los campos de formularios.
            $usuario->apellidos = e($request->input('apellidos'));
            // Conversión del formato de fecha de nacimiento para insertar en la BD
            $fecha_input = $request->input('fecha_nac');
            $partes_fecha = explode("-", $fecha_input);
            $nueva_fecha = $partes_fecha[0] . "," . $partes_fecha[1] . "," . $partes_fecha[2];//1999,10,3
            $usuario->fecha_nacimiento = $nueva_fecha; //*Averiguar como insertar un dato de tipo Date()
            //domicilio...
            $usuario->numero_telefono = e($request->input('telefono'));
            $usuario->tipo = "2";
            $usuario->codigo_recuperacion = "";

            // Si el registro se hace correctamente... 
            if ($usuario->save()):
                return redirect('/login') -> with('message', 'Su registro se realizó con éxito, ahora inicie sesión.')->with('typealert', 'success');
            endif;
        endif;
    }


    // Funciones para el catálogo de Establecimientos
    public function getEstablecimientos(Request $request) {

        $establecimientos = Negocio::where('tipo', '1')->name($request->get('name'))->loc($request->get('domicilio'))->firsta($request->get('firsta'))->lastz($request->get('lastz'))->paginate(3);
        $data_establecimientos = ['establecimiento' => $establecimientos];
        //return $data_establecimientos;
        return view('connect.EstablecimientosView', $data_establecimientos);

    }
    /*public function getEstablecimientos(Request $request) {

        //obtener el nombre del negocio
        $Establecimiento = Negocio::name($request->get('name'))->paginate(3);
        return view('connect.EstablecimientosView', compact('Establecimiento'));
    }*/
    public function getDetalleEstablecimiento($_id) {

        $negocio = Negocio::where('_id', $_id)->first();
        return view('connect.DetalleEstablecimientoView', compact('negocio'));

    }
    

    // Funciones para el catálogo de Productos
    public function getProductos(Request $request) {
        $Producto = Producto::namep($request->get('namep'))->locp($request->get('domicilio.ciudad'))->firstap($request->get('firstap'))->lastzp($request->get('lastzp'))->paginate(3);
         $data_productos = ['Producto' => $Producto];

        return view('connect.ProductosView', $data_productos);
    }


    public function getDetalleProducto($nombre_producto) {

        $pro=Producto::where('nombre_producto', $nombre_producto)->first();
        return view('connect.DetalleProductoView', compact('pro'));
    }

    /*public function iniciarMap(){
        var coord = {lat: ,log:};
        var map = new google.maps.Map(document.getElementById('map'),{
            zoom: 10,
            center: coord
    )};
    }

    function activatePlacesSearch(){
        var input = document.getElementById('searchmap');
        var autocomplete = new google.maps.places.Autocomplete(input);
        }*/

}// Cierre de la clase principal
