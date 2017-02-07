<?php

namespace SmartDelivery\Http\Controllers\API\v1;

use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

use SmartDelivery\Models\Cliente;
use SmartDelivery\Models\DireccionCliente;
use SmartDelivery\Models\PedidoUbicacion;
use SmartDelivery\Models\Usuario;
use SmartDelivery\Models\Pais;
use SmartDelivery\Models\Sector;
use SmartDelivery\Models\Pedido;
use SmartDelivery\Models\Ciudad;
use SmartDelivery\Models\UbicacionMensajero;



use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Request as Req;
use View;
use Auth;
use DB;
use Carbon\Carbon;
use Davibennun\LaravelPushNotification\Facades\PushNotification;

class RequestController extends BaseController {
	
	private function json_response($status, $status_message, $posts)
	{
		$json['status'] = $status;
		$json['status_message'] = $status_message;
		$json['posts'] = $posts;

		return response()->json($json);
	}

	/*
	*
	*
	*/
	public function fetch_client_by_phone($number)
	{
		$cliente = Cliente::where('telefonoCliente','=', $number)->get();
		
		if(count($cliente) != 0){
			
			//$direccion = DireccionCliente::where('clienteID','=', $cliente[0]->id)->get();	
			
			$direccion = DB::table('DireccionCliente')
				->select('*')
				->join('Cliente','DireccionCliente.clienteID','=','Cliente.id')
				->where('clienteID', '=', $cliente[0]->id)
				->get();

			if(count($direccion) > 0){
				$posts[] = array('data' => 'found');
			} else {
				$posts[] = array('data' => 'Ubication not found');
				
				$addDireccionCliente = new DireccionCliente;
				$addDireccionCliente->clienteID = $cliente[0]->id;
				$addDireccionCliente->posicionDefinitiva = 0;
				$addDireccionCliente->latitud = -0.191003;
				$addDireccionCliente->longitud = -78.486122;
				$addDireccionCliente->save();
				
				$direccion = DB::table('DireccionCliente')
					->select('*')
					->join('Cliente','DireccionCliente.clienteID','=','Cliente.id')
					->where('clienteID', '=', $cliente[0]->id)
					->get();
			}

			$posts[] =  array(
				'values'=> $direccion
			);

			return $this->json_response('200', 'successful', $posts);
		} else {
			
			$posts[] = array('data' => 'not found');
			
			return $this->json_response('400', 'error', $posts);
		}
	}

	/**
	 *
	 *
	 * @param $id
	 * @return mixed
	 */
	public function fetch_available_operators($id)
	{
		$where_args = array(
			'clienteID' => $id,
			'rolID'		=> 2,
			'activo'  	=> 1
		);

		$operadores = Usuario::where($where_args)->get();
		
		if(count($operadores) != 0){


			$posts[] = array('data' => 'found');

			$posts[] = array(
				'values'=> $operadores
			);

			return $this->json_response('200', 'successful', $posts);
		} else {
			$posts[] = array('data' => 'not found');
			return $this->json_response('400', 'error', $posts);
		}
	}


	/**
	 *
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function save_marker_position(Request $request)
	{
		$where_args = array(
			'clienteID' => $request->input('clienteID')
		);

		$direccion = DireccionCliente::where($where_args)->get();
		
		if(count($direccion) != 0){
			
			$posts[] = array('data' => 'found');
			
			/*
                        $reqPais = $request->input('pais');
                        $reqCiudad = $request->input('ciudad');
                        $reqSector = $request->input('sector');


                        // search & update paisID
                        $pais = Pais::where('nomrePais', 'LIKE', "%$reqPais%")->take(1)->get();

                        // if found, get id pass it to dir
                        if(count($pais) != 0){
                            $paisID = $pais[0]->id;
                        } else {
                            //if not found... do nothing or create?
                            $new_country = new Pais;
                            $new_country->nomrePais = $reqPais;
                            $new_country->save();

                            $paisID = $new_country->id;
                        }

                        // search sectorID
                        $sector = Sector::where('nombreSector', 'LIKE', "%$reqSector%")->take(1)->get();

                        // if found, get id pass it to dir
                        if(count($sector) != 0){
                            $sectorID = $sector[0]->id;
                        } else {
                            //if not found... do nothing or create?
                            $new_sector = new Sector;
                            $new_sector->nombreSector = $reqSector;
                            $new_sector->save();

                            $sectorID = $new_sector->id;
                        }

                        // search ciudadID

                        $ciudad = Ciudad::where('nombreCiudad', 'LIKE', "%$reqCiudad%")->take(1)->get();

                        // if found, get id pass it to dir
                        if(count($ciudad) != 0){
                            $cityID = $ciudad[0]->id;
                        } else {
                            //if not found... do nothing or create?
                            $new_city = new Ciudad;
                            $new_city->nombreCiudad = $reqCiudad;
                            $new_city->sectorID = $sectorID;
                            $new_city->save();

                            $cityID = $new_city->id;
                        }
                        */
			$dir =  DireccionCliente::find($direccion[0]->id);

