<?php

namespace SmartDelivery\Http\Controllers\Admin;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use SmartDelivery\Models\Localidad;
use SmartDelivery\Models\Usuario;

use View;
use Auth;
use DB;
use Mail;

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
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuanta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					//->join('Usuario as U','Localidad.id','=','U.localidadID')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			'Usuario.cuentaID' => Auth::user()->cuentaID,
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
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuanta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
					
        return view('admin.dashboard', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
    }

	
	public function showAdminConfigCuenta()
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
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admin.configCuenta', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
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
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admin.usuario', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
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
		if($data_user[0]->rolID != 1){
			if($data_user[0]->rolID== 1){
				return redirect()->action('Admin\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 5){
				return redirect()->action('AdminCallcenter\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 4){
				return redirect()->action('AdminLocalidad\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 3){
				return redirect()->action('AdminOperador\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 6){
				return redirect()->action('AdminCajero\HomeController@showAdminDashboardPos');
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
			//'Localidad.id' => Auth::user()->localidadID,
			'Localidad.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta las sucursales de una cuenta especifica
		$sucursales = DB::table('Localidad')
					->select('*')
					->where($where_args)
					->get();
		
		//Condicion para el listado de operadores
		$where_args2 = array(
			//'Usuario.localidadID' => Auth::user()->localidadID,
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
			//'Usuario.localidadID' => Auth::user()->localidadID,
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
			//'Orden.localidadID' => Auth::user()->localidadID,
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
        return view('admin.cajero', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
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
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admin.mensajero', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
        
    }

	
	public function showAdminGerente()
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
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 2
			//'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		//Condicion para el listado de mensajeros		
		$where_args3 = array(
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 4
			//'Usuario.activo'  	=> 1
		);
		
        //Consulta los mensajeros de una cuenta especifica
		$gerentes = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
					
		//Condicion para el listado de ordenes		
		$where_args4 = array(
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admin.gerente', compact('cuentas','sucursales','usuarios','mensajeros','gerentes','ordenes','pedidos'));
        
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
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->get();
		
		//Aqui es donde despacho toda la data a la vista sucursal de la sesion admin
        return view('admin.sucursal', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos'));
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
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
					->select('*')
					->where($where_args5)
					->orderBy('created_at','desc')
					->get();
					
		//Condicion para el listado de pedidos		
		$where_args6 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidosPendientes = DB::table('Pedido')
					->select('*')
					->where($where_args6)
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
        return view('admin.pedido', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes','direcciones','estado_pedidos','pedidosPendientes'));
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
			////**'Localidad.id' => Auth::user()->localidadID,
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
			////**'Usuario.localidadID' => Auth::user()->localidadID,
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
			////**'Usuario.localidadID' => Auth::user()->localidadID,
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
			////**'Pedido.localidadID' => Auth::user()->localidadID,
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
			////**'Pedido.localidadID' => Auth::user()->localidadID,
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
        return view('admin.ordenes', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes','direcciones','estado_pedidos','pedidosPendientes'));
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
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
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
        return view('admin.localizarPedido', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes','direcciones','estado_pedidos'));
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
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
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
        return view('admin.localizarMensajero', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes','direcciones','estado_pedidos'));
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
			'Orden.cuentaID' => Auth::user()->cuentaID
		);
		
        //Consulta los ordenes de una cuenta especifica
		$ordenes = DB::table('Orden')
					->select('*')
					->where($where_args4)
					->get();
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			'Pedido.cuentaID' => Auth::user()->cuentaID,
			'Pedido.estadoPedidoID' => 1
		);
		
        //Consulta los pedidos de una cuenta especifica
		$pedidos = DB::table('Pedido')
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
        return view('admin.report', compact('cuentas','sucursales','usuarios','mensajeros','ordenes','pedidos','clientes'));
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
			//'Localidad.id' => Auth::user()->localidadID,
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
			//'Usuario.localidadID' => Auth::user()->localidadID,
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
			//'Usuario.localidadID' => Auth::user()->localidadID,
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
			//'Pedido.localidadID' => Auth::user()->localidadID,
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
        return view('admin.reportPedidoMensajero', compact('cuentas','sucursales','usuarios','mensajeros','pedidos','clientes'));
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
			//'Localidad.id' => $request->input('sucursal'),
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
			//'Usuario.localidadID' => $request->input('sucursal'),
			'Usuario.cuentaID' => Auth::user()->cuentaID,
			'Usuario.rolID'		=> 3,
			'Usuario.activo'  	=> 1
		);
		
        //Consulta los operadores de una cuenta especifica
		$usuarios = DB::table('Usuario')
					->select('*')
					->where($where_args2)
					->get();
		
		if($request->input('sucursal') != ''){
			//Condicion para el listado de mensajeros		
			$where_args3 = array(
				'Usuario.localidadID' => $request->input('sucursal'),
				'Usuario.cuentaID' => Auth::user()->cuentaID,
				'Usuario.rolID'		=> 2,
				'Usuario.activo'  	=> 1
			);
		}else{
			$where_args3 = array(
				//'Usuario.localidadID' => $request->input('sucursal'),
				'Usuario.cuentaID' => Auth::user()->cuentaID,
				'Usuario.rolID'		=> 2,
				'Usuario.activo'  	=> 1
			);

		}
		
        //Consulta los mensajeros de una cuenta especifica
		$mensajeros = DB::table('Usuario')
					->select('*')
					->where($where_args3)
					->get();
		
		if($request->input('sucursal') != ''){
			//Condicion para el listado de pedidos		
			$where_args5 = array(
				'Pedido.localidadID' => $request->input('sucursal'),
				'Pedido.cuentaID' => Auth::user()->cuentaID
			);
		}else{
			//Condicion para el listado de pedidos		
			$where_args5 = array(
				//'Pedido.localidadID' => $request->input('sucursal'),
				'Pedido.cuentaID' => Auth::user()->cuentaID
			);
		}
		
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
        return view('admin.reportPedidoMensajero', compact('cuentas','sucursales','usuarios','mensajeros','pedidos','clientes'), array('desde' => $request->input('desde'),'hasta' => $request->input('hasta')));
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
			///'Localidad.id' => Auth::user()->localidadID,
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
			///'Usuario.localidadID' => Auth::user()->localidadID,
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
			///'Usuario.localidadID' => Auth::user()->localidadID,
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
			///'Pedido.localidadID' => Auth::user()->localidadID,
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
        return view('admin.reportPedidoMensajeroDetalle', compact('cuentas','sucursales','usuarios','mensajeros','pedidos','clientes','direcciones'), array('desde' => $request->input('desde'),'hasta' => $request->input('hasta')));
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
			///'Localidad.id' => Auth::user()->localidadID,
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
			///'Usuario.localidadID' => Auth::user()->localidadID,
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
			///'Usuario.localidadID' => Auth::user()->localidadID,
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
			 $hasta = $request->input('hasta'); 
		}
		/**********************************/
		
		//Condicion para el listado de pedidos		
		$where_args5 = array(
			///'Pedido.localidadID' => Auth::user()->localidadID,
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
        return view('admin.reportPedido', compact('cuentas','sucursales','usuarios','mensajeros','pedidos','clientes','direcciones'), array('desde' => $request->input('desde'),'hasta' => $request->input('hasta')));
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
			$localidadID = $sucursal->id;
			
			//Inmediatamente creara un usuario administrador para dicha sucursal
			$administrador = new Usuario();
			$administrador->cuentaID = Auth::user()->cuentaID;
			$administrador->localidadID = $localidadID;
			$administrador->userID = $request->input('nombreSucursal');
			$administrador->password = Hash::make('123456789');
			$administrador->nombreUsuario = 'Administrador';
			//$administrador->telefonoUsuario = 0;
			$administrador->rolID = 4;
			$administrador->activo = 1;
			$administrador->EstatusActual = 0;
			$administrador->save();
			
			
			
			return redirect()->action('Admin\HomeController@showAdminSucursal', array('agregado' => 'success', '#'.$sucursal->id));
		}
		elseif($request->input('asunto') == 'eliminarSucursal'){
			$sucursal = DB::table('Localidad')->where('id', '=', $request->input('idSucursal'))->delete();
			
			if($sucursal == true){
				return redirect()->action('Admin\HomeController@showAdminSucursal', array('eliminado' => 'success'));
			}else{
				return redirect()->action('Admin\HomeController@showAdminSucursal', array('eliminado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarSucursal'){
			//$sucursal = DB::table('Localidad')->where('id', '=', $request->input('idSucursal'))->delete();
			$sucursal = DB::table('Localidad')->where('id', '=', $request->input('idSucursal'))->update(array('nombreLocalidad' => $request->input('nombreSucursal'),'nombreGerente' => $request->input('nombreGerente'),'direccionLocalidad' => $request->input('direccion'),'latitud' => $request->input('latitud'),'longitud' => $request->input('longitud')));
			
			if($sucursal == true){
				return redirect()->action('Admin\HomeController@showAdminSucursal', array('editado' => 'success','#'.$request->input('idSucursal')));
			}else{
				return redirect()->action('Admin\HomeController@showAdminSucursal', array('editado' => 'error'));
			}
		}
		
		
		
		
	}
	
	
	public function showAdminEditUsuario(Request $request)
    {
		if($request->input('asunto') == 'guardarUsuario'){
			try {
				$operador = new Usuario();
				$operador->cuentaID = Auth::user()->cuentaID;
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
				return redirect()->action('Admin\HomeController@showAdminUsuario', array('agregado' => 'success', '#'.$operador->id));
			}else{
				return redirect()->action('Admin\HomeController@showAdminUsuario', array('agregado' => 'error'));
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
				return redirect()->action('Admin\HomeController@showAdminUsuario', array('eliminado' => 'success'));
			}else{
				return redirect()->action('Admin\HomeController@showAdminUsuario', array('eliminado' => 'error'));
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
				return redirect()->action('Admin\HomeController@showAdminUsuario', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('Admin\HomeController@showAdminUsuario', array('editado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarUsuarioPassword'){
			
			$operador = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'password' => Hash::make($request->input('password'))
				)
			);
			
			if($operador == true){
				return redirect()->action('Admin\HomeController@showAdminUsuario', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('Admin\HomeController@showAdminUsuario', array('editado' => 'error'));
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
		if($data_user[0]->rolID != 1){
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
				return redirect()->action('Admin\HomeController@showAdminCajero', array('agregado' => 'success', '#'.$operador->id));
			}else{
				return redirect()->action('Admin\HomeController@showAdminCajero', array('agregado' => 'error'));
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
				return redirect()->action('Admin\HomeController@showAdminCajero', array('eliminado' => 'success'));
			}else{
				return redirect()->action('Admin\HomeController@showAdminCajero', array('eliminado' => 'error'));
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
				return redirect()->action('Admin\HomeController@showAdminCajero', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('Admin\HomeController@showAdminCajero', array('editado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarUsuarioPassword'){
			
			$operador = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'password' => Hash::make($request->input('password'))
				)
			);
			
			if($operador == true){
				return redirect()->action('Admin\HomeController@showAdminCajero', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('Admin\HomeController@showAdminCajero', array('editado' => 'error'));
			}
		}
		
		
		
	}
	
	
	public function showAdminEditMensajero(Request $request)
    {
		if($request->input('asunto') == 'guardarMensajero'){
			try {
				$mensajero = new Usuario();
				$mensajero->cuentaID = Auth::user()->cuentaID;
				$mensajero->localidadID = $request->input('localidadID');
				$mensajero->userID = $request->input('userID');
				$mensajero->password = Hash::make($request->input('password'));
				$mensajero->nombreUsuario = $request->input('nombreUsuario');
				$mensajero->telefonoUsuario = $request->input('telefonoUsuario');
				$mensajero->rolID = 2;
				$mensajero->activo = 1;
				$mensajero->EstatusActual = 1;
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
				return redirect()->action('Admin\HomeController@showAdminMensajero', array('agregado' => 'success', '#'.$mensajero->id));
			}else{
				return redirect()->action('Admin\HomeController@showAdminMensajero', array('agregado' => 'error'));
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
				return redirect()->action('Admin\HomeController@showAdminMensajero', array('eliminado' => 'success'));
			}else{
				return redirect()->action('Admin\HomeController@showAdminMensajero', array('eliminado' => 'error'));
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
				return redirect()->action('Admin\HomeController@showAdminMensajero', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('Admin\HomeController@showAdminMensajero', array('editado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarMensajeroPassword'){
			
			$mensajero = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'password' => Hash::make($request->input('password'))
				)
			);
			
			if($mensajero == true){
				return redirect()->action('Admin\HomeController@showAdminMensajero', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('Admin\HomeController@showAdminMensajero', array('editado' => 'error'));
			}
		}
		
		
		
		
	}
	
	
	public function showAdminEditGerente(Request $request)
    {
		if($request->input('asunto') == 'guardarGerente'){
			try {
				$gerente = new Usuario();
				$gerente->cuentaID = Auth::user()->cuentaID;
				$gerente->localidadID = $request->input('localidadID');
				$gerente->userID = $request->input('userID');
				$gerente->password = Hash::make($request->input('password'));
				$gerente->nombreUsuario = $request->input('nombreUsuario');
				$gerente->telefonoUsuario = $request->input('telefonoUsuario');
				$gerente->rolID = 4;
				$gerente->activo = 1;
				$gerente->EstatusActual = 1;
				$gerente->accessKey = 000000;
				$gerente->save();
			} catch (\Illuminate\Database\QueryException $e) {
                //dd($e);
				$gerente = false;
            } catch (\Illuminate\Database\Connection $e) {
                //dd($e);
				$gerente = false;
            } catch (PDOException $e) {
                //dd($e);
				$gerente = false;
            }
			
			if($gerente == true){
				return redirect()->action('Admin\HomeController@showAdminGerente', array('agregado' => 'success', '#'.$gerente->id));
			}else{
				return redirect()->action('Admin\HomeController@showAdminGerente', array('agregado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'eliminarGerente'){
			try {
				$gerente = DB::table('Usuario')->where('id', '=', $request->input('id'))->delete();
			} catch (\Illuminate\Database\QueryException $e) {
                //dd($e);
				$gerente = false;
            } catch (\Illuminate\Database\Connection $e) {
                //dd($e);
				$gerente = false;
            } catch (PDOException $e) {
                //dd($e);
				$gerente = false;
            }
			
			if($gerente == true){
				return redirect()->action('Admin\HomeController@showAdminGerente', array('eliminado' => 'success'));
			}else{
				return redirect()->action('Admin\HomeController@showAdminGerente', array('eliminado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarGerente'){
			
			$gerente = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'localidadID' => $request->input('localidadID'),
				'userID' => $request->input('userID'),
				'nombreUsuario' => $request->input('nombreUsuario'),
				'telefonoUsuario' => $request->input('telefonoUsuario')
				)
			);
			
			if($gerente == true){
				return redirect()->action('Admin\HomeController@showAdminGerente', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('Admin\HomeController@showAdminGerente', array('editado' => 'error'));
			}
		}
		elseif($request->input('asunto') == 'editarGerentePassword'){
			
			$gerente = DB::table('Usuario')->where('id', '=', $request->input('id'))
			->update(array(
				'password' => Hash::make($request->input('password'))
				)
			);
			
			if($gerente == true){
				return redirect()->action('Admin\HomeController@showAdminGerente', array('editado' => 'success','#'.$request->input('id')));
			}else{
				return redirect()->action('Admin\HomeController@showAdminGerente', array('editado' => 'error'));
			}
		}
		
		
		
		
	}
}