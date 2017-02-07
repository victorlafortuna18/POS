<?php

/*
|--------------------------------------------------------------------------
| Comment Template
|--------------------------------------------------------------------------
|
|
*/


/*
|--------------------------------------------------------------------------
| Application's Main Routes
|--------------------------------------------------------------------------
|
| Aqui estan definidas las vistas principales de cada entidad del
| sistema de SmartDelivery
*/

Route::get('/', 'HomeController@showIndex');
Route::post('try', 'HomeController@postAuthenticate'); 
Route::get('logout', 'HomeController@postLogout');

Route::get('error', function(){ 
    abort(500);
});
/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Aqui se registraran todas las vistas que puede usar el administrador.
| Deben ser declaradas dentro del middleware para proveer acceso
| solo a aquellos que hayan pasado por el proceso de auth.
|
| Esta grupo de rutas funciona de la siguiente manera:
| Captura todos los request HTTP con prefijo admin, luego valida si la session
| esta iniciada correctamente y luego redirige al contenido requerido.
|
| Ejemplo:  "/admin/index"
|
| TL;DR Agrupa por ruta comenzando con "/admin" y que esté autenticado
*/

Route::group(['prefix' => 'admin'], function () {

	Route::group(['middleware' => 'auth'], function () {

		Route::get('dashboard','Admin\HomeController@showAdmin');
		Route::get('usuario','Admin\HomeController@showAdminUsuario');
		Route::get('mensajero','Admin\HomeController@showAdminMensajero');
		Route::get('gerente','Admin\HomeController@showAdminGerente');
		Route::get('cajero','Admin\HomeController@showAdminCajero');
		Route::get('sucursal','Admin\HomeController@showAdminSucursal');
		Route::get('pedido','Admin\HomeController@showAdminPedido');
		Route::get('ordenes','Admin\HomeController@showAdminOrdenes');
		Route::get('localizarMensajero','Admin\HomeController@showAdminLocalizarMensajero');
		Route::get('localizarPedido','Admin\HomeController@showAdminLocalizarPedido');
		Route::get('reportes','Admin\HomeController@showAdminReportes');
		Route::get('configuracionCuenta','Admin\HomeController@showAdminConfigCuenta');
		
		Route::get('consultorder/{tracking_id}','Operador\operadorController@showAdminConsultOrder');
		
		Route::group(['prefix' => 'reporte'], function () {
			Route::get('pedidoMensajero','Admin\HomeController@showAdminReportePedidoMensajero');
			
			//Search functions 
			Route::post('pedidoMensajero','Admin\HomeController@showAdminReportePedidoMensajeroSearch');
			Route::get('pedidoMensajeroDetalle/{idMensajero}','Admin\HomeController@showAdminReportePedidoMensajeroDetalle');
			Route::post('pedidoMensajeroDetalle/{idMensajero}','Admin\HomeController@showAdminReportePedidoMensajeroDetalle');
			
			Route::get('pedido','Admin\HomeController@showAdminReportePedido');
			Route::post('pedido','Admin\HomeController@showAdminReportePedido');
		});
		
		//Edit functions by post
		Route::post('sucursal','Admin\HomeController@showAdminEditSucursal');
		Route::post('usuario','Admin\HomeController@showAdminEditUsuario');
		Route::post('mensajero','Admin\HomeController@showAdminEditMensajero');
		Route::post('gerente','Admin\HomeController@showAdminEditGerente');
		Route::post('cajero','Admin\HomeController@showAdminEditCajero');
		Route::post('pedido','Admin\HomeController@showAdminEditPedido');
		
	});

});


