<?php

namespace SmartDelivery\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
// use Illuminate\Contracts\Validation\Validator;

use SmartDelivery\Models\Cuenta;
use SmartDelivery\Models\Usuario;

use Validator;
use View;
use Auth;
use DB;
use Input;
use Redirect;

class HomeController extends BaseController {


	public function showIndex()
	{
		if (Auth::guest())
		{
			//Condicion para el listado de mensajeros		
			$where_args3 = array(
				///'Usuario.localidadID' => Auth::user()->localidadID,
				// 'Usuario.cuentaID' => 'lincoln',
				'Usuario.rolID'		=> 6
			);
			$where_args4 = array(
				///'Usuario.localidadID' => Auth::user()->localidadID,
				 //'Usuario.cuentaID' => 3,
				'Usuario.rolID'		=> 4
			);
			$where_args5 = array(
				///'Usuario.localidadID' => Auth::user()->localidadID,
				 //'Usuario.cuentaID' => 3,
				'Usuario.rolID'		=> 1
			);
			
			//Consulta los mensajeros de una cuenta especifica
			$cajeros = DB::table('Usuario')
						->select('*')
						->where($where_args3)
						->orWhere($where_args4)
						->get();
			
			return view('login', compact('cajeros'));
		}else{
			//Redirecting user if necesary
			//return $this->redirectUser();
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
			if($data_user[0]->rolID== 1){
				return redirect()->action('Admin\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 5){
				return redirect()->action('AdminCallcenter\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 6){
				return redirect()->action('AdminCajero\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 4){
				return redirect()->action('AdminLocalidad\HomeController@showAdmin');
			}elseif($data_user[0]->rolID == 3){
				return redirect()->action('AdminOperador\HomeController@showAdmin');
			}
		}
	}

	public function postAuthenticate()
	{
		// validate the info, create rules for the inputs
		$rules = array(
			'cuenta'    => 'required',
			'user'    	=> 'required',
			'pass' 		=> 'required|alphaNum|min:6'
		);

		// run the validation rules on the inputs from the form
		$validator = Validator::make(Input::all(), $rules);

		// if the validator fails, redirect back to the form
		if ($validator->fails()) {
			return Redirect::to('/')
			->withInput(Input::except('password'))
			->with('error', 'Error en los campos del formulario.');
			
		} else {

			$cuenta = Cuenta::where('cuentaID','=',Input::get('cuenta'))->firstOrFail();
		
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
					return redirect()->action('Admin\HomeController@showAdmin');
					//return view('admin.dashboard');
				}else{
					if($rolID == 4){
						return redirect()->action('AdminLocalidad\HomeController@showAdmin');
					}elseif($rolID == 3){
						return redirect()->action('AdminOperador\HomeController@showAdmin');
						//return view('operador.dashboard');
						//return redirect()->action('Operador\HomeController@showIndex');
						//return redirect()->action('Operador\operadorController@showIndex');
						//return redirect()->action('AdminLocalidad\HomeController@showAdmin');
					}elseif($rolID == 6){
						return redirect()->action('AdminCajero\HomeController@showAdmin');
					}
				}
				
				
			

			} else {        

				return Redirect::to('/')
					->withInput(Input::except('password'))
					->with('error', 'Usuario no existe o credenciales incorrectos.');
			}

		}
	}
	
	public function postLogout()
	{
		
		Auth::logout();
		return Redirect::to('/');
		
	}
	
	
	public function missingMethod($parameters = Array())
	{
		abort(404);
	}
}