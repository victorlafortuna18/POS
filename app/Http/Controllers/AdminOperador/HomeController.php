<?php

namespace SmartDelivery\Http\Controllers\AdminOperador;

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
					
        return view('adminoperador.dashboard', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
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
        return view('adminoperador.usuario', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
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
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		$where_args4 = array(
			//'cuentaID' => Auth::user()->cuentaID,
			//'sucursalid' => $localidad->idSucursal
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
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('adminoperador.mensajero', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
        
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
        return view('adminoperador.sucursal', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
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
			//'cuentaID' => Auth::user()->cuentaID,
			//'sucursalid' => $localidad->idSucursal
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
			'Pedido.estadopedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					//->orderBy('created_at','desc')
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
					//->orderBy('created_at','desc')
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
        return view('adminoperador.pedido', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes','direcciones','estado_pedidos','pedidosPendientes'));
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
					//->orderBy('Sucursal.nombre','asc')
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
        return view('adminoperador.ordenes', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes','direcciones','estado_pedidos','pedidosPendientes'));
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
        return view('adminoperador.localizarPedido', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes','direcciones','estado_pedidos'));
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
        return view('adminoperador.localizarMensajero', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes','direcciones','estado_pedidos'));
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
        return view('adminoperador.report', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','pedidosTerminados','clientes'));
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
        return view('adminoperador.reportPedidoMensajero', compact('cuentas','sucursales','usuarios','mensajeros','pedidos','clientes'));
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
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->whereBetween('Pedido.timeInitial', array($request->input('desde'),$request->input('hasta')))
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
		
		//Aqui es donde despacho toda la data a la vista adminlocalidad/reportPedidoMensajero.blade.php
        return view('adminoperador.reportPedidoMensajero', compact('cuentas','sucursales','usuarios','mensajeros','pedidos','clientes'), array('desde' => $request->input('desde'),'hasta' => $request->input('hasta')));
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
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->whereBetween('Pedido.timeInitial', array($request->input('desde'),$request->input('hasta')))
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
		
		//Aqui es donde despacho toda la data a la vista adminlocalidad/reportPedidoMensajero.blade.php
        return view('adminoperador.reportPedidoMensajeroDetalle', compact('cuentas','sucursales','usuarios','mensajeros','pedidos','clientes','direcciones'), array('desde' => $request->input('desde'),'hasta' => $request->input('hasta')));
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
			 $desde = $request->input('desde');							
		}
		if($request->input('hasta')){
			 $hasta = $request->input('hasta')->addhours(23)->addMinutes(59)->addSeconds(59);
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
		
		//Aqui es donde despacho toda la data a la vista adminlocalidad/reportPedidoMensajero.blade.php
        return view('adminoperador.reportPedido', compact('cuentas','sucursales','usuarios','mensajeros','pedidos','clientes','direcciones'), array('desde' => $request->input('desde'),'hasta' => $request->input('hasta')));
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
			
			return redirect()->action('AdminLocalidad\HomeController@showAdminSucursal', array('agregado' => 'success', '#'.$sucursal->id));
		}
		elseif($request->input('asunto') == 'eliminarSucursal'){
			$sucursal = DB::table('Localidad')->where('id', '=', $request->input('idSucursal'))->delete();
			
			if($sucursal == true){
				return redirect()->action('AdminLocalidad\HomeController@showAdminSucursal', array('eliminado' => 'success'));
			}else{
				return redirect()->action('AdminLocalidad\HomeController@showAdminSucursal', array('eliminado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarSucursal'){
			//$sucursal = DB::table('Localidad')->where('id', '=', $request->input('idSucursal'))->delete();
			$sucursal = DB::table('Localidad')->where('id', '=', $request->input('idSucursal'))->update(array('nombreLocalidad' => $request->input('nombreSucursal'),'nombreGerente' => $request->input('nombreGerente'),'direccionLocalidad' => $request->input('direccion'),'latitud' => $request->input('latitud'),'longitud' => $request->input('longitud')));
			
			if($sucursal == true){
				return redirect()->action('AdminLocalidad\HomeController@showAdminSucursal', array('editado' => 'success','#'.$request->input('idSucursal')));
			}else{
				return redirect()->action('AdminLocalidad\HomeController@showAdminSucursal', array('editado' => 'error'));
			}
		}
		
		
		
		
	}
	
	
	public function showAdminEditUsuario(Request $request)
    {
		if($request->input('asunto') == 'guardarUsuario'){
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
			
			return redirect()->action('AdminLocalidad\HomeController@showAdminUsuario', array('agregado' => 'success', '#'.$operador->id));
		}
		elseif($request->input('asunto') == 'eliminarUsuario'){
			$operador = DB::table('Usuario')->where('id', '=', $request->input('id'))->delete();
			
			if($operador == true){
				return redirect()->action('AdminLocalidad\HomeController@showAdminUsuario', array('eliminado' => 'success'));
			}else{
				return redirect()->action('AdminLocalidad\HomeController@showAdminUsuario', array('eliminado' => 'error'));
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
				return redirect()->action('AdminLocalidad\HomeController@showAdminUsuario', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('AdminLocalidad\HomeController@showAdminUsuario', array('editado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarUsuarioPassword'){
			
			$operador = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'password' => Hash::make($request->input('password'))
				)
			);
			
			if($operador == true){
				return redirect()->action('AdminLocalidad\HomeController@showAdminUsuario', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('AdminLocalidad\HomeController@showAdminUsuario', array('editado' => 'error'));
			}
		}
		
		
		
		
	}
	
	
	public function showAdminEditMensajero(Request $request)
    {
		if($request->input('asunto') == 'guardarMensajero'){
			
			
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
			
			return redirect()->action('AdminLocalidad\HomeController@showAdminMensajero', array('agregado' => 'success', '#'.$mensajero->id));
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
				return redirect()->action('AdminLocalidad\HomeController@showAdminMensajero', array('eliminado' => 'success'));
			}else{
				return redirect()->action('AdminLocalidad\HomeController@showAdminMensajero', array('eliminado' => 'error'));
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
				return redirect()->action('AdminLocalidad\HomeController@showAdminMensajero', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('AdminLocalidad\HomeController@showAdminMensajero', array('editado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarMensajeroPassword'){
			
			$mensajero = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'password' => Hash::make($request->input('password'))
				)
			);
			
			if($mensajero == true){
				return redirect()->action('AdminLocalidad\HomeController@showAdminMensajero', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('AdminLocalidad\HomeController@showAdminMensajero', array('editado' => 'error'));
			}
		}
	}
	
	
	
	public function showAdminEditPedido(Request $request)
    {
		if($request->input('asunto') == 'editarMensajero'){
			$pedido = DB::table('Pedido')->where('id', '=', $request->input('idPedido'))->update(array('usuarioID' => $request->input('idMensajero')));
			
			if($pedido == true){
				return redirect()->action('AdminLocalidad\HomeController@showAdminPedido', array('editado' => 'success','#'.$request->input('idPedido')));
			}else{
				return redirect()->action('AdminLocalidad\HomeController@showAdminPedido', array('editado' => 'error'));
			}
		}	
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
				//$cID = $request->input('clienteID');
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
			$pedido->timestamp_time = Carbon::now()->timestamp;
			//$pedido->email = $request->input('email');
			//$pedido->total = $request->input('total');
			$pedido->save();
			
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
}