Route::group(['prefix' => 'adminlocalidad'], function () {

	Route::group(['middleware' => 'auth'], function () {

		Route::get('dashboard','AdminLocalidad\HomeController@showAdmin');
		Route::get('usuario','AdminLocalidad\HomeController@showAdminUsuario');
		Route::get('mensajero','AdminLocalidad\HomeController@showAdminMensajero');
		Route::get('cajero','AdminLocalidad\HomeController@showAdminCajero');
		Route::get('sucursal','AdminLocalidad\HomeController@showAdminSucursal');
		Route::get('pedido','AdminLocalidad\HomeController@showAdminPedido');
		Route::get('ordenes','AdminLocalidad\HomeController@showAdminOrdenes');
		Route::get('localizarMensajero','AdminLocalidad\HomeController@showAdminLocalizarMensajero');
		Route::get('localizarPedido','AdminLocalidad\HomeController@showAdminLocalizarPedido');
		Route::get('reportes','AdminLocalidad\HomeController@showAdminReportes');
		
		/*
		** POS - Routes
		*************************************************************************************************/
			Route::get('POS','AdminPOS\HomeController@showAdminPos');
			Route::get('admcaja','AdminPOS\HomeController@showAdminAdmCaja');
			
			
		/************************************************************************************************/
		
		Route::get('consultorder/{tracking_id}','Operador\operadorController@showAdminLocalidadConsultOrder');
		
		Route::group(['prefix' => 'reporte'], function () {
			Route::get('pedidoMensajero','AdminLocalidad\HomeController@showAdminReportePedidoMensajero');
			
			//Search functions 
			Route::post('pedidoMensajero','AdminLocalidad\HomeController@showAdminReportePedidoMensajeroSearch');
			Route::get('pedidoMensajeroDetalle/{idMensajero}','AdminLocalidad\HomeController@showAdminReportePedidoMensajeroDetalle');
			Route::post('pedidoMensajeroDetalle/{idMensajero}','AdminLocalidad\HomeController@showAdminReportePedidoMensajeroDetalle');
			
			Route::get('pedido','AdminLocalidad\HomeController@showAdminReportePedido');
			Route::post('pedido','AdminLocalidad\HomeController@showAdminReportePedido');
			
			//* POS Reports **
			//****************
			Route::get('sesion','AdminLocalidad\HomeController@showAdminReporteSesion');
			Route::post('sesion','AdminLocalidad\HomeController@showAdminReporteSesion');
			
			Route::get('factura/{idsesion}','AdminLocalidad\HomeController@showAdminReporteFactura');
			Route::post('factura/{idsesion}','AdminLocalidad\HomeController@showAdminReporteFactura');
		});
		
		//Edit functions by post
		Route::post('sucursal','AdminLocalidad\HomeController@showAdminEditSucursal');
		Route::post('usuario','AdminLocalidad\HomeController@showAdminEditUsuario');
		Route::post('mensajero','AdminLocalidad\HomeController@showAdminEditMensajero');
		Route::post('cajero','AdminLocalidad\HomeController@showAdminEditCajero');
		Route::post('pedido','AdminLocalidad\HomeController@showAdminEditPedido');
		Route::post('ordenes','AdminLocalidad\HomeController@showAdminEditOrden');
	});

});


Route::group(['prefix' => 'admincajero'], function () {

	Route::group(['middleware' => 'auth'], function () {

		Route::get('dashboard','AdminCajero\HomeController@showAdmin');
		Route::get('usuario','AdminCajero\HomeController@showAdminUsuario');
		Route::get('mensajero','AdminCajero\HomeController@showAdminMensajero');
		Route::get('cajero','AdminCajero\HomeController@showAdminCajero');
		Route::get('sucursal','AdminCajero\HomeController@showAdminSucursal');
		Route::get('pedido','AdminCajero\HomeController@showAdminPedido');
		Route::get('ordenes','AdminCajero\HomeController@showAdminOrdenes');
		Route::get('localizarMensajero','AdminCajero\HomeController@showAdminLocalizarMensajero');
		Route::get('localizarPedido','AdminCajero\HomeController@showAdminLocalizarPedido');
		Route::get('reportes','AdminCajero\HomeController@showAdminReportes');
		
		/*
		** POS - Routes
		*************************************************************************************************/
			Route::get('POS','AdminPOS\HomeController@showAdminPos');
			Route::get('admcaja','AdminPOS\HomeController@showAdminAdmCaja');
			
			
		/************************************************************************************************/
		
		Route::get('consultorder/{tracking_id}','Operador\operadorController@showAdminLocalidadConsultOrder');
		
		Route::group(['prefix' => 'reporte'], function () {
			Route::get('pedidoMensajero','AdminCajero\HomeController@showAdminReportePedidoMensajero');
			
			//Search functions 
			Route::post('pedidoMensajero','AdminCajero\HomeController@showAdminReportePedidoMensajeroSearch');
			Route::get('pedidoMensajeroDetalle/{idMensajero}','AdminCajero\HomeController@showAdminReportePedidoMensajeroDetalle');
			Route::post('pedidoMensajeroDetalle/{idMensajero}','AdminCajero\HomeController@showAdminReportePedidoMensajeroDetalle');
			
			Route::get('pedido','AdminCajero\HomeController@showAdminReportePedido');
			Route::post('pedido','AdminCajero\HomeController@showAdminReportePedido');
			
			//* POS Reports **
			//****************
			Route::get('sesion','AdminCajero\HomeController@showAdminReporteSesion');
			Route::post('sesion','AdminCajero\HomeController@showAdminReporteSesion');
			
			Route::get('factura/{idsesion}','AdminCajero\HomeController@showAdminReporteFactura');
			Route::post('factura/{idsesion}','AdminCajero\HomeController@showAdminReporteFactura');
			
			Route::get('producto','AdminCajero\HomeController@showAdminReporteProducto');
			Route::post('producto','AdminCajero\HomeController@showAdminReporteProducto');
		});
		
		//Edit functions by post
		Route::post('sucursal','AdminCajero\HomeController@showAdminEditSucursal');
		Route::post('usuario','AdminCajero\HomeController@showAdminEditUsuario');
		Route::post('mensajero','AdminCajero\HomeController@showAdminEditMensajero');
		Route::post('cajero','AdminCajero\HomeController@showAdminEditCajero');
		Route::post('pedido','AdminCajero\HomeController@showAdminEditPedido');
		Route::post('ordenes','AdminCajero\HomeController@showAdminEditOrden');
	});

});



