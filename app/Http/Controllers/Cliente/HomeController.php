<?php

namespace SmartDelivery\Http\Controllers\Operador;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;


use SmartDelivery\Models\Cliente;
use SmartDelivery\Models\DireccionCliente;
use SmartDelivery\Models\Usuario;
use SmartDelivery\Models\Pais;
use SmartDelivery\Models\Sector;
use SmartDelivery\Models\Ciudad;
use SmartDelivery\Models\Pedido;

use View;
use Auth;
use DB;

class HomeController extends BaseController {
	
	// Show panel to consult older
	public function showConsultOrder()
	{
		return view('cliente.consultorder');
	}	


}