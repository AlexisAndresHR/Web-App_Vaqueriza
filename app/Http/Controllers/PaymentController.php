<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

// Agregación de clases para las funciones del procesador de pagos PayPal (11)
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Payer;
use PayPal\Api\Amount;
use PayPal\Api\Transaction;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Details;

use App\VentasPendientes;// Para usar el modelo VentasPendientes.php
use Auth;
use App\Producto;// Para usar el modelo de datos Negocio.php


class PaymentController extends Controller
{

	private $apiContext;// Define la variable como un atributo de la clase (para acceder desde otros métodos)

    //
    public function __Construct() {
    	$payPalConfig = Config::get('paypal');

    	$this->apiContext = new ApiContext(
	        new OAuthTokenCredential(
	            $payPalConfig['client_id'],// ClientID
	            $payPalConfig['secret']// ClientSecret
	        )
		);
    }

    
    // Método para procesar el pago a través de PayPal API
    public function payWithPayPal() {

    	$payer = new Payer();// Crea un objeto para el Usuario comprador (quien efectuará el pago)
		$payer->setPaymentMethod('paypal');

		/*
		  Código para envíar los elementos de la Compra/Venta al procesador de pagos (PayPal)
		*/
		$items = array();// Se crea un arreglo para almacenar los elementos (items) del Carrito de Compra
		$subtotal = 0;// Variable para ir sumando el costo/importe de los productos
		$cart = \Session::get('cart');// Obtiene la variable de sesión del Carrito de Compra

		// Recorre los elementos del Carrito de Compra para agregarlos a los Conceptos del pago en Paypal
		foreach ($cart as $concepto_producto) {
			$item = new Item();// Por cada elemento de la Compra/Venta se crea un objeto de la clase Item()
			$item->setName($concepto_producto->nombre)
				->setCurrency('MXN')
				//->setDescription($concepto_producto->descripcion)
				->setQuantity($concepto_producto->cantidad)
				->setPrice($concepto_producto->precio);// Se asignan los parámetros o valores del objeto (item) para almacenarlos en el pago con PayPal
 
			$items[] = $item;// Se agrega el elemento al arreglo de elementos
			$subtotal += $concepto_producto->cantidad * $concepto_producto->precio;// Se acumula en el subtotal
		}


		$item_list = new ItemList();// Crea un objeto de la clase ItemList() para indicar a PayPal los Conceptos del pago
		$item_list->setItems($items);// Le asigna el arreglo de valores de la Compra/Venta

		$details = new Details();// Crea un objeto de la clase Details() para indicar los detalles del pago
		$details->setSubtotal($subtotal)
			->setShipping(0);// Subtotal y costo de Envío

		$total = $subtotal + 0;// Variable que suma el subtotal y el costo de envío para obtener el monto total del pago


		$amount = new Amount();// Crea un objeto de tipo Amount() que define el monto a pagar
		$amount->setTotal($total);// Se asigna el total a pagar, derivado de los items del Carrito de Compra
		$amount->setCurrency('MXN');//$amount->setCurrency('USD');
		$amount->setDetails($details);// Asigna los detalles del pago, definidos anteriormente

		$transaction = new Transaction();// Objeto para iniciar la transacción (operación de pago)
		$transaction->setAmount($amount);// Se asigna la información relacionada con el monto de pago
		$transaction->setDescription('Pago de prueba web app Vaqueriza');
		$transaction->setItemList($item_list);// Se asigna la lista de items o conceptos del pago a realizar

		/*
		  - setReturnUrl: define la URL a la que se redireccionará cuando el pago ha sido completado.
		  - setCancelUrl: define la URL a la que se redireccionará cuando el Usuario ha cancelado el proceso de pago.
		*/
		$callbackUrl = url('usuario/pago/paypal/status');

		$redirectUrls = new RedirectUrls();// Objeto para las URL de redirección después del pago
		$redirectUrls->setReturnUrl($callbackUrl)
		    ->setCancelUrl($callbackUrl);

		$payment = new Payment();// Crea un objeto para los datos del Pago
		$payment->setIntent('sale')
		    ->setPayer($payer)
		    ->setTransactions(array($transaction))
		    ->setRedirectUrls($redirectUrls);

		
		/*
		  Código para intentar realizar el Pago (valida si se presenta algún error)
		*/
		try {
			// Si los datos asignados son aprobados por la API de PayPal, nos dará acceso al link oficial de aprobación...
		    $payment->create($this->apiContext);
		    //echo $payment;
		    return redirect()->away($payment->getApprovalLink());
		    //echo "\n\nRedirect user to approval_url: " . $payment->getApprovalLink() . "\n";
		}
		catch (\PayPal\Exception\PayPalConnectionException $ex) {
		    // Imprime la información detallada del error que causo la excepción
		    echo $ex->getData();
		}

    	//return 'AA ;)';
    }


    public function payWithPayPalStatus(Request $request) {

    	//dd($request->all());//prueba...
    	$paymentId = $request->input('paymentId');
    	$payerId = $request->input('PayerID');
    	$token = $request->input('token');

    	// Comprueba si hay algún parámetro faltante antes de ejecutar el Pago
    	if(!$paymentId || !$payerId || !$token) {
			$message_pago = "El pago no se pudo realizar a través de PayPal";
    		return redirect('/usuario/pago')->with(compact('message_pago'));
    	}

    	// Si la comprobación anterior es correcta... 
    	$payment = Payment::get($paymentId, $this->apiContext);

    	$execution = new PaymentExecution();// Crea un objeto para la ejecución del Pago
    	$execution->setPayerId($payerId);

    	// Si las operaciones anteriores son correctas, se ejecuta el Pago
    	//$payment->execute($execution, $this->apiContext);
    	$result = $payment->execute($execution, $this->apiContext);
    	//dd($result);

    	if($result->getState() === 'approved') { // Si la API de PayPal aprueba el Pago, redirecciona a la interfaz 'Orden de Compra'
    		$message_pago = "Su pago a través de PayPal se ha realizado correctamente";

    		/*
    		  Código para insertar una nueva venta, una vez aprobado el pago vía PayPal.
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
        	$venta->forma_pago = "PayPal";
        	$venta->status = "0";//$venta->status = "En espera de entrega";
        	$venta->fecha_entrega = now();// Tipo date Mongo
        	$venta->comentarios_adicionales = [
        		'fecha' => now(),// Tipo date Mongo
        		'comentario' => "Pago aprobado, en espera de entrega al comprador.",
        	];

        	// Inserta el registro y verifica que se haga correctamente
        	if ($venta->save()) {
        		\Session::forget('cart');// Una vez insertada la Venta, se vacía el Carrito de Compra
        		// Redirige al usuario a la página con información de su compra
        		return redirect('/usuario/confirmacion-compra')->with(compact('message_pago'));
        	}
    		//return redirect('/usuario/confirmacion-compra')->with(compact('message_pago'));
    	}
    	else { //Si el pago es rechazado, redirecciona a la interfaz 'Pago'...
			$message_pago = "Su pago a través de PayPal no se pudo realizar. Intente más tarde.";
    		return redirect('/usuario/pago')->with(compact('message_pago'));
    	}

    }


}// Cierre de la clase principal