Route::group(['prefix' => 'adminoperador'], function () {

	Route::group(['middleware' => 'auth'], function () {

		Route::get('dashboard','AdminOperador\HomeController@showAdmin');
		Route::get('usuario','AdminOperador\HomeController@showAdminUsuario');
		Route::get('mensajero','AdminOperador\HomeController@showAdminMensajero');
		Route::get('sucursal','AdminOperador\HomeController@showAdminSucursal');
		Route::get('pedido','AdminOperador\HomeController@showAdminPedido');
		Route::get('ordenes','AdminOperador\HomeController@showAdminOrdenes');
		Route::get('localizarMensajero','AdminOperador\HomeController@showAdminLocalizarMensajero');
		Route::get('localizarPedido','AdminOperador\HomeController@showAdminLocalizarPedido');
		Route::get('reportes','AdminOperador\HomeController@showAdminReportes');
		
		Route::get('consultorder/{tracking_id}','Operador\operadorController@showOperadorConsultOrder');
		
		Route::group(['prefix' => 'reporte'], function () {
			Route::get('pedidoMensajero','AdminOperador\HomeController@showAdminReportePedidoMensajero');
			
			//Search functions 
			Route::post('pedidoMensajero','AdminOperador\HomeController@showAdminReportePedidoMensajeroSearch');
			Route::get('pedidoMensajeroDetalle/{idMensajero}','AdminOperador\HomeController@showAdminReportePedidoMensajeroDetalle');
			Route::post('pedidoMensajeroDetalle/{idMensajero}','AdminOperador\HomeController@showAdminReportePedidoMensajeroDetalle');
			
			Route::get('pedido','AdminOperador\HomeController@showAdminReportePedido');
			Route::post('pedido','AdminOperador\HomeController@showAdminReportePedido');
		});
		
		//Edit functions by post
		Route::post('sucursal','AdminOperador\HomeController@showAdminEditSucursal');
		Route::post('usuario','AdminOperador\HomeController@showAdminEditUsuario');
		Route::post('mensajero','AdminOperador\HomeController@showAdminEditMensajero');
		Route::post('pedido','AdminOperador\HomeController@showAdminEditPedido');
		
	});

});





/*
|--------------------------------------------------------------------------
| Operator Routes
|--------------------------------------------------------------------------
|
| Aqui se registraran todas las acciones que puede usar el operador.
| Deben ser declaradas dentro del middleware para proveer acceso
| solo a aquellos que hayan pasado por el proceso de auth.
|
| Esta grupo de rutas funciona de la siguiente manera:
| Captura todos los request HTTP con prefijo operador, luego valida si la session
| esta iniciada correctamente y luego redirige al contenido requerido.
|
| Ejemplo:  "/operador/index"
|
| TL;DR Agrupa por ruta comenzando con "/operador" y que esté autenticado
*/