			$dir->latitud = $request->input('latitud');
			$dir->longitud = $request->input('longitud');
			$dir->direccion = $request->input('direccion');
			/*
			if(isset($paisID)){
				$dir->paisID = $paisID;
			}
			if(isset($sectorID)){
				$dir->sectorID = $sectorID;
			}	
			if(isset($cityID)){
				$dir->ciudadID = $cityID;
			}
			*/
			$dir->save();

			$posts[] =  array(
				'values'=> $dir
			);

			return $this->json_response('200', 'successful', $posts);
		} else {

			$DireccionCliente = new DireccionCliente();
			$DireccionCliente->clienteID = $request->input('clienteID');
			$DireccionCliente->longitud = $request->input('longitud');
			$DireccionCliente->latitud = $request->input('latitud');
			$DireccionCliente->paisID = 1;
			$DireccionCliente->sectorID = 1;
			$DireccionCliente->ciudadID = 1;
			$DireccionCliente->provinciaID = 1;
			$DireccionCliente->save();


			$posts[] = array('data' => 'not found');
			return $this->json_response('400', 'error', $posts);
		}
	}


	/**
	 *
	 *
	 * @param Request $request
	 * @return mixed
	 */

	public function create_client(Request $request)
	{
		/*	$where_args = array(
                'telefonoCliente' => $request->input('telefono_cliente')
            );

            $cliente = Cliente::where($where_args)->get();

            if(count($cliente) != 0) {

                $posts[] = array('data' => 'already exists');

                $posts[] =  array(
                    'values'=> $cliente
                );

                return $this->json_response('200', 'successful', $posts);
            } else {

                $cliente = new Cliente;
                $cliente->telefonoCliente = $request->input('telefono_cliente');
                $cliente->save();

                $posts[] = array('data' => 'created');

                $posts[] =  array(
                    'values'=> $cliente
                );

                return $this->json_response('200', 'successful', $posts);
            }
            */
	}


	/**
	 *
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function postConsultOrder(Request $request)
	{
		$pedido = DB::table('Pedido')
			->select('Cliente.id as clienteID', 'Pedido.tracking_id', 'DireccionCliente.latitud','DireccionCliente.longitud','Pedido.timeCreated as timestamp')
			->join('Cliente','Pedido.clienteID', '=', 'Cliente.id')
			->join('DireccionCliente','Cliente.id', '=', 'DireccionCliente.clienteID')
			->where('Cliente.telefonoCliente', '=', $request->input('phone'))
			->orderBy('Pedido.created_at','desc')
			->take(1)
			->get();
		
		if(!empty($pedido[0]))
		{
			return $this->json_response('200', 'success', array('pedido' => $pedido));
		} else {
			return $this->json_response('200', 'error', array('status' => 'not found'));
		}
		
	}
	
	
	/**
	 *
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function postClientConsultOrder(Request $request)
	{
		$pedido = DB::table('Pedido')
			->select('Cliente.id as clienteID', 'Pedido.tracking_id', 'DireccionCliente.latitud','DireccionCliente.longitud','Pedido.timeCreated as timestamp')
			->join('Cliente','Pedido.clienteID', '=', 'Cliente.id')
			->join('DireccionCliente','Cliente.id', '=', 'DireccionCliente.clienteID')
			->where('Pedido.tracking_id', '=', $request->input('track'))
			->orderBy('Pedido.created_at','desc')
			->take(1)
			->get();
		
		if(!empty($pedido[0]))
		{
			return $this->json_response('200', 'success', array('pedido' => $pedido));
		} else {
			return $this->json_response('200', 'error', array('status' => 'not found'));
		}
		
	}





	/**
	 *
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function getNewLocation(Request $request)
	{
		$location = DB::table('PedidoUbicacion')
			->select('*')
			->where('PedidoUbicacion.pedidoID', '=', $request->input('tracking_id'))
			->orderBy('PedidoUbicacion.id','desc')
			->take(1)
			->get();
			
		$pedido = DB::table('Pedido')
			->select('*')
			->where('Pedido.tracking_id', '=', $request->input('tracking_id'))
			//->orderBy('PedidoUbicacion.id','desc')
			->take(1)
			->get();

		if(!empty($location[0]))
		{
			$posts[] =  array(
				'values'=>  $location
			);
			if(!empty($pedido[0]))
			{
				$posts[] =  array(
					'pedido'=>  $pedido
				);
			}else{
				$posts[] =  array(
					'pedido'=>  '0'
				);
			}
		} else {

			$posts[] =  array(
				'values'=>  'not found'
			);
		}

		return $this->json_response('200', 'successful', $posts);
	}


	/**
	 *
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function attemptLogin (Request $request)
	{
		try
		{
			// create our user data for the authentication
			$userdata = array(
				'userID'    => $request->input('username'),
				'password'  => $request->input('password'),
				'rolID'     => 2,
				'activo'    => 1
			);

			// attempt to do the login
			if (Auth::attempt($userdata)) {
				
				//Estatus actual del mensajero ahora es Activo
				$mensajero = DB::table('Usuario')->where('userID', '=', $request->input('username'))
					->update(array(
							'EstatusActual' => 0
						)
					);

				$posts[] = Auth::user();
			} else {

				$posts[] = array(
					'id' => 'not found'
				);
			}

			return $this->json_response('200', 'successful', $posts);
		}
		catch(\Illuminate\Database\QueryException $ex)
		{
			$posts[] = array(
				'status' => 'error',
				'exception' => $ex->getMessage()
			);

			return $this->json_response('500', 'Error', $posts);
		}
	}

    /**
     * @return mixed
     */
    public function attemptLogout(Request $request)
    {
        try
        {
            $json = Req::all();

            DB::table('Usuario')->where('id', '=', $json['id'])
                ->update(array(
                        'EstatusActual' => 3
                    )
                );

            $posts[] = array(
                'status' => 'successful'
            );

            return $this->json_response('200', 'successful', $posts);
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            $posts[] = array(
                'status' => 'error',
                'exception' => $ex->getMessage()
            );

            return $this->json_response('500', 'Query Error', $posts);
        }
        catch(Exception $ex)
        {
            $posts[] = array(
                'status' => 'error',
                'exception' => $ex->getMessage()
            );

            return $this->json_response('500', 'Error', $posts);
        }
    }



	/**
	 *
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function fetchOrders (Request $request)
	{
		try
		{
			$orders = DB::table('Pedido')
				->select('Pedido.*','DireccionCliente.direccion','DireccionCliente.latitud','DireccionCliente.longitud','Cliente.nombreCliente as nombre','Cliente.telefonoCliente as telefono')
				->join('DireccionCliente','Pedido.clienteID','=','DireccionCliente.clienteID')
				->join('Cliente','Pedido.clienteID','=','Cliente.id')
				->where('usuarioID', '=', $request->input('id'))
				->where('estadoPedidoID', '<>', 2)
				->orderBy('Pedido.created_at','asc')
				->get();

			if(!empty($orders[0]))
			{
				
				//Estatus actual del mensajero ahora es Ocupado
				$mensajero = DB::table('Usuario')->where('id', '=', $request->input('id'))
					->update(array(
							'EstatusActual' => 2
						)
					);
				
				/*$posts[] =  array(
                    'values'=>  $orders
                );*/
