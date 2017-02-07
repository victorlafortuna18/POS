<?php

namespace SmartDelivery\Http\Controllers\Operador;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

use Davibennun\LaravelPushNotification\Facades\PushNotification;

use SmartDelivery\Models\Localidad;
use SmartDelivery\Models\Usuario;
use SmartDelivery\Models\Pedido;
use SmartDelivery\Models\PedidoUbicacion;
use SmartDelivery\Models\Orden;
use SmartDelivery\Models\Cliente;
use SmartDelivery\Models\DireccionCliente;
use SmartDelivery\Models\Categoria;
use SmartDelivery\Models\Productos;
use SmartDelivery\Models\Adicionales;
use SmartDelivery\Models\AdicionalesSelected;
use SmartDelivery\Models\AdicionalOpciones;
use SmartDelivery\Models\Factura;
use SmartDelivery\Models\DetallesFactura;
use SmartDelivery\Models\OrdenOrigen;
use SmartDelivery\Models\AbrirCerrarCaja;

use View;
use Auth;
use DB;
use Mail;


class operadorController extends BaseController {


	// load dashboard
	public function showIndex()
	{
		return view('operador.dashboard');
	}
	
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
		try {
			
			$sucursales = Localidad::All();
			
			//Consulta a la base de datos
			//Condicion para el listado de pedidos
			$where_args5 = array(
				'tracking_id' => $tracking_id,
				'estadoPedidoID' => 1
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
		} catch (\Illuminate\Database\QueryException $e) {
			//dd($e);
			$pedidos = false;
		} catch (\Illuminate\Database\Connection $e) {
			//dd($e);
			$pedidos = false;
		} catch (PDOException $e) {
			//dd($e);
			$pedidos = false;
		}

		if($pedidos){
			return view('cliente.consultorder', compact('sucursales','pedidos','clientes','direccionclientes','mensajeros'));
		}else{
			return view('cliente.nopedido');
			//return "No pedidos";
		}
	}
	
