<?php

namespace SmartDelivery\Http\Controllers\API\v1;

use SmartDelivery\Models\Cuenta;
use SmartDelivery\Models\Usuario;


use SmartDelivery\Models\OrdenOrigen;
use Illuminate\Http\Request;
use SmartDelivery\Http\Requests;
use SmartDelivery\Http\Controllers\Controller;

use Storage;
use Validator;
use Auth;
use DB;
use Input;
use Response;

class OrdenOrigenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth.basic',['only'=>['update']]);
    }


    public function index()
    {
       $ordenesorigen = OrdenOrigen::all();
       return response()->json(['status'=>'ok','data'=>$ordenesorigen], 200);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
		
		function generaLogs($usuario,$accion,$origen){
			//Definimos la hora de la accion
			$hora=str_pad(date("Y-m-d H:i:s"),10," "); //hhmmss;
			//Definimos el contenido de cada registro de accion por usuario.
			$usuario=strtolower(str_pad($usuario,15," "));
			$accion=strtolower(str_pad($accion,50," "));
			$cadena=$hora." - ".$usuario." - ".$accion." - ".$origen;
			//Creamos dinamicamente el nombre del archivo por dia
			$pre=Input::get('cuentaid')."_ordenesorigen_";
			$date=date("YmdHis"); //aammddhhmmss
			$fileName=$pre.$date;
			
			if(Storage::disk('local')->has(Input::get('cuentaid').'_ordenorigen.log')){
				if(Storage::size(Input::get('cuentaid').'_ordenorigen.log') < 5000000){
					Storage::append(Input::get('cuentaid').'_ordenorigen.log', $cadena);
				}else{
					Storage::move(Input::get('cuentaid').'_ordenorigen.log', $fileName.'.log');
					
					Storage::disk('local')->put(Input::get('cuentaid').'_ordenorigen.log', '//*Logs***********************************************************************');
					Storage::append(Input::get('cuentaid').'_ordenorigen.log', $cadena);
				}
			}else{
				Storage::disk('local')->put(Input::get('cuentaid').'_ordenorigen.log', '//*Logs***********************************************************************');
				Storage::append(Input::get('cuentaid').'_ordenorigen.log', $cadena);
			}
		}//end generaLogs function
		
		// validate the info, create rules for the inputs
		$rules = array(
			'cuentaid'    => 'required',
			'user'    	=> 'required',
			'pass' 		=> 'required|alphaNum|min:6'
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			
			$usuario = Input::get('user');
			$accion = "No se han podido verificar los datos de la cuenta";
			
			$accion .= "\n	 orden: ".Input::get('ordenid');
			$accion .= "\n 	tipo ident.: ".Input::get('tip_iden');
			$accion .= "\n 	identificacion: ".Input::get('identificacion');
			$accion .= "\n 	cliente: ".Input::get('cliente');
			$accion .= "\n 	telefono: ".Input::get('telefono');
			$accion .= "\n 	mail: ".Input::get('mail');
			$accion .= "\n 	sucursal: ".Input::get('sucursalid');
			$accion .= "\n 	subtotal: ".Input::get('subtotal');
			$accion .= "\n 	impuesto: ".Input::get('impuesto');
			$accion .= "\n 	total: ".Input::get('total');
			$accion .= "\n 	ciudad: ".Input::get('ciudad');
			$accion .= "\n 	pais: ".Input::get('pais');
			$accion .= "\n 	direccion: ".Input::get('direccion');
			$accion .= "\n 	estado: ".Input::get('estadopedido');
			$accion .= "\n 	cuenta: ".Input::get('cuentaid');
			$accion .= "\n 	usuario: ".Input::get('user');
			$accion .= "\n /*************************************************************************************************/";
			
			$origen = Input::get('cuentaid');
			generaLogs($usuario,$accion,$origen);
			return response()->json(['errors'=>array(['code'=>422,'message'=>'No se han podido verificar los datos de la cuenta.'])],422);
			//return false;
		} else {

			$cuenta = Cuenta::where('cuentaID','=',Input::get('cuentaid'))->firstOrFail();
		
			// create our user data for the authentication
			$userdata = array(
				'cuentaID'	=> $cuenta->id,
				'userID'    => Input::get('user'),
				'password'  => Input::get('pass'),
				//'localidadID'  => $cuenta->localidadID,
			);

			// attempt to do the login
			if (Auth::attempt($userdata)) {

				// validation successful!
				// redirect them to the secure section
				$user = Usuario::find(1);
				$usuario = Usuario::where('userID','=',Input::get('user'))->firstOrFail();
				$localidadID = $usuario->localidadID;
				$rolID = $usuario->rolID;
				// attempt to put localidadID into userdata authentication. It helps to filter information.
				$userdata2 = array(
					'localidadID'  => $cuenta->localidadID,
					'id'  => $user->id,
				);
				Auth::attempt($userdata2);
				
				if($localidadID == 0){
					
					$usuario = Input::get('user');
					$accion = "Ha enviado datos mediante el usuario admin";
					
					$accion .= "\n 	orden: ".Input::get('ordenid');
					$accion .= "\n 	tipo ident.: ".Input::get('tip_iden');
					$accion .= "\n 	identificacion: ".Input::get('identificacion');
					$accion .= "\n 	cliente: ".Input::get('cliente');
					$accion .= "\n 	telefono: ".Input::get('telefono');
					$accion .= "\n 	mail: ".Input::get('mail');
					$accion .= "\n 	sucursal: ".Input::get('sucursalid');
					$accion .= "\n 	subtotal: ".Input::get('subtotal');
					$accion .= "\n 	impuesto: ".Input::get('impuesto');
					$accion .= "\n 	total: ".Input::get('total');
					$accion .= "\n 	ciudad: ".Input::get('ciudad');
					$accion .= "\n 	pais: ".Input::get('pais');
					$accion .= "\n 	direccion: ".Input::get('direccion');
					$accion .= "\n 	estado: ".Input::get('estadopedido');
					$accion .= "\n 	cuenta: ".Input::get('cuentaid');
					$accion .= "\n 	usuario: ".Input::get('user');
					$accion .= "\n /*************************************************************************************************/";
					
					$origen = Input::get('cuentaid');
					generaLogs($usuario,$accion,$origen);
					return response()->json(['errors'=>array(['code'=>422,'message'=>'Ha enviado datos mediante el usuario admin.'])],422);
					//return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
					//return redirect()->action('Admin\HomeController@showAdmin');
					//return view('admin.dashboard');
				}else{
					if($rolID == 4){
						
						// Primero comprobaremos si estamos recibiendo todos los campos.
						if (!$request->input('ordenid') || !$request->input('tip_iden') || !$request->input('identificacion') || !$request->input('cliente') || !$request->input('telefono') || !$request->input('sucursalid') || !$request->input('subtotal') || !$request->input('impuesto') || !$request->input('total') || !$request->input('ciudad') || !$request->input('pais') || !$request->input('direccion'))
						{
							//return response()->json(['errors'=>array(['code'=>422,'message'=>'Faltan datos necesarios para el proceso de alta.'])],422);
						}
						//Condicion para el listado de cuentas
						$where_args0 = array(
							'cuentaid' => Input::get('cuentaid'),
							'sucursalid' => Input::get('sucursalid'),
							'ordenid' => Input::get('ordenid')
						);
						
						//Consulta los datos de una cuenta especifica
						$ordenesorigenfound = DB::table('orden_origen')
									->select('*')
									->where($where_args0)
									->get();
						//$ordenesorigenfound=OrdenOrigen::where('ordenid','=',Input::get('ordenid'))->get();
						
						if(!$ordenesorigenfound){
							// Insertamos una fila en Fabricante con create pasándole todos los datos recibidos.
							// En $request->all() tendremos todos los campos del formulario recibidos.
							$ordenesorigen=OrdenOrigen::create($request->all());
						
						// Más información sobre respuestas en http://jsonapi.org/format/
						// Devolvemos el código HTTP 201 Created – [Creada] Respuesta a un POST que resulta en una creación. Debería ser combinado con un encabezado Location, apuntando a la ubicación del nuevo recurso.
							$response = Response::make(json_encode(['data'=>$ordenesorigen]), 201)->header('Location', 'http://www.octagonoerp.com/SmartDelivery/'.$ordenesorigen->id)->header('Content-Type', 'application/json');
							return $response;
						}else{
							$usuario = Input::get('user');
							$accion = "Ha enviado un numero de orden existente";
							
							$accion .= "\n 	orden: ".Input::get('ordenid');
							$accion .= "\n 	tipo ident.: ".Input::get('tip_iden');
							$accion .= "\n 	identificacion: ".Input::get('identificacion');
							$accion .= "\n 	cliente: ".Input::get('cliente');
							$accion .= "\n 	telefono: ".Input::get('telefono');
							$accion .= "\n 	mail: ".Input::get('mail');
							$accion .= "\n 	sucursal: ".Input::get('sucursalid');
							$accion .= "\n 	subtotal: ".Input::get('subtotal');
							$accion .= "\n 	impuesto: ".Input::get('impuesto');
							$accion .= "\n 	total: ".Input::get('total');
							$accion .= "\n 	ciudad: ".Input::get('ciudad');
							$accion .= "\n 	pais: ".Input::get('pais');
							$accion .= "\n 	direccion: ".Input::get('direccion');
							$accion .= "\n 	estado: ".Input::get('estadopedido');
							$accion .= "\n 	cuenta: ".Input::get('cuentaid');
							$accion .= "\n 	usuario: ".Input::get('user');
							$accion .= "\n /*************************************************************************************************/";
							
							$origen = Input::get('cuentaid');
							generaLogs($usuario,$accion,$origen);
							return response()->json(['errors'=>array(['code'=>422,'message'=>'Ha enviado un numero de orden existente.'])],422);
						}
					}elseif($rolID == 3){
						$usuario = Input::get('user');
						$accion = "Ha enviado datos mediante el usuario operador";
						
						$accion .= "\n 	orden: ".Input::get('ordenid');
						$accion .= "\n 	tipo ident.: ".Input::get('tip_iden');
						$accion .= "\n 	identificacion: ".Input::get('identificacion');
						$accion .= "\n 	cliente: ".Input::get('cliente');
						$accion .= "\n 	telefono: ".Input::get('telefono');
						$accion .= "\n 	mail: ".Input::get('mail');
						$accion .= "\n 	sucursal: ".Input::get('sucursalid');
						$accion .= "\n 	subtotal: ".Input::get('subtotal');
						$accion .= "\n 	impuesto: ".Input::get('impuesto');
						$accion .= "\n 	total: ".Input::get('total');
						$accion .= "\n 	ciudad: ".Input::get('ciudad');
						$accion .= "\n 	pais: ".Input::get('pais');
						$accion .= "\n 	direccion: ".Input::get('direccion');
						$accion .= "\n 	estado: ".Input::get('estadopedido');
						$accion .= "\n 	cuenta: ".Input::get('cuentaid');
						$accion .= "\n 	usuario: ".Input::get('user');
						$accion .= "\n /*************************************************************************************************/";

						
						$origen = Input::get('cuentaid');
						generaLogs($usuario,$accion,$origen);
						return response()->json(['errors'=>array(['code'=>422,'message'=>'Ha enviado datos mediante el usuario operador.'])],422);
					}elseif($rolID == 2){
						$usuario = Input::get('user');
						$accion = "Ha enviado datos mediante el usuario mensajero";
						
						$accion .= "\n 	orden: ".Input::get('ordenid');
						$accion .= "\n 	tipo ident.: ".Input::get('tip_iden');
						$accion .= "\n 	identificacion: ".Input::get('identificacion');
						$accion .= "\n 	cliente: ".Input::get('cliente');
						$accion .= "\n 	telefono: ".Input::get('telefono');
						$accion .= "\n 	mail: ".Input::get('mail');
						$accion .= "\n 	sucursal: ".Input::get('sucursalid');
						$accion .= "\n 	subtotal: ".Input::get('subtotal');
						$accion .= "\n 	impuesto: ".Input::get('impuesto');
						$accion .= "\n 	total: ".Input::get('total');
						$accion .= "\n 	ciudad: ".Input::get('ciudad');
						$accion .= "\n 	pais: ".Input::get('pais');
						$accion .= "\n 	direccion: ".Input::get('direccion');
						$accion .= "\n 	estado: ".Input::get('estadopedido');
						$accion .= "\n 	cuenta: ".Input::get('cuentaid');
						$accion .= "\n 	usuario: ".Input::get('user');
						$accion .= "\n /*************************************************************************************************/";
						
						$origen = Input::get('cuentaid');
						generaLogs($usuario,$accion,$origen);
						return response()->json(['errors'=>array(['code'=>422,'message'=>'Ha enviado datos mediante el usuario mensajero.'])],422);
					}
				}
			} else {        
				$usuario = Input::get('user');
				$accion = "Error de verificacion. Usuario o clave erroneo";
				$accion .= "\n 	orden: ".Input::get('ordenid');
				$accion .= "\n 	tipo ident.: ".Input::get('tip_iden');
				$accion .= "\n 	identificacion: ".Input::get('identificacion');
				$accion .= "\n 	cliente: ".Input::get('cliente');
				$accion .= "\n 	telefono: ".Input::get('telefono');
				$accion .= "\n 	mail: ".Input::get('mail');
				$accion .= "\n 	sucursal: ".Input::get('sucursalid');
				$accion .= "\n 	subtotal: ".Input::get('subtotal');
				$accion .= "\n 	impuesto: ".Input::get('impuesto');
				$accion .= "\n 	total: ".Input::get('total');
				$accion .= "\n 	ciudad: ".Input::get('ciudad');
				$accion .= "\n 	pais: ".Input::get('pais');
				$accion .= "\n 	direccion: ".Input::get('direccion');
				$accion .= "\n 	estado: ".Input::get('estadopedido');
				$accion .= "\n 	cuenta: ".Input::get('cuentaid');
				$accion .= "\n 	usuario: ".Input::get('user');
				$accion .= "\n /*************************************************************************************************/";
				
				$origen = Input::get('cuentaid');
				generaLogs($usuario,$accion,$origen);
				return response()->json(['errors'=>array(['code'=>422,'message'=>'Error de verificacion. Usuario o clave erroneo.'])],422);
				//return false;
			}
			//return false;
		}



 

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $ordenesorigen=OrdenOrigen::find($id);
        if (!$ordenesorigen)
        {
            return response()->json(['errors'=>array(['code'=>404,'message'=>'No se encuentra  ese codigo.'])],404);
        }
 
        return response()->json(['status'=>'ok','data'=>$ordenesorigen],200);
    }

}