//                $posts[] =   $orders;
			} else {
				
				//Estatus actual del mensajero ahora es Activo
				$mensajero = DB::table('Usuario')->where('id', '=', $request->input('id'))
					->update(array(
							'EstatusActual' => 0
						)
					);

				$posts[] =  array(
					'values'=>  'not found'
				);
			}

			return $this->json_response('200', 'successful', $orders);
		}
		catch(\Illuminate\Database\QueryException $ex)
		{
			$posts[] = array(
				'status' => 'error',
				'exception' => $ex->getMessage()
			);
			return $this->json_response('500', 'Error', $posts);
		}
	}


	/**
	 *
	 *
	 * @param Request $request
	 * @return mixed
	 */
	public function postNewLocation(Request $request)
	{

		$longitud = 0;
		$latitud = 0;

		if($request->has('longitud'))
		{
			$longitud = $request->input('longitud');
		}
		if($request->has('latitud'))
		{
			$latitud = $request->input('latitud');
		}

		$location = new PedidoUbicacion();
		$location->pedidoID = $request->input('pedidoID');
		$location->longitud = $longitud;
		$location->latitud  = $latitud;
		$location->created_at = Carbon::now()->toDateTimeString();
		$location->save();
		
		$pedidos = Pedido::where('tracking_id','=',$request->input('pedidoID'))->firstOrFail();

		//Estatus actual del mensajero ahora es Ocupado
		/**/
		if($latitud != 0 && $longitud != 0){
			$usuarioID = $pedidos->usuarioID;
			$mensajero = DB::table('Usuario')->where('id', '=', $usuarioID)
				->update(array(
						'EstatusActual' => 2,
						'lastLat' => $latitud,
						'lastLong' => $longitud
					)
				);
		}else{
			$usuarioID = $pedidos->usuarioID;
			$mensajero = DB::table('Usuario')->where('id', '=', $usuarioID)
				->update(array(
						'EstatusActual' => 2
					)
				);
		}
		/******/



		if($request->has('def') && $request->input('def') == '1')
		{
			$defDirection = DireccionCliente::where('clienteID','=',$request->input('cliente'))->firstOrFail();
			$defDirection->longitud = $longitud;
			$defDirection->latitud = $latitud;
			$defDirection->posicionDefinitiva = 1;
			$defDirection->save();

			//$pedido = Pedido::where('tracking_id','=',$request->input('pedidoID'))->firstOrFail();
			//$pedido->estadoPedidoID = 2;
			//$pedido->save();
			
			$pedidos = Pedido::where('tracking_id','=',$request->input('pedidoID'))->firstOrFail();
			
			//Estatus actual del mensajero ahora es Ocupado
			/**/
			$usuarioID = $pedidos->usuarioID;
			$mensajero = DB::table('Usuario')->where('id', '=', $usuarioID)
				->update(array(
						'EstatusActual' => 2
					)
				);
			/******/
		}
		
		if($request->has('end'))
		{
			$pedido = Pedido::where('tracking_id','=',$request->input('pedidoID'))->firstOrFail();
			$pedido->estadoPedidoID = 2;
			$pedido->save();
			
			$pedidos = Pedido::where('tracking_id','=',$request->input('pedidoID'))->firstOrFail();
			
			
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
			/******/
		}

        //Condicion para el conteo de pedidos
        $where_args_extra = array(
            'estadoPedidoID' => 1,
            'usuarioID' => $usuarioID
        );

        //update all other orders
        /*
        $pedidos = Pedido::where('tracking_id','=',$request->input('pedidoID'))->firstOrFail();
        $usuarioID = $pedidos->usuarioID;
        $peds = DB::table('Pedido')->select('*')->where($where_args_extra)->count();
    */

		$posts[] = array('data' => 'successful');
//
//        $posts[] =  array(
//            'values'=>  $location
//        );

		return $this->json_response('200', 'successful', $posts);

	}


	/**
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function saveGCMOperatorToken()
	{

		try {
			$json = Req::all();
			Log::info(Req::all());

			if (Usuario::where('id', '=', array_key_exists('id', $json) ? $json['id'] : "")->exists()) {

				$user = Usuario::where('id', '=', array_key_exists('id', $json) ? $json['id'] : "")->first();
				if (array_key_exists('gcm_registration_id', $json)) {
					$user->gcm_registration_id = array_key_exists('gcm_registration_id', $json) ?$json['gcm_registration_id'] : null;
				}
				$user->save();

				$posts[] = array(
					'status' => 'successful',
				);
			}
			else
			{
				$posts[] = array(
					'status' => 'not found',
				);
			}
			return $this->json_response('200', 'Success', $posts);
		}
		catch(QueryException $ex)
		{
			$posts[] = array(
				'status' => 'error',
				'exception' => $ex->getMessage()
			);
			return $this->json_response('400', 'Bad Request', $posts);
		}
	}
	


    public function saveImageFiles(Request $request)
    {
        try
        {
            $destinationPath = public_path() . "/images";

            if ($request->hasFile('photo')) {
                $photo = $request->file('photo');
                $photo->move($destinationPath, $request->input('descriptionCode') . '_' . $photo->getClientOriginalName());
                Log::info("photo moved");
            }

            if ($request->hasFile('signature')) {
                $signature = $request->file('signature');
                $signature->move($destinationPath, $request->input('descriptionCode') . '_' . $signature->getClientOriginalName());
                Log::info("signature moved");
            }

            Pedido::where('tracking_id','=',$request->input('descriptionCode'))
                ->update(
                    [
                        'image_path' => $request->hasFile('photo') ? "/public/images/" . $request->input('descriptionCode') .'_' . $photo->getClientOriginalName()  : null,
                        'signature_path' => $request->hasFile('signature') ? "/public/images/"  . $request->input('descriptionCode') .'_' . $signature->getClientOriginalName() : null,
                    ]
                );

            $pid = $request->input('descriptionCode');
            Log::info("pedido modified: $pid");

            $posts[] = array(
                'status' => 'successful',
            );

            Log::info($this->json_response('200', 'Success', $posts));
            return $this->json_response('200', 'Success', $posts);
        }
        catch (Exception $exception)
        {
            $posts[] = array(
                'status' => 'error',
                'exception' => $exception->getMessage()
            );
            return $this->json_response('400', 'Bad Request', $posts);
        }
    }


    /**
     * @return mixed
     */
    public function saveDeliveryLocation()
    {
        try
        {
            $json = Req::all();

            UbicacionMensajero::create(
                array(
                    'user_id' => array_key_exists('user_id', $json) ? $json['user_id'] : "0",
                    'longitude' => array_key_exists('longitude', $json) ? $json['longitude'] : "0",
                    'latitude' => array_key_exists('latitude', $json) ? $json['latitude'] : "0",
                    'created_at' => Carbon::now()
                )
            );

            // get all pedidos from user

            $pedidos = Pedido::where('usuarioID', $json['user_id'])
                ->where('estadoPedidoID','<>','2')
                ->get();

            if(count($pedidos) > 0){
                foreach($pedidos as $pedido) {
                    $location = new PedidoUbicacion();
                    $location->pedidoID = $pedido->tracking_id;
                    $location->longitud = $json['longitude'];
                    $location->latitud  = $json['latitude'];
                    $location->created_at = Carbon::now()->toDateTimeString();
                    $location->save();
                }
            }

			/**
			*	Estas modificiones se han hecho para almacenar la ultima ubicacion en la tabla usuarios, 
			*	para asi evitar la carga excesiva de datos, asi como consultas complejas.
			*/
			$userid = array_key_exists('user_id', $json) ? $json['user_id'] : "0";
			$lastLat = array_key_exists('latitude', $json) ? $json['latitude'] : "0";
			$lastLong = array_key_exists('longitude', $json) ? $json['longitude'] : "0";
			
			$mensajero = DB::table('Usuario')->where('id', '=', $userid)
			->update(array(
                //'EstatusActual' => 2,
				'lastLat' => $lastLat,
				'lastLong' => $lastLong
				)
			);

            $posts[] = array(
                'status' => 'successful',
            );

            return $this->json_response('200', 'Success', $posts);
        }
        catch (Exception $exception)
        {
            $posts[] = array(
                'status' => 'error',
                'exception' => $exception->getMessage()
            );
            return $this->json_response('400', 'Bad Request', $posts);
        }
    }



	public function sendPushNotification(Request $request)
	{


        $from =  Carbon::parse($request->input('desde'));

        $to =  Carbon::parse($request->input('hasta'))->addhours(23)->addMinutes(59)->addSeconds(59);


        return array('from'=> $from, 'to'=> $to);
	}

	
	
	
	
}