Route::group(['prefix' => 'operador'], function () {

	Route::group(['middleware' => 'auth'], function () {

		Route::get('/','Operador\operadorController@showIndex');
		
		///Route::get('takeorder','Operador\HomeController@showCreateOrder');
		Route::get('takeorder','Operador\operadorController@showCreateOrder');
		//Route::post('takeorder1','Operador\HomeController@postCreateOrder');
		///Route::post('takeorder','Operador\HomeController@postCreate');
		Route::post('takeorder','Operador\operadorController@postCreate');
		// Route::post('takeorder','AdminOperador\HomeController@postCreate');
		
		Route::get('consultorder','Operador\operadorController@showConsultOrder');
		//Route::get('consultorder/{tracking_id}','Operador\HomeController@showConsultOrder');
		
		Route::get('logout', 'HomeController@postLogout');
	});
	

});


/*
|--------------------------------------------------------------------------
| Operator Routes
|--------------------------------------------------------------------------
|
| Aqui se registraran todas las acciones que puede usar el operador.
| Deben ser declaradas dentro del middleware para proveer acceso
| solo a aquellos que hayan pasado por el proceso de auth.
|
| Esta grupo de rutas funciona de la siguiente manera:
| Captura todos los request HTTP con prefijo operador, luego valida si la session
| esta iniciada correctamente y luego redirige al contenido requerido.
|
| Ejemplo:  "/cliente/index"
|
| TL;DR Agrupa por ruta comenzando con "/cliente" y que esté autenticado
*/

Route::group(['prefix' => 'cliente'], function () {

	Route::group(['middleware' => 'auth'], function () {

		//Route::get('/','Operador\HomeController@showIndex');
		
		//Route::get('takeorder','Operador\HomeController@showCreateOrder');
		//Route::post('takeorder1','Operador\HomeController@postCreateOrder');
		//Route::post('takeorder','Operador\HomeController@postCreate');
		
		//Route::get('consultorder','Operador\HomeController@showConsultOrder');
	
	});
	
	// routes without any auth
	//Route::get('consultorder','Cliente\HomeController@showConsultOrder');
	Route::get('consultorder/{tracking_id}','Operador\operadorController@showClientConsultOrder');

});



/*
|--------------------------------------------------------------------------
| Restful API Routes
|--------------------------------------------------------------------------
|
| Aqui se registraran todas las vistas que puede usar el desarrollador API.
|
| Esta grupo de rutas funciona de la siguiente manera:
| Captura todos los request HTTP con prefijo api, luego valida si la session
| esta iniciada correctamente y luego redirige al contenido requerido.
|
| Ejemplo:  "/api/v1/index"
|
| TL;DR Agrupa por ruta comenzando con "/api/v1/index" y que esté autenticado
*/

Route::group(['prefix' => 'api'], function () {

	Route::group(['prefix' => 'v1'], function () {

		Route::post('cliente/{number}','API\v1\RequestController@fetch_client_by_phone');
		Route::post('operadores/{id}','API\v1\RequestController@fetch_available_operators');
		Route::post('saveMarkerPosition','API\v1\RequestController@save_marker_position');
		
		Route::post('create/client','API\v1\RequestController@create_client');
		Route::post('consultorder','API\v1\RequestController@postConsultOrder');
		Route::post('clientconsultorder','API\v1\RequestController@postClientConsultOrder');
		
		Route::post('ordenorigen','API\v1\OrdenOrigenController@store');
		//Route::resource('ordenorigen','API\v1\OrdenOrigenController',['except'=>['edit','create','update','destroy'] ]);

        Route::post('getloc','API\v1\RequestController@getNewLocation');

        Route::post('gcm','API\v1\RequestController@sendPushNotification');



        Route::group(['prefix' => 'operador'], function () {

            Route::post('login',    'API\v1\RequestController@attemptLogin');
            Route::post('logout',    'API\v1\RequestController@attemptLogout');
            Route::post('orders',   'API\v1\RequestController@fetchOrders');
            Route::post('user/location', 'API\v1\RequestController@saveDeliveryLocation');
            Route::post('location', 'API\v1\RequestController@postNewLocation');
			Route::post('token',    'API\v1\RequestController@saveGCMOperatorToken');
            Route::post('uploads',   'API\v1\RequestController@saveImageFiles');

        });






	});



});

