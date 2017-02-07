<?php

namespace SmartDelivery\Http\Controllers\Operador;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use SmartDelivery\Models\Localidad;
use SmartDelivery\Models\Usuario;
use SmartDelivery\Models\Pedido;

use View;
use Auth;
use DB;
use Mail;

class HomeController extends BaseController {


	// load dashboard
	public function showIndex()
	{
		return view('operador.dashboard');
	}
	
	// load admin dashboard
	public function showAdminIndex()
	{
		return view('operador.dashboard');
	}
	
	// load
	public function showCreateOrder()
	{
		$where_args = array(
			'cuentaID' => Auth::user()->cuentaID,
			'localidadID' => Auth::user()->localidadID,
			'rolID'		=> 2,
			'activo'  	=> 1
		);
		$operadores = Usuario::where($where_args)->get();
		
		$where_args6 = array(
			'id' => Auth::user()->cuentaID,
			//'id' => Auth::user()->localidadID
		);
		$cuentas = DB::table('Cuenta')
					->select('*')
					->where($where_args6)
					//->orderBy('Sucursal.nombre','asc')
					->get();
		
		$where_args2 = array(
			//'cuentaID' => Auth::user()->cuentaID,
			'id' => Auth::user()->localidadID
		);
		$localidades = DB::table('Localidad')
					->select('*')
					->where($where_args2)
					//->orderBy('Sucursal.nombre','asc')
					->get();
					
		$where_args3 = array(
			//'cuentaID' => Auth::user()->cuentaID,
			//'sucursalid' => $localidad->idSucursal
			'asignado' => 0
		);
		$ordenes = DB::table('orden_origen')
					->select('*')
					->where($where_args3)
					//->orderBy('Sucursal.nombre','asc')
					->get();
		
		//$paises = Pais::all();
		//$ciudades = Ciudad::all();
		//$sectores = Sector::all();
		
		
		return view('operador.takeorder', compact('operadores','ordenes','localidades','cuentas'));
	}
	
	public function showConsultOrder()
	{
		return view('operador.consultorder');
	}
	
	public function showClientConsultOrder($tracking_id)
	{
		//Consulta a la base de datos
		//Condicion para el listado de pedidos
		$where_args5 = array(
			'tracking_id' => $tracking_id
		);
		
        //Consulta los pedidos de una cuanta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
		
        //Consulta los pedidos de una cuanta especifica
		$clientes = DB::table('Cliente')
					->select('*')
					->get();
			
        //Consulta los pedidos de una cuanta especifica
		$direccionclientes = DB::table('DireccionCliente')
					->select('*')
					->get();
		
		//Condicion para el listado de mensajeros
		$where_args4 = array(
			'rolID' => 2
		);
		
        //Consulta los mensajeros
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args4)
					->get();
		
		return view('cliente.consultorder', compact('pedidos','clientes','direccionclientes','mensajeros'));
	}
	
	
	// get operator
	public function getMessagers()
	{
		
	
	
	}
	
	public function postCreate(Request $request)
	{
		if($request->input('asunto') == 'crearorder'){
			$cID = 0;
			
			if($request->input('clienteID') == -1)
			{
				$cliente = new Cliente;
				$cliente->telefonoCliente = $request->input('telefono_cliente');
				$cliente->save();
				
				$cID = $cliente->id;
			} else {
				$cID = $request->input('clienteID');
			}
			
			$track_id = $this->generateRandomString(6);
			
			$pedido = new Pedido;
			$pedido->orden = $request->input('new_order');
			$pedido->subtotal = $request->input('subtotal');
			$pedido->impuesto = $request->input('impuesto');
			$pedido->total = $request->input('total');
			$pedido->cuentaID = Auth::user()->cuentaID;
			$pedido->localidadID = Auth::user()->localidadID;
			$pedido->clienteID = $cID;
			$pedido->usuarioID = $request->input('usuarioID');
			$pedido->timeCreated = $request->input('timeCreated');
			$pedido->estadoPedidoID = 1;
			$pedido->tracking_id = $track_id;
			//$pedido->email = $request->input('email');
			//$pedido->total = $request->input('total');
			$pedido->save();
			
			$data = "";
			//$message = "Hola mundo";
			/*
			Mail::send('operador.mail.consultorder', $data, function($message)
			{
				$message->from('victorfortuna18@gmail.com', 'Operador - SmartDelivery');

				$message->to('victorfortuna18@hotmail.com')->cc('victorfortuna18@gmail.com');

				$message->attach($pathToFile);
			});
			*/
			
			//Cambiando el estatus de asignado a true
			$orden = DB::table('orden_origen')
					->where('ordenid', '=', $request->input('new_order'))
					->update(array('asignado' => 1));
			
			$data['email'] = $request->input('email_cliente');
			
			$mensaje_email = "Gracias por preferirnos. Tu orden ya fue enviada, puedes darle seguimiento dando click en el siguiente enlace: ";
			$mensaje_email .= "http://octagonoerp.com/SmartDelivery/cliente/consultorder/" . $pedido->tracking_id ;
			
			Mail::raw($mensaje_email, function($message) use ($data)
			{
				$message->from('victorfortuna18@gmail.com', 'Operador - SmartDelivery');
				$message->subject('Orden');

				$message->to($data['email'])->cc('victorfortuna18@gmail.com');
			});
			
			
			
			
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			return response()->json([
				'status' => 'success',
				'tracking_id' => $track_id
			]);
		}elseif($request->input('asunto') == 'crearcliente'){
			$cID = 0;
		
		
			$addcliente = new Cliente;
		  	$addcliente->nombreCliente = $request->input('nombre_cliente');
			$addcliente->telefonoCliente = $request->input('telefono_cliente');
			$addcliente->tipo_documento = $request->input('tipoDocumento_cliente');
			$addcliente->identificacion = $request->input('identificacion_cliente');
			$addcliente->email = $request->input('email_cliente');
			$addcliente->save();
			$cID = $addcliente->id;
			
			
			//$track_id = $this->generateRandomString(6);
			
			$addDireccionCliente = new DireccionCliente;
			$addDireccionCliente->clienteID = $cID;
			$addDireccionCliente->direccion = $request->input('direccion_cliente');
			$addDireccionCliente->posicionDefinitiva = 0;
			$addDireccionCliente->latitud = 18.4579026000;
			$addDireccionCliente->longitud = -69.9703602000;
			$addDireccionCliente->save();
			
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			return response()->json([
				'status' => 'success',
				'id' => $cID
			]);
		}elseif($request->input('asunto') == 'crearorden'){
			//$cID = 0;
		
		
			$addorden = new Orden;
		  	$addorden->nombre = $request->input('nombre');
			$addorden->telefono = $request->input('telefono');
			$addorden->orden = $request->input('orden');
			$addorden->direccion = $request->input('direccion');
			$addorden->save();
			
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			return response()->json([
				'status' => 'success'
			]);
		}
	}


	function generateRandomString($length = 10) {
		$characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}
		return $randomString;
	}
	
	
	
	
	
	
	


}