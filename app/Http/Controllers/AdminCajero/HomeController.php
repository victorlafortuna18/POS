<?php

namespace SmartDelivery\Http\Controllers\AdminCajero;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use Davibennun\LaravelPushNotification\Facades\PushNotification;
use SmartDelivery\Models\Localidad;
use SmartDelivery\Models\Usuario;
use SmartDelivery\Models\Pedido;
use SmartDelivery\Models\OrdenOrigenLog;

use View;
use Auth;
use DB;
use Mail;
use Carbon\Carbon;

class HomeController extends BaseController {

	public function showAdmin()
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
			
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuanta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuanta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuanta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		//Condicion para el listado de ordenes		
		$where_args4 = array(
			'asignado' => 0
		);
		$ordenes = DB::table('orden_origen')
					->select('*')
					->where($where_args4)
					//->orderBy('Sucursal.nombre','asc')
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuanta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
					
        return view('admincajero.dashboard', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
    }

	
	public function showAdminUsuario()
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		//Condicion para el listado de ordenes		
		$where_args4 = array(
			'Orden.localidadID' => Auth::user()->localidadID,
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admincajero.usuario', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
    }
	
	public function showAdminCajero()
    {
		
		/*
		** Verificacion de usuario
		**************************************************/
		//Toma el id del usuario logeado
		$id_user = Auth::user()->id;
		//Busca el rol del usuario para dar permisos de entrada a este panel
		$data_user = DB::table('Usuario')
			->select('rolID')
			->where('id','=',$id_user)
			->get();
		//Verifica que el rol del usuario logeado tiene acceso a este panel
		if($data_user[0]->rolID != 6){
			if($data_user[0]->rolID== 1){
				return redirect()->action('Admin\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 5){
				return redirect()->action('AdminCallcenter\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 4){
				return redirect()->action('AdminLocalidad\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 3){
				return redirect()->action('AdminOperador\HomeController@showAdmin');
			}
		}
		/*******************************************/
		
		
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 6,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		//Condicion para el listado de ordenes		
		$where_args4 = array(
			'Orden.localidadID' => Auth::user()->localidadID,
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admincajero.cajero', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
    }

	
	public function showAdminMensajero()
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 2
			//'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		//Condicion para el listado de ordenes		
		$where_args4 = array(
			'Orden.localidadID' => Auth::user()->localidadID,
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admincajero.mensajero', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
        
    }

	
	public function showAdminSucursal()
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		//Condicion para el listado de ordenes		
		$where_args4 = array(
			'Orden.localidadID' => Auth::user()->localidadID,
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admincajero.sucursal', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
    }
	
	public function showAdminPedido()
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		//Condicion para el listado de ordenes		
		$where_args4 = array(
			'Orden.localidadID' => Auth::user()->localidadID,
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->orderBy('created_at','desc')
					->get();
					
		//Condicion para el listado de clientes		
		/*$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);*/
		
		//Condicion para el listado de pedidos		
		$where_args6 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidosPendientes = DB::table('Pedido')
					->select('*')
					->where($where_args6)
					->orderBy('created_at','desc')
					->get();
		
        //Consulta todos los estados de pedidos
		$estado_pedidos = DB::table('EstadoPedido')
					->select('*')
					//->where($where_args5)
					->get();
					
		//Condicion para el listado de clientes		
		/*$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);*/
		
        //Consulta todos los clientes
		$clientes = DB::table('Cliente')
					->select('*')
					//->where($where_args5)
					->get();
					
		//Condicion para el listado de direcciones de clientes		
		/*$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);*/
		
        //Consulta todas las direcciones de clientes
		$direcciones = DB::table('DireccionCliente')
					->select('*')
					//->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admincajero.pedido', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes','direcciones','estado_pedidos','pedidosPendientes'));
    }
	
	
	public function showAdminOrdenes()
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		$where_args3 = array(
			//'cuentaID' => Auth::user()->cuentaID,
			//'sucursalid' => $localidad->idSucursal
			'asignado' => 0
		);
		$ordenes = DB::table('orden_origen')
					->select('*')
					->where($where_args3)
					//->orderBy('ordenid','asc')
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->orderBy('created_at','desc')
					->get();
					
		//Condicion para el listado de clientes		
		/*$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);*/
		
		//Condicion para el listado de pedidos		
		$where_args6 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidosPendientes = DB::table('Pedido')
					->select('*')
					->where($where_args6)
					->orderBy('created_at','desc')
					->get();
		
        //Consulta todos los estados de pedidos
		$estado_pedidos = DB::table('EstadoPedido')
					->select('*')
					//->where($where_args5)
					->get();
					
		//Condicion para el listado de clientes		
		/*$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);*/
		
        //Consulta todos los clientes
		$clientes = DB::table('Cliente')
					->select('*')
					//->where($where_args5)
					->get();
					
		//Condicion para el listado de direcciones de clientes		
		/*$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);*/
		
        //Consulta todas las direcciones de clientes
		$direcciones = DB::table('DireccionCliente')
					->select('*')
					//->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admincajero.ordenes', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes','direcciones','estado_pedidos','pedidosPendientes'));
    }
	
	public function showAdminLocalizarPedido()
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		//Condicion para el listado de ordenes		
		$where_args4 = array(
			'Orden.localidadID' => Auth::user()->localidadID,
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->orderBy('created_at','desc')
					->get();
					
		//Condicion para el listado de clientes		
		/*$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);*/
		
        //Consulta todos los estados de pedidos
		$estado_pedidos = DB::table('EstadoPedido')
					->select('*')
					//->where($where_args5)
					->get();
					
		//Condicion para el listado de clientes		
		/*$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);*/
		
        //Consulta todos los clientes
		$clientes = DB::table('Cliente')
					->select('*')
					//->where($where_args5)
					->get();
					
		//Condicion para el listado de direcciones de clientes		
		/*$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);*/
		
        //Consulta todas las direcciones de clientes
		$direcciones = DB::table('DireccionCliente')
					->select('*')
					//->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admincajero.localizarPedido', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes','direcciones','estado_pedidos'));
    }
	
	public function showAdminLocalizarMensajero()
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		//Condicion para el listado de ordenes		
		$where_args4 = array(
			'Orden.localidadID' => Auth::user()->localidadID,
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->orderBy('created_at','desc')
					->get();
					
		//Condicion para el listado de clientes		
		/*$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);*/
		
        //Consulta todos los estados de pedidos
		$estado_pedidos = DB::table('EstadoPedido')
					->select('*')
					//->where($where_args5)
					->get();
					
		//Condicion para el listado de clientes		
		/*$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);*/
		
        //Consulta todos los clientes
		$clientes = DB::table('Cliente')
					->select('*')
					//->where($where_args5)
					->get();
					
		//Condicion para el listado de direcciones de clientes		
		/*$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);*/
		
        //Consulta todas las direcciones de clientes
		$direcciones = DB::table('DireccionCliente')
					->select('*')
					//->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admincajero.localizarMensajero', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes','direcciones','estado_pedidos'));
    }

	
	public function showAdminReportes()
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		//Condicion para el listado de ordenes		
		$where_args4 = array(
			'Orden.localidadID' => Auth::user()->localidadID,
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
					
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 2
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidosTerminados = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
					
		//Condicion para el listado de clientes		
		$where_args6 = array(
			'Cliente.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los pedidos de una cuenta especifica
		$clientes = DB::table('Cliente')
					->select('*')
					//->where($where_args6)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admincajero.report', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','pedidosTerminados','clientes'));
    }
	
	public function showAdminReportePedidoMensajero()
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);

        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->whereBetween('Pedido.timeInitial', array(date('Y-m-d'),date('Y-m-d', strtotime( '+1 days' ))))
					->get();
					
		//Condicion para el listado de clientes		
		$where_args6 = array(
			'Cliente.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los clientes de una cuenta especifica
		$clientes = DB::table('Cliente')
					->select('*')
					//->where($where_args6)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admincajero.reportPedidoMensajero', compact('cuentas','sucursales','usuarios','mensajeros','pedidos','clientes'));
    }
	
	//Busqueda de pedidos por fecha en reporte
	public function showAdminReportePedidoMensajeroSearch(Request $request)
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID
		);

        $desde = date('Y-m-d');
        $hasta = date('Y-m-d', strtotime( '+1 days' ));

        if($request->input('desde')){
            $desde =  Carbon::parse($request->input('desde'));

        }
        if($request->input('hasta')){
            $hasta =  Carbon::parse($request->input('hasta'))->addhours(23)->addMinutes(59)->addSeconds(59);
        }


        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->whereBetween('Pedido.timeInitial', array($desde,$hasta))
					->get();
					
		//Condicion para el listado de clientes		
		$where_args6 = array(
			'Cliente.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los clientes de una cuenta especifica
		$clientes = DB::table('Cliente')
					->select('*')
					//->where($where_args6)
					->get();
		
		//Aqui es donde despacho toda la data a la vista admincajero/reportPedidoMensajero.blade.php
        return view('admincajero.reportPedidoMensajero', compact('cuentas','sucursales','usuarios','mensajeros','pedidos','clientes'), array('desde' => $request->input('desde'),'hasta' => $request->input('hasta')));
    }
	
	//Busqueda de detalles de pedidos por fecha en reporte
	public function showAdminReportePedidoMensajeroDetalle($idMensajero,Request $request)
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.id' => $idMensajero,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 2,
			'Pedido.usuarioID' => $idMensajero
		);

        $desde = date('Y-m-d');
        $hasta = date('Y-m-d', strtotime( '+1 days' ));

        if($request->input('desde')){
            $desde =  Carbon::parse($request->input('desde'));

        }
        if($request->input('hasta')){
            $hasta =  Carbon::parse($request->input('hasta'))->addhours(23)->addMinutes(59)->addSeconds(59);
        }

        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->whereBetween('Pedido.timeInitial', array($desde, $hasta))
					->get();
					
		//Condicion para el listado de clientes		
		$where_args6 = array(
			'Cliente.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los clientes de una cuenta especifica
		$clientes = DB::table('Cliente')
					->select('*')
					//->where($where_args6)
					->get();
					
		//Consulta los clientes de una cuenta especifica
		$direcciones = DB::table('DireccionCliente')
					->select('*')
					//->where($where_args6)
					->get();
		
		//Aqui es donde despacho toda la data a la vista admincajero/reportPedidoMensajero.blade.php
        return view('admincajero.reportPedidoMensajeroDetalle', compact('cuentas','sucursales','usuarios','mensajeros','pedidos','clientes','direcciones'), array('desde' => $request->input('desde'),'hasta' => $request->input('hasta')));
    }
	
	//Busqueda de detalles de pedidos por fecha en reporte
	public function showAdminReportePedido(Request $request)
    {
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			//'Usuario.id' => $idMensajero,
			'Usuario.rolID'		=> 2,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
		
		/*************************/
			$desde = date('Y-m-d');
			$hasta = date('Y-m-d', strtotime( '+1 days' ));
		
		if($request->input('desde')){
//			 $desde = $request->input('desde');
            $desde =  Carbon::parse($request->input('desde'));

		}
		if($request->input('hasta')){
//			 $hasta = $request->input('hasta');
            $hasta =  Carbon::parse($request->input('hasta'))->addHours(24);
        }

		/**********************************/
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.localidadID' => Auth::user()->localidadID,
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 2
			//'Pedido.usuarioID' => $idMensajero
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->whereBetween('Pedido.timeInitial', array($desde,$hasta))
					->get();
					
		
		
        //Consulta los clientes de una cuenta especifica
		$clientes = DB::table('Cliente')
					->select('*')
					//->where($where_args6)
					->get();
					
		//Consulta los clientes de una cuenta especifica
		$direcciones = DB::table('DireccionCliente')
					->select('*')
					//->where($where_args6)
					->get();
		
		//Aqui es donde despacho toda la data a la vista admincajero/reportPedidoMensajero.blade.php
        return view('admincajero.reportPedido', compact('cuentas','sucursales','usuarios','mensajeros','pedidos','clientes','direcciones'), array('desde' => $request->input('desde'),'hasta' => $request->input('hasta')));
    }
	
	/* All Admin Edits with alerts ************************/
	/******************************************************/
	public function showAdminEditSucursal(Request $request)
    {
		if($request->input('asunto') == 'guardarSucursal'){
			$sucursal = new Localidad();
			$sucursal->cuentaid = Auth::user()->cuentaID;
			$sucursal->nombreLocalidad = $request->input('nombreSucursal');
			$sucursal->nombreGerente = $request->input('nombreGerente');
			$sucursal->save();
			
			return redirect()->action('AdminCajero\HomeController@showAdminSucursal', array('agregado' => 'success', '#'.$sucursal->id));
		}
		elseif($request->input('asunto') == 'eliminarSucursal'){
			$sucursal = DB::table('Localidad')->where('id', '=', $request->input('idSucursal'))->delete();
			
			if($sucursal == true){
				return redirect()->action('AdminCajero\HomeController@showAdminSucursal', array('eliminado' => 'success'));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminSucursal', array('eliminado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarSucursal'){
			//$sucursal = DB::table('Localidad')->where('id', '=', $request->input('idSucursal'))->delete();
			$sucursal = DB::table('Localidad')->where('id', '=', $request->input('idSucursal'))->update(array('nombreLocalidad' => $request->input('nombreSucursal'),'nombreGerente' => $request->input('nombreGerente'),'direccionLocalidad' => $request->input('direccion'),'latitud' => $request->input('latitud'),'longitud' => $request->input('longitud')));
			
			if($sucursal == true){
				return redirect()->action('AdminCajero\HomeController@showAdminSucursal', array('editado' => 'success','#'.$request->input('idSucursal')));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminSucursal', array('editado' => 'error'));
			}
		}
		
		
		
		
	}
	
	
	public function showAdminEditUsuario(Request $request)
    {
		if($request->input('asunto') == 'guardarUsuario'){
			try {
				$operador = new Usuario();
				$operador->cuentaid = Auth::user()->cuentaID;
				$operador->localidadID = $request->input('localidadID');
				$operador->userID = $request->input('userID');
				$operador->password = Hash::make($request->input('password'));
				$operador->nombreUsuario = $request->input('nombreUsuario');
				$operador->telefonoUsuario = $request->input('telefonoUsuario');
				$operador->rolID = 3;
				$operador->activo = 1;
				$operador->EstatusActual = 1;
				$operador->save();
			} catch (\Illuminate\Database\QueryException $e) {
                //dd($e);
				$operador = false;
            } catch (\Illuminate\Database\Connection $e) {
                //dd($e);
				$operador = false;
            } catch (PDOException $e) {
                //dd($e);
				$operador = false;
            }
			
			if($operador == true){
				return redirect()->action('AdminCajero\HomeController@showAdminUsuario', array('agregado' => 'success', '#'.$operador->id));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminUsuario', array('agregado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'eliminarUsuario'){
			try {
				$operador = DB::table('Usuario')->where('id', '=', $request->input('id'))->delete();
			} catch (\Illuminate\Database\QueryException $e) {
                //dd($e);
				$operador = false;
            } catch (\Illuminate\Database\Connection $e) {
                //dd($e);
				$operador = false;
            } catch (PDOException $e) {
                //dd($e);
				$operador = false;
            }
			
			if($operador == true){
				return redirect()->action('AdminCajero\HomeController@showAdminUsuario', array('eliminado' => 'success'));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminUsuario', array('eliminado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarUsuario'){
			
			$operador = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'localidadID' => $request->input('localidadID'),
				'userID' => $request->input('userID'),
				'nombreUsuario' => $request->input('nombreUsuario'),
				'telefonoUsuario' => $request->input('telefonoUsuario')
				)
			);
			
			if($operador == true){
				return redirect()->action('AdminCajero\HomeController@showAdminUsuario', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminUsuario', array('editado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarUsuarioPassword'){
			
			$operador = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'password' => Hash::make($request->input('password'))
				)
			);
			
			if($operador == true){
				return redirect()->action('AdminCajero\HomeController@showAdminUsuario', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminUsuario', array('editado' => 'error'));
			}
		}
		
		
		
		
	}
	
	public function showAdminEditCajero(Request $request)
    {
		
		/*
		** Verificacion de usuario
		**************************************************/
		//Toma el id del usuario logeado
		$id_user = Auth::user()->id;
		//Busca el rol del usuario para dar permisos de entrada a este panel
		$data_user = DB::table('Usuario')
			->select('rolID')
			->where('id','=',$id_user)
			->get();
		//Verifica que el rol del usuario logeado tiene acceso a este panel
		if($data_user[0]->rolID != 6){
			if($data_user[0]->rolID== 1){
				return redirect()->action('Admin\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 5){
				return redirect()->action('AdminCallcenter\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 4){
				return redirect()->action('AdminLocalidad\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 3){
				return redirect()->action('AdminOperador\HomeController@showAdmin');
			}
		}
		/*******************************************/
		
		
		if($request->input('asunto') == 'guardarUsuario'){
			try {
				$operador = new Usuario();
				$operador->cuentaid = Auth::user()->cuentaID;
				$operador->localidadID = $request->input('localidadID');
				$operador->userID = $request->input('userID');
				$operador->password = Hash::make($request->input('password'));
				$operador->nombreUsuario = $request->input('nombreUsuario');
				$operador->telefonoUsuario = $request->input('telefonoUsuario');
				$operador->rolID = 6;
				$operador->activo = 1;
				$operador->EstatusActual = 1;
				$operador->save();
			} catch (\Illuminate\Database\QueryException $e) {
                //dd($e);
				$operador = false;
            } catch (\Illuminate\Database\Connection $e) {
                //dd($e);
				$operador = false;
            } catch (PDOException $e) {
                //dd($e);
				$operador = false;
            }
			
			if($operador == true){
				return redirect()->action('AdminCajero\HomeController@showAdminCajero', array('agregado' => 'success', '#'.$operador->id));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminCajero', array('agregado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'eliminarUsuario'){
			try {
				$operador = DB::table('Usuario')->where('id', '=', $request->input('id'))->delete();
			} catch (\Illuminate\Database\QueryException $e) {
                //dd($e);
				$operador = false;
            } catch (\Illuminate\Database\Connection $e) {
                //dd($e);
				$operador = false;
            } catch (PDOException $e) {
                //dd($e);
				$operador = false;
            }
			
			if($operador == true){
				return redirect()->action('AdminCajero\HomeController@showAdminCajero', array('eliminado' => 'success'));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminCajero', array('eliminado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarUsuario'){
			
			$operador = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'localidadID' => $request->input('localidadID'),
				'userID' => $request->input('userID'),
				'nombreUsuario' => $request->input('nombreUsuario'),
				'telefonoUsuario' => $request->input('telefonoUsuario')
				)
			);
			
			if($operador == true){
				return redirect()->action('AdminCajero\HomeController@showAdminCajero', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminCajero', array('editado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarUsuarioPassword'){
			
			$operador = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'password' => Hash::make($request->input('password'))
				)
			);
			
			if($operador == true){
				return redirect()->action('AdminCajero\HomeController@showAdminCajero', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminCajero', array('editado' => 'error'));
			}
		}
		
		
		
	}
	
	
	public function showAdminEditMensajero(Request $request)
    {
		if($request->input('asunto') == 'guardarMensajero'){
			try {
				$mensajero = new Usuario();
				$mensajero->cuentaid = Auth::user()->cuentaID;
				$mensajero->localidadID = $request->input('localidadID');
				$mensajero->userID = $request->input('userID');
				$mensajero->password = Hash::make($request->input('password'));
				$mensajero->nombreUsuario = $request->input('nombreUsuario');
				$mensajero->telefonoUsuario = $request->input('telefonoUsuario');
				$mensajero->rolID = 2;
				$mensajero->activo = 1;
				$mensajero->EstatusActual = 3;
				$mensajero->save();
			} catch (\Illuminate\Database\QueryException $e) {
                //dd($e);
				$mensajero = false;
            } catch (\Illuminate\Database\Connection $e) {
                //dd($e);
				$mensajero = false;
            } catch (PDOException $e) {
                //dd($e);
				$mensajero = false;
            }
			
			if($mensajero == true){
				return redirect()->action('AdminCajero\HomeController@showAdminMensajero', array('agregado' => 'success', '#'.$mensajero->id));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminMensajero', array('agregado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'eliminarMensajero'){
			try {
				$mensajero = DB::table('Usuario')->where('id', '=', $request->input('id'))->delete();
			} catch (\Illuminate\Database\QueryException $e) {
                //dd($e);
				$mensajero = false;
            } catch (\Illuminate\Database\Connection $e) {
                //dd($e);
				$mensajero = false;
            } catch (PDOException $e) {
                //dd($e);
				$mensajero = false;
            }
			
			if($mensajero == true){
				return redirect()->action('AdminCajero\HomeController@showAdminMensajero', array('eliminado' => 'success'));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminMensajero', array('eliminado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarMensajero'){
			
			$mensajero = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'localidadID' => $request->input('localidadID'),
				'userID' => $request->input('userID'),
				'nombreUsuario' => $request->input('nombreUsuario'),
				'telefonoUsuario' => $request->input('telefonoUsuario')
				)
			);
			
			if($mensajero == true){
				return redirect()->action('AdminCajero\HomeController@showAdminMensajero', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminMensajero', array('editado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarMensajeroPassword'){
			
			$mensajero = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'password' => Hash::make($request->input('password'))
				)
			);
			
			if($mensajero == true){
				return redirect()->action('AdminCajero\HomeController@showAdminMensajero', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminMensajero', array('editado' => 'error'));
			}
		}
	}
	
	
	public function showAdminEditOrden(Request $request)
    {
		if($request->input('asunto') == 'eliminarOrden'){
			try {
				$orden_origen = DB::table('orden_origen')->where('id', '=', $request->input('id'))->delete();
			} catch (\Illuminate\Database\QueryException $e) {
                //dd($e);
				$orden_origen = false;
            } catch (\Illuminate\Database\Connection $e) {
                //dd($e);
				$orden_origen = false;
            } catch (PDOException $e) {
                //dd($e);
				$orden_origen = false;
            }
			
			if($orden_origen == true){
				
				$accion = Auth::user()->userID . " ha eliminado la orden " . $request->input('ordenid');
				
				//Log orden_origen_log
				$ordenorigenlog = new OrdenOrigenLog();
				$ordenorigenlog->orden = $request->input('ordenid');
				$ordenorigenlog->ordenID = $request->input('id');
				$ordenorigenlog->cliente = $request->input('clientnombre');
				$ordenorigenlog->usuarioID = Auth::user()->id;
				$ordenorigenlog->accion = $accion;
				$ordenorigenlog->save();
				
				return redirect()->action('AdminCajero\HomeController@showAdminOrdenes', array('eliminado' => 'success'));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminOrdenes', array('eliminado' => 'error'));
			}
		}
	}
	
	
	
	public function showAdminEditPedido(Request $request)
    {
		if($request->input('asunto') == 'editarMensajero'){
			$pedido = DB::table('Pedido')->where('id', '=', $request->input('idPedido'))->update(array('usuarioID' => $request->input('idMensajero')));

            $user_gcm_token = Usuario::where('id','=',$request->input('idMensajero'))->first();

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

			
			if($pedido == true){
				return redirect()->action('AdminCajero\HomeController@showAdminPedido', array('editado' => 'success','#'.$request->input('idPedido')));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminPedido', array('editado' => 'error'));
			}
		}elseif($request->input('asunto') == 'completarPedido'){
			//$pedido = DB::table('Pedido')->where('id', '=', $request->input('idPedido'))->update(array('usuarioID' => $request->input('idMensajero')));

            $pedido = Pedido::where('id','=',$request->input('idPedido'))->firstOrFail();
			$pedido->estadoPedidoID = 2;
			$pedido->save();
			
			$pedidos = Pedido::where('id','=',$request->input('idPedido'))->firstOrFail();
			
			
			/**/
			$usuarioID = $pedidos->usuarioID;
			
			//Condicion para el conteo de pedidos
			$where_args5 = array(
				'estadoPedidoID' => 1,
				'usuarioID' => $usuarioID
			);
			//Contamos los pedidos asignados a este mensajero
			$pedidoscount = DB::table('Pedido')->select('*')->where($where_args5)->count();

			if($pedidoscount > 0){
				//Estatus actual del mensajero ahora es Semi Disponible
				$mensajero = DB::table('Usuario')->where('id', '=', $usuarioID)
					->update(array(
							'EstatusActual' => 2
						)
					);
			}else{
				//Estatus actual del mensajero ahora es Activo
				$mensajero = DB::table('Usuario')->where('id', '=', $usuarioID)
					->update(array(
							'EstatusActual' => 0
						)
					);
			}

			
			if($pedido == true){
				return redirect()->action('AdminCajero\HomeController@showAdminPedido', array('editado' => 'success','#'.$request->input('idPedido')));
			}else{
				return redirect()->action('AdminCajero\HomeController@showAdminPedido', array('editado' => 'error'));
			}
		}	
	}
	
	
	
	
	
	
	
	//* POS Reports *********************************
	//***********************************************
	
	//Busqueda de detalles de pedidos por fecha en reporte
	public function showAdminReporteSesion(Request $request)
    {
		
		/*
		** Verificacion de usuario
		**************************************************/
		//Toma el id del usuario logeado
		$id_user = Auth::user()->id;
		//Busca el rol del usuario para dar permisos de entrada a este panel
		$data_user = DB::table('Usuario')
			->select('rolID')
			->where('id','=',$id_user)
			->get();
		//Verifica que el rol del usuario logeado tiene acceso a este panel
		if($data_user[0]->rolID != 6){
			if($data_user[0]->rolID== 1){
				return redirect()->action('Admin\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 5){
				return redirect()->action('AdminCallcenter\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 4){
				return redirect()->action('AdminLocalidad\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 3){
				return redirect()->action('AdminOperador\HomeController@showAdmin');
			}
		}
		/*******************************************/
		
		
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		/*************************/
			$desde = date('Y-m-d');
			$hasta = date('Y-m-d', strtotime( '+1 days' ));
		
		if($request->input('desde')){
			 $desde = $request->input('desde');							
		}
		if($request->input('hasta')){
			 $hasta = $request->input('hasta'); 
		}
		/**********************************/
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'abrirCerrarCaja.localidadID' => Auth::user()->localidadID,
			'abrirCerrarCaja.cuentaID' => Auth::user()->cuentaID,
			'abrirCerrarCaja.isClosed' => 1
			//'Pedido.usuarioID' => $idMensajero
		);
		
        //Consulta los pedidos de una cuenta especifica
		$sesiones = DB::table('abrirCerrarCaja')
					->select('*')
					->where($where_args5)
					->whereBetween('abrirCerrarCaja.fechaInicialCaja', array($desde,$hasta))
					->paginate(30);
					
		$countsesiones = DB::table('abrirCerrarCaja')
					->where($where_args5)
					->whereBetween('abrirCerrarCaja.fechaInicialCaja', array($desde,$hasta))
					->count();
					
		
		//Aqui es donde despacho toda la data a la vista admincajero/reportPedidoMensajero.blade.php
        return view('admincajero.reportSesion', compact('cuentas','sucursales','usuarios','sesiones','countsesiones'), array('desde' => $request->input('desde'),'hasta' => $request->input('hasta')));
    }
	
	public function showAdminReporteFactura($idsesion, Request $request)
    {
		
		/*
		** Verificacion de usuario
		**************************************************/
		//Toma el id del usuario logeado
		$id_user = Auth::user()->id;
		//Busca el rol del usuario para dar permisos de entrada a este panel
		$data_user = DB::table('Usuario')
			->select('rolID')
			->where('id','=',$id_user)
			->get();
		//Verifica que el rol del usuario logeado tiene acceso a este panel
		if($data_user[0]->rolID != 6){
			if($data_user[0]->rolID == 1){
				return redirect()->action('Admin\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 5){
				return redirect()->action('AdminCallcenter\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 4){
				return redirect()->action('AdminLocalidad\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 3){
				return redirect()->action('AdminOperador\HomeController@showAdmin');
			}
		}
		/*******************************************/
		
		
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		/*************************/
			$desde = date('Y-m-d');
			$hasta = date('Y-m-d', strtotime( '+1 days' ));
		
		if($request->input('desde')){
			 $desde = $request->input('desde');							
		}
		if($request->input('hasta')){
			 $hasta = $request->input('hasta'); 
		}
		/**********************************/
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			///'Pedido.localidadID' => Auth::user()->localidadID,
			//'Factura.cuentaID' => Auth::user()->cuentaID,
			'Factura.sesionID' => $idsesion
			//'Pedido.usuarioID' => $idMensajero
		);
		
        //Consulta los pedidos de una cuenta especifica
		$facturas = DB::table('Factura')
					->select('*')
					->where($where_args5)
					//->whereBetween('abrirCerrarCaja.fechaInicialCaja', array($desde,$hasta))
					->get();
					//->paginate(30);
					
		//Condicion para el listado de sesiones de caja		
		$where_args6 = array(
			'id' => $idsesion
		);
		
        //Consulta los pedidos de una cuenta especifica
		$sesiones = DB::table('abrirCerrarCaja')
					->select('*')
					->where($where_args6)
					->get();
					
		
		//Aqui es donde despacho toda la data a la vista admincajero/reportPedidoMensajero.blade.php
        return view('admincajero.reportFactura', compact('cuentas','sucursales','usuarios','facturas','sesiones'), array('desde' => $request->input('desde'),'hasta' => $request->input('hasta')));
    }
	
	public function showAdminReporteProducto(Request $request)
    {
		
		/*
		** Verificacion de usuario
		**************************************************/
		//Toma el id del usuario logeado
		$id_user = Auth::user()->id;
		//Busca el rol del usuario para dar permisos de entrada a este panel
		$data_user = DB::table('Usuario')
			->select('rolID')
			->where('id','=',$id_user)
			->get();
		//Verifica que el rol del usuario logeado tiene acceso a este panel
		if($data_user[0]->rolID != 6){
			if($data_user[0]->rolID == 1){
				return redirect()->action('Admin\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 5){
				return redirect()->action('AdminCallcenter\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 4){
				return redirect()->action('AdminLocalidad\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 3){
				return redirect()->action('AdminOperador\HomeController@showAdmin');
			}
		}
		/*******************************************/
		
		
		//Condicion para el listado de cuentas
		$where_args0 = array(
			'Cuenta.id' => Auth::user()->cuentaID
		);
		
        //Consulta los datos de una cuenta especifica
		$cuentas = DB::table('Cuenta')
					->select('Cuenta.id','Cuenta.cuentaID','Cuenta.nombreContacto','Cuenta.numeroContacto','Cuenta.correoContacto','Cuenta.pais_id')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args0)
					->get();
		
		//Condicion para el listado de sucursales
		$where_args = array(
			'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.localidadID' => Auth::user()->localidadID,
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		/*************************/
			$desde = date('Y-m-d');
			$hasta = date('Y-m-d', strtotime( '+1 days' ));
		
		if($request->input('desde')){
			 $desde = $request->input('desde');							
		}
		if($request->input('hasta')){
			 $hasta = $request->input('hasta'); 
		}
		/**********************************/
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			///'Pedido.localidadID' => Auth::user()->localidadID,
			//'Factura.cuentaID' => Auth::user()->cuentaID,
			//'DetallesFactura.sesionID' => $idsesion
			//'Pedido.usuarioID' => $idMensajero
		);
		

					
		$productos = DB::table('factura')
						->select('detallesFactura.productoID','detallesFactura.nombreProducto',DB::raw('SUM(detallesFactura.cantidadProducto) as cantidad'),DB::raw('SUM(detallesFactura.subtotalProducto) as total'),'detallesFactura.costoProducto')
						->join('detallesFactura','factura.id','=','detallesFactura.facturaID')
						//->where($where_args3)
						->whereBetween('Factura.fechaFactura', array($desde,$hasta))
						->groupBy('detallesFactura.nombreProducto')
						->orderBy('detallesFactura.nombreProducto','asc')
						->get();
					
		
		
		//Aqui es donde despacho toda la data a la vista admincajero/reportPedidoMensajero.blade.php
        return view('admincajero.reportProducto', compact('cuentas','sucursales','usuarios','productos'), array('desde' => $request->input('desde'),'hasta' => $request->input('hasta')));
    }
	
}