	public function showOperadorConsultOrder($tracking_id)
	{
		try {
			
			$sucursales = Localidad::All();
			
			//Consulta a la base de datos
			//Condicion para el listado de pedidos
			$where_args5 = array(
				'tracking_id' => $tracking_id,
				'estadoPedidoID' => 1
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
		} catch (\Illuminate\Database\QueryException $e) {
			//dd($e);
			$pedidos = false;
		} catch (\Illuminate\Database\Connection $e) {
			//dd($e);
			$pedidos = false;
		} catch (PDOException $e) {
			//dd($e);
			$pedidos = false;
		}

		if($pedidos){
			return view('adminoperador.consultorder', compact('sucursales','pedidos','clientes','direccionclientes','mensajeros'));
		}else{
			return view('adminoperador.nopedido');
			//return "No pedidos";
		}
	}
	
	public function showAdminLocalidadConsultOrder($tracking_id)
	{
		try {
			
			$sucursales = Localidad::All();
			
			//Consulta a la base de datos
			//Condicion para el listado de pedidos
			$where_args5 = array(
				'tracking_id' => $tracking_id,
				'estadoPedidoID' => 1
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
		} catch (\Illuminate\Database\QueryException $e) {
			//dd($e);
			$pedidos = false;
		} catch (\Illuminate\Database\Connection $e) {
			//dd($e);
			$pedidos = false;
		} catch (PDOException $e) {
			//dd($e);
			$pedidos = false;
		}

		if($pedidos){
			return view('adminlocalidad.consultorder', compact('sucursales','pedidos','clientes','direccionclientes','mensajeros'));
		}else{
			return view('adminlocalidad.nopedido');
			//return "No pedidos";
		}
	}
	
	public function showAdminConsultOrder($tracking_id)
	{
		try {
			
			$sucursales = Localidad::All();
			
			//Consulta a la base de datos
			//Condicion para el listado de pedidos
			$where_args5 = array(
				'tracking_id' => $tracking_id,
				'estadoPedidoID' => 1
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
		} catch (\Illuminate\Database\QueryException $e) {
			//dd($e);
			$pedidos = false;
		} catch (\Illuminate\Database\Connection $e) {
			//dd($e);
			$pedidos = false;
		} catch (PDOException $e) {
			//dd($e);
			$pedidos = false;
		}

		if($pedidos){
			return view('admin.consultorder', compact('sucursales','pedidos','clientes','direccionclientes','mensajeros'));
		}else{
			return view('admin.nopedido');
			//return "No pedidos";
		}
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
				//$cliente = new Cliente;
				//$cliente->telefonoCliente = $request->input('telefono_cliente');
				//$cliente->save();
				
				//$cID = $cliente->id;
				return false;
			} else {
				$cID = $request->input('clienteID');
			}
			
			$track_id = date('YmdHis');
			
			//Condicion para el listado de cuentas
			$where_args0 = array(
				'Pedido.tracking_id' => $track_id,
				'Pedido.cuentaID' => Auth::user()->cuentaID,
				'Pedido.localidadID' => Auth::user()->localidadID
			);
			
			//Consulta los datos de una cuenta especifica
			$PedidoPorTrack = DB::table('Pedido')
						->select('*')
						//->join('Usuario as U','Localidad.id','=','U.localidadID')
						->where($where_args0)
						->get();
			
			if($PedidoPorTrack){
				return response()->json([
					'status' => 'error',
					//'tracking_id' => $track_id
				]);
			}
			
			
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
			$pedido->timeInitial = $request->input('today');
			$pedido->estadoPedidoID = 1;
			$pedido->tracking_id = $track_id;
			//$pedido->email = $request->input('email');
			//$pedido->total = $request->input('total');
			$pedido->save();
			
			/**/
			$localidadid = Auth::user()->localidadID;
			//Consulta la localidad
			$localidad = Localidad::where('id','=',$localidadid)->firstOrFail();

			$lng = $localidad->longitud;
			$lat = $localidad->latitud;
			
			
			$pedidoubicacion = new PedidoUbicacion;
			$pedidoubicacion->pedidoID = $track_id;
			$pedidoubicacion->longitud = $lng;
			$pedidoubicacion->latitud = $lat;
			$pedidoubicacion->save();
			/***************************************/
			//Cambiamos el estatus actual del mensajero a Asignado
			$usuarioID = $request->input('usuarioID');
			$mensajero = DB::table('Usuario')->where('id', '=', $usuarioID)
				->update(array(
						'EstatusActual' => 2
					)
				);
			
			/***************************************/
			
			$data = "";
			
			//Cambiando el estatus de asignado a true
			$orden = DB::table('orden_origen')
				->where('ordenid', '=', $request->input('new_order'))
				->update(array('asignado' => 1));
			
			$data['email'] = $request->input('email_cliente');
			
			$Sintaxis='#^[\w.-]+@[\w.-]+\.[a-zA-Z]{2,6}$#';
			if(preg_match($Sintaxis,$data['email'])){
				//Email to comment when people start using
				$data['email'] = "imarquez@mayflower.com.ec";
			}else{
				$data['email'] = "imarquez@mayflower.com.ec";
			}
			
			$mensaje_email = "Gracias por preferirnos. Tu orden ya fue enviada, puedes darle seguimiento dando click en el siguiente enlace: ";
			$mensaje_email .= "http://octagonoerp.com/SmartDelivery/cliente/consultorder/" . $pedido->tracking_id ;
			
			Mail::raw($mensaje_email, function($message) use ($data)
			{
				$message->from('victorfortuna18@gmail.com', 'Operador - SmartDelivery');
				$message->subject('Orden');

				$message->to($data['email'])->cc('victorfortuna18@gmail.com');
			});
			

			$user_gcm_token = Usuario::where('id','=',$request->input('usuarioID'))->first();

			if(strlen($user_gcm_token->gcm_registration_id) > 5)
			{
				$message = PushNotification::Message('Message Text', array(
					'to' => '/topics/operadores',
					'title' => 'SmartDelivery - Notificación',
					'body' => 'Tienes una nueva orden!'
				));

				$col = PushNotification::app('appNameAndroid')->to($user_gcm_token->gcm_registration_id);
				$col->adapter->setAdapterParameters(['sslverifypeer' => false]);
				$col->send($message);


                Log::info("Push notification sent to {$user_gcm_token->gcm_registration_id}");
			}

			
			
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			return response()->json([
				'status' => 'success',
				'tracking_id' => $track_id
			]);
		}elseif($request->input('asunto') == 'crearcliente'){
			$cID = 0;


			$addcliente = new Cliente;
			$addcliente->nombreCliente = $request->input('nombre');
			$addcliente->telefonoCliente = $request->input('telefono');
			$addcliente->tipo_documento = $request->input('tipo');
			$addcliente->identificacion = $request->input('identificacion');
			$addcliente->email = $request->input('email');
			$addcliente->save();
			$cID = $addcliente->id;
			
			
			//$track_id = $this->generateRandomString(6);
			
			$addDireccionCliente = new DireccionCliente;
			$addDireccionCliente->clienteID = $cID;
			$addDireccionCliente->direccion = $request->input('direccion');
			$addDireccionCliente->direccionOrigen = $request->input('direccionorigen');
			$addDireccionCliente->posicionDefinitiva = 0;
			$addDireccionCliente->latitud = -0.191003;
			$addDireccionCliente->longitud = -78.486122;
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
		}elseif($request->input('asunto') == 'switchestatususuario'){
			//$cID = 0;


			$usuario = DB::table('Usuario')->where('id', '=', $request->input('usuarioid'))->update(array('activo' => $request->input('estatus')));
			
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($usuario){
				return response()->json([
					'status' => 'success'
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'searchnewoerders'){
			
			//Condicion para el listado de ordenes		
			$where_args4 = array(
				'asignado' => 0
			);
			$ordenes = DB::table('orden_origen')
				->select('*')
				->where($where_args4)
				//->orderBy('Sucursal.nombre','asc')
				->get();
			
			
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($ordenes){
				return response()->json([
					'status' => 'success',
					'data' => $ordenes
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'searchnewpedidos'){
			// $i = array();
			/////$data = json_decode(stripslashes($request->input('datos')));
			// $data = explode(",", $request->input('dato'));
			// foreach($data as $d){
				
				// $pedidos = DB::table('Pedido')
				// ->select('*')
				// ->where($where_args4)
				// ->get();
				
				// $i[] = $d;
			// }
			
			//Condicion para el listado de pedidos		
			$where_args4 = array(
				'Pedido.localidadID' => Auth::user()->localidadID,
				'Pedido.cuentaID' => Auth::user()->cuentaID,
				'Pedido.estadoPedidoID' => 1
			);
			$pedidos = DB::table('Pedido')
				->select('*')
				->where($where_args4)
				//->orderBy('Sucursal.nombre','asc')
				->get();
			
			
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($pedidos){
				return response()->json([
					'status' => 'success',
					'data' => $pedidos
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'switchPosicionDefinitiva'){
			//$cID = 0;


			$posicionDefinitiva = DB::table('DireccionCliente')->where('clienteID', '=', $request->input('clienteid'))->update(array('posicionDefinitiva' => $request->input('def')));
			
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($posicionDefinitiva){
				return response()->json([
					'status' => 'success'
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'entercategoria'){
			//$cID = 0;


			//Condicion para el listado de pedidos		
			$where_args5 = array(
				'Categoria.localidadID' => Auth::user()->localidadID,
				'Categoria.cuentaID' => Auth::user()->cuentaID,
				//'Categoria.idCategoriaMadre' => 0
				'Categoria.idCategoriaMadre' => $request->input('categoriaid')
			);
			
			//Consulta los pedidos de una cuenta especifica
			$categorias = DB::table('Categoria')
						->select('*')
						->where($where_args5)
						->orderBy('nombreCategoria')
						->get();
						
			//Condicion para el listado de pedidos		
			$where_args6 = array(
				'Productos.localidadID' => Auth::user()->localidadID,
				'Productos.cuentaID' => Auth::user()->cuentaID,
				//'Categoria.idCategoriaMadre' => 0
				'Productos.categoriaid' => $request->input('categoriaid')
			);
			
			//Consulta los pedidos de una cuenta especifica
			$productos = DB::table('Productos')
						->select('*')
						->where($where_args6)
						->orderBy('nombre')
						->get();
			
			
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($categorias && $productos){
				return response()->json([
					'status' => 'success',
					'data' => $categorias,
					'data2' => $productos
				]);
			}elseif($categorias && !$productos){
				return response()->json([
					'status' => 'success',
					'data' => $categorias,
					'data2' => $productos
				]);
			}elseif(!$categorias && $productos){
				return response()->json([
					'status' => 'success',
					'data' => $categorias,
					'data2' => $productos
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'getproducto'){
			//$cID = 0;


			//Condicion para obtener los detalles del producto		
			$where_args5 = array(
				'Productos.localidadID' => Auth::user()->localidadID,
				'Productos.cuentaID' => Auth::user()->cuentaID,
				'Productos.id' => $request->input('productoid')
			);
			
			//Consulta los pedidos de una cuenta especifica
			$producto = DB::table('Productos')
						->select('*')
						->where($where_args5)
						->get();
						
			//Condicion para el listado de pedidos		
			$where_args6 = array(
				'AdicionalesSelected.localidadID' => Auth::user()->localidadID,
				'AdicionalesSelected.cuentaID' => Auth::user()->cuentaID,
				'AdicionalesSelected.productoID' => $request->input('productoid')
			);
			
			//Consulta los pedidos de una cuenta especifica
			$adicionalesselected = DB::table('AdicionalesSelected')
						->select('*')
						->where($where_args6)
						->orderBy('nombreAdicional')
						->get();
			
			$adicionalesID[0] = '';
			$countAdicionales = 0;
			foreach($adicionalesselected as $adicionalselected){
				$adicionalesID[$countAdicionales] = $adicionalselected->adicionalID;
				$countAdicionales++;
			}
			
			//Condicion para el listado de pedidos		
			$where_args6 = array(
				'AdicionalOpciones.localidadID' => Auth::user()->localidadID,
				'AdicionalOpciones.cuentaID' => Auth::user()->cuentaID
			);
			
			//Consulta los pedidos de una cuenta especifica
			$adicionalopciones = DB::table('AdicionalOpciones')
						->select('*')
						//->where($where_args6)
						->whereIn('adicionalID',$adicionalesID)
						->orderBy('nombreOpcion')
						->get();
			
			
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($producto && $adicionalesselected){
				return response()->json([
					'status' => 'success',
					'data' => $producto,
					'data2' => $adicionalesselected,
					'data3' => $adicionalopciones
				]);
			}elseif($producto && !$adicionalesselected){
				return response()->json([
					'status' => 'success',
					'data' => $producto,
					'data2' => $adicionalesselected,
					'data3' => $adicionalopciones
				]);
			}elseif(!$producto && $adicionalesselected){
				return response()->json([
					'status' => 'success',
					'data' => $producto,
					'data2' => $adicionalesselected,
					'data3' => $adicionalopciones
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'agregarcategoria'){
			//$cID = 0;
			
			$categoria = new Categoria;
			$categoria->cuentaID = Auth::user()->cuentaID;
			$categoria->localidadID = Auth::user()->localidadID;
			$categoria->nombreCategoria = $request->input('nombreCategoria');
			$categoria->Descripcion = $request->input('descripcion');
			$categoria->bgcolor = $request->input('bgcolor');
			$categoria->idCategoriaMadre = $request->input('idcategoriamadre');
			$categoria->save();
			$id = $categoria->id;
			
			//$categoria = true;
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($categoria){
				return response()->json([
					'status' => 'success',
					'data' => $categoria
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'guardaractualizarcategoria'){
			//$cID = 0;
			
			$idcategoria = $request->input('idcategoria');
			$nombrecategoria = $request->input('nombreCategoria');
			$descripcion = $request->input('descripcion');
			$bgcolor = $request->input('bgcolor');
			
			$where_args1 = array(
				'Categoria.id' => $idcategoria
			);
			
			$actualizarcategoria = DB::table('Categoria')->where($where_args1)
				->update(array(
						'nombreCategoria' => $nombrecategoria,
						'Descripcion' => $descripcion,
						'bgcolor' => $bgcolor
					)
				);
			
			$categoria = DB::table('Categoria')
							->where($where_args1)
							//->orderBy('id','desc')
							->take(1)
							->get();
			
			//$categoria = true;
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($actualizarcategoria){
				return response()->json([
					'status' => 'success',
					'data' => $categoria
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'agregarproducto'){
			//$cID = 0;
			
			$producto = new Productos;
			$producto->cuentaID = Auth::user()->cuentaID;
			$producto->localidadID = Auth::user()->localidadID;
			$producto->nombre = $request->input('nombreProducto');
			$producto->descripcion = $request->input('descripcion');
			$producto->precio = $request->input('precio');
			$producto->bgcolor = $request->input('bgcolor');
			$producto->categoriaid = $request->input('idcategoriamadre');
			$producto->save();
			$id = $producto->id;
			
			$adicionales = $request->input('adicionales');
			if(strlen(trim($adicionales)) > 0){
				//Divide cada valor
				$adicionals = explode(";;;",$adicionales,-1);
				
				foreach($adicionals as $adicionalID){
					
					$adicional = Adicionales::where('id','=',$adicionalID)->firstOrFail();
					
					$adicionalesselected = new AdicionalesSelected();
					$adicionalesselected->adicionalID = $adicionalID;
					$adicionalesselected->cuentaID = Auth::user()->cuentaID;
					$adicionalesselected->localidadID = Auth::user()->localidadID;
					$adicionalesselected->productoID = $id; //Producto ID
					$adicionalesselected->nombreAdicional = $adicional->nombreAdicional;
					$adicionalesselected->save();
				}
			}
			
			//$categoria = true;
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($producto){
				return response()->json([
					'status' => 'success',
					'data' => $producto
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'actualizarproducto'){
			//$cID = 0;
			
			$id = $request->input('idproducto');
			$nombreproducto = $request->input('nombreProducto');
			$descripcion = $request->input('descripcion');
			$precio = $request->input('precio');
			$bgcolor = $request->input('bgcolor');
			
			$where_args1 = array(
				'Productos.id' => $id
			);
			
			$actualizarproducto = DB::table('Productos')->where($where_args1)
				->update(array(
						'nombre' => $nombreproducto,
						'descripcion' => $descripcion,
						'precio' => $precio,
						'bgcolor' => $bgcolor
					)
				);
			
			$producto = DB::table('Productos')
							->where($where_args1)
							//->orderBy('id','desc')
							->take(1)
							->get();
							
			$deleteOldAdicionales = DB::table('AdicionalesSelected')->where('productoID', '=', $id)->delete();
			
			$adicionales = $request->input('adicionales');
			if(strlen(trim($adicionales)) > 0){
				//Divide cada valor
				$adicionals = explode(";;;",$adicionales,-1);
				
				foreach($adicionals as $adicionalID){
					
					$adicional = Adicionales::where('id','=',$adicionalID)->firstOrFail();
					
					$adicionalesselected = new AdicionalesSelected();
					$adicionalesselected->adicionalID = $adicionalID;
					$adicionalesselected->cuentaID = Auth::user()->cuentaID;
					$adicionalesselected->localidadID = Auth::user()->localidadID;
					$adicionalesselected->productoID = $id; //Producto ID
					$adicionalesselected->nombreAdicional = $adicional->nombreAdicional;
					$adicionalesselected->save();
				}
			}
			
			//$categoria = true;
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($producto){
				return response()->json([
					'status' => 'success',
					'data' => $producto
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'agregaradicional'){
			//$cID = 0;
			
			$adicional = new Adicionales;
			$adicional->cuentaID = Auth::user()->cuentaID;
			$adicional->localidadID = Auth::user()->localidadID;
			$adicional->nombreAdicional = $request->input('nombre');
			$adicional->save();
			$id = $adicional->id;
			
			$opciones = $request->input('opciones');
			if(strlen(trim($opciones)) > 0){
				//Divide cada valor
				$opcions = explode(";;;",$opciones,-1);
				
				foreach($opcions as $opcion){
					$adicionalopciones = new AdicionalOpciones();
					$adicionalopciones->adicionalID = $id;
					$adicionalopciones->cuentaID = Auth::user()->cuentaID;
					$adicionalopciones->localidadID = Auth::user()->localidadID;
					$adicionalopciones->nombreOpcion = $opcion;
					$adicionalopciones->save();
				}
			}
			
			//$categoria = true;
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($adicional){
				return response()->json([
					'status' => 'success',
					'data' => $adicional
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'actualizaradicional'){
			//$cID = 0;
			
			
			$id = $request->input('idadicional');
			$nombreAdicional = $request->input('nombre');
			
			$where_args1 = array(
				'Adicionales.id' => $id
			);
			
			$actualizaradicional = DB::table('Adicionales')->where($where_args1)
				->update(array(
						'nombreAdicional' => $nombreAdicional
					)
				);
			
			$adicional = DB::table('Adicionales')
							->where($where_args1)
							//->orderBy('id','desc')
							->take(1)
							->get();
							
			$deleteOldAdicionalOpciones = DB::table('AdicionalOpciones')->where('adicionalID', '=', $id)->delete();
			
			
			$opciones = $request->input('opciones');
			if(strlen(trim($opciones)) > 0){
				//Divide cada valor
				$opcions = explode(";;;",$opciones,-1);
				
				foreach($opcions as $opcion){
					$adicionalopciones = new AdicionalOpciones();
					$adicionalopciones->adicionalID = $id;
					$adicionalopciones->cuentaID = Auth::user()->cuentaID;
					$adicionalopciones->localidadID = Auth::user()->localidadID;
					$adicionalopciones->nombreOpcion = $opcion;
					$adicionalopciones->save();
				}
			}
			
			//$categoria = true;
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($adicional){
				return response()->json([
					'status' => 'success',
					'data' => $adicional
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'getproductoadicionales'){
			//$cID = 0;
			
			
			$idproducto = $request->input('idproducto');
			
			$where_args1 = array(
				'AdicionalesSelected.productoID' => $idproducto
			);
			
			$adicionales = DB::table('AdicionalesSelected')
							->where($where_args1)
							->orderBy('nombreAdicional','asc')
							//->take(1)
							->get();
			
			
			//$categoria = true;
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($adicionales){
				return response()->json([
					'status' => 'success',
					'data' => $adicionales
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'getadicionalopciones'){
			//$cID = 0;
			
			
			$idadicional = $request->input('idadicional');
			
			$where_args1 = array(
				'AdicionalOpciones.adicionalID' => $idadicional
			);
			
			$opciones = DB::table('AdicionalOpciones')
							->where($where_args1)
							->orderBy('nombreOpcion','asc')
							//->take(1)
							->get();
			
			
			//$categoria = true;
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($opciones){
				return response()->json([
					'status' => 'success',
					'data' => $opciones
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'agregarfactura'){
			//$cID = 0;
			$where_args1 = array(
				'abrirCerrarCaja.localidadID' => Auth::user()->localidadID,
				'abrirCerrarCaja.cuentaID' => Auth::user()->cuentaID,
				'abrirCerrarCaja.userID' => Auth::user()->id,
				'abrirCerrarCaja.isClosed' => 0
			);
			
			$getsesioncaja = DB::table('abrirCerrarCaja')
							->where($where_args1)
							->orderBy('id','desc')
							->take(1)
							->get();
							
			$where_args2 = array(
				'Usuario.id' => Auth::user()->id
			);
			
			$usuarios = DB::table('Usuario')
							->where($where_args2)
							//->orderBy('id','desc')
							->take(1)
							->get();
			
			$valorcredito = strlen(trim($request->input('valorcredito'))) > 0 ?  $request->input('valorcredito') : '0.00';
			$valorefectivo = strlen(trim($request->input('valorefectivo'))) > 0 ?  $request->input('valorefectivo') : '0.00';
			$valortarjeta = strlen(trim($request->input('valortarjeta'))) > 0 ?  $request->input('valortarjeta') : '0.00';
			
			$factura = new Factura;
			$factura->cuentaID = Auth::user()->cuentaID;
			$factura->localidadID = Auth::user()->localidadID;
			$factura->userID = Auth::user()->id;
			$factura->sesionID = $getsesioncaja[0]->id;
			$factura->clienteID = $request->input('clienteid');
			$factura->nombreCliente = $request->input('nombrecliente');
			$factura->telefonoCliente = $request->input('telefonocliente');
			$factura->direccionCliente = $request->input('direccioncliente');
			$factura->identificacionCliente = $request->input('identificacioncliente');
			$factura->correoCliente = $request->input('correocliente');
			$factura->valorFactura = $request->input('valorfactura');
			$factura->impuestoFactura = $request->input('impuestofactura');
			$factura->descuentoFactura = $request->input('descuentofactura');
			$factura->comisionFactura = $request->input('comisionfactura');
			$factura->fechaFactura = $request->input('fechafactura');
			$factura->tipoFactura = $request->input('tipofactura');
			$factura->valorCredito = $valorcredito;
			$factura->valorEfectivo = $valorefectivo;
			$factura->valorTarjeta = $valortarjeta;
			$factura->useDelivery = $request->input('usedelivery');
			$factura->notaFactura = $request->input('notafactura');
			$factura->idExterno = $request->input('idexterno');
			$factura->save();
			$id = $factura->id;
			
			$productos = $request->input('productos');
			if(strlen(trim($productos)) > 0){
				//Divide cada valor
				$products = explode(";;;",$productos,-1);
				
				foreach($products as $product){
					
					$productoDetalle = explode("!@@@!",$product);
					
					$detallesfactura = new DetallesFactura();
					$detallesfactura->cuentaID = Auth::user()->cuentaID;
					$detallesfactura->localidadID = Auth::user()->localidadID;
					$detallesfactura->facturaID = $id;
					$detallesfactura->productoID = $productoDetalle[0];
					$detallesfactura->nombreProducto = $productoDetalle[1];
					$detallesfactura->cantidadProducto = $productoDetalle[2];
					$detallesfactura->costoProducto = $productoDetalle[3];
					$detallesfactura->subtotalProducto = $productoDetalle[4];
					$detallesfactura->notaProducto = $productoDetalle[5];
					$detallesfactura->adicionalesProducto = $productoDetalle[6];
					$detallesfactura->save();
					
				}
			}
			
			if($factura->useDelivery == 1){
				
				$cuenta = DB::table('Cuenta')
					->select('*')
					->where('id','=',Auth::user()->cuentaID)
					->get();
					
				$localidad = DB::table('Localidad')
					->select('*')
					->where('id','=',Auth::user()->localidadID)
					->get();
				
				if($request->input('ismensajero') == 0){
					$ordenorigen = new OrdenOrigen();
					$ordenorigen->ordenid = date("YmdHis") . Auth::user()->localidadID;
					$ordenorigen->tip_iden = "C";
					$ordenorigen->identificacion = $request->input('identificacioncliente');
					$ordenorigen->cliente = $request->input('nombrecliente');
					$ordenorigen->telefono = $request->input('telefonocliente');
					$ordenorigen->mail = $request->input('correocliente');
					$ordenorigen->sucursalid = $localidad[0]->idSucursal;	//?
					$ordenorigen->subtotal = ((float)$request->input('valorfactura') - (float)$request->input('impuestofactura'));
					$ordenorigen->impuesto = $request->input('impuestofactura');
					$ordenorigen->total = $request->input('valorfactura');
					$ordenorigen->ciudad = "";
					$ordenorigen->pais = "";
					$ordenorigen->direccion = $request->input('direccioncliente');
					$ordenorigen->estadopedido = 0;
					$ordenorigen->asignado = 0;
					$ordenorigen->cuentaid = $cuenta[0]->cuentaID; 	//?
					$ordenorigen->fechaOrden = $request->input('fechafactura');
					$ordenorigen->save();
				
				}else{
					$track_id = date('YmdHis');
					
					
					//Condicion para el listado de cuentas
					$where_args6 = array(
						'Pedido.tracking_id' => $track_id,
						'Pedido.cuentaID' => Auth::user()->cuentaID,
						'Pedido.localidadID' => Auth::user()->localidadID
					);
					
					//Consulta los datos de una cuenta especifica
					$PedidoPorTrack = DB::table('Pedido')
								->select(DB::raw('count(*) as cantidad'))
								//->join('Usuario as U','Localidad.id','=','U.localidadID')
								->where($where_args6)
								->get();
					
					
					if($PedidoPorTrack[0]->cantidad > 0){
						return response()->json([
							'status' => 'error pedidosportrack',
							'data' => $PedidoPorTrack
						]);
					}
					
					
					$where_args7 = array(
						'telefonoCliente' => $request->input('telefonocliente')
					);
					$obtenercliente = DB::table('Cliente')
								->select('*')
								->where($where_args7)
								->get();
					
					$cID = 3;
					if(count($obtenercliente) <= 0){
						
						$addcliente = new Cliente;
						$addcliente->nombreCliente = $request->input('nombrecliente');
						$addcliente->telefonoCliente = $request->input('telefonocliente');
						$addcliente->tipo_documento = 'C';
						$addcliente->identificacion = $request->input('identificacioncliente');
						$addcliente->email = $request->input('correocliente');
						$addcliente->save();
						$cID = $addcliente->id;
						
						
						$addDireccionCliente = new DireccionCliente;
						$addDireccionCliente->clienteID = $cID;
						$addDireccionCliente->direccion = $request->input('direccioncliente');
						$addDireccionCliente->direccionOrigen = $request->input('direccioncliente');
						$addDireccionCliente->posicionDefinitiva = 0;
						$addDireccionCliente->latitud = -0.191003;
						$addDireccionCliente->longitud = -78.486122;
						$addDireccionCliente->save();
						
					}else{
						$cID = $obtenercliente[0]->id;
					}
					
					
					
					$pedido = new Pedido;
					$pedido->orden = $track_id;
					$pedido->subtotal = (float)$request->input('valorfactura') - (float)$request->input('impuestofactura');
					$pedido->impuesto = $request->input('impuestofactura');
					$pedido->total = $request->input('valorfactura');
					$pedido->cuentaID = Auth::user()->cuentaID;
					$pedido->localidadID = Auth::user()->localidadID;
					$pedido->clienteID = $cID;
					$pedido->usuarioID = $request->input('idmensajero');
					$pedido->timeCreated = $request->input('fechafactura');
					$pedido->timeInitial = $request->input('fechafactura');
					$pedido->estadoPedidoID = 1;
					$pedido->tracking_id = $track_id;
					$pedido->save();
					
					
					/* This code bellow is working well */
					/************************************/
					
					
					$localidadid = Auth::user()->localidadID;
					//Consulta la localidad
					$localidad = Localidad::where('id','=',$localidadid)->firstOrFail();

					$lng = $localidad->longitud;
					$lat = $localidad->latitud;
					
					
					$pedidoubicacion = new PedidoUbicacion;
					$pedidoubicacion->pedidoID = $track_id;
					$pedidoubicacion->longitud = $lng;
					$pedidoubicacion->latitud = $lat;
					$pedidoubicacion->save();
					/***************************************/
					//Cambiamos el estatus actual del mensajero a Asignado
					$usuarioID = $request->input('idmensajero');
					$mensajero = DB::table('Usuario')->where('id', '=', $usuarioID)
						->update(array(
								'EstatusActual' => 2
							)
						);
					
					/***************************************/
				}
				
			}
			
			
			
			$valorventatotal = (float)$getsesioncaja[0]->valorVentaTotal + (float)$request->input('valorfactura');
			$valorimpuestototal = (float)$getsesioncaja[0]->valorImpuestoTotal + (float)$request->input('impuestofactura');
			$cantfacturas = (float)$getsesioncaja[0]->cantFacturasCaja + 1;
			
			$updatesesioncaja = DB::table('abrirCerrarCaja')->where($where_args1)
				->update(array(
						'valorVentaTotal' => $valorventatotal,
						'valorImpuestoTotal' => $valorimpuestototal,
						'cantFacturasCaja' => $cantfacturas
					)
				);
			
			
			//$categoria = true;
			// return success
			// return redirect()->action('Operador\HomeController@showIndex');
			if($factura){
				return response()->json([
					'status' => 'success',
					'data' => $factura,
					'data2' => $usuarios
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'buscarProductos'){
						
			/*
			'Productos.localidadID' => Auth::user()->localidadID,
				'Productos.cuentaID' => Auth::user()->cuentaID,
				->orWhere('descripcion', 'like', '%'.$request->input('textobuscado').'%')
			*/
			$cuentaID = Auth::user()->cuentaID;
			$localidadID = Auth::user()->localidadID;
			
			$productos = DB::table('Productos')->where(function ($query) use ($request,$cuentaID,$localidadID) {
							$query->where('nombre', 'like', '%'.$request->input('textobuscado').'%')
							      ->where('cuentaID','=',$cuentaID)
							      ->where('localidadID','=',$localidadID);
						})
						->orWhere(function ($query) use ($request,$cuentaID,$localidadID) {
							$query->where('descripcion', 'like', '%'.$request->input('textobuscado').'%')
							      ->where('cuentaID','=',$cuentaID)
							      ->where('localidadID','=',$localidadID);
						})
						->orderBy('nombre')
						->get();
			
			if($productos){
				return response()->json([
					'status' => 'success',
					'data2' => $productos
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'ultimasfactura'){
						
			$cuentaID = Auth::user()->cuentaID;
			$localidadID = Auth::user()->localidadID;
			
			$facturas = DB::table('factura')->where(function ($query) use ($request,$cuentaID,$localidadID) {
							$query->where('cuentaID','=',$cuentaID)
							      ->where('localidadID','=',$localidadID);
						})
						->orderBy('fechaFactura','desc')
						->take(10)
						->get();
			
			if($facturas){
				return response()->json([
					'status' => 'success',
					'data2' => $facturas
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'getmensajeros'){
						
			$cuentaID = Auth::user()->cuentaID;
			$localidadID = Auth::user()->localidadID;
			
			$mensajeros = DB::table('Usuario')->where(function ($query) use ($request,$cuentaID,$localidadID) {
							$query->where('cuentaID','=',$cuentaID)
							      ->where('localidadID','=',$localidadID)
							      ->where('rolID','=',2);
						})
						->orderBy('nombreUsuario','asc')
						->get();
			
			if($mensajeros){
				return response()->json([
					'status' => 'success',
					'data' => $mensajeros
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'getfacturatoprint'){
						
			$idexterno = $request->input('id'); //Id externo de la factura
			$cuentaID = Auth::user()->cuentaID;
			$localidadID = Auth::user()->localidadID;
			
			$facturas = DB::table('factura')->where(function ($query) use ($request,$cuentaID,$localidadID,$idexterno) {
							$query->where('cuentaID','=',$cuentaID)
							      ->where('localidadID','=',$localidadID)
							      ->where('id','=',$idexterno);
						})
						//->orderBy('fechaFactura','desc')
						->take(1)
						->get();
						
			$id = $facturas[0]->id;
			$userID = $facturas[0]->userID;
						
			$detallesfactura = DB::table('DetallesFactura')->where(function ($query) use ($request,$cuentaID,$localidadID,$id) {
							$query->where('facturaID','=',$id);
						})
						//->orderBy('fechaFactura','desc')
						//->take(10)
						->get();
						
			$usuario = DB::table('Usuario')->where(function ($query) use ($request,$cuentaID,$localidadID,$userID) {
							$query->where('id','=',$userID);
						})
						//->orderBy('fechaFactura','desc')
						//->take(10)
						->get();
						
			
			
			if($facturas){
				return response()->json([
					'status' => 'success',
					'data' => $facturas,
					'data2' => $detallesfactura,
					'data3' => $usuario
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'grantAccessByKey'){
						
			$cuentaID = Auth::user()->cuentaID;
			$localidadID = Auth::user()->localidadID;
			if(strlen(trim($request->input('accesskey'))) > 3){
				$grantAccessByKeys = DB::table('Usuario')
						->where(function ($query) use ($request,$cuentaID,$localidadID) {
							$query->where('cuentaID','=',$cuentaID)
							      ->where('localidadID','=',$localidadID)
							      ->where('rolID','=',4)
							      ->where('accessKey','=',$request->input('accesskey'));
						})
						->orWhere(function ($query) use ($request,$cuentaID,$localidadID) {
							$query->where('cuentaID','=',$cuentaID)
							      ->where('localidadID','=',0)
							      ->where('rolID','=',1)
							      ->where('accessKey','=',$request->input('accesskey'));
						})
						->get();
			}else{
				$grantAccessByKeys = false;
			}
			if($grantAccessByKeys){
				return response()->json([
					'status' => 'success',
					'data' => $grantAccessByKeys
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'anularFactura'){
						
			$cuentaID = Auth::user()->cuentaID;
			$localidadID = Auth::user()->localidadID;
			
			$anularfactura = DB::table('Factura')->where('idExterno', '=', $request->input('id'))->update(array('iscanceled' => 1));
			
			$getfactura = DB::table('Factura')->where('idExterno', '=', $request->input('id'))->get();
			
			$where_args1 = array(
				'abrirCerrarCaja.localidadID' => Auth::user()->localidadID,
				'abrirCerrarCaja.cuentaID' => Auth::user()->cuentaID,
				'abrirCerrarCaja.userID' => Auth::user()->id,
				'abrirCerrarCaja.isClosed' => 0
			);
			
			$getsesioncaja = DB::table('abrirCerrarCaja')
							->where($where_args1)
							->orderBy('id','desc')
							->take(1)
							->get();
							
			$valorventatotal = (float)$getsesioncaja[0]->valorVentaTotal - (float)$getfactura[0]->valorFactura;
			$valorimpuestototal = (float)$getsesioncaja[0]->valorImpuestoTotal - (float)$getfactura[0]->impuestoFactura;
			$cantfacturas = (float)$getsesioncaja[0]->cantFacturasCaja - 1;
			
			$updatesesioncaja = DB::table('abrirCerrarCaja')->where($where_args1)
				->update(array(
						'valorVentaTotal' => $valorventatotal,
						'valorImpuestoTotal' => $valorimpuestototal,
						'cantFacturasCaja' => $cantfacturas
					)
				);				
			
			if($anularfactura){
				return response()->json([
					'status' => 'success',
					'data' => $anularfactura
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'enterCajaActualSesion'){
						
			$cuentaID = Auth::user()->cuentaID;
			$localidadID = Auth::user()->localidadID;
			$idsesion = $request->input('idsesion');
			$ipaddress = $request->input('ipaddress');
			
			$sesion = DB::table('abrirCerrarCaja')->where('id', '=', $idsesion)->update(array('ipAddress' => $ipaddress));
			
			if($sesion){
				return response()->json([
					'status' => 'success',
					'data' => $sesion
				]);
			}else{
				return response()->json([
					'status' => 'error'
				]);
			}
		}elseif($request->input('asunto') == 'getSelectedCajaLastSesion'){
						
			$where_args1 = array(
				'abrirCerrarCaja.localidadID' => Auth::user()->localidadID,
				'abrirCerrarCaja.cuentaID' => Auth::user()->cuentaID,
				'abrirCerrarCaja.idCaja' => $request->input('idcaja')
			);
			
			$lastsesion = DB::table('abrirCerrarCaja')
							->where($where_args1)
							->orderBy('id','desc')
							->take(1)
							->get();
			
			if($lastsesion){
				return response()->json([
					'status' => 'success',
					'data' => $lastsesion
				]);
			}else{
				return response()->json([
					'status' => 'error',
					'data' => 'nothing_found'
				]);
			}
		}elseif($request->input('asunto') == 'getSelectedCajaOcupada'){
			$lastsesion = false;
			if(Auth::user()->rolID == 4){			
				$where_args1 = array(
					'abrirCerrarCaja.localidadID' => Auth::user()->localidadID,
					'abrirCerrarCaja.cuentaID' => Auth::user()->cuentaID,
					'abrirCerrarCaja.idCaja' => $request->input('idcaja')
				);
				
				$lastsesion = DB::table('abrirCerrarCaja')
								->where($where_args1)
								->orderBy('id','desc')
								->take(1)
								->get();
			}
			if($lastsesion){
				return response()->json([
					'status' => 'success',
					'data' => $lastsesion
				]);
			}else{
				return response()->json([
					'status' => 'error',
					'data' => 'nothing_found'
				]);
			}
		}elseif($request->input('asunto') == 'iniciarSesionCaja'){
						
			$newsesioncaja = new AbrirCerrarCaja();
			$newsesioncaja->idCaja = $request->input('idcaja');
			$newsesioncaja->localidadID = Auth::user()->localidadID;
			$newsesioncaja->cuentaID = Auth::user()->cuentaID;
			$newsesioncaja->userID = Auth::user()->id;
			$newsesioncaja->cantFacturasCaja = '0';
			$newsesioncaja->valorVentaTotal = '0';
			$newsesioncaja->valorInicialCaja = $request->input('valorinicialcaja');
			$newsesioncaja->fechaInicialCaja = $request->input('fechainicialcaja');
			$newsesioncaja->ipAddress = $request->input('ipaddress');
			$newsesioncaja->save();
			
			
			if($newsesioncaja){
				return response()->json([
					'status' => 'success',
					'data' => $newsesioncaja
				]);
			}else{
				return response()->json([
					'status' => 'error',
					'data' => 'nothing_save'
				]);
			}
		}elseif($request->input('asunto') == 'getDatosSesionCaja'){
						
			$where_args1 = array(
				'abrirCerrarCaja.localidadID' => Auth::user()->localidadID,
				'abrirCerrarCaja.cuentaID' => Auth::user()->cuentaID,
				'abrirCerrarCaja.idCaja' => $request->input('idcaja'),
				'abrirCerrarCaja.isClosed' => 0
			);
			
			$sesioncaja = DB::table('abrirCerrarCaja')
							->where($where_args1)
							->orderBy('id','desc')
							->take(1)
							->get();
			
			if($sesioncaja){
				return response()->json([
					'status' => 'success',
					'data' => $sesioncaja
				]);
			}else{
				return response()->json([
					'status' => 'error',
					'data' => 'nothing_found'
				]);
			}
		}elseif($request->input('asunto') == 'cerrarSesionCaja'){
						
			$where_args1 = array(
				'abrirCerrarCaja.localidadID' => Auth::user()->localidadID,
				'abrirCerrarCaja.cuentaID' => Auth::user()->cuentaID,
				'abrirCerrarCaja.idCaja' => $request->input('idcaja'),
				'abrirCerrarCaja.isClosed' => 0
			);
			
			$sesioncaja = DB::table('abrirCerrarCaja')->where($where_args1)
				->update(array(
						'valorEfectivoCaja' => $request->input('efectivocaja'),
						'valorTarjetaCaja' => $request->input('tarjetacaja'),
						'valorCreditoCaja' => $request->input('creditocaja'),
						'valorChequeCaja' => $request->input('chequecaja'),
						'fechaFinalCaja' => $request->input('fechacierrecaja'),
						'isClosed' => 1
					)
				);
			
			$where_args2 = array(
				'abrirCerrarCaja.localidadID' => Auth::user()->localidadID,
				'abrirCerrarCaja.cuentaID' => Auth::user()->cuentaID,
				'abrirCerrarCaja.userID' => Auth::user()->id
			);
			
			$datoscierre = DB::table('abrirCerrarCaja')
							->where($where_args2)
							->orderBy('fechaFinalCaja','desc')
							->take(1)
							->get();
							
			$where_args3 = array(
				'factura.sesionID' => $datoscierre[0]->id
			);
			
			$datoscierreproductos = DB::table('factura')
							->select('detallesFactura.productoID','detallesFactura.nombreProducto',DB::raw('SUM(detallesFactura.cantidadProducto) as cantidad'),DB::raw('SUM(detallesFactura.subtotalProducto) as total'),'detallesFactura.costoProducto')
							->join('detallesFactura','factura.id','=','detallesFactura.facturaID')
							->where($where_args3)
							->groupBy('detallesFactura.nombreProducto')
							->orderBy('detallesFactura.nombreProducto','asc')
							->get();
							
			$where_args4 = array(
				'factura.sesionID' => $datoscierre[0]->id,
				'factura.useDelivery' => 1
			);
			
			$cantFacturasDelivery = DB::table('factura')
							->select(DB::raw('count(*) as cantidad'))
							->where($where_args4)
							->get();
			
			if($sesioncaja){
				return response()->json([
					'status' => 'success',
					'data' => $datoscierre,
					'data2' => $datoscierreproductos,
					'cantidadcomanda' => $cantFacturasDelivery[0]->cantidad
				]);
			}else{
				return response()->json([
					'status' => 'error',
					'data' => 'nothing_found'
				]);
			}
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