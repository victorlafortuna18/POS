@extends('PosCategorias.template.template')
@section('page-title')
	 POS
@stop
@section('body')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<link href="{{ asset('public/assets/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<link href="{{ asset('resources/views/PosCategorias/css/Buttoms.css') }}" rel="stylesheet">
<link href="{{ asset('resources/views/PosCategorias/css/simple-sidebar.css') }}" rel="stylesheet">

<div class="container-fluid">
	<style type="text/css">
		
		
		
		
		body {
			/*
			background-image: url(http://www.officialpsds.com/images/thumbs/Chef-psd95302.png);
			background-position: right bottom;
			background-attachment: fixed;
			background-repeat: no-repeat;
			/*background-size: cover;*/
		}
		
		.clear {
			width:100%;
			clear:both;
		}
		
		.panel-default {
			background: rgba(255,255,255,0.6);
		}
		
		.cantidad {
			font-size:35px;
			font-weight:bold;
		}
		
		.conteo {
			margin-left:25px;
			padding:10px;
			position:relative;
			color:#FFF;
			text-align:center;
			float:left;
			border-radius:3px;
			border:1px solid #d1d1d1;
		}
		
		.conteo #tooltip {
			padding:3px;
			margin:0px auto;
			display:block;
			color:#fff;
			font-weight:bold;
			text-decoration:none;
			opacity:0;
			background:rgba(0,0,0,0.8);
			position:absolute;
			top:-30px;
			left:-15px;
			border-radius:3px;
			z-index:10000000;
			transition: all 0.5s;
		}
		
		.conteo:hover #tooltip {
			opacity:1;
		}
		
		#itemOperador:focus { 
			border:0px;
			font-weight:bold;
		}
		
		td {
			background: rgba(255,255,255,1);
			background: -moz-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 49%, rgba(250,250,250,1) 100%);
			background: -webkit-gradient(left top, right top, color-stop(0%, rgba(255,255,255,1)), color-stop(49%, rgba(255,255,255,1)), color-stop(100%, rgba(250,250,250,1)));
			background: -webkit-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 49%, rgba(250,250,250,1) 100%);
			background: -o-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 49%, rgba(250,250,250,1) 100%);
			background: -ms-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 49%, rgba(250,250,250,1) 100%);
			background: linear-gradient(to right, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 49%, rgba(250,250,250,1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#fafafa', GradientType=1 );
		}
		
		.td-producto {
			background: rgba(255,255,255,1);
			background: -moz-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 49%, rgba(250,250,250,1) 100%);
			background: -webkit-gradient(left top, right top, color-stop(0%, rgba(255,255,255,1)), color-stop(49%, rgba(255,255,255,1)), color-stop(100%, rgba(250,250,250,1)));
			background: -webkit-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 49%, rgba(250,250,250,1) 100%);
			background: -o-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 49%, rgba(250,250,250,1) 100%);
			background: -ms-linear-gradient(left, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 49%, rgba(250,250,250,1) 100%);
			background: linear-gradient(to right, rgba(255,255,255,1) 0%, rgba(255,255,255,1) 49%, rgba(250,250,250,1) 100%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#fafafa', GradientType=1 );
		}
		
		.notificacionesSuccess {
			position:absolute;
			top:60px;
			left:0px;
			width:100%;
			height:200px;
			overflow:hidden;
		}
		
		.notificacionesSuccess div {
			padding:10px;
			margin:0px auto;
			display:block;
			min-width:200px;
		}
		
		.notificacionesError {
			position:absolute;
			top:60px;
			left:0px;
			width:100%;
			height:200px;
			overflow:hidden;
		}
		
		.notificacionesError div {
			padding:10px;
			margin:0px auto;
			display:block;
			min-width:200px;
		}
		
		.select {
			padding:5px;
			margin-bottom:10px;
			background: #fafafa;
			font-weight:;
			font-size:18px;
			color:#333;
			border-bottom:3px solid #0080FF;
			border:0px;
		}
		
		.toggle-on.btn {
			padding: 0px !important;
			margin:0px;
		}
		.toggle-on {
			position: absolute;
			top: 0;
			bottom: 0;
			left: 0;
			right: 50%;
			margin: 0;
			border: 0;
			border-radius: 0;
		}
		.toggle.btn {
			min-width: 59px ;
			min-height: 34px ;
			width: 70px !important;
			height: 15px !important;
			margin: 0px;
			padding: 0px;
		}
		
		#todo {
			padding:0px;
			margin:0px;
			float:right;
		}
		
		.todo1 {
			width:calc(100% - 400px);
		}
		
		.todo2 {
			width:100%;
		}
		
		.comentario {
			display:block;
			width:100%;
			font-size:12px;
			color:#aaaaaa;
		}
		
		.categorias, .productos, .pago, #modalSeleccionCaja .cajas {
			text-shadow: 1px 1px 1px rgba(0,0,0,0.8);
		}
		
		.categorias .destello {
		    width: 100px;
			height: 100px;
			position: absolute;
			left: 0px;
			top: 0px;
			border-radius: 10px;
			
			background: rgba(255,255,255,1);
			background: -moz-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.78) 14%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: -webkit-gradient(left bottom, right top, color-stop(0%, rgba(255,255,255,1)), color-stop(14%, rgba(237,237,237,0.78)), color-stop(47%, rgba(246,246,246,0.26)), color-stop(61%, rgba(246,246,246,0.04)));
			background: -webkit-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.78) 14%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: -o-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.78) 14%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: -ms-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.78) 14%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.78) 14%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6', GradientType=1 );
		}
		
		.categorias:hover .destello {
		    background: rgba(255,255,255,1);
			background: -moz-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.56) 28%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: -webkit-gradient(left bottom, right top, color-stop(0%, rgba(255,255,255,1)), color-stop(28%, rgba(237,237,237,0.56)), color-stop(47%, rgba(246,246,246,0.26)), color-stop(61%, rgba(246,246,246,0.04)));
			background: -webkit-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.56) 28%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: -o-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.56) 28%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: -ms-linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.56) 28%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: linear-gradient(45deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.56) 28%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6', GradientType=1 );
		}
		
		.categorias .editarCategoria, .productos .editarProducto {
			display:none;
			color:white;
			text-shadow:1px 1px 3px black;
			position:absolute;
			right:5px;
			bottom:5px;
			
		}
		.categorias:hover .editarCategoria, .productos:hover .editarProducto {
			display:block;
		}
		
		/* The animation code */
		@keyframes added {
			0%   {transform:rotate(0deg) scale(1.5,1.5);-webkit-transform:rotate(0deg) scale(1.5,1.5);}
			50%  {transform:rotate(180deg) scale(1.5,1.5);-webkit-transform:rotate(180deg) scale(1.5,1.5);}
			100% {transform:rotate(0deg) scale(1.5,1.5);-webkit-transform:rotate(0deg) scale(1.5,1.5);}
		}

		/* The element to apply the animation to */
		.added {
			overflow:hidden;
			
		}
		.added .destello {
			animation-name: added;
			animation-duration: 2s;
			animation-iteration-count: 3;
			
		}
		
		
		.productos .destello {
		    width: 100px;
			height: 100px;
			position: absolute;
			left: 0px;
			top: 0px;
			border-radius: 10px;
			
			background: rgba(255,255,255,1);
			background: -moz-linear-gradient(315deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.78) 14%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: -webkit-gradient(right top, left bottom, color-stop(0%, rgba(255,255,255,1)), color-stop(14%, rgba(237,237,237,0.78)), color-stop(47%, rgba(246,246,246,0.26)), color-stop(61%, rgba(246,246,246,0.04)));
			background: -webkit-linear-gradient(315deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.78) 14%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: -o-linear-gradient(315deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.78) 14%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: -ms-linear-gradient(315deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.78) 14%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: linear-gradient(315deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.78) 14%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6', GradientType=1 );
		}
		
		
		.productos:hover .destello {
		    background: rgba(255,255,255,1);
			background: -moz-linear-gradient(315deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.56) 28%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: -webkit-gradient(left bottom, right top, color-stop(0%, rgba(255,255,255,1)), color-stop(28%, rgba(237,237,237,0.56)), color-stop(47%, rgba(246,246,246,0.26)), color-stop(61%, rgba(246,246,246,0.04)));
			background: -webkit-linear-gradient(315deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.56) 28%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: -o-linear-gradient(315deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.56) 28%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: -ms-linear-gradient(315deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.56) 28%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			background: linear-gradient(315deg, rgba(255,255,255,1) 0%, rgba(237,237,237,0.56) 28%, rgba(246,246,246,0.26) 47%, rgba(246,246,246,0.04) 61%);
			filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#ffffff', endColorstr='#f6f6f6', GradientType=1 );
		}
		
		.Order_boxHidden {
			display:none;
		}
		
		#textBuscarProductos:focus {
			border:0px solid transparent;
		}
		
		#modalListMensajeros #formListMensajeros .modal-body .selected {
			background: green; 
		}
	</style>
	<?php
		function getRealIP()
		{
			if (isset($_SERVER["HTTP_CLIENT_IP"]))
			{
				return $_SERVER["HTTP_CLIENT_IP"];
			}
			elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"]))
			{
				return $_SERVER["HTTP_X_FORWARDED_FOR"];
			}
			elseif (isset($_SERVER["HTTP_X_FORWARDED"]))
			{
				return $_SERVER["HTTP_X_FORWARDED"];
			}
			elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]))
			{
				return $_SERVER["HTTP_FORWARDED_FOR"];
			}
			elseif (isset($_SERVER["HTTP_FORWARDED"]))
			{
				return $_SERVER["HTTP_FORWARDED"];
			}
			else
			{
				return $_SERVER["REMOTE_ADDR"];
			}
		}	
	?>
	
	<?php 
		//Generando un conteo de los sucursales
		//*************************************
		$conteoSucursales = 0;
	?>
	@if (empty($sucursales))
		
	@else
		@foreach($sucursales as $sucursal)
			<?php $conteoSucursales++; ?>
		@endforeach
	@endif
	
	<?php 
		//Generando datos de cuenta
		//*************************
		$id = 0;
		$cuentaID = 'None';
		$nombreContacto = '';
		$numeroContacto = '';
		$correoContacto = '';
	?>
	@if (empty($cuentas))
		
	@else
		@foreach($cuentas as $cuenta)
			<?php
				$id = $cuenta->id;
				$cuentaID = $cuenta->cuentaID;
				$nombreContacto = $cuenta->nombreContacto;
				$numeroContacto = $cuenta->numeroContacto;
				$correoContacto = $cuenta->correoContacto;
			?>
		@endforeach
	@endif
	
	
	<?php 
		//Generando un conteo de los operadores
		//*************************************
		$conteoUsuarios = 0;
	?>
	@if (empty($usuarios))
		
	@else
		@foreach($usuarios as $usuario)
			<?php $conteoUsuarios++; ?>
		@endforeach
	@endif
	
	
	<?php 
		//Generando un conteo de los mensajeros
		//*************************************
		$conteoMensajeros = 0;
	?>
	@if (empty($mensajeros))
		
	@else
		@foreach($mensajeros as $mensajero)
			<?php $conteoMensajeros++; ?>
		@endforeach
	@endif
	
	
	<?php 
		//Generando un conteo de los ordenes
		//*************************************
		$conteoOrdenes = 0; 
	?>
	@if (empty($ordenes))
		
	@else
		@foreach($ordenes as $orden)
			<?php $conteoOrdenes++; ?>
		@endforeach
	@endif
	
	
	<?php 
		//Generando un conteo de los pedidos
		//*************************************
		$conteoPedidos = 0;
	?>
	@if (empty($pedidos))
		
	@else
		@foreach($pedidos as $pedido)
			<?php $conteoPedidos++; ?>
		@endforeach
	@endif
	
	<?php 
		//Generando un conteo de las categorias
		//*************************************
		$conteoCategorias = 0;
	?>
	@if (empty($categorias))
		
	@else
		@foreach($categorias as $categoria)
			<?php $conteoCategorias++; ?>
		@endforeach
	@endif
	
	<?php 
		//Generando un conteo de las productos
		//*************************************
		$conteoProductos = 0;
	?>
	@if (empty($productos))
		
	@else
		@foreach($productos as $producto)
			<?php $conteoProductos++; ?>
		@endforeach
	@endif
	
	<?php 
		//Generando datos del usuario logeado
		//*************************************
		$id = 0;
		$rolID = 0;
		$nombreUsuario = '';
		$userID = '';
	?>
	@if (empty($usuariologged))
		
	@else
		@foreach($usuariologged as $usuariolog)
			<?php 
				$id = $usuariolog->id;
				$rolID = $usuariolog->rolID;
				$nombreUsuario = $usuariolog->nombreUsuario;
				$userID = $usuariolog->userID;
			?>
		@endforeach
	@endif
	
	<span class="uslog" data-id="{{ $id }}" data-rolid="{{ $rolID }}" style="display:none;"></span>

	
	<!-- Modal -->
	<div id="modalSeleccionCaja" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.95);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalSeleccionCaja" type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none;"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-sitemap"></i> Caja </h4>
				</div>
				<form id="formSeleccionCaja" action="categorias" method="post">
					<div class="modal-body">
							<?php
								$hasSesion = false;
								$idCaja = '';
								$ipAddress = '';
								$valorTotalCaja = '';
								$valorInicialCaja = '';
								$fechaInicialCaja = '';
							?>
							@if (!empty($cajas))
								@foreach($cajas as $caja)
									<?php
										$isCajaAble = true;
									?>
									@if (!empty($abrircerrarcajas))
										@foreach($abrircerrarcajas as $abrircerrarcaja)
											@if($caja->id == $abrircerrarcaja->idCaja)
												<?php
													$isCajaAble = false;
												?>
												@if($abrircerrarcaja->userID == $idUser)
													<?php
														$hasSesion = $abrircerrarcaja->id;
														$idCaja = $abrircerrarcaja->idCaja;
														$ipAddress = $abrircerrarcaja->ipAddress;
														$valorTotalCaja = $abrircerrarcaja->valorVentaTotal;
														$valorInicialCaja = $abrircerrarcaja->valorInicialCaja;
														$fechaInicialCaja = $abrircerrarcaja->fechaInicialCaja;
													?>
												@endif
											@endif
										@endforeach
									@endif
									
									@if($isCajaAble)
										<div class="cajas caja-disponible" data-id="{{ $caja->id }}" data-ip="{{ getRealIP() }}" style="display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#01DF3A;color:#fff;font-weight:bold;cursor:pointer;position:relative;">Caja <br/> Disponible </div>
									@else
										<div class="cajas caja-ocupada" data-id="{{ $caja->id }}" data-ip="{{ getRealIP() }}" style="display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#FFBF00;color:#fff;font-weight:bold;cursor:;position:relative;cursor:default;">Caja en uso <br/>{{ $abrircerrarcaja->fechaInicialCaja }} <br/>RD$ {{ number_format($abrircerrarcaja->valorInicialCaja, 2) }} </div>
									@endif
								@endforeach
							@endif
						<div class="clear"></div>
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarSeleccionCaja" href="{{ url('adminlocalidad/dashboard') }}" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	@if($hasSesion)
		@if($ipAddress == getRealIP())
			<!-- Modal -->
			<div id="modalAbrirCajaSesionActualThisPC" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
				<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
					<div class="modal-content">
						<div class="modal-header">
							<button id="closeModalAbrirCaja" type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none;"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"><i class="fa fa-sitemap"></i> Abrir Caja </h4>
						</div>
						<form id="formSeleccionCaja" action="categorias" method="post">
							<div class="modal-body">
									<input type="hidden" id="idsesion" value="{{ $hasSesion }}">
									<span style="margin-bottom:10px;display:block;width:100%;">
										Ya posees una sesion activa en este navegador. Desea continuar?
									</span>
									<span style="margin-bottom:10px;display:block;width:100%;">
										Ultima sesion <br/>
										{{ $userID }} <br/>
										{{ $fechaInicialCaja }} <br/>
									</span>
									<span style="margin-bottom:10px;display:block;width:100%;">
										Valor inicial de caja <br/>
										RD${{ number_format($valorInicialCaja,2) }}
									</span>
									
								<div class="clear"></div>
								
							</div>
							<div class="modal-footer">
								<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
								<a id="CancelarAbrirCaja"  href="{{ url('adminlocalidad/dashboard') }}" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
								<a id="GuardarModalAbrirCaja" type="button" class="btn btn-success" data-dismiss="modal">Continuar</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		@else
			<!-- Modal -->
			<div id="modalAbrirCajaSesionActualOtherPC" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
				<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
					<div class="modal-content">
						<div class="modal-header">
							<button id="closeModalAbrirCaja" type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none;"><span aria-hidden="true">&times;</span></button>
							<h4 class="modal-title" id="myModalLabel"><i class="fa fa-sitemap"></i> Abrir Caja </h4>
						</div>
						<form id="formAbrirCajaSesionActualOtherPC" action="categorias" method="post">
							<div class="modal-body">
									<input type="hidden" id="idsesion" value="{{ $hasSesion }}">
									<input type="hidden" id="ip" value="{{ getRealIP() }}">
									<span style="margin-bottom:10px;display:block;width:100%;">
										Ya posees una sesion activa en otro computador o navegador. 
										Si deseas continuar se cerrara la otra sesion y abrira en 
										este navegador. Deseas continuar?
									</span>
									<span style="margin-bottom:10px;display:block;width:100%;">
										Ultima sesion <br/>
										{{ $userID }} <br/>
										{{ $fechaInicialCaja }} <br/>
									</span>
									<span style="margin-bottom:10px;display:block;width:100%;">
										Valor inicial de caja <br/>
										RD${{ number_format($valorInicialCaja,2) }}
									</span>
									
								<div class="clear"></div>
								
							</div>
							<div class="modal-footer">
								<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
								<a id="CancelarAbrirCaja"  href="{{ url('adminlocalidad/dashboard') }}" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
								<a id="GuardarModalAbrirCaja" type="button" class="btn btn-success" data-dismiss="modal">Continuar</a>
							</div>
						</form>
					</div>
				</div>
			</div>
		@endif
	@endif
	
	<!-- Modal -->
	<div id="modalAbrirCaja" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalAbrirCaja" type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none;"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-sitemap"></i> Abrir Caja </h4>
				</div>
				<form id="formAbrirCaja" action="categorias" method="post">
					<div class="modal-body">
							<input type="hidden" id="id" value="{{ $idCaja }}">
							<input type="hidden" id="ip" value="{{ getRealIP() }}">
							
							<span style="margin-bottom:10px;display:block;width:100%;">
								Ultima sesion <br/>
								<span class="userID"></span> <br/>
								<span class="fechaInicialSesion"></span> -- <span class="fechaFinalSesion"></span> <br/>
							</span>
							<span style="margin-bottom:10px;display:block;width:100%;">
								Valor inicial de caja <br/>
								<span class="valorInicialCajaSpan" style="display:none;"></span>
								<input id="valorInicialCaja" type="text" name="valorInicialCaja" class="valorInicialCaja withScreenKeyboard" value="" placeholder="Valor inicial de caja" style="display:none;">
								
							</span>
							
						<div class="clear"></div>
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarAbrirCaja" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarModalAbrirCaja" type="button" class="btn btn-success" data-dismiss="modal">Abrir caja</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<!-- Modal -->
	<div id="modalCierreCaja" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:800px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalCierreCaja" type="button" class="close" data-dismiss="modal" aria-label="Close" style="display:none;"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-sign-out"></i> Cierre de Caja </h4>
				</div>
				<form id="formCierreCaja" action="categorias" method="post">
					<div class="modal-body">
							<input type="hidden" id="id" value="">
							<input type="hidden" id="ip" value="{{ getRealIP() }}">
						
							<div style="float:left;width:399px;">
								<div class="efectivo" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:399px;float:left;">
									<div style="margin-left:10px;float:left;width:50px;"><input id="cantidadvalor" data-valor="2000" type="number" min="0" class="cantidadvalor withScreenKeyboard" value="0" placeholder="Cant." style="text-align:center;"></div>
									<span class="valor" data-valor="2000" style="width: 155px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">* RD$2000</span>
									
									<span class="subTotalValor" data-subtotalvalor="0" style="width: 180px;float:left;text-align: right;font-size: 17px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">= RD$0.00</span>
									<div class="clear"></div>
								</div>
								<div class="efectivo" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:399px;float:left;">
									<div style="margin-left:10px;float:left;width:50px;"><input id="cantidadvalor" data-valor="1000" type="number" min="0" class="cantidadvalor withScreenKeyboard" value="0" placeholder="Cant." style="text-align:center;"></div>
									<span class="valor" data-valor="1000" style="width: 155px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">* RD$1000</span>
									
									<span class="subTotalValor" data-subtotalvalor="0" style="width: 180px;float:left;text-align: right;font-size: 17px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">= RD$0.00</span>
									<div class="clear"></div>
								</div>
								<div class="efectivo" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:399px;float:left;">
									<div style="margin-left:10px;float:left;width:50px;"><input id="cantidadvalor" data-valor="500" type="number" min="0" class="cantidadvalor withScreenKeyboard" value="0" placeholder="Cant." style="text-align:center;"></div>
									<span class="valor" data-valor="500" style="width: 155px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">* RD$500</span>
									
									<span class="subTotalValor" data-subtotalvalor="0" style="width: 180px;float:left;text-align: right;font-size: 17px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">= RD$0.00</span>
									<div class="clear"></div>
								</div>
								<div class="efectivo" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:399px;float:left;">
									<div style="margin-left:10px;float:left;width:50px;"><input id="cantidadvalor" data-valor="200" type="number" min="0" class="cantidadvalor withScreenKeyboard" value="0" placeholder="Cant." style="text-align:center;"></div>
									<span class="valor" data-valor="200" style="width: 155px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">* RD$200</span>
									
									<span class="subTotalValor" data-subtotalvalor="0" style="width: 180px;float:left;text-align: right;font-size: 17px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">= RD$0.00</span>
									<div class="clear"></div>
								</div>
								<div class="efectivo" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:399px;float:left;">
									<div style="margin-left:10px;float:left;width:50px;"><input id="cantidadvalor" data-valor="100" type="number" min="0" class="cantidadvalor withScreenKeyboard" value="0" placeholder="Cant." style="text-align:center;"></div>
									<span class="valor" data-valor="100" style="width: 155px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">* RD$100</span>
									
									<span class="subTotalValor" data-subtotalvalor="0" style="width: 180px;float:left;text-align: right;font-size: 17px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">= RD$0.00</span>
									<div class="clear"></div>
								</div>
								<div class="efectivo" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:399px;float:left;">
									<div style="margin-left:10px;float:left;width:50px;"><input id="cantidadvalor" data-valor="50" type="number" min="0" class="cantidadvalor withScreenKeyboard" value="0" placeholder="Cant." style="text-align:center;"></div>
									<span class="valor" data-valor="50" style="width: 155px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">* RD$50</span>
									
									<span class="subTotalValor" data-subtotalvalor="0" style="width: 180px;float:left;text-align: right;font-size: 17px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">= RD$0.00</span>
									<div class="clear"></div>
								</div>
								<div class="efectivo" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:399px;float:left;">
									<div style="margin-left:10px;float:left;width:50px;"><input id="cantidadvalor" data-valor="25" type="number" min="0" class="cantidadvalor withScreenKeyboard" value="0" placeholder="Cant." style="text-align:center;"></div>
									<span class="valor" data-valor="25" style="width: 155px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">* RD$25</span>
									
									<span class="subTotalValor" data-subtotalvalor="0" style="width: 180px;float:left;text-align: right;font-size: 17px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">= RD$0.00</span>
									<div class="clear"></div>
								</div>
								<div class="efectivo" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:399px;float:left;">
									<div style="margin-left:10px;float:left;width:50px;"><input id="cantidadvalor" data-valor="10" type="number" min="0" class="cantidadvalor withScreenKeyboard" value="0" placeholder="Cant." style="text-align:center;"></div>
									<span class="valor" data-valor="10" style="width: 155px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">* RD$10</span>
									
									<span class="subTotalValor" data-subtotalvalor="0" style="width: 180px;float:left;text-align: right;font-size: 17px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">= RD$0.00</span>
									<div class="clear"></div>
								</div>
								<div class="efectivo" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:399px;float:left;">
									<div style="margin-left:10px;float:left;width:50px;"><input id="cantidadvalor" data-valor="5" type="number" min="0" class="cantidadvalor withScreenKeyboard" value="0" placeholder="Cant." style="text-align:center;"></div>
									<span class="valor" data-valor="5" style="width: 155px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">* RD$5</span>
									
									<span class="subTotalValor" data-subtotalvalor="0" style="width: 180px;float:left;text-align: right;font-size: 17px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">= RD$0.00</span>
									<div class="clear"></div>
								</div>
								<div class="efectivo" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:399px;float:left;">
									<div style="margin-left:10px;float:left;width:50px;"><input id="cantidadvalor" data-valor="1" type="number" min="0" class="cantidadvalor withScreenKeyboard" value="0" placeholder="Cant." style="text-align:center;"></div>
									<span class="valor" data-valor="1" style="width: 155px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">* RD$1</span>
									
									<span class="subTotalValor" data-subtotalvalor="0" style="width: 180px;float:left;text-align: right;font-size: 17px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">= RD$0.00</span>
									<div class="clear"></div>
								</div>
							</div>
							
							<div style="float:right;width:300px;margin-bottom:20px;">
								<div class="tarjeta" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:330px;float:right;">
									<span class="valor" data-valor="0" style="width: 170px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">Targeta RD$ </span>
									<div style="margin-left:10px;float:left;width:100px;"><input id="tarjetavalor" data-valor="1" type="text" min="0" class="tarjetavalor withScreenKeyboard" value="0" placeholder="Valor" style="text-align:center;"></div>
									<div class="clear"></div>
								</div>
								<div class="credito" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:330px;float:right;">
									<span class="valor" data-valor="0" style="width: 170px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">Credito RD$ </span>
									<div style="margin-left:10px;float:left;width:100px;"><input id="creditovalor" data-valor="1" type="text" min="0" class="creditovalor withScreenKeyboard" value="0" placeholder="Valor" style="text-align:center;"></div>
									<div class="clear"></div>
								</div>
								<div class="cheque" style="display:none;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:330px;float:right;">
									<span class="valor" data-valor="0" style="width: 170px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">Cheque RD$ </span>
									<div style="margin-left:10px;float:left;width:100px;"><input id="chequevalor" data-valor="1" type="text" min="0" class="chequevalor withScreenKeyboard" value="0" placeholder="Valor" style="text-align:center;"></div>
									<div class="clear"></div>
								</div>
							</div>
							
							<div style="float:right;width:300px;margin-bottom:20px;">
								<div class="totalcaja" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:330px;float:right;">
									<span class="valor" data-valor="" style="width: 170px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">Total RD$ </span>
									<span class="valortotal" data-valor="0" style="width: 100px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">0.00 </span>
									
									<div class="clear"></div>
								</div>
								<div class="totalVentacaja" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:330px;float:right;">
									<span class="valor" data-valor="" style="width: 170px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">Venta RD$ </span>
									<span class="valortotal" data-valor="21120" style="width: 100px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">0.00 </span>
									
									<div class="clear"></div>
								</div>
								<div class="inicialcaja" style="display:block;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:330px;float:right;">
									<span class="valor" data-valor="1" style="width: 170px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">Val. Inicial RD$ </span>
									<span class="valortotal" data-valor="0" style="width: 100px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;color:green;">0.00 </span>
									<div class="clear"></div>
								</div>
								
								<div class="diferenciacaja" style="display:block;margin-top:20px;position:;background:#f1f1f1;height: 50px;overflow:hidden;width:330px;float:right;">
									<span class="valor" data-valor="1" style="width: 170px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;">Dif. RD$ </span>
									<span class="valortotal" data-valor="0" style="width: 100px;float:left;text-align: left;font-size: 20px;border: none;outline: none;height: 3rem;margin: 0 0 15px 0;padding: 12px;-moz-box-sizing: content-box;box-sizing: border-box;color:green;">0.00 </span>
									<div class="clear"></div>
								</div>
							</div>
							
						<div class="clear"></div>
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarCierreCaja" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarModalCierreCaja" type="button" class="btn btn-success" data-dismiss="modal">Cerrar caja</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	

    <div id="wrapper" data-ip="{{ getRealIP() }}" style="display:none;">
		
        <!-- Sidebar -->
        <div id="sidebar-wrapper" style="position:fixed;width:400px;height: calc(100% - 50px);">
			<a id="mostrarFacturas" type="button" class="btn btn-default" data-dismiss="modal"  style="position: absolute;right: -5px;top: 7px;width: 30px;height: 30px;border-radius: 1px 10px 0px 34px;padding-right: 37px;padding-bottom: 29px;"><i class="fa fa-clone" style="" aria-hidden="true"></i></a>
            <h4 class="Order_title"></h4>
            <div class="OrderBox Order_box">
                <div class="Order_table" style="height:calc(100% - 70px);">
                    <span class="Order_caption" style="display:block;width:326px;padding:2px;box-sizing:border-box;font-weight:bold;font-size:20px;"> <i class="fa fa-user" aria-hidden="true"></i>	<div class="clienteDataVenta" data-codigocliente="" data-nombrecliente="" data-telefonocliente="" data-direccioncliente="" data-identificacioncliente="" data-emailcliente="" data-hascliente="0" title="" style="margin-left:5px;width:300px !important;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;float:right;"> -- </div>
					</span>
					
					<div class="thead" style="display:block;width:100%;height:25px;border-bottom:1px solid #f1f1f1;">
						<ul>
							<li class="th-producto" style="width:230px;float:left;font-weight:bold;">Producto</li>
							<li class="th-cantidad" style="width:50px;float:left;font-weight:bold;"></li>
							<li class="th-precio" style="padding-right:20px;text-align:right;width:135px;float:left;font-weight:bold;box-sizing:border-box;">Precio</li>
						</ul>
					</div>
					<div class="tbody" style="margin-top:10px;overflow:auto;height:calc(100% - 100px);"></div>
                </div>
                <label class="Total_label" data-valortotal="0.00" style="width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;font-size: 15px;right: -7px;bottom: 332px;">Total RD$ 0.00</label>
                <label class="Total_label_servicio" data-valortotal="0.00" style="width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;position: absolute;right: -7px;bottom: 353px;">Servicio RD$ 0.00</label>
                <label class="Total_label_itbis" data-valortotal="0.00" style="width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;position: absolute;right: -7px;bottom: 371px;">Itbis RD$ 0.00</label>
                <label class="Total_label_descuento" data-valortotal="0.00" style="width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;position: absolute;right: -7px;bottom: 390px;">Descuento RD$ 0.00</label>
                <label class="Total_label_subtotal" data-valortotal="0.00" style="width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;position: absolute;right: -7px;bottom: 408px;">SubTotal RD$ 0.00</label>
            </div>

            <div class="group-add">
            	<div class="form-group">
              <div class="input-group">
                <input class="form-control input-pagar" type="text" placeholder="Monto efectivo" id="monto_pagar" style="text-align:right;">
                <span class="input-group-btn">
                    <button type="button" class="btn btn-primary btn-sm" style="display:none;"> <i class="fa fa-file" aria-hidden="true"></i> Escribir nota</button>
                </span>
              </div>
            </div>

			<a href="#" class="btn btn-danger btn-order anularFacturaActual" style="width:110px;"><i class="fa fa-ban" aria-hidden="true" style="color: #fff;"></i> Anular </a>
            <a href="#" class="btn btn-info btn-order notaFacturaActual" style="width:90px;"><i class="fa fa-file" aria-hidden="true" style="color: #fff;"></i> nota </a>
            <a href="#" class="btn btn-success btn-order descuentoFacturaActual" style="width: 154px;"><i class="fa fa-tag" aria-hidden="true" style="color: #fff;"></i> Desct (F8)</a>
            
           <div class="btn-group btn-group-container">
                <div class="btn-group-vertical">
                    <a href="#" class="btn btn-default bCliente" id="btn-cliente"><i class="fa fa-user" aria-hidden="true" style="color: #FFF;"></i> Clientes (F3)</a>
                    <a href="#" class="btn btn-default botonPagar" id="btn-pay"><i class="fa fa-shopping-cart" aria-hidden="true" style="color: #FFF;"></i> Pago (F5)</a> 
                </div>
                <div class="btn-group btn-group-horizontal">
                    <div class="btn-toolbar">
                  <div class="btn-group">
                    <a href="#" class="btn btn-default btn-num numero">7</a>
                    <a href="#" class="btn btn-default btn-num numero">8</a>
                    <a href="#" class="btn btn-default btn-num numero">9</a>
                  </div>
                </div>
                <div class="btn-toolbar">
                  <div class="btn-group">
                    <a href="#" class="btn btn-default btn-num numero">4</a>
                    <a href="#" class="btn btn-default btn-num numero">5</a>
                    <a href="#" class="btn btn-default btn-num numero">6</a>
                  </div>
                </div>
                <div class="btn-toolbar">
                  <div class="btn-group">
                    <a href="#" class="btn btn-default btn-num numero">1</a>
                    <a href="#" class="btn btn-default btn-num numero">2</a>
                    <a href="#" class="btn btn-default btn-num numero">3</a>
                  </div>
                </div>
                <div class="btn-toolbar">
                  <div class="btn-group">
                    <a href="#" class="btn btn-default btn-num delete"><i class="fa fa-caret-square-o-left" aria-hidden="true" style="color: #FFF"></i></a>
                    <a href="#" class="btn btn-default btn-num numero">0</a>
                    <a href="#" class="btn btn-default btn-num eraser"><i class="fa fa-eraser" aria-hidden="true" style="color: #FFF"></i></a>
                  </div>
                </div>
                </div>
           </div>

            	
            </div>
            
           
            <!--<div class="wrap">
                <ul class="buttons">
                    <li><a class="clear">C</a></li>
                </ul>
            </div>-->
        </div><!-- /#sidebar-wrapper -->
        <!-- Page Content -->
        <div id="page-content-wrapper">
            <div class="container-fluid xyz">
                <div class="row">
                    <div class="col-lg-12">
                        
                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
<div id="todo" class="todo1" style="display:none;">
	<!-- Search -->
	<div class="row" style="display:none;width:75%;float:left;">
		<div class="col-lg-12">
			<!--panel -->
			<div class="panel panel-default">
				
					<div class="panel-body">
						<div class="col-lg-6">
							<div class="input-group" style="font-size:28px;">
							{{
								$cuentaID
							}}
							</div>
							<div class="input-group" style="display:block;color:;font-weight:bold;background:;border:0px solid #333;">
								<a href="dashboard"><i class="fa fa-home"></i> Admin</a> >> <a href="#">Productos</a>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
						
					</div>
				
			</div> 
			<!-- /.panel -->
		</div>
	</div>
	
	<style>
	
		.breadcrumb { 
			list-style: none; 
			overflow: hidden; 
			font: 18px Helvetica, Arial, Sans-Serif;
			max-width:900px;
			max-height: 38px;
			padding: 0;
			background: none;
			margin: 0;
		}
		.breadcrumb li { 
			float: left; 
		}
		.breadcrumb li a {
			color: white;
			text-decoration: none; 
			padding: 10px 0 10px 55px;
			background: #3FE1D1;                   /* fallback color */
			background: #3FE1D1; 
			position: relative; 
			display: block;
			float: left;
		}
		.breadcrumb li a:after { 
			content: " "; 
			display: block; 
			width: 0; 
			height: 0;
			border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
			border-bottom: 50px solid transparent;
			border-left: 30px solid #3FE1D1;
			position: absolute;
			top: 50%;
			margin-top: -50px; 
			left: 100%;
			z-index: 2; 
		}	
		.breadcrumb li a:before { 
			content: " "; 
			display: block; 
			width: 0; 
			height: 0;
			border-top: 50px solid transparent;           /* Go big on the size, and let overflow hide */
			border-bottom: 50px solid transparent;
			border-left: 30px solid white;
			position: absolute;
			top: 50%;
			margin-top: -50px; 
			margin-left: 1px;
			left: 100%;
			z-index: 1; 
		}	
		.breadcrumb li:first-child a {
			padding-left: 10px;
		}
		/* .breadcrumb li:nth-child(2) a       { background:        hsla(34,85%,45%,1); }
		.breadcrumb li:nth-child(2) a:after { border-left-color: hsla(34,85%,45%,1); }
		.breadcrumb li:nth-child(3) a       { background:        hsla(34,85%,55%,1); }
		.breadcrumb li:nth-child(3) a:after { border-left-color: hsla(34,85%,55%,1); }
		.breadcrumb li:nth-child(4) a       { background:        hsla(34,85%,65%,1); }
		.breadcrumb li:nth-child(4) a:after { border-left-color: hsla(34,85%,65%,1); }
		.breadcrumb li:nth-child(5) a       { background:        hsla(34,85%,75%,1); }
		.breadcrumb li:nth-child(5) a:after { border-left-color: hsla(34,85%,75%,1); } */
		.breadcrumb li:last-child a {
			background: #2BBBAD !important;
			/*color: black;*/
			pointer-events: none;
 			cursor: default;
		}
		.breadcrumb li:last-child a:after { border-left-color:#2BBBAD; }
		.breadcrumb li a:hover { background: #2BBBAD; }
		.breadcrumb li a:hover:after { border-left-color: #2BBBAD !important; }
		
	</style>


	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"> Categorias encontradas ( <span id="conteoCategorias">{{ $conteoCategorias }}</span> ) @if($rolID == 4) <a href="#" id="agregarCategoria" style="cursor:pointer;">Agregar nuevo</a> @endif  <a href="#" id="verFacturas" style="cursor:pointer;float:right;" title="Ver facturas emitidas recientemente">Ultimas Facturas (F9)</a></div>
				<div class="panel-heading breadcrumbs" style="border:0px;"> 
					<ul class="breadcrumb">
						<li class="breadcrumbOption"><a data-categoriaid="0" href="#"><i class="fa fa-home" aria-hidden="true"></i></a></li>
					</ul>
				</div>
				<div class="panel-body">
					<div class="panel-body">
                        @if (Session::has('message_create'))
                            <div class=" {{ Session::get('alert_class') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('message_create') }}
                            </div>
                        @endif
						<div class="list-group">
							<div id="" class="display" cellspacing="0" width="100%">
								@if (empty($categorias))
									
								@else
									@foreach($categorias as $categoria)
										<div class="categorias" id="{{ $categoria->id }}" data-url="edit-sucursal" data-id="{{ $categoria->id }}"  data-nombrecategoria="{{ $categoria->nombreCategoria }}"  data-descripcion="{{ $categoria->Descripcion }}"  data-bgcolor="{{ $categoria->bgcolor }}" data-categoriamadre="{{ $categoria->idCategoriaMadre }}" style="display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:{{$categoria->bgcolor}};color:#fff;font-weight:bold;cursor:pointer;position:relative;border-radius:10px;box-shadow: 1px 1px 3px #000;">{{ $categoria->nombreCategoria }} <i class="fa fa-folder-open fa-3x" aria-hidden="true" style="position:absolute;right: 10px;top: 52px;/* color: rgba(0, 0, 0, 0.5); */opacity: 0.2;"></i><div class="destello"></div>
											@if($rolID == 4)
												<a href="#" class="editarCategoria" data-id="{{ $categoria->id }}" data-nombrecategoria="{{ $categoria->nombreCategoria }}"  data-descripcion="{{ $categoria->Descripcion }}"  data-bgcolor="{{ $categoria->bgcolor }}" data-categoriamadre="{{ $categoria->idCategoriaMadre }}"><i class="fa fa-edit " aria-hidden="true"></i></a>
											@endif
										</div>
									@endforeach
								@endif


							</div>
						</div>
					</div>
				</div>
			</div>
		</div>                
	</div>
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"> Productos encontrados ( <span id="conteoProductos">{{ $conteoProductos }}</span> ) @if($rolID == 4) <a href="#" id="agregarProducto" style="cursor:pointer;">Agregar nuevo</a> @endif
					<input id="textBuscarProductos" type="text" name="buscador" class="text withScreenKeyboard" value="" placeholder="Buscador (F4)" style="height: 22px;width:250px;float:right;border-bottom: 0px;">
					<i class="fa fa-search " aria-hidden="true" style="float:right;margin-right:10px;font-size:20px;color:#cccccc;"></i>
				</div>
				<div class="panel-body">
					<div class="panel-body">
                        @if (Session::has('message_create'))
                            <div class=" {{ Session::get('alert_class') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('message_create') }}
                            </div>
                        @endif
						<div class="list-group">
							<div id="" class="display2" cellspacing="0" width="100%">
								@if (empty($productos))
								
								@else
									@foreach($productos as $producto)
										<div class="productos" id="{{ $producto->id }}" data-id="{{ $producto->id }}" data-categoriamadre="{{ $producto->categoriaid }}" data-nombre="{{ $producto->nombre }}" data-descripcion="{{ $producto->descripcion }}" data-precio="{{ $producto->precio }}" data-bgcolor="{{ $producto->bgcolor }}" style="display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:{{$producto->bgcolor}};color:#fff;font-weight:bold;cursor:pointer;position:relative;border-radius:10px;box-shadow: 1px 1px 3px #000;">{{ $producto->nombre }} 
											<span style="position:absolute;left: 0px;bottom: 0px;display: block;width: 100%;background: rgba(0,0,0,0.5);font-size: 13px;padding-left: 2px;border-radius: 0px 0px 10px 10px;">${{ $producto->precio }}</span>
											<i class="fa fa-shopping-cart fa-3x" aria-hidden="true" style="position:absolute;right: 10px;top: 52px;/* color: rgba(0, 0, 0, 0.5); */opacity: 0.3;"></i><div class="destello"></div>
											@if($rolID == 4)
												<a href="#" class="editarProducto" data-id="{{ $producto->id }}"  data-categoriamadre="{{ $producto->categoriaid }}" data-nombre="{{ $producto->nombre }}" data-descripcion="{{ $producto->descripcion }}" data-precio="{{ $producto->precio }}" data-bgcolor="{{ $producto->bgcolor }}"><i class="fa fa-edit " aria-hidden="true"></i></a>
											@endif
										</div>
									@endforeach
								@endif
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>                
	</div>
	
	<!-- Modal -->
	<div id="modalAgregarCategoria" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalAgregarCategoria" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Agregar Categoria</h4>
				</div>
				<form id="formAgregarCategoria" action="categorias" method="post">
					<div class="modal-body">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							
							<input type="hidden" name="asunto" value="guardarCategoria">
							<input type="hidden" name="idcategoriamadre" value="id">
							
							<input id="bgcolor" type="color" name="bgcolor" class="text" value="#DF3A01" placeholder="Color" style="height: 80px;width: 80px;">
							
							<input id="nombreCategoria" type="text" name="nombreCategoria" class="text withScreenKeyboard" value="" placeholder="Nombre de categoria">
							
							<input id="descripcion" type="text" name="descripcion" class="text withScreenKeyboard" value="" placeholder="Descripcion">
							
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarGuardarCategoria" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarCategoria" type="button" class="btn btn-success" data-dismiss="modal">Agregar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<!-- Modal -->
	<div id="modalActualizarCategoria" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalActualizarCategoria" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Actualizar Categoria</h4>
				</div>
				<form id="formActualizarCategoria" action="categorias" method="post">
					<div class="modal-body">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							
							<input type="hidden" id="asunto" value="guardarActualizarCategoria">
							<input type="hidden" id="idcategoria" value="id">
							
							<input id="bgcolor" type="color" name="bgcolor" class="text" value="#DF3A01" placeholder="Color" style="height: 80px;width: 80px;">
							
							<input id="nombreCategoria" type="text" name="nombreCategoria" class="text withScreenKeyboard" value="" placeholder="Nombre de categoria">
							
							<input id="descripcion" type="text" name="descripcion" class="text withScreenKeyboard" value="" placeholder="Descripcion">
							
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarActualizarCategoria" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarActualizarCategoria" type="button" class="btn btn-success" data-dismiss="modal">Guardar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<style>
		.listaAdicionales .selected {
			background:#55B947 !important;
			color:white;
			font-weight:bold;
		}
		
		#formVentaProducto .modal-body .selected {
			background:#55B947 !important;
			color:white;
			font-weight:bold;
		}
	</style>
	
	
	<!-- Modal -->
	<div id="modalAgregarProducto" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:800px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalAgregarProducto" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Crear Producto</h4>
				</div>
				<form id="formAgregarProducto" action="POS" method="post">
					<div class="modal-body" style="width:450px;height:290px;float:left;">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<input type="hidden" name="asunto" value="guardarProducto">
						<input type="hidden" name="idcategoriamadre" value="id">
						
						<input id="bgcolor" type="color" name="bgcolor" class="text" value="#DF3A01" placeholder="Color" style="height: 80px;width: 80px;">
						
						<input id="nombreProducto" type="text" name="nombreProducto" class="text withScreenKeyboard" value="" placeholder="Nombre de producto">
						
						<input id="descripcion" type="text" name="descripcion" class="text withScreenKeyboard" value="" placeholder="Descripcion">
						
						<input id="precio" type="text" name="precio" class="text withScreenKeyboard" value="" placeholder="Precio">
					</div>
					<div class="modal-body right" style="width:300px;height:290px;float:right;">
						<span style="font-weight:bold;">Adicionales ( <span id="conteoAdicionalesSelected" class="conteoAdicionalesSelected">3</span> / <span id="conteoAdicionales" class="conteoAdicionales">8</span> )</span>	<a href="#" class="agregarCategoriaAdicional">Agregar nuevo</a>
						
						<div id="listaAdicionales" class="listaAdicionales" style="margin-top:20px;width:260px;max-height:225px;overflow:auto;">
							<span class="comentario">Seleccione los adicionales para el producto.</span>
								@if (empty($adicionales))
								
								@else
									@foreach($adicionales as $adicional)
										<div id="{{ $adicional->id }}" data-id="{{ $adicional->id }}" class="categoriasAdicionales" style="background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;">{{ $adicional->nombreAdicional }} 		<a href="#" class="btnEliminarAdicional" data-id="{{ $adicional->id }}" data-nombreadicional="{{ $adicional->nombreAdicional }}" style="float:right;margin-right:2px;"><span aria-hidden="true">&times;</span></a> <a href="#" class="btnEditarAdicional" data-id="{{ $adicional->id }}" data-nombreadicional="{{ $adicional->nombreAdicional }}" style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
									@endforeach
								@endif
						</div>
					</div>
					<div class="modal-footer" style="background:;display:block;width:100%;">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarGuardarProducto" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarProducto" type="button" class="btn btn-success" data-dismiss="modal">Guardar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<!-- Modal -->
	<div id="modalActualizarProducto" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:800px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalActualizarProducto" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Actualizar Producto</h4>
				</div>
				<form id="formActualizarProducto" action="POS" method="post">
					<div class="modal-body" style="width:450px;height:290px;float:left;">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<input type="hidden" id="asunto" value="guardarActualizarProducto">
						<input type="hidden" id="idproducto" value="id">
						
						<input id="bgcolor" type="color" name="bgcolor" class="text" value="#DF3A01" placeholder="Color" style="height: 80px;width: 80px;">
						
						<input id="nombreProducto" type="text" name="nombreProducto" class="text withScreenKeyboard" value="" placeholder="Nombre de producto">
						
						<input id="descripcion" type="text" name="descripcion" class="text withScreenKeyboard" value="" placeholder="Descripcion">
						
						<input id="precio" type="text" name="precio" class="text withScreenKeyboard" value="" placeholder="Precio">
					</div>
					<div class="modal-body right" style="width:300px;height:290px;float:right;">
						<span style="font-weight:bold;">Adicionales ( <span id="conteoAdicionalesSelected" class="conteoAdicionalesSelected">3</span> / <span id="conteoAdicionales" class="conteoAdicionales">8</span> )</span>	<a href="#" class="agregarCategoriaAdicional">Agregar nuevo</a>
						
						<div id="listaAdicionales" class="listaAdicionales" style="margin-top:20px;width:260px;max-height:225px;overflow:auto;">
							<span class="comentario">Seleccione los adicionales para el producto.</span>
								@if (empty($adicionales))
								
								@else
									@foreach($adicionales as $adicional)
										<div id="{{ $adicional->id }}" data-id="{{ $adicional->id }}" class="categoriasAdicionales" style="background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;">{{ $adicional->nombreAdicional }} 		<a href="#" class="btnEliminarAdicional" data-id="{{ $adicional->id }}" data-nombreadicional="{{ $adicional->nombreAdicional }}" style="float:right;margin-right:2px;"><span aria-hidden="true">&times;</span></a> <a href="#" class="btnEditarAdicional" data-id="{{ $adicional->id }}" data-nombreadicional="{{ $adicional->nombreAdicional }}" style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
									@endforeach
								@endif
						</div>
					</div>
					<div class="modal-footer" style="background:;display:block;width:100%;">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarActualizarProducto" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarActualizarProducto" type="button" class="btn btn-success" data-dismiss="modal">Guardar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="modalVentaProducto" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="position:relative;margin:0px auto;margin-top:100px;width:600px;">
			
			<span class="modal-back" data-id="0" 	style="position:absolute;	left:	-60px;	top:150px;font-size:20px;color:white;background:;float:left;"><i 	class="fa fa-chevron-left fa-4x" aria-hidden="true"></i></span>
			<span class="modal-forward" data-id="0" style="position:absolute;	right:	-60px;	top:150px;font-size:20px;color:white;background:;float:right;"><i 	class="fa fa-chevron-right fa-4x" aria-hidden="true"></i></span>
			
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalVentaProducto" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Producto </h4>
				</div>
				<form id="formVentaProducto" class="0" action="categorias" method="post">
					<div class="modal-body 0" style="margin:0px auto;width:600px;height:290px;float:left;">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						
						<input type="hidden" name="asunto" value="guardarProducto">
						<input type="hidden" name="idcategoriamadre" value="id">
						
						<i class="fa fa-newspaper-o" aria-hidden="true"></i> <span style="font-weight:bold;font-size:17px;color:#2E9AFE;">Arroz blanco con habichuelas</span>
						<span class="comentario"> <i class="fa fa-minus" aria-hidden="true"></i> Descripcion del producto</span>
						
						<div style="text-align:right;margin-top:5px;width:100%;height:;border-top:0px solid #cccccc;">
							<span class="precio" style="float:left;font-weight:bold;font-size:20px;color:red;">$315.02</span>
						</div>
						
						<div style="float:right;text-align:right;margin-top:20px;width:100%;height:;border-top:0px solid #cccccc;">
							<span class="btn btn-info restarCantidad"><i class="fa fa-chevron-left" aria-hidden="true"></i></span>
								<span class="cantidadProducto" style="font-weight:bold;font-size:25px;">5</span>
							<span class="btn btn-info sumarCantidad"><i class="fa fa-chevron-right" aria-hidden="true"></i></span>
						</div>
						
						<div style="float:right;text-align:right;padding:10px;margin-top:20px;background:;width:100%;height:;border-top:2px solid #f1f1f1;">
							<span class="valorTotalProducto" style="font-weight:bold;font-size:35px;color:red;">$1,576.00</span>
						</div>
						
					</div>
					<div class="modal-footer" style="padding:10px;margin:0px auto;width:590px;height:100px;float:left;box-sizing:border-box;">
						<textarea id="notaVentaProducto" class="withScreenKeyboard" rows="4" cols="50" style="width:570px;" placeholder="Escriba aqui su nota"></textarea>
					</div>
					<div class="modal-footer" style="background:;display:block;width:100%;">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarVentaProducto" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarVentaProducto" type="button" class="btn btn-success" data-dismiss="modal">Agregar a factura</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	<!--
	<div class="modal-body right" style="display:none;width:300px;height:290px;float:right;">
		<span style="font-weight:bold;">Adicionales ( <span id="conteoAdicionalesSelected">3</span> / <span id="conteoAdicionales">8</span> )</span>	<a href="#" id="agregarCategoriaAdicional">Agregar nuevo</a>
		
		<div id="listaOpciones" class="listaOpciones" style="margin-top:20px;width:260px;max-height:225px;overflow:auto;">
			<span class="comentario">Seleccione los adicionales para el producto.</span>
			<div id="1" data-id="1" class="opcionesAdicionales" style="background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;">Salsas 		<a href="#" style="float:right;margin-right:2px;"><span aria-hidden="true">&times;</span></a> <a href="#" style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
			<div id="2" data-id="2" class="opcionesAdicionales" style="background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;">Ensaladas 		<a href="#" style="float:right;margin-right:2px;"><span aria-hidden="true">&times;</span></a> <a href="#" style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
			<div id="3" data-id="3" class="opcionesAdicionales" style="background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;">Postres 		<a href="#" style="float:right;margin-right:2px;"><span aria-hidden="true">&times;</span></a> <a href="#" style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
			<div id="4" data-id="4" class="opcionesAdicionales" style="background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;">Frutas 		<a href="#" style="float:right;margin-right:2px;"><span aria-hidden="true">&times;</span></a> <a href="#" style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
			<div id="5" data-id="5" class="opcionesAdicionales" style="background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;">Carnes 		<a href="#" style="float:right;margin-right:2px;"><span aria-hidden="true">&times;</span></a> <a href="#" style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
			<div id="6" data-id="6" class="opcionesAdicionales" style="background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;">Mariscos 		<a href="#" style="float:right;margin-right:2px;"><span aria-hidden="true">&times;</span></a> <a href="#" style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
			<div id="6" data-id="6" class="opcionesAdicionales" style="background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;">Mariscos 		<a href="#" style="float:right;margin-right:2px;"><span aria-hidden="true">&times;</span></a> <a href="#" style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
			<div id="6" data-id="6" class="opcionesAdicionales" style="background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;">Mariscos 		<a href="#" style="float:right;margin-right:2px;"><span aria-hidden="true">&times;</span></a> <a href="#" style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
			<div id="6" data-id="6" class="opcionesAdicionales" style="background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;">Mariscos 		<a href="#" style="float:right;margin-right:2px;"><span aria-hidden="true">&times;</span></a> <a href="#" style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
			<div id="6" data-id="6" class="opcionesAdicionales" style="background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;">Mariscos 		<a href="#" style="float:right;margin-right:2px;"><span aria-hidden="true">&times;</span></a> <a href="#" style="float:right;margin-right:10px;"><i class="fa fa-pencil" aria-hidden="true"></i></a></div>
		</div>
	</div>
	-->
	
	<!-- Modal -->
	<div id="modalAgregarCategoriaAdicional" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.1);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalAgregarCategoriaAdicional" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-list-ol"></i> Agregar Adicionales </h4>
				</div>
				<form id="formAgregarCategoriaAdicional" action="mensajero" method="post">
					<div class="modal-body">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="text" id="nombreCategoriaAdicional" class="withScreenKeyboard" name="nombreCategoriaAdicional" placeholder="Titulo" style="width: 85%;margin-bottom:50px;">
							
							<div id="agregarCategoriaAdicionalOpciones" style="margin-left:25px;">
								<span class="comentario">Digite la opcion y pulse Enter para continuar agregando.</span>
								<input type="text" id="opcionMaker" class="opcionMaker withScreenKeyboard" placeholder="Opcion" style="width: 80%;margin-bottom:20px;">
								
								
								
							</div>
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarAgregarCategoriaAdicional" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarAgregarCategoriaAdicional" type="button" class="btn btn-success" data-dismiss="modal">Agregar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="modalActualizarCategoriaAdicional" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.1);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalActualizarCategoriaAdicional" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-list-ol"></i> Actualizar Adicionales </h4>
				</div>
				<form id="formActualizarCategoriaAdicional" action="mensajero" method="post">
					<div class="modal-body">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" id="idadicional" value="">
							<input type="text" id="nombreCategoriaAdicional" class="withScreenKeyboard" name="nombreCategoriaAdicional" placeholder="Titulo" style="width: 85%;margin-bottom:50px;">
							
							<div id="actualizarCategoriaAdicionalOpciones" style="margin-left:25px;">
								<span class="comentario">Digite la opcion y pulse Enter para continuar agregando.</span>
								<input type="text" id="opcionMaker" class="opcionMaker withScreenKeyboard" placeholder="Opcion" style="width: 80%;margin-bottom:20px;">
								
								
								
							</div>
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarActualizarCategoriaAdicional" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarActualizarCategoriaAdicional" type="button" class="btn btn-success" data-dismiss="modal">Guardar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<!-- Modal -->
	<div id="modalVentaProductoAdicionalSelected"  class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.5);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalVentaProductoAdicionalSelected" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle"></i> No ha seleccionado algun adicional </h4>
				</div>
				<form id="formVentaProductoAdicionalSelected" action="mensajero" method="post">
					<div class="modal-body">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							
							<span>Agrega este producto seleccionando alguna opcion en todos los adicionales.</span>
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarVentaProductoAdicionalSelected" type="button" class="btn btn-default" data-dismiss="modal">Aceptar</a>
						<a id="GuardarVentaProductoAdicionalSelected" type="button" class="btn btn-success" data-dismiss="modal" style="display:none;">Continuar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	<!-- Modal -->
	<div id="modalBuscarCliente"  class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalBuscarCliente" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user fa-2x"></i> Buscar Cliente</h4>
				</div>
				<form id="formBuscarCliente" action="mensajero" method="post" onSubmit="return false;">
					<div class="modal-body">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="text" id="buscadorCliente" name="buscadorCliente" class="withScreenKeyboard" placeholder="Buscar cliente" style="width: 65%;" autocomplete="off">
							<a href="#" type="submit" id="buscarCliente" type="button" class="btn btn-success botonBuscarCliente" data-dismiss="modal"><i class="fa fa-search fa-2x" aria-hidden="true"></i></a>
							<a href="#" type="submit" id="buscarCliente" type="button" class="btn btn-success botonAgregarCliente" data-dismiss="modal"><i class="fa fa-user-plus fa-2x" aria-hidden="true"></i></a>
							
							<div id="resultadosClientes">
								<table class="Order_table2">
									<thead>
										<tr style="display:none;">
											<th class="th-nombre">Nombre</th><th class="th-telefono">Telefono</th><th class="th-direccion">Direccion</th>
										</tr>
									</thead>

									<tbody></tbody>      
	                			</table>
							</div>
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarBuscarCliente" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="modalAgregarCliente" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalAgregarCliente" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user-plus fa-2x"></i> Agregar Cliente</h4>
				</div>
				<form id="formAgregarCliente" action="cliente" method="post">
					<div class="modal-body">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<i class="fa fa-user" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="nombrecliente" class="withScreenKeyboard" name="nombre" placeholder="Nombre del cliente" maxlength="45" style="width: 97%;">
							<i class="fa fa-legal" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="razonsocialcliente" class="withScreenKeyboard" placeholder="Razon Social" maxlength="45" style="width: 97%;">
							<i class="fa fa-phone" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="telefonocliente" class="withScreenKeyboard" placeholder="Telefono" maxlength="13" style="width: 97%;">
							<i class="fa fa-map-marker" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="direccioncliente" class="withScreenKeyboard" placeholder="Dirección" maxlength="70" style="width: 97%;">
							<i class="fa fa-envelope" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="emailcliente" class="withScreenKeyboard" placeholder="Email" maxlength="47" style="width: 97%;">
							<i class="fa fa-list-alt" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="cedularnccliente" class="withScreenKeyboard" placeholder="Cedula o RNC" maxlength="14" style="width: 97%;">
							<i class="fa fa-map" aria-hidden="true" style="padding-right: 3px;"></i><select type="text" id="localexteriorcliente" class="withScreenKeyboard" placeholder="Local (L) o Exterior (E)" maxlength="1" style="width: 97%;">
								<option value="L">Local</option>
								<option value="E">Exterior</option>
							</select>
							<i class="fa fa-comment" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="notacliente" class="withScreenKeyboard" placeholder="Escribir Nota" style="width: 97%;">
												
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarAgregarCliente" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="guardarCliente" type="button" class="btn btn-success" data-dismiss="modal">Guardar cliente</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="modalEditarCliente" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalEditarCliente" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-user fa-2x"></i> Actualizacion de Cliente</h4>
				</div>
				<form id="formEditarCliente" action="cliente" method="post">
					<div class="modal-body">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" id="clienteid" value="">
							<i class="fa fa-user" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="nombrecliente" class="withScreenKeyboard" name="nombre" placeholder="Nombre del cliente" maxlength="45" style="width: 97%;">
							<i class="fa fa-legal" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="razonsocialcliente" class="withScreenKeyboard" placeholder="Razon Social" maxlength="45" style="width: 97%;">
							<i class="fa fa-phone" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="telefonocliente" class="withScreenKeyboard" placeholder="Telefono" maxlength="13" style="width: 97%;">
							<i class="fa fa-map-marker" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="direccioncliente" class="withScreenKeyboard" placeholder="Dirección" maxlength="70" style="width: 97%;">
							<i class="fa fa-envelope" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="emailcliente" class="withScreenKeyboard" placeholder="Email" maxlength="47" style="width: 97%;">
							<i class="fa fa-list-alt" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="cedularnccliente" class="withScreenKeyboard" placeholder="Cedula o RNC" maxlength="14" style="width: 97%;">
						
							<i class="fa fa-comment" aria-hidden="true" style="padding-right: 3px;"></i><input type="text" id="notacliente" class="withScreenKeyboard" placeholder="Escribir Nota" style="width: 97%;">
												
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarEditarCliente" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="guardarEditarCliente" type="button" class="btn btn-success" data-dismiss="modal">Actualizar cliente</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="modalTabFacturas" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:400;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalTabFacturas" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-clone fa-2x"></i> Facturas</h4>
				</div>
				<form id="formTabFacturas" action="mensajero" method="post" onSubmit="return false;">
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarTabFacturas" type="button" class="btn btn-default" data-dismiss="modal">Volver</a>
						<a id="NuevoTabFacturas" type="button" class="btn btn-default" data-dismiss="modal">Nueva Factura</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modalUltimasFacturas"  class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalUltimasFacturas" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-clone fa-2x"></i> Ultimas facturas</h4>
				</div>
				<form id="formUltimasFacturas" action="mensajero" method="post" onSubmit="return false;">
					<div class="modal-body">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							
							
							<div id="resultadosUltimasFacturas">
								<table class="Order_table2" style="width:500px;">
									<thead>
										<tr style="">
											<th></th>
											<th></th>
											<th></th>
											<th></th>
										</tr>
									</thead>

									<tbody style="width: 550px;">
										
									</tbody>      
	                			</table>
							</div>
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarModalUltimasFacturas" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="toPrint" style="display:none;">
		<div style="width:100%;max-width:140px;font-size:12px;">
			<span style="display:block;width:100%;text-align:center;"> L.R. </span>
			<span style="display:block;width:100%;text-align:center;"> Repleto de Sabor </span>
			<span style="display:block;width:100%;text-align:center;"> RNC. 1-01-66458-4 </span>
			<p>&nbsp;</p>
			<span style="display:block;width:100%;padding:0px;margin:0px;"> Orden : <span class="orden_print"></span></span>
			<span style="width:300px;"> Fecha : <span class="fecha_print"></span></span><br>
			<p>&nbsp;</p>
			<span style="width:300px;">Datos del cliente</span><br>
			<span style="width:300px;"><span class="nombrecliente_print"></span></span><br>
			<span style="width:300px;"><span class="telefonocliente_print"></span></span><br>
			<span style="width:300px;"><span class="direccioncliente_print"></span></span>
			<div class="Order_table" style="height:calc(100% - 70px);">
				
				<div class="thead" style="display:block;width:100%;height:10px;border-bottom:1px solid #f1f1f1;">
					<ul style="margin:0px;padding:0px;">
						<li class="th-producto" style="width:130px;float:left;font-weight:bold;">Producto</li>
						<li class="th-cantidad" style="width:50px;float:left;font-weight:bold;"></li>
						<li class="th-precio" style="padding-right:20px;text-align:right;width:135px;float:left;font-weight:bold;box-sizing:border-box;">Precio</li>
					</ul>
				</div>
				<div class="tbody" style="margin-top:10px;overflow:auto;height:calc(100% - 100px);">
					<ul class="" data-id="1" data-nombreproducto="Spaguetti" data-precioproducto="150" data-cantidadproducto="1" data-subtotalproducto="150" data-notaproducto="" style="display:block;margin-top:10px;">
						<li class="td-producto" style="width:130px;float:left;font-weight:bold;"><i class="fa fa-cart-plus"></i><div style="width:190px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;float:right;" title="Spaguetti">Spaguetti</div>
							<ul><div class="clear" style="width:100%;clear:both;"></div></ul>
						</li>
						<li class="td-cantidad" style="width:25px;float:left;font-weight:initial;">(1)</li> 
						<li class="td-precio" style="width:73px;float:left;font-weight:initial;text-align:right;">150.00</li> 
						<li class="td-close" title="Remover" style="width:5px;float:left;font-weight:initial;text-align:right;margin-left:10px;cursor:pointer;">×</li>
						<div class="notaProducto" data-nota="" style="font-weight:initial;color:#c1c1c1;width:100%;clear:both;"></div>
					</ul>
					<ul class="" data-id="2" data-nombreproducto="Macarrones" data-precioproducto="200" data-cantidadproducto="1" data-subtotalproducto="200" data-notaproducto="" style="display:block;margin-top:10px;">
						<li class="td-producto" style="width:210px;float:left;font-weight:bold;"><i class="fa fa-cart-plus"></i><div style="width:190px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;float:right;" title="Macarrones">Macarrones</div>
							<ul>
								<div class="clear" style="width:100%;clear:both;"></div>
							</ul>
						</li>
						<li class="td-cantidad" style="width:25px;float:left;font-weight:initial;">(1)</li> 
						<li class="td-precio" style="width:100px;float:left;font-weight:initial;text-align:right;">200.00</li> 
						<li class="td-close" title="Remover" style="width:5px;float:left;font-weight:initial;text-align:right;margin-left:10px;cursor:pointer;">×</li>
						<div class="notaProducto" data-nota="" style="font-weight:initial;color:#c1c1c1;width:100%;clear:both;"></div>
					</ul>
					<ul class="" style="display:block;margin-top:10px;">
						<li class="td-producto" style="width:210px;float:left;font-weight:bold;"><i class="fa fa-cart-plus"></i><div style="width:190px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;float:right;" title="Lasagna">Lasagna</div>
							<ul>
								<li class="facturaProductoAdicional" style="font-weight:initial;border-left: 3px solid #46ec46;padding-left: 4px;">Bebidas Ice tea</li>
								<li class="facturaProductoAdicional" style="font-weight:initial;border-left: 3px solid #46ec46;padding-left: 4px;">Papas fritas Mediano</li>
								<div class="clear" style="width:100%;clear:both;"></div>
							</ul>
						</li>
						<li class="td-cantidad" style="width:25px;float:left;font-weight:initial;">(3)</li> 
						<li class="td-precio" style="width:100px;float:left;font-weight:initial;text-align:right;">250.00</li> 
						<li class="td-close" title="Remover" style="width:5px;float:left;font-weight:initial;text-align:right;margin-left:10px;cursor:pointer;">×</li>
						<div class="notaProducto" data-nota="" style="font-weight:initial;color:#c1c1c1;width:100%;clear:both;"></div>
					</ul>
				</div>
			</div>
					<label class="Total_label" data-valortotal="0.00" style="width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;font-size: 8px;right: -7px;bottom: 332px;">Total RD$ <span class="total_print"></span></label>
					<label class="Total_label_servicio" data-valortotal="0.00" style="width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;position: absolute;right: -7px;bottom: 353px;">Servicio RD$ <span class="servicio_print"></span></label>
					<label class="Total_label_itbis" data-valortotal="0.00" style="width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;position: absolute;right: -7px;bottom: 371px;">Itbis RD$ <span class="itbis_print"></span></label>
					<label class="Total_label_descuento" data-valortotal="0.00" style="width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;position: absolute;right: -7px;bottom: 390px;">Descuento RD$ <span class="descuento_print"></span></label>
					<label class="Total_label_subtotal" data-valortotal="0.00" style="width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;position: absolute;right: -7px;bottom: 408px;">SubTotal RD$ <span class="subtotal_print"></span></label>
			
			<div style=" display:block;margin-top:50px;width:100%;text-align:right;font-size:8px !important;font-weight:bold;position:relative; right:20px !important; ">Forma de pago </div>
			<div style=" display:block;width:100%;text-align:right;position:relative; right:20px !important; ">Efectivo <span class="efectivo_print"></span></div>
			<div style=" display:block;width:100%;text-align:right;position:relative; right:20px !important; ">Credito <span class="credito_print"></span></div>
			<div style=" display:block;width:100%;text-align:right;position:relative; right:20px !important; margin-bottom:0px;">Tarjeta <span class="tarjeta_print"></span></div>
			
			<div style=" display:block;margin-top:4px;width:100%;text-align:right;font-size:8px !important;font-weight:bold;position:relative; right:20px !important; ">Cambio RD$ <span class="cambio_print"></span></div>
			<div style=" display:block;margin-top:4px;width:100%;text-align:left;font-size:8px !important;position:relative; ">Cajero (a) : <span class="cajero_print"></span></div>
			<span style="margin-top:2px;padding-top:0px;display:block;width:100%;text-align:center;border-top:1px solid #777777; margin-bottom:5px;"> GRACIAS POR PREFERIRNOS </span>
		</div>
	</div>
	
	
	<div id="toPrintCierre" style="display:none;">
		<div style="width:100%;font-size:12px;">
			<span style="display:block;width:100%;text-align:center;"> L.R. </span>
			<span style="display:block;width:100%;text-align:center;"> Reporte de cuadre de caja </span>
			
			<span style="display:block;width:300px;"> Fecha : <span class="fecha_print"></span></span>
			
			
			<span style="display:block;margin-top:10px;width:300px;border-top:1px solid #ccc;"> Ventas segun caja </span>
			
			<span style="display:block;width:300px;"> Fondo Apertura : <span class="fondoapertura_print" style="float:right;"></span></span>
			<span style="display:block;width:300px;"> Descuento : <span class="descuento_print" style="float:right;"></span></span>
			
			
			<span style="display:block;padding-top:10px;width:300px;"> Desglose de ventas </span>
			<span style="display:block;width:300px;"> Efectivo : <span class="efectivo_print" style="float:right;"></span></span>
			<span style="display:block;width:300px;"> Tarjeta : <span class="tarjeta_print" style="float:right;"></span></span>
			<span style="display:block;width:300px;"> Credito : <span class="credito_print" style="float:right;"></span></span>
			
			
			<span style="display:block;padding-top:10px;width:300px;"> Cobros/Creditos </span>
			<span style="display:block;width:300px;"> Egresos Caja : <span class="egresoscaja_print" style="float:right;"></span></span>
			<span style="display:block;width:300px;"> Ingresos Caja : <span class="ingresoscaja_print" style="float:right;"></span></span>
			
			
			<span style="display:block;padding-top:10px;margin-top:10px;width:300px;border-top:1px solid #ccc;"></span>
			
			<span style="display:block;width:300px;"> Ventas Brutas : <span class="ventasbrutas_print" style="float:right;"></span></span>
			<span style="display:block;width:300px;"> +Egresos-Ingresos : <span class="masegresosmenosingresos_print" style="float:right;"></span></span>
			
			
			<span style="display:block;padding-top:10px;width:300px;"> - Impuestos </span>
			<span style="display:block;width:300px;"> - Itbis : <span class="itbis_print" style="float:right;"></span></span>
				
			
			<span style="display:block;display:block;padding-top:10px;width:300px;"> Ventas Netas : <span class="ventasnetas_print" style="float:right;"></span></span>
			
			<span style="display:block;padding-top:10px;width:300px;"> No. de Facturas : <span class="nofacturas_print" style="float:right;"></span></span>
			<span style="display:block;width:300px;"> Promedio : <span class="promedio_print" style="float:right;"></span></span>
			<span style="display:block;width:300px;"> No. de Visitantes : <span class="novisitantes_print" style="float:right;"></span></span>
			
			
			<span style="display:block;padding-top:10px;width:300px;"> Diferencia Efectivo : <span class="diferenciaefectivo_print" style="float:right;"></span></span>
			<span style="display:block;width:300px;"> Diferencia Tarjeta : <span class="diferenciatarjeta_print" style="float:right;"></span></span>
			

			<span style="display:block;padding-top:2px;padding-top:0px;display:block;width:100%;text-align:center;border-top:1px solid #777777; margin-bottom:5px;">  </span>
		</div>
	</div>
	
	<div id="toPrintProductosCierre" style="display:none;">
		<div style="width:100%;font-size:12px;">
			<span style="display:block;width:100%;text-align:center;"> L.R. </span>
			<span style="display:block;width:100%;text-align:center;"> Reporte de productos </span>
			
			<span style="display:block;width:300px;"> Fecha : <span class="fecha_print"></span></span>
			
			
			<span style="display:block;margin-top:10px;width:300px;border-top:1px solid #ccc;">  </span>
			
			<div class="productList">
				
				
			</div>
			
			<span style="display:block;padding-top:2px;padding-top:0px;display:block;width:100%;text-align:center;border-top:1px solid #777777; margin-bottom:5px;">  </span>
		</div>
	</div>
	
	<div id="modalAnularFactura" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:347px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalAnularFactura" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-info fa-2x"></i> Anular factura</h4>
				</div>
				<form id="formAnularFactura" action="AnularFactura" method="post">
					<div class="modal-body tipos">
						Esta accion no podra deshacerse. ¿Esta seguro que desea anular esta factura?
						<input type="hidden" id="idFactura" name="idFactura" value="">
						<div style="display:block;width:100%;clear:both;"></div>
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarAnularFactura" type="button" class="btn btn-default" data-dismiss="modal">Volver</a>
						<a id="GuardarAnularFactura" type="button" class="btn btn-success" data-dismiss="modal">Aceptar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modalAnularFacturaActual" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:347px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalAnularFacturaActual" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-info fa-2x"></i> Anular factura</h4>
				</div>
				<form id="formAnularFacturaActual" action="AnularFactura" method="post">
					<div class="modal-body tipos">
						Esta accion no podra deshacerse. ¿Esta seguro que desea anular esta factura?
						<div style="display:block;width:100%;clear:both;"></div>
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarAnularFacturaActual" type="button" class="btn btn-default" data-dismiss="modal">Volver</a>
						<a id="GuardarAnularFacturaActual" type="button" class="btn btn-success" data-dismiss="modal">Aceptar</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="modalPago" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:600px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalPago" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-shopping-cart fa-2x"></i> Pago</h4>
				</div>
				<form id="formPago" action="mensajero" method="post">
					<div class="modal-body pagos">
						<div style="position:relative;height:70px;margin:0px auto;margin-bottom: 42px;border-bottom:1px solid #dddddd;">
							<div style="display:block;width:48%;float:left;text-align:center;">
								<span>Monto a pagar</span><br/>
								<span class="montoAPagar" data-valor="0.00" style="font-weight:bold;font-size:18px;">RD$ 0.00</span>
							</div>
							<div style="display:block;width:48%;float:left;text-align:center;">
								<span>Cambio</span><br/>
								<span class="montoCambio" data-valor="0.00" style="font-weight:bold;font-size:18px;">RD$ 0.00</span>
							</div>
							<div class="clear"></div>
						</div>
						<div style="position:relative;height:70px;margin:0px auto;">
							<div style="display:block;width:48%;float:left;text-align:center;margin-top: 11px;font-size: 14px;font-weight: bold;">
								<span>Efectivo</span>
							</div>
							<div style="display:block;width:48%;float:left;text-align:center;">
								<input type="text" class="textPagoEfectivo withScreenKeyboard" value="" placeholder="Monto efectivo" style="font-weight:bold;">
								
							</div>
							<div class="clear"></div>
						</div>
						<div style="position:relative;height:70px;margin:0px auto;">
							<div style="display:block;width:48%;float:left;text-align:center;margin-top: 11px;font-size: 14px;font-weight: bold;">
								<span>Credito</span>
							</div>
							<div style="display:block;width:48%;float:left;text-align:center;">
								<input type="text" class="textPagoCredito withScreenKeyboard" value="" placeholder="Monto credito" style="font-weight:bold;">
								
							</div>
							<div class="clear"></div>
						</div>
						<div style="position:relative;height:70px;margin:0px auto;">
							<div style="display:block;width:48%;float:left;text-align:center;margin-top: 11px;font-size: 14px;font-weight: bold;">
								<span>Tarjeta</span>
							</div>
							<div style="display:block;width:48%;float:left;text-align:center;">
								<input type="text" class="textPagoTarjeta withScreenKeyboard" value="" placeholder="Monto tarjeta" style="font-weight:bold;">
								
							</div>
							<div class="clear"></div>
						</div>
						<div style="position:relative;height:70px;margin:0px auto;">
							<div class="isDelivery btn btn-warning" data-delivery="0" style="display:block;width:96%;float:left;text-align:center;font-weight:bold;">
								 A domicilio
							</div>
							<div class="clear"></div>
						</div>
						
					</div>
					<div class="modal-body loader" style="display:none;">
							<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
							<span>Procesando...</span>
						<div style="display:block;width:100%;clear:both;"></div>
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarPago" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarPago" type="button" class="btn btn-success" data-dismiss="modal">Pagar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modalListMensajeros" data-id="modalTabFacturas" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:400;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalListMensajeros" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-clone fa-2x"></i> Mensajeros</h4>
				</div>
				<form id="formListMensajeros" action="mensajero" method="post" onSubmit="return false;">
					<input type="hidden" id="ismensajero">
					<input type="hidden" id="idmensajero">
					
					<div class="modal-body">
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarListMensajeros" type="button" class="btn btn-default" data-dismiss="modal">Aceptar</a>
						<a id="GuardarListMensajeros" type="button" class="btn btn-default" data-dismiss="modal" style="display:none;">Aceptar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modalPagoTarjeta" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:347px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalPagoTarjeta" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-credit-card fa-2x"></i> Tarjeta</h4>
				</div>
				<form id="formPagoTarjeta" action="mensajero" method="post">
					<div class="modal-body tipos">
						<div style="position:relative;display:block;height:30px;margin:0px auto;">
							<div class="pago" id="efectivo" style="display:block;float:left;width:100px;height:30px;padding:5px;margin-right:5px;margin-bottom:5px;background:#01DF3A;color:#fff;font-weight:bold;cursor:pointer;position:relative;">Efectivo </i></div>
							<div class="pago" id="credito" style="display:block;float:left;width:100px;height:30px;padding:5px;margin-right:5px;margin-bottom:5px;background:#FFBF00;color:#fff;font-weight:bold;cursor:pointer;position:relative;">Credito </div>
							<div class="pago" id="tarjeta" style="display:block;float:left;width:100px;height:30px;padding:5px;margin-right:5px;margin-bottom:5px;background:#00BFFF;color:#fff;font-weight:bold;cursor:pointer;position:relative;">Tarjeta </div>
						</div>
						<div class="modal-body tarjeta" style="display:;margin-top:20px;">
							<input type="text" class="montoPagarTarjeta" style="float:right;width:150px;text-align:right;" placeholder="Monto tarjeta">
							<input type="text" class="montoPagarEfectivo" style="float:right;width:150px;text-align:right;" placeholder="Monto efectivo">
							<input type="text" class="montoPagarCambio" style="float:right;width:150px;text-align:right;" placeholder="Monto a pagar" readonly="readonly">
						</div>
						<div style="display:block;width:100%;clear:both;"></div>
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarPagoTarjeta" type="button" class="btn btn-default" data-dismiss="modal">Volver</a>
						<a id="GuardarPagoTarjeta" type="button" class="btn btn-success" data-dismiss="modal">Pagar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modalPagoEfectivo" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:347px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalPagoEfectivo" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-usd fa-2x"></i> Efectivo</h4>
				</div>
				<form id="formPagoEfectivo" action="mensajero" method="post">
					<div class="modal-body tipos">
						<div style="position:relative;display:block;height:30px;margin:0px auto;">
							<div class="pago" id="efectivo" style="display:block;float:left;width:100px;height:30px;padding:5px;margin-right:5px;margin-bottom:5px;background:#01DF3A;color:#fff;font-weight:bold;cursor:pointer;position:relative;">Efectivo </i></div>
							<div class="pago" id="credito" style="display:block;float:left;width:100px;height:30px;padding:5px;margin-right:5px;margin-bottom:5px;background:#FFBF00;color:#fff;font-weight:bold;cursor:pointer;position:relative;">Credito </div>
							<div class="pago" id="tarjeta" style="display:block;float:left;width:100px;height:30px;padding:5px;margin-right:5px;margin-bottom:5px;background:#00BFFF;color:#fff;font-weight:bold;cursor:pointer;position:relative;">Tarjeta </div>
						</div>
						<div class="modal-body efectivo" style="display:;margin-top:20px;">
							<input type="text" class="montoPagarEfectivo" style="float:right;width:150px;text-align:right;" placeholder="Monto efectivo">
							<input type="text" class="montoPagarCambio" style="float:right;width:150px;text-align:right;" placeholder="Monto a pagar" readonly="readonly">
						</div>
						<div style="display:block;width:100%;clear:both;"></div>
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarPagoEfectivo" type="button" class="btn btn-default" data-dismiss="modal">Volver</a>
						<a id="GuardarPagoEfectivo" type="button" class="btn btn-success" data-dismiss="modal">Pagar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modalPagoCredito" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:347px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalPagoCredito" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-credit-card fa-2x"></i> Credito</h4>
				</div>
				<form id="formPagoCredito" action="mensajero" method="post">
					<div class="modal-body tipos">
						<div style="position:relative;display:block;height:30px;margin:0px auto;">
							<div class="pago" id="efectivo" style="display:block;float:left;width:100px;height:30px;padding:5px;margin-right:5px;margin-bottom:5px;background:#01DF3A;color:#fff;font-weight:bold;cursor:pointer;position:relative;">Efectivo </i></div>
							<div class="pago" id="credito" style="display:block;float:left;width:100px;height:30px;padding:5px;margin-right:5px;margin-bottom:5px;background:#FFBF00;color:#fff;font-weight:bold;cursor:pointer;position:relative;">Credito </div>
							<div class="pago" id="tarjeta" style="display:block;float:left;width:100px;height:30px;padding:5px;margin-right:5px;margin-bottom:5px;background:#00BFFF;color:#fff;font-weight:bold;cursor:pointer;position:relative;">Tarjeta </div>
						</div>
						<div class="modal-body efectivo" style="display:;margin-top:20px;">
							<input type="text" class="montoPagarCambio" style="float:right;width:150px;text-align:right;" placeholder="Monto a pagar" readonly="readonly">
						</div>
						<div style="display:block;width:100%;clear:both;"></div>
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarPagoCredito" type="button" class="btn btn-default" data-dismiss="modal">Volver</a>
						<a id="GuardarPagoCredito" type="button" class="btn btn-success" data-dismiss="modal">Pagar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modalLoader" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:347px;">
			<div class="modal-content">
				<div class="modal-header" style="display:none;">
					<button  id="closeModalLoader" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-shopping-cart fa-2x"></i> Pago</h4>
				</div>
				<form id="formPago" action="mensajero" method="post">
					<div class="modal-body loader">
							<i class="fa fa-refresh fa-spin fa-3x fa-fw"></i>
							<span class="loaderTitle">Procesando...</span><br/>
							<span class="loaderProcess" style="font-size:12px;width: 100%;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;"></span>
						<div style="display:block;width:100%;clear:both;"></div>
					</div>
					<div class="modal-footer" style="display:none;">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarPago" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
					</div>
				</form>
			</div>
		</div>
	</div>

	<div id="modalNota" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalNota" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-sticky-note fa-2x"></i> Escribir Nota</h4>
				</div>
				<form id="formNota" action="mensajero" method="post">
					<div class="modal-body">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<label style="font-size: 20px; font-family: Arial;">Nota</label>
							<textarea name="textNota" id="notafactura" class="withScreenKeyboard" placeholder="Escriba aqui su nota" style="max-width: 100%; max-height: 200px; min-width: 100%; min-height: 200px;"></textarea>
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarNota" type="button" class="btn btn-default" data-dismiss="modal">Aceptar</a>
						
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="modalDescuento" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalDescuento" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-tag"></i> Descuento </h4>
				</div>
				<form id="formDescuento" action="Descuento" method="post">
					<div class="modal-body">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							
							<input id="descuento" type="text" name="descuento" class="text withScreenKeyboard" value="" placeholder="Descuento">
							
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarDescuento" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarDescuento" type="button" class="btn btn-success" data-dismiss="modal">Aceptar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	
	
	
	

</div>


	
	<!-- Modal -->
	<div id="modalAccessKey" class="modul" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalAccessKey" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-lock"></i> Seguridad </h4>
				</div>
				<form id="formAccessKey" action="categorias" method="post">
					<div class="modal-body">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							
							<input type="hidden" id="id" name="id" value="">
							
							<input id="accessKey" type="password" name="accessKey" class="text withScreenKeyboard" value="" placeholder="Clave de acceso">
							
						
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarAccessKey" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarAccessKey" type="button" class="btn btn-success" data-dismiss="modal">Aceptar</a>
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
	
	
	
	<style>
		#modalScreenKeyboard #formScreenKeyboard a {
			margin: 2px 1px !important;
			padding: 7px 24px;
		}
		#modalScreenKeyboardHidden #formScreenKeyboard a {
			margin: 2px 1px !important;
			padding: 7px 24px;
		}
	</style>
	<!-- Modal -->
	<div id="modalScreenKeyboard" class="modul" style="display:none;position:absolute;bottom:0px;left:0px;width:100%;height:285px;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:100000000;">
		<div class="modal-dialog" role="document" style="margin:0px;width:100%;">
			<div class="modal-content" style="position: absolute;top: 0px;left: 0px;width: 100%; height: 285px;background:none;">
				
				<form id="formScreenKeyboard" action="categorias" method="post">
					<div class="modal-body" style="padding:10px;">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							
							<input type="hidden" id="id" name="id" value="">
							
							<div class="AllKeys" style="margin:0px auto;text-align:center;">
							
								<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
								<a id="ESC" type="button" class="btn btn-default" data-dismiss="modal">ESC</a>
								<a id="1" type="button" class="btn btn-default" data-dismiss="modal">1</a>
								<a id="2" type="button" class="btn btn-default" data-dismiss="modal">2</a>
								<a id="3" type="button" class="btn btn-default" data-dismiss="modal">3</a>
								<a id="4" type="button" class="btn btn-default" data-dismiss="modal">4</a>
								<a id="5" type="button" class="btn btn-default" data-dismiss="modal">5</a>
								<a id="6" type="button" class="btn btn-default" data-dismiss="modal">6</a>
								<a id="7" type="button" class="btn btn-default" data-dismiss="modal">7</a>
								<a id="8" type="button" class="btn btn-default" data-dismiss="modal">8</a>
								<a id="9" type="button" class="btn btn-default" data-dismiss="modal">9</a>
								<a id="0" type="button" class="btn btn-default" data-dismiss="modal">0</a>
								<a id="-" type="button" class="btn btn-default" data-dismiss="modal">-</a>
								<a id="BACK" type="button" class="btn btn-default" data-dismiss="modal">BACK</a>
								<br/>
								
								<a id="q" type="button" class="btn btn-default" data-dismiss="modal">Q</a>
								<a id="w" type="button" class="btn btn-default" data-dismiss="modal">W</a>
								<a id="e" type="button" class="btn btn-default" data-dismiss="modal">E</a>
								<a id="r" type="button" class="btn btn-default" data-dismiss="modal">R</a>
								<a id="t" type="button" class="btn btn-default" data-dismiss="modal">T</a>
								<a id="y" type="button" class="btn btn-default" data-dismiss="modal">Y</a>
								<a id="u" type="button" class="btn btn-default" data-dismiss="modal">U</a>
								<a id="i" type="button" class="btn btn-default" data-dismiss="modal">I</a>
								<a id="o" type="button" class="btn btn-default" data-dismiss="modal">O</a>
								<a id="p" type="button" class="btn btn-default" data-dismiss="modal">P</a>
								<a id="ENTER" type="button" class="btn btn-default" data-dismiss="modal">ENTER</a>
								<br/>
								<a id="a" type="button" class="btn btn-default" data-dismiss="modal">A</a>
								<a id="s" type="button" class="btn btn-default" data-dismiss="modal">S</a>
								<a id="d" type="button" class="btn btn-default" data-dismiss="modal">D</a>
								<a id="f" type="button" class="btn btn-default" data-dismiss="modal">F</a>
								<a id="g" type="button" class="btn btn-default" data-dismiss="modal">G</a>
								<a id="h" type="button" class="btn btn-default" data-dismiss="modal">H</a>
								<a id="j" type="button" class="btn btn-default" data-dismiss="modal">J</a>
								<a id="k" type="button" class="btn btn-default" data-dismiss="modal">K</a>
								<a id="l" type="button" class="btn btn-default" data-dismiss="modal">L</a>
								<a id="ñ" type="button" class="btn btn-default" data-dismiss="modal">Ñ</a>
								
								<br/>
								<a id="CAPSLOCK" type="button" class="btn btn-default" data-dismiss="modal" style="display:none;">SHIFT</a>
								<a id="z" type="button" class="btn btn-default" data-dismiss="modal">Z</a>
								<a id="x" type="button" class="btn btn-default" data-dismiss="modal">X</a>
								<a id="c" type="button" class="btn btn-default" data-dismiss="modal">C</a>
								<a id="v" type="button" class="btn btn-default" data-dismiss="modal">V</a>
								<a id="b" type="button" class="btn btn-default" data-dismiss="modal">B</a>
								<a id="n" type="button" class="btn btn-default" data-dismiss="modal">N</a>
								<a id="m" type="button" class="btn btn-default" data-dismiss="modal">M</a>
								<a id="," type="button" class="btn btn-default" data-dismiss="modal">,</a>
								<a id="." type="button" class="btn btn-default" data-dismiss="modal">.</a>
								<br/>
								<a id=" " type="button" class="btn btn-default" data-dismiss="modal" style="width:500px;">SPACE</a>
								
								<div class="clear"></div>
							</div>
							
						
					</div>
				</form>
				
				<span style="display:none;">{{ 'Memoria usada: ' . round(memory_get_usage() / 1024,1) . ' KB de ' . round(memory_get_usage(1) / 1024,1) . ' KB' }}</span>
				
				<a id="inhabilitarScreenKeyboard" type="button" class="btn btn-link" data-dismiss="modal" style="position:absolute;right:0px;bottom:0px;color:white;">
					<i class="fa fa-keyboard-o" aria-hidden="true" style="padding:0px;margin:0px;"></i>
					<!-- <i class="fa fa-sort-desc" aria-hidden="true" style="padding:0px;margin: 0px;margin-left: 6px;position: absolute;top: 11px;left: 21px;"></i>-->
					<i class="fa fa-ban" aria-hidden="true" style="padding:0px;margin: 0px;margin-left: 6px;position: absolute;top: 10px;left: 28px;font-size:14px;color:red;"></i>
				</a>
				
			</div>
		</div>
	</div>
	<a id="habilitarScreenKeyboard" type="button" class="btn btn-link" data-dismiss="modal" style="display:none;position:absolute;right:0px;bottom:0px;z-index:100000000;background:rgba(255,255,255,1);outline-color:invert;"><i class="fa fa-keyboard-o" aria-hidden="true"></i></a>
	
	
	
<!-- <div>

</div> -->
@stop
@section('custom-js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
@stop

<script type="text/javascript" src="{{ asset('public/assets/js/jquery-2.2.2.js') }}"></script>

<script>
	
	/*****************************************************/
		
		(function ($) {
			var _oldShow = $.fn.show;

			$.fn.show = function (/*speed, easing, callback*/) {
				var argsArray = Array.prototype.slice.call(arguments),
					duration = argsArray[0],
					easing,
					callback,
					callbackArgIndex;

				// jQuery recursively calls show sometimes; we shouldn't
				//  handle such situations. Pass it to original show method.
				if (!this.selector) {
					_oldShow.apply(this, argsArray);
					return this;
				}

				if (argsArray.length === 2) {
					if ($.isFunction(argsArray[1])) {
						callback = argsArray[1];
						callbackArgIndex = 1;
					} else {
						easing = argsArray[1];
					}
				} else if (argsArray.length === 3) {
					easing = argsArray[1];
					callback = argsArray[2];
					callbackArgIndex = 2;
				}

				return $(this).each(function () {
					var obj = $(this),
						oldCallback = callback,
						newCallback = function () {
							if ($.isFunction(oldCallback)) {
								oldCallback.apply(obj);
							}

							obj.trigger('afterShow');
						};

					if (callback) {
						argsArray[callbackArgIndex] = newCallback;
					} else {
						argsArray.push(newCallback);
					}

					obj.trigger('beforeShow');

					_oldShow.apply(obj, argsArray);
				});
			};
		})(jQuery);
		/*****************************************************/
	
	$(document).ready(function(){
		
		var itbis = 0.18; // Correspondiente al itbis

		/*****************************************************/
			$.fn.selectOff = function() {
				return this
					.attr('unselectable', 'on')
					.css('user-select', 'none')
					.on('selectstart', false);
			};
			$(document).on(".Order_box .Order_table .tbody ul").selectOff();
			$(document).on(".Order_box .Order_table .tbody li").selectOff();
			$(document).on(".Order_box .Order_table .tbody ul div").selectOff();
			$(".panel-heading").selectOff();
		
		/**********************************************************/
		
		/** Funcion hold button .categorias ******************/
		/*****************************************************/
			$(document).on('click','.categorias .editarCategoria',function(){
				
				var idcategoria = $(this).attr('data-id');
				var nombrecategoria = $(this).attr('data-nombrecategoria');
				var descripcion = $(this).attr('data-descripcion');
				var bgcolor = $(this).attr('data-bgcolor');
				
					
					$('#modalActualizarCategoria #formActualizarCategoria #idcategoria').val(idcategoria);
					$('#modalActualizarCategoria #formActualizarCategoria #bgcolor').val(bgcolor);
					$('#modalActualizarCategoria #formActualizarCategoria #nombrecategoria').val(nombrecategoria);
					$('#modalActualizarCategoria #formActualizarCategoria #descripcion').val(descripcion);
					
					$('#modalActualizarCategoria').fadeIn('fast');
				

				return false;
			});
		/**********************************************************/
		
		/** Funcion hold button .productos ******************/
		/*****************************************************/
			$(document).on('click','.productos .editarProducto',function(){
				
				var idproducto = $(this).attr('data-id');
				var nombrecategoria = $(this).attr('data-nombre');
				var descripcion = $(this).attr('data-descripcion');
				var precio = $(this).attr('data-precio');
				var bgcolor = $(this).attr('data-bgcolor');
				
					
					$('#modalActualizarProducto #formActualizarProducto #idproducto').val(idproducto);
					$('#modalActualizarProducto #formActualizarProducto #bgcolor').val(bgcolor);
					$('#modalActualizarProducto #formActualizarProducto #nombreProducto').val(nombrecategoria);
					$('#modalActualizarProducto #formActualizarProducto #descripcion').val(descripcion);
					$('#modalActualizarProducto #formActualizarProducto #precio').val(precio);
					
					var dominio = document.domain;
					var asunto = 'getproductoadicionales';
					//var statusresult;
					
					//var categoriaid = $(this).attr('data-id');
					//var categoriamadre = $(this).attr('data-categoriamadre');
					
					var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
					{ 
						asunto: asunto,
						idproducto: idproducto
					}, function(data,status){
						if(status == "success"){
							//alert("Success");
							var datos = data.data;
							//var datos2 = data.data2;
							//var datos3 = data.data3;
							$('#modalActualizarProducto #listaAdicionales .selected').removeClass('selected');
							
							var countAdicionales = 0;
							$.each(datos, function ( index, value ) {
								countAdicionales++;
								
								$('#modalActualizarProducto #listaAdicionales').find('#'+value['adicionalID']).addClass('selected');
							});
							contarCategoriasAdicionales();
						}
					});
					
					$('#modalActualizarProducto').fadeIn('fast');
				

				return false;
			});

		/**********************************************************/
		
		/** Shortcuts *********************************************/
		/**********************************************************/
		$('body').keydown(function(event) {
			
			if(event.which == 113) { //F2
				//updateMtr();
				return false;
			}
			else if(event.which == 114) { //F3 -- Clientes
				//resetView();
				$('#modalBuscarCliente').fadeIn('fast');
				$('#buscadorCliente').focus();
				return false;
			}
			else if(event.which == 115) { //F4 -- Buscar productos
				$('#textBuscarProductos').focus();
				return false;
			}
			else if(event.which == 116) { //F5
				modalPago();
				return false;
			}
			else if(event.which == 117) { //F6
				
				return false;
			}
			else if(event.which == 118) { //F7
				//resetView();
				return false;
			}
			else if(event.which == 119) { //F8 -- Aplica descuento a la factura actual
				callModalAccessKey('modalDescuento');
				return false;
			}
			else if(event.which == 120) { //F9
				//resetView();
				showUltimasFacturas();
				return false;
			}
			else if(event.which == 121) { //F10
				//resetView();
				return false;
			}
			else if(event.which == 122) { //F11
				//resetView();
				
				
				event.preventDefault();
				
				imprSelec('.Order_box');
				return false;
			}
			else if(event.which == 123) { //F12
				$('.cierreCaja').click();
				return false;
			}
			else if(event.which == 27) { //ESC
				//resetView();
				$('.modul').fadeOut('fast');
				return false;
			}
			else if(event.which == 70 && event.ctrlKey && event.shiftKey ) { //CTRL SHIFT F
				event.preventDefault();
				//alert("CTRL + SHIFT + F Pressed");
				$('#sidebar-wrapper #mostrarFacturas').click();
				return false;
			}
			else if(event.ctrlKey && event.which == 70) { //CTRL + F
				event.preventDefault();
				//alert("CTRL + F Pressed");
				changeIntoFacturas();
				return false;
			}
			else if(event.ctrlKey && event.which == 81) { //CTRL + Q
				// Show modal to close cashier sesion
				return false;
			}
		});
		
		/**********************************************************/
			function addCommas(str) {
				var parts = (str + "").split("."),
					main = parts[0],
					len = main.length,
					output = "",
					first = main.charAt(0),
					i;

				if (first === '-') {
					main = main.slice(1);
					len = main.length;    
				} else {
					first = "";
				}
				i = len - 1;
				while(i >= 0) {
					output = main.charAt(i) + output;
					if ((len - i) % 3 === 0 && i > 0) {
						output = "," + output;
					}
					--i;
				}
				// put sign back
				output = first + output;
				// put decimal part back
				if (parts.length > 1) {
					output += "." + parts[1];
				}
				return output;
			}
		
		/**********************************************************/
		
		/**********************************************************/
			function addZero(i) {
				if (i < 10) {
					i = "0" + i;
				}
				return i;
			}
			
			function getFecha(){
				var today = new Date();
				
				var ss = addZero(today.getSeconds());
				var ii = addZero(today.getMinutes());
				var hh = addZero(today.getHours());
				
				var dd = addZero(today.getDate());
				var mm = addZero(today.getMonth()+1); //January is 0!

				var yyyy = today.getFullYear();
				 
				var todayStr = yyyy+'-'+mm+'-'+dd+' '+hh+':'+ii+':'+ss;
				
				return todayStr;
			}
			
			function getFechaAllTogether(){
				var today = new Date();
				
				var ss = addZero(today.getSeconds());
				var ii = addZero(today.getMinutes());
				var hh = addZero(today.getHours());
				
				var dd = addZero(today.getDate());
				var mm = addZero(today.getMonth()+1); //January is 0!

				var yyyy = today.getFullYear();
				 
				var todayStr = yyyy+mm+dd+hh+ii+ss;
				
				return todayStr;
			}
		/**********************************************************/
		
		
		/**********************************************************/
		$('form').submit(function(){
			return false;
		});
		/**********************************************************/
		
		var idcategoriamadre = 0; //Usado para la creacion de categorias y productos en la categoria madre actual, inicialmente es cero ya que la categoria principal es cero
		var	idcategoriamadreback; //Usado para guardar la categoria madre
		
		/** Cuenta categorias y productos actuales en la pantalla
		********************************************************/
		var countCategorias = 0;
		var countProductos = 0;
		
		function contarCategoriasProductos(menosCategoria = 0,menosProducto = 0){
			countCategorias = $(".categorias").length; //Usado para contar todas las categorias presentes
			countProductos = $(".productos").length;	//Usado para contar todos los productos presentes
		
			$('#conteoCategorias').text(countCategorias - menosCategoria);
			$('#conteoProductos').text(countProductos - menosProducto);
		}
		
		contarCategoriasProductos();
		/*******************************************************/
		
		/** Cuenta todas las categorias adicionales y las que estan seleccionadas
		************************************************************************/
		var countCategoriasAdicionales = 0;
		var countCategoriasAdicionalesSelected = 0;
		
		var countCategoriasAdicionalesActualizar = 0;
		var countCategoriasAdicionalesSelectedActualizar = 0;
		
		function contarCategoriasAdicionales(){
			/** Conteo de los adicionales selected on creating products **/
			/*************************************************************/
			countCategoriasAdicionales = $('#modalAgregarProducto .listaAdicionales .categoriasAdicionales').length;
			countCategoriasAdicionalesSelected = $('#modalAgregarProducto .listaAdicionales .selected').length;
			
			$('#modalAgregarProducto .conteoAdicionales').text(countCategoriasAdicionales);
			$('#modalAgregarProducto .conteoAdicionalesSelected').text(countCategoriasAdicionalesSelected);
			
			/** Conteo de los adicionales selected on updating products **/
			/*************************************************************/
			countCategoriasAdicionalesActualizar = $('#modalActualizarProducto .listaAdicionales .categoriasAdicionales').length;
			countCategoriasAdicionalesSelectedActualizar = $('#modalActualizarProducto .listaAdicionales .selected').length;
			
			$('#modalActualizarProducto .conteoAdicionales').text(countCategoriasAdicionalesActualizar);
			$('#modalActualizarProducto .conteoAdicionalesSelected').text(countCategoriasAdicionalesSelectedActualizar);
		}
		
		contarCategoriasAdicionales();
		/******************************************************/
		
		/********************************************************************/
		var countModalBodyProducto = $("#modalVentaProducto .modal-body").length; //Representa el conteo de todos los adicionales del producto actual seleccionado
		var actualModalBodyProducto = 0;
		function showModalBodyProducto(index){
			countModalBodyProducto = $("#modalVentaProducto .modal-body").length;
			
			$('#formVentaProducto .modal-body').hide();
			$('#formVentaProducto .'+index).fadeIn('fast');
			
			if(actualModalBodyProducto < 1){
				$('#modalVentaProducto .modal-back').fadeTo('fast',0.2);
			}
			if(actualModalBodyProducto > (countModalBodyProducto - 2)){
				$('#modalVentaProducto .modal-forward').fadeTo('fast',0.2);
			}
			if(actualModalBodyProducto > 0){
				$('#modalVentaProducto .modal-back').fadeTo('fast',1);
			}
			if(actualModalBodyProducto < (countModalBodyProducto - 1)){
				$('#modalVentaProducto .modal-forward').fadeTo('fast',1);
			}
		}
		function forwardModalBodyProducto(){
			if(actualModalBodyProducto < (countModalBodyProducto - 1)){
				actualModalBodyProducto++;
				showModalBodyProducto(actualModalBodyProducto);
			}
		}
		function backModalBodyProducto(){
			if(actualModalBodyProducto > 0){
				actualModalBodyProducto = actualModalBodyProducto - 1;
				showModalBodyProducto(actualModalBodyProducto);
			}
		}
		
		$('#modalVentaProducto .modal-back').click(function(){
			backModalBodyProducto();
		});
		$('#modalVentaProducto .modal-forward').click(function(){
			forwardModalBodyProducto();
		});
		
		//Functions modalVentaProducto
			$(document).on('click','.display2 .productos',function(){
				
				var productoid = $(this).attr('data-id');
				
				var dominio = document.domain;
				var asunto = 'getproducto';
				//var statusresult;
				
				//var categoriaid = $(this).attr('data-id');
				//var categoriamadre = $(this).attr('data-categoriamadre');
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					productoid: productoid
				}, function(data,status){
					if(status == "success"){
						//alert("Success");
						
						$('#modalAgregarCategoria').fadeOut('fast');
						actualModalBodyProducto = 0;
						//$( ".categorias" ).remove();
						

						/* if(categoriaid != categoriamadre){
							$( ".display" ).append( "<div class=\"categorias\" id=\"categoriasBack\"  data-id=\""+categoriamadre+"\" data-categoriamadre=\"0\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\"><i class=\"fa fa-4x fa-arrow-left\";\"></i></div>" );
						} */
						$( "#formVentaProducto .modal-body" ).remove();
						var value = data.data[0];
						var modalbodyproducto = "<div class=\"modal-body 0\" data-id='" + value['id'] + "' data-nombreproducto=\""+value['nombre']+"\" data-descripcionproducto=\""+value['descripcion']+"\" data-precioproducto=\""+value['precio']+"\" style=\"margin:0px auto;width:600px;height:290px;float:left;\"> <i class=\"fa fa-newspaper-o\" aria-hidden=\"true\"></i> <span style=\"font-weight:bold;font-size:17px;color:#2E9AFE;\">"+value['nombre']+"</span><span class=\"comentario\"> <i class=\"fa fa-minus\" aria-hidden=\"true\"></i>"+value['descripcion']+"</span><div style=\"text-align:right;margin-top:5px;width:100%;height:;border-top:0px solid #cccccc;\"><span class='precio' data-precio=\""+value['precio']+"\" style=\"float:left;font-weight:bold;font-size:20px;color:red;\">$"+value['precio']+"</span></div><div style=\"float:right;text-align:right;margin-top:20px;width:100%;height:;border-top:0px solid #cccccc;\"><span class=\"btn btn-info restarCantidad\"><i class=\"fa fa-chevron-left\" aria-hidden=\"true\"></i></span><span class=\"cantidadProducto btn btn-info\" data-cantidadproducto=\"1\" style=\"font-weight:bold;font-size:25px;margin-left:0px;margin-right:0px;\">1</span><span class=\"btn btn-info sumarCantidad\"><i class=\"fa fa-chevron-right\" aria-hidden=\"true\"></i></span></div><div style=\"float:right;text-align:right;padding:10px;margin-top:20px;background:;width:100%;height:;border-top:2px solid #f1f1f1;\"><span class=\"valorTotalProducto\" data-valortotal=\""+value['precio']+"\" style=\"font-weight:bold;font-size:35px;color:red;\">$"+value['precio']+"</span></div></div>";
							$( "#formVentaProducto" ).prepend( modalbodyproducto );
						//});
						 
						var datos2 = data.data2;
						var datos3 = data.data3;
						var countAdicionales = 0;
						$.each(datos2, function ( index, value2 ) {
							countAdicionales++;
							
							var classAdicionalActual = "#formVentaProducto ."+countAdicionales;
							//$( ".display" ).append( "<div class=\"categorias\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value['nombreCategoria']+"</div>" );
							$( "#formVentaProducto" ).prepend( "<div class=\"modal-body "+countAdicionales+"\" data-nombreadicional=\""+value2['nombreAdicional']+"\" style=\"margin:0px auto;width:600px;height:290px;float:left;\"><span style=\"font-weight:bold;font-size:25px;color:#2E9AFE;\">"+value2['nombreAdicional']+"</span></div>");
							$.each(datos3, function ( index, value3 ) {
								if(value2['adicionalID'] == value3['adicionalID']){
									
									$(classAdicionalActual).append( "<div id='"+value3['id']+"' data-id='"+value3['id']+"' data-divclass='"+countAdicionales+"' class=\"opcionesAdicionalesProducto\" style=\"background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:5px;box-sizing:border-box;width:100%;cursor: pointer;\">"+value3['nombreOpcion']+"</div>" );
								}
							});
						}); 
						
						if($( "#formVentaProducto .modal-body" ).length == 1){
							addProductoToFactura();
							return false;
						}
						
						showModalBodyProducto(0);
						$('#modalVentaProducto').fadeIn('fast');
					}
				});
			});
			$(document).on('click','#formVentaProducto .modal-body .restarCantidad',function(){
				var cantidadproductoactual = $('#formVentaProducto .modal-body .cantidadProducto').attr('data-cantidadproducto');
				if(cantidadproductoactual > 1){
					$('#formVentaProducto .modal-body .cantidadProducto').attr('data-cantidadproducto', (parseInt(cantidadproductoactual) - 1));
					$('#formVentaProducto .modal-body .cantidadProducto').html(parseInt(cantidadproductoactual) - 1);
					
					var valor = parseFloat($('#formVentaProducto .modal-body .precio').attr('data-precio')) * (parseFloat(cantidadproductoactual) - 1);
					
					$('#formVentaProducto .modal-body .valorTotalProducto').html('$' + addCommas(valor.toFixed(2)));
					$('#formVentaProducto .modal-body .valorTotalProducto').attr('data-valortotal',valor.toFixed(2));
				}
			});
			$(document).on('click','#formVentaProducto .modal-body .sumarCantidad',function(){
				var cantidadproductoactual = $('#formVentaProducto .modal-body .cantidadProducto').attr('data-cantidadproducto');
				//if(cantidadproductoactual > 1){
					$('#formVentaProducto .modal-body .cantidadProducto').attr('data-cantidadproducto', (parseInt(cantidadproductoactual) + 1));
					$('#formVentaProducto .modal-body .cantidadProducto').html((parseInt(cantidadproductoactual) + 1));
				//}
				var valor = parseFloat($('#formVentaProducto .modal-body .precio').attr('data-precio')) * (parseFloat(cantidadproductoactual) + 1);
				
				$('#formVentaProducto .modal-body .valorTotalProducto').html('$' + addCommas(valor.toFixed(2)));
				$('#formVentaProducto .modal-body .valorTotalProducto').attr('data-valortotal',valor.toFixed(2));
			});
			$(document).on('click','#formVentaProducto .modal-body .opcionesAdicionalesProducto',function(){
				var divclass = $(this).attr('data-divclass');
				if($(this).hasClass('selected')){
					$(this).removeClass('selected');
				}else{
					$('.'+divclass+' .opcionesAdicionalesProducto').removeClass('selected');
					$(this).addClass('selected');
				}
			});
			$('#closeModalVentaProducto, #CancelarVentaProducto').click(function(){
				event.preventDefault();
				
				$('#modalVentaProducto').fadeOut('fast');
				
				$('#formVentaProducto #notaVentaProducto').val("");
			});
			function calcTotal(){
				/** Calculo del total *****/
					var subtotal = 0;
					$('.Order_box .Order_table .tbody > ul').each(function(index,element){
						subtotal += parseFloat($(element).attr('data-subtotalproducto'));
					});
					
					var subtotalFactura = subtotal;
					var itbisFactura = subtotal * itbis;
					var descuento = parseFloat($('.Order_box .Total_label_descuento').attr('data-valortotal'));
					var servicio = (subtotalFactura / 100) * 10;
					subtotalFactura = subtotalFactura - descuento;
					var total = subtotalFactura + itbisFactura + servicio;
					
					// Total
					$('.Order_box .Total_label').text("Total RD$ " + addCommas(total.toFixed(2)));
					$('.Order_box .Total_label').attr('data-valortotal',total);
					// Itbis
					$('.Order_box .Total_label_itbis').text("Itbis RD$ " + addCommas(itbisFactura.toFixed(2)));
					$('.Order_box .Total_label_itbis').attr('data-valortotal',itbisFactura);
					// Servicio
					$('.Order_box .Total_label_servicio').text("Servicio RD$ " + addCommas(servicio.toFixed(2)));
					$('.Order_box .Total_label_servicio').attr('data-valortotal',servicio);
					// Subtotal
					$('.Order_box .Total_label_subtotal').text("SubTotal RD$ " + addCommas(subtotalFactura.toFixed(2)));
					$('.Order_box .Total_label_subtotal').attr('data-valortotal',subtotalFactura);
					
				/*******/
			}
			function addProductoToFactura(){
				var idProducto = $('#formVentaProducto .0').attr('data-id');
				var nombreProducto = $('#formVentaProducto .0').attr('data-nombreproducto');
				var descripcionProducto = $('#formVentaProducto .0').attr('data-descripcionproducto');
				var precioProducto = $('#formVentaProducto .0').attr('data-precioproducto');
				precioProducto = parseFloat(precioProducto);
				var cantidadProducto = $('#formVentaProducto .0 .cantidadProducto').attr('data-cantidadproducto');
				var subtotalProducto = $('#formVentaProducto .0 .valorTotalProducto').attr('data-valortotal');
				var notaProducto = $('#formVentaProducto #notaVentaProducto').val();
				var adicionalesSelectedVentaProducto = "";

				$('.Order_box .Order_table .tbody').append("<ul class='adding' data-id='"+ idProducto +"' data-nombreproducto='"+ nombreProducto +"' data-precioproducto='"+ precioProducto +"' data-cantidadproducto='"+ cantidadProducto +"' data-subtotalproducto='"+ subtotalProducto +"' data-notaproducto='"+ notaProducto +"' style=\"display:block;margin-top:10px;\"></ul>");
				$('.Order_box .Order_table .tbody .adding').append("<li class=\"td-producto\" style=\"width:210px;float:left;font-weight:bold;\"><i class=\"fa fa-cart-plus\"></i><div style=\"width:190px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;float:right;\" title=\""+nombreProducto+"\">"+nombreProducto+"</div><ul><div class='clear' style=\"width:100%;clear:both;\"></div></ul></li>");
				$('.Order_box .Order_table .tbody .adding').append("<li class=\"td-cantidad\" style=\"width:25px;float:left;font-weight:initial;\">("+cantidadProducto+")</li> <li class=\"td-precio\" style=\"width:100px;float:left;font-weight:initial;text-align:right;\">"+ precioProducto.toFixed(2) +"</li> <li class='td-close' title='Remover' style='width:5px;float:left;font-weight:initial;text-align:right;margin-left:10px;cursor:pointer;'>&times;</li>");
				
				$('#formVentaProducto .modal-body .selected').each(function(index,element){
					var divclass = $(element).attr('data-divclass');
					var adicionalesSelectedVentaProducto = $('#formVentaProducto .' + divclass).attr('data-nombreadicional');
					var OpcionSelectedVentaProducto = $(element).html();
					$('.Order_box .Order_table .tbody .adding .td-producto ul').prepend("<li class=\"facturaProductoAdicional\" style=\"font-weight:initial;border-left: 3px solid #46ec46;padding-left: 4px;\">" + adicionalesSelectedVentaProducto + " " + OpcionSelectedVentaProducto + "</li>");
				});
				$('.Order_box .Order_table .tbody .adding').append("<div class='notaProducto' data-nota=\""+notaProducto+"\" style='font-weight:initial;color:#c1c1c1;width:100%;clear:both;'>" + notaProducto + "</div>");	
				
				//** Cheking if this Product with the same Options has been added ************************************************/
				//****************************************************************************************************************/
				var isFoundSameOptions = false;
				$('.Order_box .Order_table .tbody ul[data-id="'+idProducto+'"]').each(function(index, element){
					if(!$(element).hasClass('adding')){
						var htmlFoundElement = $(element).find('.td-producto').html();
						var htmlAddingElement = $('.Order_box .Order_table .tbody .adding').find('.td-producto').html();
						if(htmlFoundElement == htmlAddingElement){
							isFoundSameOptions = true;
							var masCantidadProducto = parseInt($(element).attr('data-cantidadproducto')) + parseInt(cantidadProducto);
							$(element).attr('data-cantidadproducto', masCantidadProducto);
							$(element).find('.td-cantidad').text('('+masCantidadProducto+')');
							$(element).attr('data-subtotalproducto', (precioProducto * masCantidadProducto));
						}
					}
				});
				/*****************************************************************************************************************/
				
				if(isFoundSameOptions){
					$('.Order_box .Order_table .tbody .adding').remove();
				}else{
					$('.Order_box .Order_table .tbody .adding').removeClass('adding');
				}
				
				calcTotal();
				
				$('#modalVentaProducto').fadeOut('fast');
				$('#formVentaProducto #notaVentaProducto').val("");
			}
			//Validaciones
			$('#GuardarVentaProducto').click(function(){
				if($('#formVentaProducto').find('.opcionesAdicionalesProducto').length != 0){
					// if($('#formVentaProducto .modal-body .opcionesAdicionalesProducto').hasClass('selected')){
					if($('#formVentaProducto .modal-body .selected').length == ($('#formVentaProducto .modal-body').length - 1)){
						addProductoToFactura();
					}else{
						$('#modalVentaProductoAdicionalSelected').fadeIn('fast');
					}
				}else{
					addProductoToFactura();
				}
			});
		/**************************************************************************/
		/** DblClick to delete product from factura *******************************/
			$(document).on('dblclick','.Order_box .Order_table .tbody > ul',function(){
				//$(this).remove();
				calcTotal();
			});
		/**************************************************************************/
			$(document).on('click','.Order_box .Order_table .tbody > ul .td-close',function(){
				$(this).parent("ul").remove();
				calcTotal();
			});
		/**************************************************************************/
			$(document).on('click','.Order_box .Order_table .tbody > ul',function(){
				var notaProducto = $(this).find(".notaProducto").attr('data-nota');
				$(this).find(".notaProducto").html("<input class=\"notaPro withScreenKeyboard\" type='text' name='nota' class='text' value='"+notaProducto+"' placeholder='Escribe un comentario'>");
				$(this).find(".notaProducto .notaPro").focus();
				$(this).find(".notaProducto .notaPro").val($(this).find(".notaProducto .notaPro").val());
			});
			$(document).on('focusout','.notaPro',function(e){
				
				  // var target = e.explicitOriginalTarget||document.activeElement;
				  // alert(target ? target.id||target.tagName||target : '');
				// if( event.delegateTarget == '' ){
					
				// }else{
					// var notaProducto = $(this).val();
					// $(this).parent(".notaProducto").attr('data-nota',notaProducto);
					// $(this).parent(".notaProducto").html(notaProducto);
					// $(this).remove();
				// }
			});
			$(document).on('keydown','.notaPro',function(event){
				if(event.which == 13){
					var notaProducto = $(this).val();
					$(this).parent(".notaProducto").attr('data-nota',notaProducto);
					$(this).parent(".notaProducto").html(notaProducto);
					//$(this).remove();
				}
			});
			$(document).on('click','.notaPro',function(){
				return false;
			});
		/**************************************************************************/
		
		//Functions modalAgregarCategoria
			$('#closeModalVentaProductoAdicionalSelected, #CancelarVentaProductoAdicionalSelected').click(function(){
				event.preventDefault();
				$('#modalVentaProductoAdicionalSelected').fadeOut('fast');
			});
			//Validaciones
			$('#GuardarVentaProductoAdicionalSelected').click(function(){
				$('#modalVentaProductoAdicionalSelected').fadeOut('fast');
				addProductoToFactura();
			});
		//***************************************/
		
		$('#tablaUsuarios').DataTable({
			"dom": '<"top"f>rt<"bottom"p><"clear">',
			"paging":   false,
			"scrollY":  "410px",
			"scrollCollapse": true,
			//"ordering": false,
			"info":     true
		});
		
		$(document).on('click','.categorias, #categoriasBack',function(){
			var dominio = document.domain;
			var asunto = 'entercategoria';
			//var statusresult;
			
			var categoriaNombre = $(this).text();
			var categoriaid = $(this).attr('data-id');
			var categoriamadre = $(this).attr('data-categoriamadre');
			
			idcategoriamadre = categoriamadre;
			//var mensajeroid = $(this).children('.switchestatusmensajero').attr('data-mensajeroid');
			//var estatus = $(this).children('.switchestatusmensajero').attr('data-estatus');
			
			var isBack = false;
			if($(this).attr('id') == 'categoriasBack'){
				isBack = true;
				var cantBreadcrumbs = $('.breadcrumb li').length - 1;
				categoriaid = $('.breadcrumb li:nth-child('+cantBreadcrumbs+') a').attr('data-categoriaid');
			}
			/*
			function switchbutton(newestatus){
				$(this).children('.switchestatusmensajero').attr('data-estatus',newestatus);
			}
			*/
			//$(this).children('.switchestatusmensajero').attr('data-estatus',statusresult);
			
			var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
			{ 
				asunto: asunto,
				categoriaid: categoriaid,
			}, function(data, status){
				if(status == "success"){
					//alert ("Success");
					
					$( ".categorias" ).remove();
					$( ".productos" ).remove();
					
					

					if(categoriaid != categoriamadre){
						$( ".display" ).append( "<div class=\"categorias\" id=\"categoriasBack\"  data-id=\""+categoriamadre+"\" data-categoriamadre=\"0\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;position:relative;border-radius:10px;box-shadow: 1px 1px 3px #000;\"><i class=\"fa fa-4x fa-arrow-left\";\"></i><div class='destello'></div></div>" );
					}
					
					var datos = data.data;
					$.each(datos, function ( index, value ) {
						$( ".display" ).append( "<div class=\"categorias\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-nombrecategoria=\""+value['nombreCategoria']+"\"  data-descripcion=\""+value['Descripcion']+"\"  data-bgcolor=\""+value['bgcolor']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:" + value['bgcolor'] + ";color:#fff;font-weight:bold;cursor:pointer;position:relative;border-radius:10px;box-shadow: 1px 1px 3px #000;\">"+value['nombreCategoria']+"<i class=\"fa fa-folder-open fa-3x\" aria-hidden=\"true\" style=\"position:absolute;right: 10px;top: 52px;opacity: 0.2;\"></i><div class='destello'></div></div>" );
						if($('.uslog').attr('data-rolid') == 4){
							$( ".display .categorias:last" ).append( "<a href=\"#\" class=\"editarCategoria\" data-id=\""+value['id']+"\" data-nombrecategoria=\""+value['nombreCategoria']+"\"  data-descripcion=\""+value['Descripcion']+"\"  data-bgcolor=\""+value['bgcolor']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\"><i class=\"fa fa-edit \" aria-hidden=\"true\"></i></a>" );
						}
					});
					
					var datos2 = data.data2;
					$.each(datos2, function ( index, value2 ) {
						//$( ".display" ).append( "<div class=\"categorias\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value['nombreCategoria']+"</div>" );
						$( ".display2" ).append( "<div class=\"productos\" id=\""+value2['id']+"\" data-id=\""+value2['id']+"\" data-categoriamadre=\""+value2['categoriaid']+"\" data-nombre=\""+value2['nombre']+"\" data-descripcion=\""+value2['descripcion']+"\" data-precio=\""+value2['precio']+"\" data-bgcolor=\""+value2['bgcolor']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:" + value2['bgcolor'] + ";color:#fff;font-weight:bold;cursor:pointer;position:relative;border-radius:10px;box-shadow: 1px 1px 3px #000;\">"+value2['nombre']+" <span style=\"position:absolute;left: 0px;bottom: 0px;display: block;width: 100%;background: rgba(0,0,0,0.5);font-size: 13px;padding-left: 2px;border-radius:0px 0px 10px 10px;\">$" + value2['precio'] + "</span> <i class=\"fa fa-shopping-cart fa-3x\" aria-hidden=\"true\" style=\"position:absolute;right: 10px;top: 52px;opacity: 0.2;\"></i><div class='destello'></div></div>" );
						if($('.uslog').attr('data-rolid') == 4){
							$( ".display2 .productos:last" ).append( "<a href=\"#\" class=\"editarProducto\" data-id=\""+value2['id']+"\"  data-categoriamadre=\""+value2['categoriaid']+"\" data-nombre=\""+value2['nombre']+"\" data-descripcion=\""+value2['descripcion']+"\" data-precio=\""+value2['precio']+"\" data-bgcolor=\""+value2['bgcolor']+"\"><i class=\"fa fa-edit \" aria-hidden=\"true\"></i></a>" );
						}
					});
					
					idcategoriamadre = categoriaid;
					
					if(idcategoriamadre == 0){
						contarCategoriasProductos();
					}else{
						contarCategoriasProductos(1,0);
					}
					
					if(isBack == true){
						$(".breadcrumb li:last-child").remove();
					}else{
						$(".breadcrumb").append("<li class=\"breadcrumbOption\"><a data-categoriaid='"+ idcategoriamadre +"' href='#'>" + categoriaNombre + "</a></li>");
					}

				}
			
				if(status == "error"){
					//alert ("Error");
					
				}
			});
			
		});
		
		
		$("#textBuscarProductos").keydown(function(event) {
			if(event.which == 13) {
				if($(this).val().length < 2) {
					return false;
				}
				var dominio = document.domain;
				var asunto = 'buscarProductos';
				//var statusresult;
				
				var textobuscado = $(this).val();
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					textobuscado: textobuscado,
				}, function(data, status){
					if(status == "success"){
						//alert ("Success");
						
						//$( ".categorias" ).remove();
						$( ".productos" ).remove();
						
						/*

						if(categoriaid != categoriamadre){
							$( ".display" ).append( "<div class=\"categorias\" id=\"categoriasBack\"  data-id=\""+categoriamadre+"\" data-categoriamadre=\"0\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;position:relative;border-radius:10px;box-shadow: 1px 1px 3px #000;\"><i class=\"fa fa-4x fa-arrow-left\";\"></i><div class='destello'></div></div>" );
						}
						
						var datos = data.data;
						$.each(datos, function ( index, value ) {
							$( ".display" ).append( "<div class=\"categorias\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:" + value['bgcolor'] + ";color:#fff;font-weight:bold;cursor:pointer;position:relative;border-radius:10px;box-shadow: 1px 1px 3px #000;\">"+value['nombreCategoria']+"<i class=\"fa fa-folder-open fa-3x\" aria-hidden=\"true\" style=\"position:absolute;right: 10px;top: 52px;opacity: 0.2;\"></i><div class='destello'></div></div>" );
						});
						*/
						var datos2 = data.data2;
						$.each(datos2, function ( index, value2 ) {
							//$( ".display" ).append( "<div class=\"categorias\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value['nombreCategoria']+"</div>" );
							$( ".display2" ).append( "<div class=\"productos\" id=\""+value2['id']+"\" data-id=\""+value2['id']+"\" data-categoriamadre=\""+value2['categoriaid']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:" + value2['bgcolor'] + ";color:#fff;font-weight:bold;cursor:pointer;position:relative;border-radius:10px;box-shadow: 1px 1px 3px #000;\">"+value2['nombre']+" <span style=\"position:absolute;left: 0px;bottom: 0px;display: block;width: 100%;background: rgba(0,0,0,0.5);font-size: 13px;padding-left: 2px;border-radius:0px 0px 10px 10px;\">$" + value2['precio'] + "</span> <i class=\"fa fa-shopping-cart fa-3x\" aria-hidden=\"true\" style=\"position:absolute;right: 10px;top: 52px;opacity: 0.2;\"></i><div class='destello'></div></div>" );
						});
						
						//idcategoriamadre = categoriaid;
						/*
						if(idcategoriamadre == 0){
							contarCategoriasProductos();
						}else{
							contarCategoriasProductos(1,0);
						}
						
						if(isBack == true){
							$(".breadcrumb li:last-child").remove();
						}else{
							$(".breadcrumb").append("<li class=\"breadcrumbOption\"><a data-categoriaid='"+ idcategoriamadre +"' href='#'>" + categoriaNombre + "</a></li>");
						}
						*/
					}
				
					if(status == "error"){
						//alert ("Error");
						
					}
				});
			}
		});
		
		//Functions modalAgregarCategoria
			$('#agregarCategoria').click(function(){
				event.preventDefault();
								
				$('#modalAgregarCategoria').fadeIn('fast');
				
				return false;
			});
			$('#closeModalAgregarCategoria, #CancelarGuardarCategoria').click(function(){
				event.preventDefault();
				$('#modalAgregarCategoria').fadeOut('fast');
			});
			//Validaciones
			$('#GuardarCategoria').click(function(){
				var nombreCategoria = $('#formAgregarCategoria #nombreCategoria').val();
				var descripcion = $('#formAgregarCategoria #descripcion').val();
				var bgcolor = $('#formAgregarCategoria #bgcolor').val();
				
				if(nombreCategoria == ''){
					alert('No ha especificado un nombre!');
					return false;
				}
				
				var dominio = document.domain;
				var asunto = 'agregarcategoria';
				//var statusresult;
				
				//var categoriaid = $(this).attr('data-id');
				//var categoriamadre = $(this).attr('data-categoriamadre');
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					nombreCategoria: nombreCategoria,
					descripcion: descripcion,
					bgcolor: bgcolor,
					idcategoriamadre: idcategoriamadre
				}, function(data,status){
					if(status == "success"){
						//alert("Success");
						
						$('#modalAgregarCategoria').fadeOut('fast');
						
						//$( ".categorias" ).remove();
						//$( ".productos" ).remove();

						/* if(categoriaid != categoriamadre){
							$( ".display" ).append( "<div class=\"categorias\" id=\"categoriasBack\"  data-id=\""+categoriamadre+"\" data-categoriamadre=\"0\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\"><i class=\"fa fa-4x fa-arrow-left\";\"></i></div>" );
						} */
						
						var value = data.data;
						//$.each(datos, function ( index, value ) {
							$( ".display" ).append( "<div class=\"categorias added\" id=\""+value['id']+"\" data-id=\""+value['id']+"\"  data-nombrecategoria=\""+value['nombreCategoria']+"\"  data-descripcion=\""+value['Descripcion']+"\"  data-bgcolor=\""+value['bgcolor']+"\"  data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:" + value['bgcolor'] + ";color:#fff;font-weight:bold;cursor:pointer;position:relative;border-radius:10px;box-shadow: 1px 1px 3px #000;\">"+value['nombreCategoria']+"<i class=\"fa fa-folder-open fa-3x\" aria-hidden=\"true\" style=\"position:absolute;right: 10px;top: 52px;opacity: 0.2;\"></i><div class='destello'></div></div>" );
						//});
						/* 
						var datos2 = data.data2;
						$.each(datos2, function ( index, value2 ) {
						//$( ".display" ).append( "<div class=\"categorias\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value['nombreCategoria']+"</div>" );
						$( ".display2" ).append( "<div class=\"productos\" id=\""+value2['id']+"\" data-id=\""+value2['id']+"\" data-categoriamadre=\""+value2['categoriaid']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value2['nombre']+"</div>" );
						}); */

					}
				});
				
				if(idcategoriamadre == 0){
					contarCategoriasProductos();
				}else{
					contarCategoriasProductos(1,0);
				}
			});
			$('#closeModalActualizarCategoria, #CancelarActualizarCategoria').click(function(){
				event.preventDefault();
				$('#modalActualizarCategoria').fadeOut('fast');
			});
			//Validaciones
			$('#GuardarActualizarCategoria').click(function(){
				var idcategoria = $('#formActualizarCategoria #idcategoria').val();
				var nombreCategoria = $('#formActualizarCategoria #nombreCategoria').val();
				var descripcion = $('#formActualizarCategoria #descripcion').val();
				var bgcolor = $('#formActualizarCategoria #bgcolor').val();
				
				if(nombreCategoria == ''){
					alert('No ha especificado un nombre!');
					return false;
				}
				
				var dominio = document.domain;
				var asunto = 'guardaractualizarcategoria';
				//var statusresult;
				
				//var categoriaid = $(this).attr('data-id');
				//var categoriamadre = $(this).attr('data-categoriamadre');
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					nombreCategoria: nombreCategoria,
					descripcion: descripcion,
					bgcolor: bgcolor,
					idcategoria: idcategoria
				}, function(data,status){
					if(status == "success"){
						//alert("Success");
						
						$('#modalActualizarCategoria').fadeOut('fast');
						
						$( ".display #" + idcategoria ).remove();
						//$( ".productos" ).remove();

						/* if(categoriaid != categoriamadre){
							$( ".display" ).append( "<div class=\"categorias\" id=\"categoriasBack\"  data-id=\""+categoriamadre+"\" data-categoriamadre=\"0\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\"><i class=\"fa fa-4x fa-arrow-left\";\"></i></div>" );
						} */
						
						var value = data.data[0];
						//$.each(datos, function ( index, value ) {
							$( ".display" ).append( "<div class=\"categorias added\" id=\""+value['id']+"\" data-id=\""+value['id']+"\"  data-nombrecategoria=\""+value['nombreCategoria']+"\"  data-descripcion=\""+value['Descripcion']+"\"  data-bgcolor=\""+value['bgcolor']+"\"  data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:" + value['bgcolor'] + ";color:#fff;font-weight:bold;cursor:pointer;position:relative;border-radius:10px;box-shadow: 1px 1px 3px #000;\">"+value['nombreCategoria']+"<i class=\"fa fa-folder-open fa-3x\" aria-hidden=\"true\" style=\"position:absolute;right: 10px;top: 52px;opacity: 0.2;\"></i><div class='destello'></div></div>" );
						//});
						/* 
						var datos2 = data.data2;
						$.each(datos2, function ( index, value2 ) {
						//$( ".display" ).append( "<div class=\"categorias\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value['nombreCategoria']+"</div>" );
						$( ".display2" ).append( "<div class=\"productos\" id=\""+value2['id']+"\" data-id=\""+value2['id']+"\" data-categoriamadre=\""+value2['categoriaid']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value2['nombre']+"</div>" );
						}); */

					}
				});
				
				if(idcategoriamadre == 0){
					contarCategoriasProductos();
				}else{
					contarCategoriasProductos(1,0);
				}
			});
		//***************************************/
		
		//Functions modalAgregarProducto
			$('#agregarProducto').click(function(){
				event.preventDefault();
								
				$('#modalAgregarProducto').fadeIn('fast');
				
				return false;
			});
			$(document).on('click','.listaAdicionales .categoriasAdicionales',function(){
				event.preventDefault();
				$(this).toggleClass('selected');
				
				contarCategoriasAdicionales();
			});
			$('#closeModalAgregarProducto, #CancelarGuardarProducto').click(function(){
				event.preventDefault();
				$('#modalAgregarProducto').fadeOut('fast');
				
				$('.listaAdicionales .categoriasAdicionales').removeClass('selected'); //Quitamos la seleccion a todas las categorias adicionales
				contarCategoriasAdicionales(); 
			});
			//Validaciones
			$('#GuardarProducto').click(function(){
				var nombreProducto = $('#formAgregarProducto #nombreProducto').val();
				var descripcion = $('#formAgregarProducto #descripcion').val();
				var precio = $('#formAgregarProducto #precio').val();
				var bgcolor = $('#formAgregarProducto #bgcolor').val();
				
				
				var adicionales = "";
				$('#listaAdicionales .selected').each(function(index,element){
					adicionales = adicionales + $(element).attr('data-id') + ";;;";
				});
				
				if(nombreProducto == ''){
					alert('No ha especificado un nombre!');
					return false;
				}
				
				var dominio = document.domain;
				var asunto = 'agregarproducto';
				//var statusresult;
				
				//var categoriaid = $(this).attr('data-id');
				//var categoriamadre = $(this).attr('data-categoriamadre');
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					nombreProducto: nombreProducto,
					descripcion: descripcion,
					precio: precio,
					bgcolor: bgcolor,
					idcategoriamadre: idcategoriamadre,
					adicionales: adicionales
				}, function(data,status){
					if(status == "success"){
						
						$('#modalAgregarProducto').fadeOut('fast');
						
						$('#formAgregarProducto #nombreProducto').val('');
						$('#formAgregarProducto #descripcion').val('');
						$('#formAgregarProducto #precio').val('');
						$('.listaAdicionales .categoriasAdicionales').removeClass('selected'); //Quitamos la seleccion a todas las categorias adicionales
						contarCategoriasAdicionales(); 
						
						var value = data.data;
						$( ".display2" ).append( "<div class=\"productos added\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['categoriaid']+"\"  data-nombre=\""+value['nombre']+"\" data-descripcion=\""+value['descripcion']+"\" data-precio=\""+value['precio']+"\" data-bgcolor=\""+value['bgcolor']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:" + value['bgcolor'] + ";color:#fff;font-weight:bold;cursor:pointer;position:relative;border-radius:10px;box-shadow: 1px 1px 3px #000;\">"+value['nombre']+" <span style=\"position:absolute;left: 0px;bottom: 0px;display: block;width: 100%;background: rgba(0,0,0,0.5);font-size: 13px;padding-left: 2px;border-radius:0px 0px 10px 10px;\">$" + value['precio'] + "</span> <i class=\"fa fa-shopping-cart fa-3x\" aria-hidden=\"true\" style=\"position:absolute;right: 10px;top: 52px;opacity: 0.2;\"></i><div class='destello'></div></div>" );
						
					}
				});
				
				if(idcategoriamadre == 0){
					contarCategoriasProductos();
				}else{
					contarCategoriasProductos(1,0);
				}
			});
			$('#closeModalActualizarProducto, #CancelarActualizarProducto').click(function(){
				event.preventDefault();
				$('#modalActualizarProducto').fadeOut('fast');
				
				$('.listaAdicionales .categoriasAdicionales').removeClass('selected'); //Quitamos la seleccion a todas las categorias adicionales
				contarCategoriasAdicionales(); 
			});
			//Validaciones
			$('#GuardarActualizarProducto').click(function(){
				var idproducto = $('#formActualizarProducto #idproducto').val();
				var nombreProducto = $('#formActualizarProducto #nombreProducto').val();
				var descripcion = $('#formActualizarProducto #descripcion').val();
				var precio = $('#formActualizarProducto #precio').val();
				var bgcolor = $('#formActualizarProducto #bgcolor').val();
				
				
				var adicionales = "";
				$('#modalActualizarProducto .listaAdicionales .selected').each(function(index,element){
					adicionales = adicionales + $(element).attr('data-id') + ";;;";
				});
				
				if(nombreProducto == ''){
					alert('No ha especificado un nombre!');
					return false;
				}
				
				var dominio = document.domain;
				var asunto = 'actualizarproducto';
				//var statusresult;
				
				//var categoriaid = $(this).attr('data-id');
				//var categoriamadre = $(this).attr('data-categoriamadre');
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					nombreProducto: nombreProducto,
					descripcion: descripcion,
					precio: precio,
					bgcolor: bgcolor,
					idproducto: idproducto,
					adicionales: adicionales
				}, function(data,status){
					if(status == "success"){
						
						$( ".display2 #" + idproducto ).remove();
						
						$('#modalActualizarProducto').fadeOut('fast');
						
						$('#formActualizarProducto #nombreProducto').val('');
						$('#formActualizarProducto #descripcion').val('');
						$('#formActualizarProducto #precio').val('');
						$('.listaAdicionales .categoriasAdicionales').removeClass('selected'); //Quitamos la seleccion a todas las categorias adicionales
						contarCategoriasAdicionales(); 
						
						var value = data.data[0];
						$( ".display2" ).append( "<div class=\"productos added\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['categoriaid']+"\"  data-nombre=\""+value['nombre']+"\" data-descripcion=\""+value['descripcion']+"\" data-precio=\""+value['precio']+"\" data-bgcolor=\""+value['bgcolor']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:" + value['bgcolor'] + ";color:#fff;font-weight:bold;cursor:pointer;position:relative;border-radius:10px;box-shadow: 1px 1px 3px #000;\">"+value['nombre']+" <span style=\"position:absolute;left: 0px;bottom: 0px;display: block;width: 100%;background: rgba(0,0,0,0.5);font-size: 13px;padding-left: 2px;border-radius:0px 0px 10px 10px;\">$" + value['precio'] + "</span> <i class=\"fa fa-shopping-cart fa-3x\" aria-hidden=\"true\" style=\"position:absolute;right: 10px;top: 52px;opacity: 0.2;\"></i><div class='destello'></div></div>" );
						
					}
				});
				
				if(idcategoriamadre == 0){
					contarCategoriasProductos();
				}else{
					contarCategoriasProductos(1,0);
				}
			});
		//***************************************/
		
		//Functions modalAgregarCategoriaAdicional
			$('.agregarCategoriaAdicional').click(function(){
				event.preventDefault();
								
				$('#modalAgregarCategoriaAdicional').fadeIn('fast');
				
				return false;
			});
			/*$('#listaAdicionales .categoriasAdicionales').click(function(){
				event.preventDefault();
				$(this).toggleClass('selected');
				
				contarCategoriasAdicionales();
			}); */
			$('#closeModalAgregarCategoriaAdicional, #CancelarAgregarCategoriaAdicional').click(function(){
				event.preventDefault();
				$('#modalAgregarCategoriaAdicional').fadeOut('fast');
				
				$('#agregarCategoriaAdicionalOpciones .opcion').remove();
				// $('#listaAdicionales .categoriasAdicionales').removeClass('selected'); //Quitamos la seleccion a todas las categorias adicionales
				// contarCategoriasAdicionales(); 
			});
			$('#closeModalActualizarCategoriaAdicional, #CancelarActualizarCategoriaAdicional').click(function(){
				event.preventDefault();
				$('#modalActualizarCategoriaAdicional').fadeOut('fast');
				
				$('#actualizarCategoriaAdicionalOpciones .opcion').remove();
				// $('#listaAdicionales .categoriasAdicionales').removeClass('selected'); //Quitamos la seleccion a todas las categorias adicionales
				// contarCategoriasAdicionales(); 
			});
			$('#modalAgregarCategoriaAdicional #opcionMaker').keyup(function(ev) {
				if (ev.which === 13 ) {
					//ev.preventDefault();
					$('#agregarCategoriaAdicionalOpciones').append("<span class=\"opcion\" data-text=\""+$(this).val()+"\" style=\"display:block;background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:80%;\">"+$(this).val()+"</span>");
					$(this).val('');
				}
			});
			$('#modalActualizarCategoriaAdicional #opcionMaker').keyup(function(ev) {
				if (ev.which === 13 ) {
					//ev.preventDefault();
					$('#actualizarCategoriaAdicionalOpciones').append("<span class=\"opcion\" data-text=\""+$(this).val()+"\" style=\"display:block;background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:80%;\">"+$(this).val()+"</span>");
					$(this).val('');
				}
			});
			$(document).on('dblclick','.opcion',function(){
				$(this).remove();
			});
			//Validaciones
			$('#modalAgregarCategoriaAdicional #GuardarAgregarCategoriaAdicional').click(function(){
				var nombre = $('#formAgregarCategoriaAdicional #nombreCategoriaAdicional').val();
				var opciones = "";
				$('#formAgregarCategoriaAdicional .opcion').each(function(index,element){
					opciones = opciones + $(element).attr('data-text') + ";;;";
				});
				//var precio = $('#formAgregarProducto #precio').val();
				//var bgcolor = $('#formAgregarProducto #bgcolor').val();
				
				if(nombre == ''){
					alert('No ha especificado un titulo!');
					return false;
				}
				
				var dominio = document.domain;
				var asunto = 'agregaradicional';
				//var statusresult;
				
				//var categoriaid = $(this).attr('data-id');
				//var categoriamadre = $(this).attr('data-categoriamadre');
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					nombre: nombre,
					opciones: opciones
				}, function(data,status){
					if(status == "success"){
						//alert("Success");
						
						$('#modalAgregarCategoriaAdicional').fadeOut('fast');
						$('#formAgregarCategoriaAdicional #nombreCategoriaAdicional').val('');
						$('#opcionMaker').val('');
						$('.opcion').remove();
						//$( ".categorias" ).remove();
						//$( ".productos" ).remove();

						/* if(categoriaid != categoriamadre){
							$( ".display" ).append( "<div class=\"categorias\" id=\"categoriasBack\"  data-id=\""+categoriamadre+"\" data-categoriamadre=\"0\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\"><i class=\"fa fa-4x fa-arrow-left\";\"></i></div>" );
						} */
						
						var value = data.data;
						$('.listaAdicionales').append("<div id=\""+value['id']+"\" data-id=\""+value['id']+"\" class=\"categoriasAdicionales\" style=\"background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;\">"+value['nombreAdicional']+"	<a href='#' class='btnEliminarAdicional' data-id='"+value['id']+"' data-nombreadicional=\""+value['nombreAdicional']+"\" style=\"float:right;margin-right:2px;\"><span aria-hidden=\"true\">&times;</span></a> <a href='#' class='btnEditarAdicional' data-id=\""+value['id']+"\" data-nombreadicional=\""+value['nombreAdicional']+"\" style=\"float:right;margin-right:10px;\"><i class=\"fa fa-pencil\" aria-hidden='true'></i></a></div>");
						//$.each(datos, function ( index, value ) {
							//**$( ".display2" ).append( "<div class=\"productos\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['categoriaid']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:" + value['bgcolor'] + ";color:#fff;font-weight:bold;cursor:pointer;\">"+value['nombre']+"</div>" );
						//});
						/* 
						var datos2 = data.data2;
						$.each(datos2, function ( index, value2 ) {
						//$( ".display" ).append( "<div class=\"categorias\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value['nombreCategoria']+"</div>" );
						$( ".display2" ).append( "<div class=\"productos\" id=\""+value2['id']+"\" data-id=\""+value2['id']+"\" data-categoriamadre=\""+value2['categoriaid']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value2['nombre']+"</div>" );
						}); */

					}
				});
				/*
				if(idcategoriamadre == 0){
					contarCategoriasProductos();
				}else{
					contarCategoriasProductos(1,0);
				}
				*/
			});
			
			$('#modalActualizarCategoriaAdicional #GuardarActualizarCategoriaAdicional').click(function(){
				var idadicional = $('#formActualizarCategoriaAdicional #idadicional').val();
				var nombre = $('#formActualizarCategoriaAdicional #nombreCategoriaAdicional').val();
				var opciones = "";
				$('#formActualizarCategoriaAdicional .opcion').each(function(index,element){
					opciones = opciones + $(element).attr('data-text') + ";;;";
				});
				//var precio = $('#formAgregarProducto #precio').val();
				//var bgcolor = $('#formAgregarProducto #bgcolor').val();
				
				if(nombre == ''){
					alert('No ha especificado un titulo!');
					return false;
				}
				
				var dominio = document.domain;
				var asunto = 'actualizaradicional';
				//var statusresult;
				
				//var categoriaid = $(this).attr('data-id');
				//var categoriamadre = $(this).attr('data-categoriamadre');
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					idadicional: idadicional,
					nombre: nombre,
					opciones: opciones
				}, function(data,status){
					if(status == "success"){
						//alert("Success");
						
						$('#modalActualizarCategoriaAdicional').fadeOut('fast');
						$('#formActualizarCategoriaAdicional #nombreCategoriaAdicional').val('');
						$('#modalActualizarCategoriaAdicional #opcionMaker').val('');
						$('.opcion').remove();
						//$( ".categorias" ).remove();
						//$( ".productos" ).remove();

						/* if(categoriaid != categoriamadre){
							$( ".display" ).append( "<div class=\"categorias\" id=\"categoriasBack\"  data-id=\""+categoriamadre+"\" data-categoriamadre=\"0\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\"><i class=\"fa fa-4x fa-arrow-left\";\"></i></div>" );
						} */
						
						$('.listaAdicionales #'+idadicional).remove();
						
						var value = data.data[0];
						$('.listaAdicionales').append("<div id=\""+value['id']+"\" data-id=\""+value['id']+"\" class=\"categoriasAdicionales\" style=\"background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:100%;cursor: pointer;\">"+value['nombreAdicional']+"	<a href='#' class='btnEliminarAdicional' data-id='"+value['id']+"' data-nombreadicional=\""+value['nombreAdicional']+"\" style=\"float:right;margin-right:2px;\"><span aria-hidden=\"true\">&times;</span></a> <a href='#' class='btnEditarAdicional' data-id=\""+value['id']+"\" data-nombreadicional=\""+value['nombreAdicional']+"\" style=\"float:right;margin-right:10px;\"><i class=\"fa fa-pencil\" aria-hidden='true'></i></a></div>");
					}
				});
				/*
				if(idcategoriamadre == 0){
					contarCategoriasProductos();
				}else{
					contarCategoriasProductos(1,0);
				}
				*/
			});
			
			$(document).on('click','.btnEditarAdicional',function(){
				var idadicional = $(this).attr('data-id');
				var nombreadicional = $(this).attr('data-nombreadicional');
				
				$('#modalActualizarCategoriaAdicional #idadicional').val(idadicional);
				$('#modalActualizarCategoriaAdicional #nombreCategoriaAdicional').val(nombreadicional);
				
				var dominio = document.domain;
				var asunto = 'getadicionalopciones';
				//var statusresult;
				
				//var categoriaid = $(this).attr('data-id');
				//var categoriamadre = $(this).attr('data-categoriamadre');
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					idadicional: idadicional
				}, function(data,status){
					if(status == "success"){
						
						var datos = data.data;
						
						$('#actualizarCategoriaAdicionalOpciones .opcion').remove();
						
						$.each(datos, function ( index, value ) {
							$('#actualizarCategoriaAdicionalOpciones').append("<span class=\"opcion\" data-text=\""+value['nombreOpcion']+"\" style=\"display:block;background:#f1f1f1;padding:2px;border-left:2px solid green;margin-bottom:3px;box-sizing:border-box;width:80%;\">"+value['nombreOpcion']+"</span>");
						});
						
					}
				});
				
				$('#modalActualizarCategoriaAdicional').fadeIn('fast');
				
				return false;
			});
		//***************************************/
		
		
		
		$('.facturacion').click(function () {
			//$('.eliminarMensajero').click(function(){
				//event.preventDefault();
				//$('#wrapper').fadeToggle('fast');
				$('#wrapper').animate({left:'toggle'},-500);
				$('#todo').toggleClass('todo2');
				
				
				return false;
			});

		//Calculadora... 

		$('.numero').click(function(e){
			e.preventDefault();
			var number = $(this).text();
			var monto = $('#monto_pagar').val();
			var total = monto + '' + number;

			$('#monto_pagar').val(total);
		});

		$('.eraser').click(function(e){
			$('#monto_pagar').val("");
		});

		$('.delete').click(function(e){
			e.preventDefault();
			var texto = $('#monto_pagar').val();
			texto = texto.substring(0,texto.length-1);
			$('#monto_pagar').val(texto);
		});
		
		//Functions 
			//$('#modalBuscarCliente').fadeToggle('fast');
			$('.bCliente').click(function () {
			//$('.editarMensajeroPassword').click(function(){
				event.preventDefault();
				$('#modalBuscarCliente').fadeIn('fast');
				$('#buscadorCliente').focus();
				
				return false;
			});
			$('#closeModalBuscarCliente, #CancelarBuscarCliente').click(function(){
				event.preventDefault();
				$('#modalBuscarCliente').fadeToggle('fast');
			});
			$('#buscarCliente').click(function(){
				return false;
			});


			//BotonBuscarCliente....................................................
			$('.botonBuscarCliente').click(function () {
				var e = jQuery.Event("keydown");
				e.which = 13; // Enter
				$('#buscadorCliente').trigger(e);
			});
			
			//BotonBuscarCliente....................................................
			$('#verFacturas').click(function () {
				var e = jQuery.Event("keydown");
				e.which = 120; // F9
				$('body').trigger(e);
				
				//showUltimasFacturas();
			});
			
			//AgregarCliente....................................................
			$('.botonAgregarCliente').click(function () {
			//$('.editarMensajeroPassword').click(function(){
				event.preventDefault();
				$('#modalBuscarCliente').fadeToggle('fast');
				$('#modalAgregarCliente').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalAgregarCliente, #CancelarAgregarCliente').click(function(){
				event.preventDefault();
				$('#modalAgregarCliente').fadeToggle('fast');
				$('#modalBuscarCliente').fadeToggle('fast');
			});
			$('#agregarCliente').click(function(){
				return false;
			});
			
			
		/** Funciones para los tabs de las facturas **********************************************************/
			$('.Order_box').attr('data-class',getFechaAllTogether()); // Aplicamos un nuevo atributo data-class=yyyymmddHHiiss
			function mostrarFacturas(){
				$('#modalTabFacturas #formTabFacturas .modal-body .facturasAbiertas').remove();
				
				$('#wrapper #sidebar-wrapper .OrderBox').each(function(index, element){
					var nombreCliente =  $(element).find(".clienteDataVenta").text();
					var dataClassFactura =  $(element).attr("data-class");
					if($(this).hasClass('Order_box')){
						$('#modalTabFacturas #formTabFacturas .modal-body').append("<div class=\"facturasAbiertas\" data-classfactura='" + dataClassFactura + "' style=\"background: green;font-weight:bold; color:white; padding: 10px;border-left: 2px solid green;margin-bottom: 10px;box-sizing: border-box;width: 100%;cursor: pointer; overflow: hidden;white-space: nowrap;text-overflow: ellipsis; \">" + nombreCliente + "</div>");
					}else{
						$('#modalTabFacturas #formTabFacturas .modal-body').append("<div class=\"facturasAbiertas\" data-classfactura='" + dataClassFactura + "' style=\"background: #f1f1f1;padding: 10px;border-left: 2px solid green;margin-bottom: 10px;box-sizing: border-box;width: 100%;cursor: pointer; overflow: hidden;white-space: nowrap;text-overflow: ellipsis; \">" + nombreCliente + "</div>");
					}
				});
			}
			function anularAndDefinirNuevaFacturaActual(){
				if($('.OrderBox').length > 1){
					$('.Order_box').remove();
					$('.OrderBox:first').removeClass('Order_boxHidden');
					$('.OrderBox:first').addClass('Order_box');
				}else{
					addNuevaFactura();
					$('.Order_boxHidden').remove();
				}
			}
			$('#sidebar-wrapper #mostrarFacturas').click(function(){
				
				mostrarFacturas();
				
				$('#modalTabFacturas').fadeIn('fast');
			});
			$('.anularFacturaActual').click(function(){
				
				$('#modalAnularFacturaActual').fadeIn('fast');
				
				
				return false;
			});
			$('#modalAnularFacturaActual #closeModalAnularFacturaActual, #modalAnularFacturaActual #CancelarAnularFacturaActual').click(function(){
				$('#modalAnularFacturaActual').fadeOut('fast');
			});
			$('#modalAnularFacturaActual #GuardarAnularFacturaActual').click(function(){
				
				anularAndDefinirNuevaFacturaActual();
				$('#modalAnularFacturaActual').fadeOut('fast');
				
				return false;
			});
			$('#modalTabFacturas #closeModalTabFacturas, #modalTabFacturas #CancelarTabFacturas').click(function(){
				$('#modalTabFacturas').fadeOut('fast');
			});
			$(document).on('click','#modalTabFacturas #formTabFacturas .modal-body .facturasAbiertas',function(){
				$('.Order_box').addClass('Order_boxHidden');
				$('.Order_box').removeClass('Order_box');
				
				$('.Orderbox[data-class="'+$(this).attr('data-classfactura')+'"]').addClass('Order_box');
				$('.Orderbox[data-class="'+$(this).attr('data-classfactura')+'"]').removeClass('Order_boxHidden');
				
				$('#modalTabFacturas').fadeOut('fast');
			});
			function addNuevaFactura(){
				$('.Order_box').addClass('Order_boxHidden');
				$('.Order_box').removeClass('Order_box');
				
				var nuevoOrderBox = "<div class=\"OrderBox Order_box\" data-class='"+ getFechaAllTogether() +"'>  <div class='Order_table' style=\"height:calc(100% - 70px);\">  <span class=\"Order_caption\" style=\"display:block;width:326px;padding:2px;box-sizing:border-box;font-weight:bold;font-size:20px;\"> <i class=\"fa fa-user\" aria-hidden=\"true\"></i>	<div class=\"clienteDataVenta\" data-codigocliente='' data-nombrecliente='' data-telefonocliente='' data-direccioncliente='' data-identificacioncliente='' data-emailcliente='' data-hascliente='0' title='' style=\"margin-left:5px;width:300px !important;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;float:right;\"> -- </div></span><div class=\"thead\" style=\"display:block;width:100%;height:25px;border-bottom:1px solid #f1f1f1;\"><ul><li class=\"th-producto\" style=\"width:230px;float:left;font-weight:bold;\">Producto</li><li class=\"th-cantidad\" style=\"width:50px;float:left;font-weight:bold;\"></li><li class=\"th-precio\" style=\"padding-right:20px;text-align:right;width:135px;float:left;font-weight:bold;box-sizing:border-box;\">Precio</li></ul></div><div class=\"tbody\" style=\"margin-top:10px;overflow:auto;height:calc(100% - 100px);\"></div></div><label class=\"Total_label\" data-valortotal=\"0.00\" style=\"width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;font-size: 15px;right: -7px;bottom: 332px;\">Total RD$ 0.00</label><label class=\"Total_label_servicio\" data-valortotal=\"0.00\" style=\"width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;position: absolute;right: -7px;bottom: 353px;\">Servicio RD$ 0.00</label><label class=\"Total_label_itbis\" data-valortotal=\"0.00\" style=\"width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;position: absolute;right: -7px;bottom: 371px;\">Itbis RD$ 0.00</label><label class=\"Total_label_descuento\" data-valortotal=\"0.00\" style=\"width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;position: absolute;right: -7px;bottom: 390px;\">Descuento RD$ 0.00</label><label class=\"Total_label_subtotal\" data-valortotal=\"0.00\" style=\"width: 100%;float: right !important;margin: 0px;text-align: right;padding-right: 15px;box-sizing: border-box;position: absolute;right: -7px;bottom: 408px;\">SubTotal RD$ 0.00</label>";
				
				$('#wrapper #sidebar-wrapper .OrderBox:last').after(nuevoOrderBox);
			}
			function changeIntoFacturas(){
				
				$('.Order_box').addClass('Order_boxHidden');
				$('.Order_box').addClass('Order_boxToRemove');
				$('.Order_boxToRemove').removeClass('Order_box');
				if($('.Order_boxToRemove').next('.OrderBox').length){
					$('.Order_boxToRemove').next('.OrderBox').removeClass('Order_boxHidden');
					$('.Order_boxToRemove').next('.OrderBox').addClass('Order_box');
				}else{
					$( ".OrderBox" ).first().removeClass('Order_boxHidden');
					$( ".OrderBox" ).first().removeClass('Order_box');
					$( ".OrderBox" ).first().addClass('Order_box');
				}
				$('.Order_boxToRemove').removeClass('Order_boxToRemove');
				
				mostrarFacturas();
			}
			$('#modalTabFacturas #NuevoTabFacturas').click(function(){
				addNuevaFactura();
				$('#modalTabFacturas').fadeOut('fast');
			}); // Crear nueva factura
		/************************************************************/
		/** Funciones para el pago **********************************/
		/************************************************************/
			
			function modalPago(){
				var total = parseFloat($('.Order_box .Total_label').attr('data-valortotal'));
				
				$('#modalPago #formPago .textPagoEfectivo').val($('#monto_pagar').val());
				
				$('#modalPago #formPago .montoAPagar').attr('data-valor',total);
				$('#modalPago #formPago .montoAPagar').text('RD$ ' + addCommas(total.toFixed(2)));
				
				var cambio = (parseFloat($('#modalPago #formPago .textPagoEfectivo').val()? $('#modalPago #formPago .textPagoEfectivo').val(): 0) + parseFloat($('#modalPago #formPago .textPagoCredito').val()? $('#modalPago #formPago .textPagoCredito').val(): 0) + parseFloat($('#modalPago #formPago .textPagoTarjeta').val()? $('#modalPago #formPago .textPagoTarjeta').val(): 0)) - total;
				
				$('#modalPago #formPago .montoCambio').attr('data-valor',cambio);
				$('#modalPago #formPago .montoCambio').text('RD$ ' + addCommas(cambio.toFixed(2)));
				
				if(cambio < 0){
					$('#modalPago #formPago .montoCambio').css('color','red');
				}else if(cambio > 0){
					$('#modalPago #formPago .montoCambio').css('color','green');
				}
				
				$('#modalPago').fadeIn('fast');
			}
			$('#modalPago #formPago .textPagoEfectivo, #modalPago #formPago .textPagoCredito, #modalPago #formPago .textPagoTarjeta').on("change paste keyup blur focusin",function(){
				var total = parseFloat($('.Order_box .Total_label').attr('data-valortotal'));
				
				var cambio = (parseFloat($('#modalPago #formPago .textPagoEfectivo').val()? $('#modalPago #formPago .textPagoEfectivo').val(): 0) + parseFloat($('#modalPago #formPago .textPagoCredito').val()? $('#modalPago #formPago .textPagoCredito').val(): 0) + parseFloat($('#modalPago #formPago .textPagoTarjeta').val()? $('#modalPago #formPago .textPagoTarjeta').val(): 0)) - total;
				
				$('#modalPago #formPago .montoCambio').attr('data-valor',cambio);
				$('#modalPago #formPago .montoCambio').text('RD$ ' + addCommas(cambio.toFixed(2)));
				
				$('#monto_pagar').val($('#modalPago #formPago .textPagoEfectivo').val());
				
				if(cambio < 0){
					$('#modalPago #formPago .montoCambio').css('color','red');
				}else if(cambio > 0){
					$('#modalPago #formPago .montoCambio').css('color','green');
				}else {
					$('#modalPago #formPago .montoCambio').css('color','black');
				}
			});
			$('#modalPago #formPago .isDelivery').click(function(){
				if($(this).attr('data-delivery') == '0'){
					$(this).attr('data-delivery','1');
					$(this).append("<i class=\"fa fa-check\" aria-hidden='true'></i>");
					$(this).removeClass("btn-warning");
					$(this).addClass("btn-success");
					
					showAllMensajeros();
					
				}else if($(this).attr('data-delivery') == '1'){
					$(this).attr('data-delivery','0');
					$(this).find('i').remove();
					$(this).removeClass("btn-success");
					$(this).addClass("btn-warning");
				}
			});
			$(document).on('click', '.botonPagar',function () {
			//$('.editarMensajeroPassword').click(function(){
				event.preventDefault();
				modalPago();
				return false;
			});
					
			$('#closeModalPago, #CancelarPago').click(function(){
				event.preventDefault();
				$('#modalPago').fadeOut('fast');
			});
			$('#pago').click(function(){
				return false;
			});
			$('#modalPago #formPago #GuardarPago').click(function(){
				
				$('#modalLoader').fadeIn('fast');
				
				// $('#modalPago #formPago .modal-body').hide();
				// $('#modalPago #formPago .modal-footer').hide();
				// $('#modalPago .modal-header').hide();
				// $('#modalPago #formPago .loader').fadeIn('fast');
				
				/** Funciones para guardar factura en CXC */
					
					var dominio = document.domain;
					var asunto = "guardarFacturaCredito";
					
					var codigocliente 				= $('.Order_box .Order_table .clienteDataVenta').attr('data-codigocliente');
					var tdctipofactura 				= 'FT';
					var tdccodigofactura 			= '1';
					var impuestofactura 			= $('.Order_box .Total_label_itbis').attr('data-valortotal');
					// var valorfactura 			= $('.Order_box .Total_label').attr('data-valortotal');
					var valorfactura 				= parseFloat($('#modalPago #formPago .textPagoCredito').val() != '' ? $('#modalPago #formPago .textPagoCredito').val() : '0.00' );
					var descuentofactura 			= $('.Order_box .Total_label_descuento').attr('data-valortotal');
					var comisionfactura 			= $('.Order_box .Total_label_servicio').attr('data-valortotal');
					var fechafactura 				= getFecha();
					var notafactura 				= $('#modalNota #notafactura').val();
					
					if(codigocliente == ''){
						alert('No ha especificado un cliente!');
						
						$('#modalLoader').fadeOut('fast');
						
						// $('#modalPago #formPago .modal-body').hide();
						// $('#modalPago #formPago .modal-footer').fadeIn('fast');
						// $('#modalPago .modal-header').fadeIn('fast');
						// $('#modalPago #formPago .pagos').fadeIn('fast');
						
						return false;
					}
					
					function siRespuesta(r){
						
						// $('#modalPago').fadeOut('fast');
						//$('#modalPagoCredito').fadeOut('fast');
						
						// $('#modalPago #formPago .modal-body').hide();
						// $('#modalPago #formPago .modal-footer').fadeIn('fast');
						// $('#modalPago .modal-header').fadeIn('fast');
						// $('#modalPago #formPago .pagos').fadeIn('fast');
						
						guardarFacturaPos(r);
					}
				 
					function siError(e){
						
						// $('#modalPago #formPago .modal-body').hide();
						// $('#modalPago #formPago .modal-footer').fadeIn('fast');
						// $('#modalPago .modal-header').fadeIn('fast');
						// $('#modalPago #formPago .pagos').fadeIn('fast');
						
						$('#modalLoader').fadeOut('fast');
						
						alert('Ocurrió un error al realizar la petición: '+e.statusText + '\n' + e.responseText);
					}
				 
					function peticion(e){
						// Realizar la petición
						var parametros = {
							asunto: asunto,
							codigocliente: codigocliente,
							tdctipofactura: tdctipofactura,
							valorfactura: valorfactura,
							impuestofactura: impuestofactura,
							fechafactura: fechafactura,
							notafactura: notafactura,
							comisionfactura: comisionfactura
						};
				 
						var post = $.post("http://"+dominio+"/phpsql/facturas.php", parametros, siRespuesta, 'json');
				 
						/* Registrar evento de la petición (hay mas)
						   (no es obligatorio implementarlo, pero es muy recomendable para detectar errores) */
				 
						post.error(siError);         // Si ocurrió un error al ejecutar la petición se ejecuta "siError"
					}
					var isCredito = false;
					if($('#modalPago #formPago .textPagoCredito').val() != ''){
						if(parseFloat($('#modalPago #formPago .textPagoCredito').val()) > 0){
							isCredito = true;
							peticion();
						}
					}
					
					if(isCredito == false){
						var idexterno = getFechaAllTogether();
						guardarFacturaPos(idexterno);
					}
					
				/** Funciones para guardar factura en POS */
					function guardarFacturaPos(idexterno){
						var clienteid					= $('.Order_box .Order_table .Order_caption .ClienteDataVenta').attr('data-codigocliente');
						var nombrecliente				= $('.Order_box .Order_table .Order_caption .ClienteDataVenta').attr('data-nombrecliente');
						var telefonocliente				= $('.Order_box .Order_table .Order_caption .ClienteDataVenta').attr('data-telefonocliente');
						var direccioncliente 			= $('.Order_box .Order_table .Order_caption .ClienteDataVenta').attr('data-direccioncliente');
						var identificacioncliente 		= $('.Order_box .Order_table .Order_caption .ClienteDataVenta').attr('data-identificacioncliente');
						var correocliente 				= $('.Order_box .Order_table .Order_caption .ClienteDataVenta').attr('data-emailcliente');
						var valorfactura 				= $('.Order_box .Total_label').attr('data-valortotal');
						//var impuestofactura 			= impuestoFactura;
						var fechafactura 				= getFecha();
						var tipofactura 				= 0;		// 0:Credito; 1:Efectivo; 2:Tarjeta;
						var usedelivery 				= $('#modalPago #formPago .isDelivery').attr('data-delivery');		// 0:Venta Local; 1:Venta con Delivery;
						var notafactura 				= $('#modalNota #notafactura').text();
						
						var credito = parseFloat($('#modalPago #formPago .textPagoCredito').val() != '' ? $('#modalPago #formPago .textPagoCredito').val() : '0.00' );
						var efectivo = parseFloat($('#modalPago #formPago .textPagoEfectivo').val() != '' ? $('#modalPago #formPago .textPagoEfectivo').val() : '0.00');
						var tarjeta = parseFloat($('#modalPago #formPago .textPagoTarjeta').val() != '' ? $('#modalPago #formPago .textPagoTarjeta').val() : '0.00');
						
						var valorcredito = credito.toFixed(2);
						var valorefectivo = efectivo.toFixed(2);
						var valortarjeta = tarjeta.toFixed(2);
						
						var productos = ''; 
						$('.Order_box .Order_table .tbody > ul').each(function(index,element){
							$(element).addClass('productoTaken');
							productos = productos + $(element).attr('data-id') + "!@@@!";
							productos = productos + $(element).attr('data-nombreproducto') + "!@@@!";
							productos = productos + $(element).attr('data-cantidadproducto') + "!@@@!";
							productos = productos + $(element).attr('data-precioproducto') + "!@@@!";
							productos = productos + $(element).attr('data-subtotalproducto') + "!@@@!";
							productos = productos + $(element).attr('data-notaproducto') + "!@@@!";
							
							$('.productoTaken .td-producto > ul li').each(function(index,elementos){
								productos = productos + $(elementos).text() + ', ';
							});
							
							productos = productos + ";;;";
							$(element).removeClass('productoTaken');
						});
						
						//Si es delivery, indicar quien
						//*****************************
						var ismensajero = 0;
						var idmensajero = 0;
						if(usedelivery == 1){
							if($('#modalListMensajeros #formListMensajeros #ismensajero').val() == 1){
								ismensajero = 1;
								idmensajero = $('#modalListMensajeros #formListMensajeros #idmensajero').val();
							}
						}
						
						var dominio = document.domain;
						var asunto = 'agregarfactura';
						
						var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
						{ 
							asunto: asunto,
							clienteid: clienteid,
							nombrecliente: nombrecliente,
							telefonocliente: telefonocliente,
							direccioncliente: direccioncliente,
							identificacioncliente: identificacioncliente,
							correocliente: correocliente,
							valorfactura: valorfactura,
							impuestofactura: impuestofactura,
							fechafactura: fechafactura,
							tipofactura: tipofactura,
							usedelivery: usedelivery,
							ismensajero: ismensajero,
							idmensajero: idmensajero,
							notafactura: notafactura,
							productos: productos,
							descuentofactura: descuentofactura,
							comisionfactura: comisionfactura,
							idexterno: idexterno,
							valorcredito: valorcredito,
							valorefectivo: valorefectivo,
							valortarjeta: valortarjeta
						}, function(data,status){
							if(status == "success"){
								
								$('#modalLoader').fadeOut('fast');
								$('#modalPago').fadeOut('fast');
								$('#modalPagoCredito').fadeOut('fast');
								
								/** Limpiar factura luego de ser procesada */
								// $('.Order_box .Order_table .tbody > ul').remove(); // Quita todos los productos de la factura
								// $('.clienteDataVenta').attr('data-codigocliente',''); // Quita elementos del cliente
								// $('.clienteDataVenta').attr('data-nombrecliente',''); // Quita elementos del cliente
								// $('.clienteDataVenta').attr('data-telefonocliente',''); // Quita elementos del cliente
								// $('.clienteDataVenta').attr('data-direccioncliente',''); // Quita elementos del cliente
								// $('.clienteDataVenta').attr('data-hascliente','0'); // Quita elementos del cliente
								// $('.clienteDataVenta').attr('title',''); // Quita elementos del cliente
								// $('.clienteDataVenta').text('--'); // Quita elementos del cliente
								// $('#modalNota #notafactura').val(''); // Quita nota de la factura
								// calcTotal(); // Calcula el valor total luego de quitar los productos
								
								
								
								//imprimirFactura();
								imprSelecComanda('.Order_box',idexterno,data.data2[0]['nombreUsuario']);
								//imprimirFactura();
								imprSelec('.Order_box',idexterno,data.data2[0]['nombreUsuario']);
								
								
								$('#modalPago #formPago .textPagoCredito').val('');
								$('#modalPago #formPago .textPagoEfectivo').val('');
								$('#modalPago #formPago .textPagoTarjeta').val('');
								
								anularAndDefinirNuevaFacturaActual();
								
								$('#modalPago #formPago .isDelivery').attr('data-delivery','0');
								$('#modalPago #formPago .isDelivery').find('i').remove();
								$('#modalPago #formPago .isDelivery').removeClass("btn-success");
								$('#modalPago #formPago .isDelivery').addClass("btn-warning");
								
								$('#modalListMensajeros #formListMensajeros #ismensajero').val(0);
								$('#modalListMensajeros #formListMensajeros #idmensajero').val(0);
							}
						});
					}
					
					//$('#modalLoader').fadeOut('fast');
				/***************************/
				
			});
			//************************************************************************************/
			
			/* 
			** imprSelec(id, idexterno = 0)
			** id: (string) id del div que contiene los detalles de la factura.
			** idexterno: (int,string) id o numero de orden de la factura, por default es 0 si no es especificado.
			** cajero: (string) Nombre del cajero(a) que factura, por default es '' si no es especificado.
			*/
			function imprSelec(id, idexterno = 0,cajero = '') {
				$('.OrderBox .Order_table .Order_caption').hide();
				
				var div, imp, Order_box_width;
				Order_box_width = $(id).width();
				div = $(id).html();//seleccionamos el objeto
				imp = window.open(" ","Formato de Impresion"); //damos un titulo
				imp.document.open();					//abrimos
				var style = '';
				$('style').each(function(index,element){
					style = style + $(element).text();
				});
				
				$('.OrderBox .Order_table .Order_caption').show();
				
				var clienteNombre = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-nombrecliente');
				var clienteTelefono = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-telefonocliente');
				var clienteDireccion = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-direccioncliente');
				
				var credito = parseFloat($('#modalPago #formPago .textPagoCredito').val() != '' ? $('#modalPago #formPago .textPagoCredito').val() : '0.00' );
				var efectivo = parseFloat($('#modalPago #formPago .textPagoEfectivo').val() != '' ? $('#modalPago #formPago .textPagoEfectivo').val() : '0.00');
				var tarjeta = parseFloat($('#modalPago #formPago .textPagoTarjeta').val() != '' ? $('#modalPago #formPago .textPagoTarjeta').val() : '0.00');
				var cambio = parseFloat($('#modalPago #formPago .montoCambio').attr('data-valor') != '' ? $('#modalPago #formPago .montoCambio').attr('data-valor') : '0.00');
				
				var valorcredito = credito.toFixed(2);
				var valorefectivo = efectivo.toFixed(2);
				var valortarjeta = tarjeta.toFixed(2);
				var valorcambio = cambio.toFixed(2);
				
				//imp.document.write('<style>' + style + '</style>'); //tambien podriamos agregarle un <link ...
				imp.document.write("<style media=\"print\">"); 
				imp.document.write("* {list-style:none;padding:0px;margin:0px;font-weight:normal !important;} "); 
				imp.document.write("@media only print { "); 
				imp.document.write(".Order_table {height:auto !important;padding-top: 10px;padding-bottom: 0px;} "); 
				imp.document.write(".Order_box {width:400px;border:3px solid #cccccc;} "); 
				imp.document.write(".thead ul {display: !important;} "); 
				imp.document.write(".tbody {margin-top:0px !important;overflow:initial !important;height:auto !important;} "); 
				imp.document.write(".Total_label {position:relative !important;bottom:-34px !important;font-size:9px !important;font-weight:bold;right:10px !important;} "); 
				imp.document.write(".Total_label_servicio {position:relative !important;bottom:-14px !important;right:10px !important;} "); 
				imp.document.write(".Total_label_itbis {position:relative !important;bottom:4px !important;right:10px !important;} "); 
				imp.document.write(".Total_label_descuento {position:relative !important;bottom:22px !important;right:10px !important;} ");
				imp.document.write(".Total_label_subtotal {position:relative !important;bottom:40px !important;right:10px !important;} "); 
				imp.document.write(".thead {padding-top:0px !important;height:10px !important;border-bottom: 1px solid #000 !important;border-top: 1px solid #000;} "); 
				imp.document.write(".th-producto {max-width:130px !important;} "); 
				imp.document.write(".td-producto {max-width:120px !important;margin-bottom:5px;} "); 
				imp.document.write(".facturaProductoAdicional {border-left:0px !important;} "); 
				imp.document.write(".tbody ul {margin:0px !important;padding:0px !important;} "); 
				imp.document.write(".td-producto div {max-width:127px !important;float:left !important;} ");  
				imp.document.write(".th-precio {max-width:71px;} "); 
				imp.document.write(".td-precio {max-width:40px;} "); 
				imp.document.write(".td-close {display:none;} "); 
				imp.document.write("* {font-size:7.5px !important;font-family:verdana !important;color:#000;} "); 
				imp.document.write("p {display:none;} ");
				imp.document.write("}"); 
				imp.document.write("</style>"); 
				imp.document.write('<div style="width:100%;max-width:240px;font-size:12px;">'); 
				imp.document.write('<span style="display:block;width:100%;text-align:center;"> L.R. </span>');//agregamos el objeto;
				imp.document.write('<span style="display:block;width:100%;text-align:center;"> Repleto de Sabor </span>');//agregamos el objeto;
				imp.document.write('<span style="display:block;width:100%;text-align:center;"> RNC. 1-01-66458-4 </span>');//agregamos el objeto;
				//imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				imp.document.write('<span style="display:block;width:100%;"> Orden : ' + idexterno + '</span>');//agregamos el objeto;
				imp.document.write('<span style="width:300px;"> Fecha : ' + getFecha() + '</span><br/>');//agregamos el objeto;
				//imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				imp.document.write("<span style=\"width:300px;\">Datos del cliente</span><br/>");//agregamos el objeto;
				imp.document.write('<span style="width:300px;">' + clienteNombre + '</span><br/>');//agregamos el objeto;
				imp.document.write('<span style="width:300px;">' + clienteTelefono + '</span><br/>');//agregamos el objeto;
				imp.document.write('<span style="width:300px;">' + clienteDireccion + '</span><br/>');//agregamos el objeto;
				imp.document.write(div);//agregamos el objeto;
				//imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				imp.document.write("<div style=\" display:block;margin-top:10px;width:100%;text-align:right;font-size:16px ;font-weight:bold;position:relative; right:20px !important; \">Forma de pago </div>");//agregamos el objeto;
				if(valorefectivo > 0){
					imp.document.write("<div style=\" display:block;width:100%;text-align:right;position:relative; right:20px !important; \">Efectivo " + valorefectivo + "</div>");//agregamos el objeto;
				}
				if(valorcredito > 0){
					imp.document.write("<div style=\" display:block;width:100%;text-align:right;position:relative; right:20px !important; \">Credito " + valorcredito + "</div>");//agregamos el objeto;
				}
				if(valortarjeta > 0){
					imp.document.write("<div style=\" display:block;width:100%;text-align:right;position:relative; right:20px !important; \">Tarjeta " + valortarjeta + "</div>");//agregamos el objeto;
				}
				//imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				imp.document.write("<div style=\" display:block;margin-top:4px;width:100%;text-align:right;font-size:14px ;font-weight:bold;position:relative; right:20px !important; \">Cambio RD$ " + valorcambio + "</div>");//agregamos el objeto;
				imp.document.write("<div style=\" display:block;margin-top:0px;width:100%;text-align:left;font-size:12px ;position:relative; \">Cajero (a) : " + cajero + "</div>");//agregamos el objeto;
				imp.document.write('<span style="margin-top:0px;padding-top:0px;display:block;width:100%;text-align:center;border-top:1px solid #777777;"> GRACIAS POR PREFERIRNOS </span>');//agregamos el objeto;
				imp.document.write("</div>");//agregamos el objeto;
				imp.document.close();
				//imp.print();   //Abrimos la opcion de imprimir
				//imp.close(); //cerramos la ventana nueva
				
				if ((navigator.appName == "Netscape")) { 
					imp.print();
					imp.close();
				} else { 
					var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
					imp.insertAdjacentHTML('beforeEnd', WebBrowser); 
					WebBrowser1.ExecWB(6, -1); 
					WebBrowser1.outerHTML = "";
				}
			}
			
			/* 
			** imprSelec(id, idexterno = 0)
			** id: (string) id del div que contiene los detalles de la factura.
			** idexterno: (int,string) id o numero de orden de la factura, por default es 0 si no es especificado.
			** cajero: (string) Nombre del cajero(a) que factura, por default es '' si no es especificado.
			*/
			function imprSelecComanda(id, idexterno = 0,cajero = '') {
				$('.OrderBox .Order_table .Order_caption').hide();
				
				var div, imp, Order_box_width;
				Order_box_width = $(id).width();
				div = $(id).html();//seleccionamos el objeto
				imp = window.open(" ","Formato de Impresion"); //damos un titulo
				imp.document.open();					//abrimos
				var style = '';
				$('style').each(function(index,element){
					style = style + $(element).text();
				});
				
				$('.OrderBox .Order_table .Order_caption').show();
				
				var clienteNombre = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-nombrecliente');
				var clienteTelefono = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-telefonocliente');
				var clienteDireccion = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-direccioncliente');
				
				var credito = parseFloat($('#modalPago #formPago .textPagoCredito').val() != '' ? $('#modalPago #formPago .textPagoCredito').val() : '0.00' );
				var efectivo = parseFloat($('#modalPago #formPago .textPagoEfectivo').val() != '' ? $('#modalPago #formPago .textPagoEfectivo').val() : '0.00');
				var tarjeta = parseFloat($('#modalPago #formPago .textPagoTarjeta').val() != '' ? $('#modalPago #formPago .textPagoTarjeta').val() : '0.00');
				var cambio = parseFloat($('#modalPago #formPago .montoCambio').attr('data-valor') != '' ? $('#modalPago #formPago .montoCambio').attr('data-valor') : '0.00');
				
				var valorcredito = credito.toFixed(2);
				var valorefectivo = efectivo.toFixed(2);
				var valortarjeta = tarjeta.toFixed(2);
				var valorcambio = cambio.toFixed(2);
				
				//imp.document.write('<style>' + style + '</style>'); //tambien podriamos agregarle un <link ...
				imp.document.write("<style media=\"print\">"); 
				imp.document.write("* {list-style:none;padding:0px;margin:0px;font-weight:normal !important;} "); 
				imp.document.write("@media only print { "); 
				imp.document.write(".Order_table {height:auto !important;padding-top: 10px;padding-bottom: 0px;} "); 
				imp.document.write(".Order_box {width:400px;border:3px solid #cccccc;} "); 
				imp.document.write(".thead ul {display: !important;} "); 
				imp.document.write(".tbody {margin-top:0px !important;overflow:initial !important;height:auto !important;} "); 
				imp.document.write(".Total_label {display:none;position:relative !important;bottom:-34px !important;font-size:9px !important;font-weight:bold;right:10px !important;} "); 
				imp.document.write(".Total_label_servicio {display:none;position:relative !important;bottom:-14px !important;right:10px !important;} "); 
				imp.document.write(".Total_label_itbis {display:none;position:relative !important;bottom:4px !important;right:10px !important;} "); 
				imp.document.write(".Total_label_descuento {display:none;position:relative !important;bottom:22px !important;right:10px !important;} ");
				imp.document.write(".Total_label_subtotal {display:none;position:relative !important;bottom:40px !important;right:10px !important;} "); 
				imp.document.write(".thead {padding-top:0px !important;height:10px !important;border-bottom: 1px solid #000 !important;border-top: 1px solid #000;} "); 
				imp.document.write(".th-producto {max-width:130px !important;} "); 
				imp.document.write(".td-producto {max-width:120px !important;margin-bottom:5px;} "); 
				imp.document.write(".facturaProductoAdicional {border-left:0px !important;} "); 
				imp.document.write(".tbody ul {margin:0px !important;padding:0px !important;} "); 
				imp.document.write(".td-producto div {max-width:127px !important;float:left !important;} ");  
				imp.document.write(".th-precio { display:none;max-width:71px;} "); 
				imp.document.write(".td-precio { display:none;max-width:40px;} "); 
				imp.document.write(".td-close {display:none;} "); 
				imp.document.write("* {font-size:7.5px !important;font-family:verdana !important;color:#000;} "); 
				imp.document.write("p {display:none;} ");
				imp.document.write("}"); 
				imp.document.write("</style>"); 
				imp.document.write('<div style="width:100%;max-width:240px;font-size:12px;">'); 
				imp.document.write('<span style="display:block;width:100%;text-align:center;"> LLEVAR </span>');//agregamos el objeto;
				imp.document.write("<div style=\" display:block;margin-top:0px;width:100%;text-align:left;font-size:12px ;position:relative; \">Cajero (a) : " + cajero + "</div>");//agregamos el objeto;
				//imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				imp.document.write('<span style="display:block;width:100%;"> Orden : ' + idexterno + '</span>');//agregamos el objeto;
				imp.document.write('<span style="width:300px;"> Fecha : ' + getFecha() + '</span><br/>');//agregamos el objeto;
				//imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				imp.document.write(div);//agregamos el objeto;
				
				
				imp.document.write("</div>");//agregamos el objeto;
				imp.document.close();
				//imp.print();   //Abrimos la opcion de imprimir
				//imp.close(); //cerramos la ventana nueva
				
				if ((navigator.appName == "Netscape")) { 
					imp.print();
					imp.close();
				} else { 
					var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
					imp.insertAdjacentHTML('beforeEnd', WebBrowser); 
					WebBrowser1.ExecWB(6, -1); 
					WebBrowser1.outerHTML = "";
				}
			}
			
			
			/* 
			** imprSelec(id, idexterno = 0)
			** id: (string) id del div que contiene los detalles de la factura.
			** idexterno: (int,string) id o numero de orden de la factura, por default es 0 si no es especificado.
			** cajero: (string) Nombre del cajero(a) que factura, por default es '' si no es especificado.
			*/
			function reImprSelec(id) {
				//$('.OrderBox .Order_table .Order_caption').hide();
				
				var div, imp, Order_box_width;
				Order_box_width = $(id).width();
				div = $(id).html();//seleccionamos el objeto
				imp = window.open(" ","Formato de Impresion"); //damos un titulo
				imp.document.open();					//abrimos
				var style = '';
				$('style').each(function(index,element){
					style = style + $(element).text();
				});
				
				$('.OrderBox .Order_table .Order_caption').show();
				
				//var clienteNombre = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-nombrecliente');
				//var clienteTelefono = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-telefonocliente');
				//var clienteDireccion = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-direccioncliente');
				
				//var credito = parseFloat($('#modalPago #formPago .textPagoCredito').val() != '' ? $('#modalPago #formPago .textPagoCredito').val() : '0.00' );
				//var efectivo = parseFloat($('#modalPago #formPago .textPagoEfectivo').val() != '' ? $('#modalPago #formPago .textPagoEfectivo').val() : '0.00');
				//var tarjeta = parseFloat($('#modalPago #formPago .textPagoTarjeta').val() != '' ? $('#modalPago #formPago .textPagoTarjeta').val() : '0.00');
				//var cambio = parseFloat($('#modalPago #formPago .montoCambio').attr('data-valor') != '' ? $('#modalPago #formPago .montoCambio').attr('data-valor') : '0.00');
				
				//var valorcredito = credito.toFixed(2);
				//var valorefectivo = efectivo.toFixed(2);
				//var valortarjeta = tarjeta.toFixed(2);
				//var valorcambio = cambio.toFixed(2);
				
				//imp.document.write("&lt;script&gt;"); //tambien podriamos agregarle un <link ...
				//imp.document.write("$(document).ready(function(){"); //tambien podriamos agregarle un <link ...
				//imp.document.write("	$('css').attr('media','print');"); //tambien podriamos agregarle un <link ...
				//imp.document.write("});"); //tambien podriamos agregarle un <link ...
				//imp.document.write("&lt;/script&gt;"); //tambien podriamos agregarle un <link ...
				/////*imp.document.write('<style media=\'print\'>@media only print {' + style + '}</style>'); //tambien podriamos agregarle un <link ...
				//imp.document.write("Hola"); 
				imp.document.write("<style media=\"print\">"); 
				imp.document.write("* {list-style:none;padding:0px;margin:0px;font-weight:normal !important;} "); 
				imp.document.write("@media only print { "); 
				imp.document.write(".Order_table {height:auto !important;padding-top: 10px;padding-bottom: 0px;} "); 
				imp.document.write(".Order_box {width:400px;border:3px solid #cccccc;} "); 
				imp.document.write(".thead ul {display: !important;} "); 
				imp.document.write(".tbody {margin-top:0px !important;overflow:initial !important;height:auto !important;} "); 
				imp.document.write(".Total_label {position:relative !important;bottom:-34px !important;font-size:9px !important;font-weight:bold;right:10px !important;} "); 
				imp.document.write(".Total_label_servicio {position:relative !important;bottom:-14px !important;right:10px !important;} "); 
				imp.document.write(".Total_label_itbis {position:relative !important;bottom:4px !important;right:10px !important;} "); 
				imp.document.write(".Total_label_descuento {position:relative !important;bottom:22px !important;right:10px !important;} ");
				imp.document.write(".Total_label_subtotal {position:relative !important;bottom:40px !important;right:10px !important;} "); 
				imp.document.write(".thead {padding-top:0px !important;height:10px !important;border-bottom: 1px solid #000 !important;border-top: 1px solid #000;} "); 
				imp.document.write(".th-producto {max-width:130px !important;} "); 
				imp.document.write(".td-producto {max-width:120px !important;margin-bottom:5px;} "); 
				imp.document.write(".facturaProductoAdicional {border-left:0px !important;} "); 
				imp.document.write(".tbody ul {margin:0px !important;padding:0px !important;} "); 
				imp.document.write(".td-producto div {max-width:127px !important;float:left !important;} "); 
				imp.document.write(".th-precio {max-width:71px;} "); 
				imp.document.write(".td-precio {max-width:40px;} "); 
				imp.document.write(".td-close {display:none;} "); 
				imp.document.write("* {font-size:7.5px !important;font-family:verdana !important;color:#000;} "); 
				imp.document.write("p {display:none;} "); 
				//imp.document.write("<span style=\"font-size:15px !important;\">Datos del cliente*</span><br/>");//agregamos el objeto;
				imp.document.write("}"); 
				imp.document.write("</style>"); 
				imp.document.write('<div style="width:100%;max-width:240px;font-size:12px;">'); 
				//imp.document.write('<span style="display:block;width:100%;text-align:center;"> L.R. </span>');//agregamos el objeto;
				//imp.document.write('<span style="display:block;width:100%;text-align:center;"> Repleto de Sabor </span>');//agregamos el objeto;
				//imp.document.write('<span style="display:block;width:100%;text-align:center;"> RNC. 1-01-66458-4 </span>');//agregamos el objeto;
				// imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				//imp.document.write('<span style="display:block;width:100%;"> Orden : ' + idexterno + '</span>');//agregamos el objeto;
				// imp.document.write('<span style="width:300px;"> Fecha : ' + getFecha() + '</span>');//agregamos el objeto;
				// imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				// imp.document.write('<span style="width:300px;">' + clienteNombre + '</span><br/>');//agregamos el objeto;
				// imp.document.write('<span style="width:300px;">' + clienteTelefono + '</span><br/>');//agregamos el objeto;
				// imp.document.write('<span style="width:300px;">' + clienteDireccion + '</span><br/>');//agregamos el objeto;
				imp.document.write(div);//agregamos el objeto;
				// imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;margin-top:10px;width:100%;text-align:right;font-size:16px !important;font-weight:bold;position:relative; right:20px !important; \">Forma de pago </div>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;width:100%;text-align:right;position:relative; right:20px !important; \">Efectivo " + valorefectivo + "</div>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;width:100%;text-align:right;position:relative; right:20px !important; \">Credito " + valorcredito + "</div>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;width:100%;text-align:right;position:relative; right:20px !important; \">Tarjeta " + valortarjeta + "</div>");//agregamos el objeto;
				// imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;margin-top:10px;width:100%;text-align:right;font-size:14px !important;font-weight:bold;position:relative; right:20px !important; \">Cambio RD$ " + valorcambio + "</div>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;margin-top:10px;width:100%;text-align:left;font-size:12px !important;position:relative; \">Cajero (a) : " + cajero + "</div>");//agregamos el objeto;
				// imp.document.write('<span style="margin-top:10px;padding-top:10px;display:block;width:100%;text-align:center;border-top:1px solid #777777;"> GRACIAS POR PREFERIRNOS </span>');//agregamos el objeto;
				imp.document.write("</div>");//agregamos el objeto;
				imp.document.close();
				//imp.print();   //Abrimos la opcion de imprimir
				//imp.close(); //cerramos la ventana nueva
				
				if ((navigator.appName == "Netscape")) { 
					imp.print();
					imp.close();
				} else { 
					var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
					imp.insertAdjacentHTML('beforeEnd', WebBrowser); 
					WebBrowser1.ExecWB(6, -1); 
					WebBrowser1.outerHTML = "";
				}
			}
			
			/* 
			** imprSelec(id, idexterno = 0)
			** id: (string) id del div que contiene los detalles de la factura.
			** idexterno: (int,string) id o numero de orden de la factura, por default es 0 si no es especificado.
			** cajero: (string) Nombre del cajero(a) que factura, por default es '' si no es especificado.
			*/
			function imprSelecCierre(id) {
				//$('.OrderBox .Order_table .Order_caption').hide();
				
				var div, imp, Order_box_width;
				Order_box_width = $(id).width();
				div = $(id).html();//seleccionamos el objeto
				imp = window.open(" ","Formato de Impresion"); //damos un titulo
				imp.document.open();					//abrimos
				var style = '';
				$('style').each(function(index,element){
					style = style + $(element).text();
				});
				
				//$('.OrderBox .Order_table .Order_caption').show();
				
				//var clienteNombre = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-nombrecliente');
				//var clienteTelefono = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-telefonocliente');
				//var clienteDireccion = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-direccioncliente');
				
				//var credito = parseFloat($('#modalPago #formPago .textPagoCredito').val() != '' ? $('#modalPago #formPago .textPagoCredito').val() : '0.00' );
				//var efectivo = parseFloat($('#modalPago #formPago .textPagoEfectivo').val() != '' ? $('#modalPago #formPago .textPagoEfectivo').val() : '0.00');
				//var tarjeta = parseFloat($('#modalPago #formPago .textPagoTarjeta').val() != '' ? $('#modalPago #formPago .textPagoTarjeta').val() : '0.00');
				//var cambio = parseFloat($('#modalPago #formPago .montoCambio').attr('data-valor') != '' ? $('#modalPago #formPago .montoCambio').attr('data-valor') : '0.00');
				
				//var valorcredito = credito.toFixed(2);
				//var valorefectivo = efectivo.toFixed(2);
				//var valortarjeta = tarjeta.toFixed(2);
				//var valorcambio = cambio.toFixed(2);
				
				//imp.document.write("&lt;script&gt;"); //tambien podriamos agregarle un <link ...
				//imp.document.write("$(document).ready(function(){"); //tambien podriamos agregarle un <link ...
				//imp.document.write("	$('css').attr('media','print');"); //tambien podriamos agregarle un <link ...
				//imp.document.write("});"); //tambien podriamos agregarle un <link ...
				//imp.document.write("&lt;/script&gt;"); //tambien podriamos agregarle un <link ...
				/////*imp.document.write('<style media=\'print\'>@media only print {' + style + '}</style>'); //tambien podriamos agregarle un <link ...
				//imp.document.write("Hola"); 
				imp.document.write("<style media=\"print\">"); 
				imp.document.write("* {list-style:none;padding:0px;margin:0px;font-weight:normal !important;} "); 
				imp.document.write("@media only print { "); 
				imp.document.write(".Order_table {height:auto !important;padding-top: 10px;padding-bottom: 0px;} "); 
				imp.document.write(".Order_box {width:400px;border:3px solid #cccccc;} "); 
				imp.document.write(".thead ul {display: !important;} "); 
				imp.document.write(".tbody {margin-top:0px !important;overflow:initial !important;height:auto !important;} "); 
				imp.document.write(".Total_label {position:relative !important;bottom:-34px !important;font-size:9px !important;font-weight:bold;right:10px !important;} "); 
				imp.document.write(".Total_label_servicio {position:relative !important;bottom:-14px !important;right:10px !important;} "); 
				imp.document.write(".Total_label_itbis {position:relative !important;bottom:4px !important;right:10px !important;} "); 
				imp.document.write(".Total_label_descuento {position:relative !important;bottom:22px !important;right:10px !important;} ");
				imp.document.write(".Total_label_subtotal {position:relative !important;bottom:40px !important;right:10px !important;} "); 
				imp.document.write(".thead {padding-top:0px !important;height:10px !important;border-bottom: 1px solid #000 !important;border-top: 1px solid #000;} "); 
				imp.document.write(".th-producto {max-width:130px !important;} "); 
				imp.document.write(".td-producto {max-width:120px !important;margin-bottom:5px;} "); 
				imp.document.write(".facturaProductoAdicional {border-left:0px !important;} "); 
				imp.document.write(".tbody ul {margin:0px !important;padding:0px !important;} "); 
				imp.document.write(".td-producto div {max-width:127px !important;float:left !important;} "); 
				imp.document.write(".th-precio {max-width:71px;} "); 
				imp.document.write(".td-precio {max-width:40px;} "); 
				imp.document.write(".td-close {display:none;} "); 
				imp.document.write("* {font-size:13px !important;font-family:verdana !important;color:#000;} "); 
				imp.document.write("p {display:none;} "); 
				//imp.document.write("<span style=\"font-size:15px !important;\">Datos del cliente*</span><br/>");//agregamos el objeto;
				imp.document.write("}"); 
				imp.document.write("</style>"); 
				imp.document.write('<div style="width:100%;max-width:240px;font-size:12px;">'); 
				//imp.document.write('<span style="display:block;width:100%;text-align:center;"> L.R. </span>');//agregamos el objeto;
				//imp.document.write('<span style="display:block;width:100%;text-align:center;"> Repleto de Sabor </span>');//agregamos el objeto;
				//imp.document.write('<span style="display:block;width:100%;text-align:center;"> RNC. 1-01-66458-4 </span>');//agregamos el objeto;
				// imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				//imp.document.write('<span style="display:block;width:100%;"> Orden : ' + idexterno + '</span>');//agregamos el objeto;
				// imp.document.write('<span style="width:300px;"> Fecha : ' + getFecha() + '</span>');//agregamos el objeto;
				// imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				// imp.document.write('<span style="width:300px;">' + clienteNombre + '</span><br/>');//agregamos el objeto;
				// imp.document.write('<span style="width:300px;">' + clienteTelefono + '</span><br/>');//agregamos el objeto;
				// imp.document.write('<span style="width:300px;">' + clienteDireccion + '</span><br/>');//agregamos el objeto;
				imp.document.write(div);//agregamos el objeto;
				// imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;margin-top:10px;width:100%;text-align:right;font-size:16px !important;font-weight:bold;position:relative; right:20px !important; \">Forma de pago </div>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;width:100%;text-align:right;position:relative; right:20px !important; \">Efectivo " + valorefectivo + "</div>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;width:100%;text-align:right;position:relative; right:20px !important; \">Credito " + valorcredito + "</div>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;width:100%;text-align:right;position:relative; right:20px !important; \">Tarjeta " + valortarjeta + "</div>");//agregamos el objeto;
				// imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;margin-top:10px;width:100%;text-align:right;font-size:14px !important;font-weight:bold;position:relative; right:20px !important; \">Cambio RD$ " + valorcambio + "</div>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;margin-top:10px;width:100%;text-align:left;font-size:12px !important;position:relative; \">Cajero (a) : " + cajero + "</div>");//agregamos el objeto;
				// imp.document.write('<span style="margin-top:10px;padding-top:10px;display:block;width:100%;text-align:center;border-top:1px solid #777777;"> GRACIAS POR PREFERIRNOS </span>');//agregamos el objeto;
				imp.document.write("</div>");//agregamos el objeto;
				imp.document.close();
				//imp.print();   //Abrimos la opcion de imprimir
				//imp.close(); //cerramos la ventana nueva
				
				if ((navigator.appName == "Netscape")) { 
					imp.print();
					imp.close();
				} else { 
					var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
					imp.insertAdjacentHTML('beforeEnd', WebBrowser); 
					WebBrowser1.ExecWB(6, -1); 
					WebBrowser1.outerHTML = "";
				}
				
				imprSelecCierreProductos('#toPrintProductosCierre');
			}
			
			function imprSelecCierreProductos(id) {
				//$('.OrderBox .Order_table .Order_caption').hide();
				
				var div, imp, Order_box_width;
				Order_box_width = $(id).width();
				div = $(id).html();//seleccionamos el objeto
				imp = window.open(" ","Formato de Impresion"); //damos un titulo
				imp.document.open();					//abrimos
				var style = '';
				$('style').each(function(index,element){
					style = style + $(element).text();
				});
				
				//$('.OrderBox .Order_table .Order_caption').show();
				
				//var clienteNombre = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-nombrecliente');
				//var clienteTelefono = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-telefonocliente');
				//var clienteDireccion = $('.OrderBox .Order_table .Order_caption .clienteDataVenta').attr('data-direccioncliente');
				
				//var credito = parseFloat($('#modalPago #formPago .textPagoCredito').val() != '' ? $('#modalPago #formPago .textPagoCredito').val() : '0.00' );
				//var efectivo = parseFloat($('#modalPago #formPago .textPagoEfectivo').val() != '' ? $('#modalPago #formPago .textPagoEfectivo').val() : '0.00');
				//var tarjeta = parseFloat($('#modalPago #formPago .textPagoTarjeta').val() != '' ? $('#modalPago #formPago .textPagoTarjeta').val() : '0.00');
				//var cambio = parseFloat($('#modalPago #formPago .montoCambio').attr('data-valor') != '' ? $('#modalPago #formPago .montoCambio').attr('data-valor') : '0.00');
				
				//var valorcredito = credito.toFixed(2);
				//var valorefectivo = efectivo.toFixed(2);
				//var valortarjeta = tarjeta.toFixed(2);
				//var valorcambio = cambio.toFixed(2);
				
				//imp.document.write("&lt;script&gt;"); //tambien podriamos agregarle un <link ...
				//imp.document.write("$(document).ready(function(){"); //tambien podriamos agregarle un <link ...
				//imp.document.write("	$('css').attr('media','print');"); //tambien podriamos agregarle un <link ...
				//imp.document.write("});"); //tambien podriamos agregarle un <link ...
				//imp.document.write("&lt;/script&gt;"); //tambien podriamos agregarle un <link ...
				/////*imp.document.write('<style media=\'print\'>@media only print {' + style + '}</style>'); //tambien podriamos agregarle un <link ...
				//imp.document.write("Hola"); 
				imp.document.write("<style media=\"print\">"); 
				imp.document.write("* {list-style:none;padding:0px;margin:0px;font-weight:normal !important;} "); 
				imp.document.write("@media only print { "); 
				imp.document.write(".Order_table {height:auto !important;padding-top: 10px;padding-bottom: 0px;} "); 
				imp.document.write(".Order_box {width:400px;border:3px solid #cccccc;} "); 
				imp.document.write(".thead ul {display: !important;} "); 
				imp.document.write(".tbody {margin-top:0px !important;overflow:initial !important;height:auto !important;} "); 
				imp.document.write(".Total_label {position:relative !important;bottom:-34px !important;font-size:9px !important;font-weight:bold;right:10px !important;} "); 
				imp.document.write(".Total_label_servicio {position:relative !important;bottom:-14px !important;right:10px !important;} "); 
				imp.document.write(".Total_label_itbis {position:relative !important;bottom:4px !important;right:10px !important;} "); 
				imp.document.write(".Total_label_descuento {position:relative !important;bottom:22px !important;right:10px !important;} ");
				imp.document.write(".Total_label_subtotal {position:relative !important;bottom:40px !important;right:10px !important;} "); 
				imp.document.write(".thead {padding-top:0px !important;height:10px !important;border-bottom: 1px solid #000 !important;border-top: 1px solid #000;} "); 
				imp.document.write(".th-producto {max-width:130px !important;} "); 
				imp.document.write(".td-producto {max-width:120px !important;margin-bottom:5px;} "); 
				imp.document.write(".facturaProductoAdicional {border-left:0px !important;} "); 
				imp.document.write(".tbody ul {margin:0px !important;padding:0px !important;} "); 
				imp.document.write(".td-producto div {max-width:127px !important;float:left !important;} "); 
				imp.document.write(".th-precio {max-width:71px;} "); 
				imp.document.write(".td-precio {max-width:40px;} "); 
				imp.document.write(".td-close {display:none;} "); 
				imp.document.write("* {font-size:13px !important;font-family:verdana !important;color:#000;} "); 
				imp.document.write("p {display:none;} "); 
				//imp.document.write("<span style=\"font-size:15px !important;\">Datos del cliente*</span><br/>");//agregamos el objeto;
				imp.document.write("}"); 
				imp.document.write("</style>"); 
				imp.document.write('<div style="width:100%;max-width:240px;font-size:12px;">'); 
				//imp.document.write('<span style="display:block;width:100%;text-align:center;"> L.R. </span>');//agregamos el objeto;
				//imp.document.write('<span style="display:block;width:100%;text-align:center;"> Repleto de Sabor </span>');//agregamos el objeto;
				//imp.document.write('<span style="display:block;width:100%;text-align:center;"> RNC. 1-01-66458-4 </span>');//agregamos el objeto;
				// imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				//imp.document.write('<span style="display:block;width:100%;"> Orden : ' + idexterno + '</span>');//agregamos el objeto;
				// imp.document.write('<span style="width:300px;"> Fecha : ' + getFecha() + '</span>');//agregamos el objeto;
				// imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				// imp.document.write('<span style="width:300px;">' + clienteNombre + '</span><br/>');//agregamos el objeto;
				// imp.document.write('<span style="width:300px;">' + clienteTelefono + '</span><br/>');//agregamos el objeto;
				// imp.document.write('<span style="width:300px;">' + clienteDireccion + '</span><br/>');//agregamos el objeto;
				imp.document.write(div);//agregamos el objeto;
				// imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;margin-top:10px;width:100%;text-align:right;font-size:16px !important;font-weight:bold;position:relative; right:20px !important; \">Forma de pago </div>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;width:100%;text-align:right;position:relative; right:20px !important; \">Efectivo " + valorefectivo + "</div>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;width:100%;text-align:right;position:relative; right:20px !important; \">Credito " + valorcredito + "</div>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;width:100%;text-align:right;position:relative; right:20px !important; \">Tarjeta " + valortarjeta + "</div>");//agregamos el objeto;
				// imp.document.write("<p>&nbsp;</p>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;margin-top:10px;width:100%;text-align:right;font-size:14px !important;font-weight:bold;position:relative; right:20px !important; \">Cambio RD$ " + valorcambio + "</div>");//agregamos el objeto;
				// imp.document.write("<div style=\" display:block;margin-top:10px;width:100%;text-align:left;font-size:12px !important;position:relative; \">Cajero (a) : " + cajero + "</div>");//agregamos el objeto;
				// imp.document.write('<span style="margin-top:10px;padding-top:10px;display:block;width:100%;text-align:center;border-top:1px solid #777777;"> GRACIAS POR PREFERIRNOS </span>');//agregamos el objeto;
				imp.document.write("</div>");//agregamos el objeto;
				imp.document.close();
				//imp.print();   //Abrimos la opcion de imprimir
				//imp.close(); //cerramos la ventana nueva
				
				if ((navigator.appName == "Netscape")) { 
					imp.print();
					imp.close();
				} else { 
					var WebBrowser = '<OBJECT ID="WebBrowser1" WIDTH=0 HEIGHT=0 CLASSID="CLSID:8856F961-340A-11D0-A96B-00C04FD705A2"></OBJECT>';
					imp.insertAdjacentHTML('beforeEnd', WebBrowser); 
					WebBrowser1.ExecWB(6, -1); 
					WebBrowser1.outerHTML = "";
				}
			}
			
			//** Mostrar los mensajeros de esta localidad para seleccion a factura ***************/
			//************************************************************************************/
			$('#modalListMensajeros #closeModalListMensajeros, #modalListMensajeros #CancelarListMensajeros').click(function(){
				$('#modalListMensajeros').fadeOut('fast');
			});
			$(document).on('click','#modalListMensajeros #formListMensajeros .modal-body .mensajero',function(){
				event.preventDefault();
				if($(this).hasClass('selected')){
					$('#modalListMensajeros #formListMensajeros .modal-body .mensajero').removeClass('selected');
					$('#modalListMensajeros #formListMensajeros .modal-body .mensajero').css('background','#e8e8e8');
					$('#modalListMensajeros #formListMensajeros .modal-body .mensajero').css('font-weight','normal');
					$('#modalListMensajeros #formListMensajeros .modal-body .mensajero').css('color','black');
					$('#modalListMensajeros #formListMensajeros #ismensajero').val(0);
					$('#modalListMensajeros #formListMensajeros #idmensajero').val(0);
				}else{
					$('#modalListMensajeros #formListMensajeros .modal-body .mensajero').removeClass('selected');
					$('#modalListMensajeros #formListMensajeros .modal-body .mensajero').css('background','#e8e8e8');
					$('#modalListMensajeros #formListMensajeros .modal-body .mensajero').css('font-weight','normal');
					$('#modalListMensajeros #formListMensajeros .modal-body .mensajero').css('color','black');
					$(this).addClass('selected');
					$(this).css('background','green');
					$(this).css('font-weight','bold');
					$(this).css('color','white');
					
					$('#modalListMensajeros #formListMensajeros #ismensajero').val(1);
					$('#modalListMensajeros #formListMensajeros #idmensajero').val($(this).attr('data-id'));
				}
			});
			function showAllMensajeros(){
				var dominio = document.domain;
				var asunto = 'getmensajeros';
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto
				}, function(data,status){
					if(status == "success"){
						$( "#modalListMensajeros #formListMensajeros .modal-body .mensajero" ).remove();
						
						var datos = data.data;
						$.each(datos, function ( index, value ) {
							//$( ".display" ).append( "<div class=\"categorias\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value['nombreCategoria']+"</div>" );
							var datosUsuario = "";
							if(value['EstatusActual'] == 0){
								datosUsuario += "<div class=\" mensajero \" data-id=\""+ value['id'] +"\" style=\" display:block;padding:5px;margin-bottom:3px;width:100%;background:#e8e8e8;border-left:2px solid green;cursor:pointer; \">"+ value['nombreUsuario'] +"</div>";
							}else if(value['EstatusActual'] == 1){
								datosUsuario += "<div class=\" mensajero \" data-id=\""+ value['id'] +"\" style=\" display:block;padding:5px;margin-bottom:3px;width:100%;background:#e8e8e8;border-left:2px solid green;cursor:pointer; \">"+ value['nombreUsuario'] +"</div>";
							}else if(value['EstatusActual'] == 2){
								datosUsuario += "<div class=\" mensajero \" data-id=\""+ value['id'] +"\" style=\" display:block;padding:5px;margin-bottom:3px;width:100%;background:#e8e8e8;border-left:2px solid #FE9A2E;cursor:pointer; \">"+ value['nombreUsuario'] +"</div>";
							}else if(value['EstatusActual'] == 3){
								datosUsuario += "<div class=\" mensajero \" data-id=\""+ value['id'] +"\" style=\" display:block;padding:5px;margin-bottom:3px;width:100%;background:#e8e8e8;border-left:2px solid green;cursor:pointer; \">"+ value['nombreUsuario'] +"</div>";
							}else{
								datosUsuario += "<div class=\" mensajero \" data-id=\""+ value['id'] +"\" style=\" display:block;padding:5px;margin-bottom:3px;width:100%;background:#e8e8e8;border-left:2px solid green;cursor:pointer; \">"+ value['nombreUsuario'] +"</div>";
							}
							$( "#modalListMensajeros #formListMensajeros .modal-body" ).append(datosUsuario);
						});
						
						if($('#modalListMensajeros #formListMensajeros #ismensajero').val() == 1){
							$('#modalListMensajeros #formListMensajeros .modal-body div').each(function(index,element){
								if($(element).attr('data-id') == $('#modalListMensajeros #formListMensajeros #idmensajero').val()){
									$(element).addClass('selected');
									$(element).css('background','green');
									$(element).css('font-weight','bold');
									$(element).css('color','white');
								}
							});
						}
						
						$('#modalListMensajeros').fadeIn('fast');
					}
				});
			}
			
			//** Mostrar las ultimas facturas en modal *******************************************/
			//************************************************************************************/
			function showUltimasFacturas(){
				var dominio = document.domain;
				var asunto = 'ultimasfactura';
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto
				}, function(data,status){
					if(status == "success"){
						$( "#modalUltimasFacturas #formUltimasFacturas #resultadosUltimasFacturas tbody tr" ).remove();
						var datos2 = data.data2;
						$.each(datos2, function ( index, value2 ) {
							//$( ".display" ).append( "<div class=\"categorias\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value['nombreCategoria']+"</div>" );
							if(value2['iscanceled'] == 1){
								var datosFactura = "<tr class=facturaData data-idfactura=\"" + value2['idExterno'] + "\" data-numerofactura=\"" + value2['idExterno'] + "\" data-ctenombre=\"" + value2['nombreCliente'] + "\" data-fechafactura=\"" + value2['fechaFactura'] + "\" data-iscanceledfactura=\"" + value2['iscanceled'] + "\" style=\" opacity:0.5; \">";
								datosFactura += "<td class=\"td-nombre\" style=\"min-width:150px;width:226px;\"><i class=\"fa fa-user\"></i> <span style=\" font-weight:bold;color:black; \">" + value2['nombreCliente'] + "</span><br>F. No. " + value2['idExterno'] + "</td>";
								datosFactura += "<td class=\"td-monto\" style=\"width:170px;\">RD$ "+addCommas(parseFloat(value2['valorFactura']).toFixed(2))+"</td>";
								datosFactura += "<td class=\"td-fecha\" style=\"width:168px;\">"+value2['fechaFactura']+"</td>";
								datosFactura += "<td class=\"td-anular\" style=\"width:26px;\"><i class=\"fa fa-ban\" aria-hidden='true'></i></td>";
								datosFactura += "<td class=\"td-print\" style=\"width:26px;\"><i class=\"fa fa-print\" aria-hidden='true'></i></td>";
								datosFactura += "</tr>";
							}else{
								var datosFactura = "<tr class=facturaData data-idfactura=\"" + value2['idExterno'] + "\" data-numerofactura=\"" + value2['idExterno'] + "\" data-ctenombre=\"" + value2['nombreCliente'] + "\" data-fechafactura=\"" + value2['fechaFactura'] + "\" data-iscanceledfactura=\"" + value2['iscanceled'] + "\">";
								datosFactura += "<td class=\"td-nombre\" style=\"min-width:150px;width:226px;\"><i class=\"fa fa-user\"></i> <span style=\" font-weight:bold;color:#2BBBAD; \">" + value2['nombreCliente'] + "</span><br>F. No. " + value2['idExterno'] + "</td>";
								datosFactura += "<td class=\"td-monto\" style=\"width:170px;\">RD$ "+addCommas(parseFloat(value2['valorFactura']).toFixed(2))+"</td>";
								datosFactura += "<td class=\"td-fecha\" style=\"width:168px;\">"+value2['fechaFactura']+"</td>";
								datosFactura += "<td class=\"td-anular\" style=\"width:26px;\"><a href='#' data-id='"+value2['idExterno']+"' title=\"Anular factura\"><i class=\"fa fa-ban\" aria-hidden='true'></i></a></td>";
								datosFactura += "<td class=\"td-print\" style=\"width:26px;color:blue;\"><a href='#' data-id='"+value2['id']+"' title=\"Reimprimir factura\"><i class=\"fa fa-print\" aria-hidden='true'></i></a></td>";
								datosFactura += "</tr>";
							}
							$( "#modalUltimasFacturas #formUltimasFacturas #resultadosUltimasFacturas tbody" ).append(datosFactura);
						});
						$('#modalUltimasFacturas').fadeIn('fast');
					}
				});
			}
			/* Funciones para la reimpresion de facturas provenientes del modal ultimasFacturas */
			/************************************************************************************/
			$(document).on('click',"#modalUltimasFacturas #formUltimasFacturas #resultadosUltimasFacturas tbody tr .td-print a",function(){
				
				var id = $(this).attr('data-id');
				
				var dominio = document.domain;
				var asunto = 'getfacturatoprint';
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					id: id
				}, function(data,status){
					if(status == "success"){
						if(data.status == "success"){
							
							
							var datos = data.data; //Datos de factura
							var datos2 = data.data2; //Detalles de factura
							var datos3 = data.data3; //Usuario cajero
							$.each(datos, function ( index, value ) {
								//$( ".display" ).append( "<div class=\"categorias\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value['nombreCategoria']+"</div>" );
								
								$('#toPrint .orden_print').text(value['idExterno']);	
								$('#toPrint .fecha_print').text(value['fechaFactura']);	
								$('#toPrint .nombrecliente_print').text(value['nombreCliente']);	
								$('#toPrint .telefonocliente_print').text(value['telefonoCliente']);	
								$('#toPrint .direccioncliente_print').text(value['direccionCliente']);	
								
								$('#toPrint .total_print').text(addCommas(parseFloat(value['valorFactura']).toFixed(2)));	
								$('#toPrint .servicio_print').text(addCommas(parseFloat(value['comisionFactura']).toFixed(2)));	
								$('#toPrint .itbis_print').text(addCommas(parseFloat(value['impuestoFactura']).toFixed(2)));	
								$('#toPrint .descuento_print').text(addCommas(parseFloat(value['descuentoFactura']).toFixed(2)));	
								$('#toPrint .subtotal_print').text(addCommas(parseFloat(parseFloat(value['valorFactura']) - parseFloat(value['impuestoFactura'])).toFixed(2)));	
								
								$('#toPrint .cambio_print').text(addCommas(parseFloat((parseFloat(value['valorEfectivo']) + parseFloat(value['valorCredito']) + parseFloat(value['valorTarjeta'])) - parseFloat(value['valorFactura'])).toFixed(2)));	
									
								$('#toPrint .efectivo_print').text(addCommas(parseFloat(value['valorEfectivo']).toFixed(2)));		
								$('#toPrint .credito_print').text(addCommas(parseFloat(value['valorCredito']).toFixed(2)));		
								$('#toPrint .tarjeta_print').text(addCommas(parseFloat(value['valorTarjeta']).toFixed(2)));		
								//$( "#modalUltimasFacturas #formUltimasFacturas #resultadosUltimasFacturas tbody" ).append(datosFactura);
								
								if(parseFloat(value['valorEfectivo']) > 0){
									$('#toPrint .efectivo_print').parent('div').show();
								}else{
									$('#toPrint .efectivo_print').parent('div').hide();
								}
								
								if(parseFloat(value['valorTarjeta']) > 0){
									$('#toPrint .tarjeta_print').parent('div').show();
								}else{
									$('#toPrint .tarjeta_print').parent('div').hide();
								}
								
								if(parseFloat(value['valorCredito']) > 0){
									$('#toPrint .credito_print').parent('div').show();
								}else{
									$('#toPrint .credito_print').parent('div').hide();
								}
							});
							
							var dataProducto = "";
							var dataAdicionales = "";
							$.each(datos2, function ( index, value2 ) {
								
								dataProducto += "<ul class=\"\" style=\"display:block;margin-top:10px;\">";
								dataProducto += "<li class=\"td-producto\" style=\"width:210px;float:left;font-weight:bold;\"><i class=\"fa fa-cart-plus\"></i><div style=\"width:190px;overflow: hidden;white-space: nowrap;text-overflow: ellipsis;float:right;\" title=\"Lasagna\">" + value2['nombreProducto'] + "</div>";
								dataProducto += "<ul>";
								
								dataAdicionales = value2['adicionalesProducto'];
								dataAdicionales.split(",").forEach(function(filas){
									if(filas != ""){
										dataProducto += "<li class=\"facturaProductoAdicional\" style=\"font-weight:initial;border-left: 3px solid #46ec46;padding-left: 4px;\">" + filas + "</li>";
									}
								});
								
								dataProducto += "<div class=\"clear\" style=\"width:100%;clear:both;\"></div>";
								dataProducto += "</ul>";
								dataProducto += "</li>";
								dataProducto += "<li class=\"td-cantidad\" style=\"width:25px;float:left;font-weight:initial;\">(" + value2['cantidadProducto'] + ")</li>";
								dataProducto += "<li class=\"td-precio\" style=\"width:100px;float:left;font-weight:initial;text-align:right;\">" + addCommas(parseFloat(value2['costoProducto']).toFixed(2)) + "</li>";
								dataProducto += "<div class=\"notaProducto\" data-nota=\"\" style=\"font-weight:initial;color:#c1c1c1;width:100%;clear:both;\">" + value2['notaProducto'] + "</div>";
								dataProducto += "</ul>";
								
								$('#toPrint .tbody ul').remove();
								$('#toPrint .tbody').append(dataProducto);
								
								
								//$('#toPrint .cajero_print').text(value3['nombreUsuario']);
							});
							
							$.each(datos3, function ( index, value3 ) {
								//$( ".display" ).append( "<div class=\"categorias\" id=\""+value['id']+"\" data-id=\""+value['id']+"\" data-categoriamadre=\""+value['idCategoriaMadre']+"\" style=\"display:block;float:left;width:100px;height:100px;padding:5px;margin-right:5px;margin-bottom:5px;background:#F78181;color:#fff;font-weight:bold;cursor:pointer;\">"+value['nombreCategoria']+"</div>" );
								
								$('#toPrint .cajero_print').text(value3['nombreUsuario']);
							});
							
							var datosFactura = $('#toPrint').html();
							
							reImprSelec(datosFactura);
						}
					}else{
						alert('server error');
					}
				});
			});
			$(document).on('click',"#modalUltimasFacturas #formUltimasFacturas #resultadosUltimasFacturas tbody tr .td-anular a",function(){
				
				$('#modalAnularFactura #formAnularFactura #idFactura').val($(this).attr('data-id'));
				
				callModalAccessKey('modalAnularFactura');
			});
			$('#closeModalAnularFactura, #CancelarAnularFactura').click(function(){
				event.preventDefault();
				$('#modalAnularFactura').fadeOut('fast');
			});
			$('#modalAnularFactura #GuardarAnularFactura').click(function(){
				var id = $('#modalAnularFactura #formAnularFactura #idFactura').val();
			
				//var accesskey = $('#modalAccessKey #formAccessKey #accessKey').val();
					
				var dominio = document.domain;
				var asunto = 'anularFactura';
				
					var notafactura 				= $('#modalNota #notafactura').val();
					
					if(id == ''){
						alert('El id de la factura esta vacio');
						
						//$('#modalLoader').fadeOut('fast');
						
						// $('#modalPago #formPago .modal-body').hide();
						// $('#modalPago #formPago .modal-footer').fadeIn('fast');
						// $('#modalPago .modal-header').fadeIn('fast');
						// $('#modalPago #formPago .pagos').fadeIn('fast');
						
						return false;
					}
					
					function siRespuesta(){
						
						// $('#modalPago').fadeOut('fast');
						//$('#modalPagoCredito').fadeOut('fast');
						
						// $('#modalPago #formPago .modal-body').hide();
						// $('#modalPago #formPago .modal-footer').fadeIn('fast');
						// $('#modalPago .modal-header').fadeIn('fast');
						// $('#modalPago #formPago .pagos').fadeIn('fast');
						
						anularFactura(id);
					}
				 
					function siError(e){
						
						// $('#modalPago #formPago .modal-body').hide();
						// $('#modalPago #formPago .modal-footer').fadeIn('fast');
						// $('#modalPago .modal-header').fadeIn('fast');
						// $('#modalPago #formPago .pagos').fadeIn('fast');
						
						//$('#modalLoader').fadeOut('fast');
						
						alert('Ocurrió un error al realizar la petición: '+e.statusText + '\n' + e.responseText);
					}
				 
					function peticion(e){
						// Realizar la petición
						var parametros = {
							asunto: asunto,
							id: id
						};
				 
						var post = $.post("http://"+dominio+"/phpsql/facturas.php", parametros, siRespuesta, 'json');
				 
						/* Registrar evento de la petición (hay mas)
						   (no es obligatorio implementarlo, pero es muy recomendable para detectar errores) */
				 
						post.error(siError);         // Si ocurrió un error al ejecutar la petición se ejecuta "siError"
					}
					peticion();
				
				
				
				function anularFactura(id){
					var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
					{ 
						asunto: asunto,
						id: id
					}, function(data,status){
						if(status == "success"){
							if(data.status == "success"){
								$('#modalAnularFactura').fadeOut('fast');
								showUltimasFacturas();
							}
						}else{
							alert('server error');
						}
					});
				}
			});
			$('#closeModalUltimasFacturas, #CancelarModalUltimasFacturas').click(function(){
				event.preventDefault();
				$('#modalUltimasFacturas').fadeOut('fast');
			});
			
			//************************************************************************************/
			
			
			$(document).on('click', '.notaFacturaActual',function () {
			//$('.editarMensajeroPassword').click(function(){
				event.preventDefault();
				$('#modalNota').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalNota, #CancelarNota').click(function(){
				event.preventDefault();
				$('#modalNota').fadeToggle('fast');
			});
			$('#nota').click(function(){
				return false;
			});
		//***************************************/
		
		//** Tabs tipos de pagos *******************************/
			$('#modalPagoCredito #formPagoCredito #credito,#modalPagoEfectivo #formPagoEfectivo #credito, #modalPagoTarjeta #formPagoTarjeta #credito').click(function(){
				$('#modalPagoCredito').fadeIn('fast');
				$('#modalPagoEfectivo').fadeOut('slow');
				$('#modalPagoTarjeta').fadeOut('slow');
			});
			$('#modalPagoCredito #formPagoCredito #efectivo,#modalPagoEfectivo #formPagoEfectivo #efectivo, #modalPagoTarjeta #formPagoTarjeta #efectivo').click(function(){
				$('#modalPagoEfectivo').fadeIn('fast');
				$('#modalPagoCredito').fadeOut('slow');
				$('#modalPagoTarjeta').fadeOut('slow');
			});
			$('#modalPagoCredito #formPagoCredito #tarjeta,#modalPagoEfectivo #formPagoEfectivo #tarjeta, #modalPagoTarjeta #formPagoTarjeta #tarjeta').click(function(){
				$('#modalPagoTarjeta').fadeIn('fast');
				$('#modalPagoCredito').fadeOut('slow');
				$('#modalPagoEfectivo').fadeOut('slow');
				$('.montoPagarCambio').val('');
			});
		//*****************************************/
				
		//** Pago a credito *************************************/
			$('#modalPago #formPago #credito').click(function(){
				$('#modalPago').fadeOut('fast');
				$('#modalPagoCredito').fadeIn('fast');
			});
			$('#modalPagoCredito #CancelarPagoCredito, #modalPagoCredito #closeModalPagoCredito').click(function(){
				$('#modalPagoCredito').fadeOut('fast');
				$('#modalPago').fadeIn('fast');
			});
			$('#modalPagoCredito #formPagoCredito #GuardarPagoCredito').click(function(){
				
				$('#modalLoader').fadeIn('fast');
				
				// $('#modalPago #formPago .modal-body').hide();
				// $('#modalPago #formPago .modal-footer').hide();
				// $('#modalPago .modal-header').hide();
				// $('#modalPago #formPago .loader').fadeIn('fast');
				
				/** Funciones para guardar factura en CXC */
					
					var dominio = document.domain;
					var asunto = "guardarFacturaCredito";
					
					var codigocliente 				= $('.Order_box .Order_table .clienteDataVenta').attr('data-codigocliente');
					var tdctipofactura 				= 'FT';
					var tdccodigofactura 			= '1';
					var valorfactura 				= $('.Order_box .Total_label').attr('data-valortotal');
					var fechafactura 				= getFecha();
					var notafactura 				= $('#modalNota #notafactura').val();
					
					if(codigocliente == ''){
						alert('No ha especificado un cliente!');
						
						$('#modalLoader').fadeOut('fast');
						
						// $('#modalPago #formPago .modal-body').hide();
						// $('#modalPago #formPago .modal-footer').fadeIn('fast');
						// $('#modalPago .modal-header').fadeIn('fast');
						// $('#modalPago #formPago .pagos').fadeIn('fast');
						
						return false;
					}
					
					function siRespuesta(r){
						
						// $('#modalPago').fadeOut('fast');
						//$('#modalPagoCredito').fadeOut('fast');
						
						// $('#modalPago #formPago .modal-body').hide();
						// $('#modalPago #formPago .modal-footer').fadeIn('fast');
						// $('#modalPago .modal-header').fadeIn('fast');
						// $('#modalPago #formPago .pagos').fadeIn('fast');
						
						guardarFacturaPos(r);
					}
				 
					function siError(e){
						
						// $('#modalPago #formPago .modal-body').hide();
						// $('#modalPago #formPago .modal-footer').fadeIn('fast');
						// $('#modalPago .modal-header').fadeIn('fast');
						// $('#modalPago #formPago .pagos').fadeIn('fast');
						
						$('#modalLoader').fadeOut('fast');
						
						alert('Ocurrió un error al realizar la petición: '+e.statusText + '\n' + e.responseText);
					}
				 
					function peticion(e){
						// Realizar la petición
						var parametros = {
							asunto: asunto,
							codigocliente: codigocliente,
							tdctipofactura: tdctipofactura,
							valorfactura: valorfactura,
							fechafactura: fechafactura,
							notafactura: notafactura
						};
				 
						var post = $.post("http://"+dominio+"/phpsql/facturas.php", parametros, siRespuesta, 'json');
				 
						/* Registrar evento de la petición (hay mas)
						   (no es obligatorio implementarlo, pero es muy recomendable para detectar errores) */
				 
						post.error(siError);         // Si ocurrió un error al ejecutar la petición se ejecuta "siError"
					}
					peticion();
			
					
				/** Funciones para guardar factura en POS */
					function guardarFacturaPos(idexterno){
						var clienteid					= $('.Order_box .Order_table .Order_caption .ClienteDataVenta').attr('data-codigocliente');
						var nombrecliente				= $('.Order_box .Order_table .Order_caption .ClienteDataVenta').attr('data-nombrecliente');
						var telefonocliente				= $('.Order_box .Order_table .Order_caption .ClienteDataVenta').attr('data-telefonocliente');
						var direccioncliente 			= $('.Order_box .Order_table .Order_caption .ClienteDataVenta').attr('data-direccioncliente');
						var identificacioncliente 		= $('.Order_box .Order_table .Order_caption .ClienteDataVenta').attr('data-identificacioncliente');
						var correocliente 				= $('.Order_box .Order_table .Order_caption .ClienteDataVenta').attr('data-emailcliente');
						var valorfactura 				= $('.Order_box .Total_label').attr('data-valortotal');
						var impuestofactura 			= 0;
						var fechafactura 				= getFecha();
						var tipofactura 				= 0;		// 0:Credito; 1:Efectivo; 2:Tarjeta;
						var usedelivery 				= 0;		// 0:Venta Local; 1:Venta con Delivery;
						var notafactura 				= $('#modalNota #notafactura').text();
						
						var productos = ''; 
						$('.Order_box .Order_table .tbody > ul').each(function(index,element){
							$(element).addClass('productoTaken');
							productos = productos + $(element).attr('data-id') + "!@@@!";
							productos = productos + $(element).attr('data-nombreproducto') + "!@@@!";
							productos = productos + $(element).attr('data-cantidadproducto') + "!@@@!";
							productos = productos + $(element).attr('data-precioproducto') + "!@@@!";
							productos = productos + $(element).attr('data-subtotalproducto') + "!@@@!";
							productos = productos + $(element).attr('data-notaproducto') + "!@@@!";
							
							$('.productoTaken .td-producto > ul li').each(function(index,elementos){
								productos = productos + $(elementos).text() + ', ';
							});
							
							productos = productos + ";;;";
							$(element).removeClass('productoTaken');
						});
						
						var dominio = document.domain;
						var asunto = 'agregarfactura';
						
						var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
						{ 
							asunto: asunto,
							clienteid: clienteid,
							nombrecliente: nombrecliente,
							telefonocliente: telefonocliente,
							direccioncliente: direccioncliente,
							identificacioncliente: identificacioncliente,
							correocliente: correocliente,
							valorfactura: valorfactura,
							impuestofactura: impuestofactura,
							fechafactura: fechafactura,
							tipofactura: tipofactura,
							usedelivery: usedelivery,
							notafactura: notafactura,
							productos: productos,
							idexterno: idexterno
						}, function(data,status){
							if(status == "success"){
								
								$('#modalLoader').fadeOut('fast');
								$('#modalPago').fadeOut('fast');
								$('#modalPagoCredito').fadeOut('fast');
								
								/** Limpiar factura luego de ser procesada */
								// $('.Order_box .Order_table .tbody > ul').remove(); // Quita todos los productos de la factura
								// $('.clienteDataVenta').attr('data-codigocliente',''); // Quita elementos del cliente
								// $('.clienteDataVenta').attr('data-nombrecliente',''); // Quita elementos del cliente
								// $('.clienteDataVenta').attr('data-telefonocliente',''); // Quita elementos del cliente
								// $('.clienteDataVenta').attr('data-direccioncliente',''); // Quita elementos del cliente
								// $('.clienteDataVenta').attr('data-hascliente','0'); // Quita elementos del cliente
								// $('.clienteDataVenta').attr('title',''); // Quita elementos del cliente
								// $('.clienteDataVenta').text('--'); // Quita elementos del cliente
								// $('#modalNota #notafactura').val(''); // Quita nota de la factura
								// calcTotal(); // Calcula el valor total luego de quitar los productos
								
								
								if($('.OrderBox').length > 1){
									$('.Order_box').remove();
									$('.OrderBox:first').removeClass('Order_boxHidden');
									$('.OrderBox:first').addClass('Order_box');
								}else{
									addNuevaFactura();
									$('.Order_boxHidden').remove();
								}
								
							}
						});
					}
					//$('#modalLoader').fadeOut('fast');
				/***************************/
				
			});
		//***************************************/
		
		//** Pago con tarjeta ************************************/
			$('#modalPago #formPago #tarjeta').click(function(){
				$('#modalPago').fadeOut('fast');
				$('#modalPagoTarjeta').fadeIn('fast');
			});
			$('#modalPagoTarjeta #CancelarPagoTarjeta, #modalPagoTarjeta #closeModalPagoTarjeta').click(function(){
				$('#modalPagoTarjeta').fadeOut('fast');
				$('#modalPago').fadeIn('fast');
			});
			$('#modalPagoTarjeta #formPagoTarjeta #GuardarPagoTarjeta').click(function(){
				
			});
		//***************************************/
		
		//** Pago con tarjeta ************************************/
			$('#modalPago #formPago #efectivo').click(function(){
				$('#modalPago').fadeOut('fast');
				$('#modalPagoEfectivo').fadeIn('fast');
			});
			$('#modalPagoEfectivo #CancelarPagoEfectivo, #modalPagoEfectivo #closeModalPagoEfectivo').click(function(){
				$('#modalPagoEfectivo').fadeOut('fast');
				$('#modalPago').fadeIn('fast');
			});
			$('#modalPagoEfectivo #formPagoEfectivo #GuardarPagoEfectivo').click(function(){
				
			});
		//***************************************/
		
		//** Descuento ************************************/
			$('#modalDescuento')
				.bind('beforeShow', function () {
					//alert('before show');
				})
				.bind('afterShow', function () {
					$('#modalDescuento #formDescuento #descuento').focus();
				});
			$('#modalDescuento #CancelarDescuento, #modalDescuento #closeModalDescuento').click(function(){
				$('#modalDescuento').fadeOut('fast');
			});
			$('#modalDescuento #formDescuento #GuardarDescuento').click(function(){
				$('.Order_box .Total_label_descuento').attr('data-valortotal',$('#modalDescuento #formDescuento #descuento').val());
				$('.Order_box .Total_label_descuento').text("Descuento RD$ " + addCommas(parseFloat($('#modalDescuento #formDescuento #descuento').val()).toFixed(2)));
				calcTotal();
				$('#modalDescuento').fadeOut('fast');
			});
			$('#modalDescuento #formDescuento #descuento').keydown(function(event){
				if(event.which == 13){
					$('#modalDescuento #formDescuento #GuardarDescuento').click();
					return false;
				}
			});
			$('.descuentoFacturaActual').click(function(){
				callModalAccessKey('modalDescuento');
			});
		//***************************************/
		
		//***************************************************/
		$('#buscadorCliente').keydown(function(ev) {
			
			if (ev.which === 13 ) {
				ev.preventDefault();
				if($.trim($(this).val()).length < 3) {
					alert("La frase introducida es muy corta para la busqueda.");
					return false;
				}
				
				var dominio = document.domain;
				var buscadorcliente = $(this).val();
				var asunto = "buscarCliente";
				
				$('#resultadosClientes .Order_table2 > tbody tr').remove();
				
				$('#resultadosClientes .Order_table2 > tbody').append("<tr ><td class=\"td-nombre\" style='min-width:150px;'><i class=\"fa fa-spinner fa-pulse fa-1x fa-fw\"></i> Buscando...</td><td class=\"td-telefono\"></td><td class=\"td-direccion\"></td><td></td></tr>");
				
				function siRespuesta(r){
					// Crear HTML con las respuestas del servidor
					/*var rHtml = 'Razon Social: ' + r.razon + '<br/>';
						rHtml += 'Nombre: ' + r.nombre + '<br/>';
						rHtml += 'Direccion: ' + r.direccion;*/
			 
					//$('#respuesta').html(rHtml);   // Mostrar la respuesta del servidor en el div con el id "respuesta"
					
					$('#resultadosClientes .Order_table2 > tbody tr').remove();
					
					r.split(";@++@;").forEach(function(filas){
						if(filas != ""){
							var data = filas.split(";@+;");
						
							// $('#resultadosClientes .Order_table2 > tbody').append("<tr><td class=\"td-nombre\"><i class=\"fa fa-user\"></i>" + data[0] + "</td><td class=\"td-telefono\">" + data[1] + "</td><td class=\"td-direccion\">" + data[2] + "</td><td></td></tr>");
							$('#resultadosClientes .Order_table2 > tbody').append("<tr class='clienteData' data-ctecodigo=\"" + data[0] + "\" data-ctenombre=\"" + data[1] + "\" data-ctetelefono=\"" + data[2] + "\" data-ctedireccion=\"" + data[3] + "\" data-cteidentificacion=\"" + data[4] + "\" data-ctecorreo=\"" + data[5] + "\"><td class=\"td-nombre\" style='min-width:150px;'><i class=\"fa fa-user\"></i><span style=\" font-weight:bold;color:#2BBBAD; \"> " + data[1] + "</span><br/>" + data[2] + "</td><td class=\"td-telefono\"></td><td class=\"td-direccion\">" + data[3] + "</td><td><a data-clienteid='" + data[0] + "' href='#' class='obtenerDatosCliente'><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i></a></td></tr>");
						}else{
							$('#resultadosClientes .Order_table2 > tbody').append("<tr><td class=\"td-nombre\">No se ha encontrado el cliente</td><td class=\"td-telefono\"></td><td class=\"td-direccion\"></td><td></td></tr>");
						}
					});
					
					
					
				}
			 
				function siError(e){
					alert('Ocurrió un error al realizar la petición: '+e.statusText);
				}
			 
				function peticion(e){
					// Realizar la petición
					var parametros = {
						asunto: asunto,
						buscadorcliente: buscadorcliente
					};
			 
					var post = $.post("http://"+dominio+"/phpsql/clientes.php", parametros, siRespuesta, 'json');
			 
					/* Registrar evento de la petición (hay mas)
					   (no es obligatorio implementarlo, pero es muy recomendable para detectar errores) */
			 
					post.error(siError);         // Si ocurrió un error al ejecutar la petición se ejecuta "siError"
				}
				peticion();
				///searchPosition();
			}
		});
		//***************************************/
		
		//***************************************************/
		$(document).on('click','.obtenerDatosCliente',function(ev) {
			
			
				ev.preventDefault();
				// if($.trim($(this).attr('data-clienteid')).length < 3) {
					// alert("La frase introducida es muy corta para la busqueda.");
					// return false;
				// }
				
				var dominio = document.domain;
				var buscadorcliente = $(this).attr('data-clienteid');
				var asunto = "obtenerDatosCliente";
				
				//$('#resultadosClientes .Order_table2 > tbody tr').remove();
				
				function siRespuesta(r){
					// Crear HTML con las respuestas del servidor
					/*var rHtml = 'Razon Social: ' + r.razon + '<br/>';
						rHtml += 'Nombre: ' + r.nombre + '<br/>';
						rHtml += 'Direccion: ' + r.direccion;*/
			 
					//$('#respuesta').html(rHtml);   // Mostrar la respuesta del servidor en el div con el id "respuesta"
					
					//$('#resultadosClientes .Order_table2 > tbody tr').remove();
					
					r.split(";@++@;").forEach(function(filas){
						if(filas != ""){
							var data = filas.split(";@+;");
						
							// $('#resultadosClientes .Order_table2 > tbody').append("<tr><td class=\"td-nombre\"><i class=\"fa fa-user\"></i>" + data[0] + "</td><td class=\"td-telefono\">" + data[1] + "</td><td class=\"td-direccion\">" + data[2] + "</td><td></td></tr>");
							//$('#resultadosClientes .Order_table2 > tbody').append("<tr class='clienteData' data-ctecodigo=\"" + data[0] + "\" data-ctenombre=\"" + data[1] + "\" data-ctetelefono=\"" + data[2] + "\" data-ctedireccion=\"" + data[3] + "\" data-cteidentificacion=\"" + data[4] + "\" data-ctecorreo=\"" + data[5] + "\"><td class=\"td-nombre\" style='min-width:150px;'><i class=\"fa fa-user\"></i><span style=\" font-weight:bold;color:#2BBBAD; \"> " + data[1] + "</span><br/>" + data[2] + "</td><td class=\"td-telefono\"></td><td class=\"td-direccion\">" + data[3] + "</td><td></td></tr>");
							
							var idcliente = data[0];
							var nombrecliente = data[1];
							var razonsocialcliente = data[2];
							var telefonocliente = data[3];
							var direccioncliente = data[4];
							var emailcliente = data[5];
							var cedularnccliente = data[6];
							var notacliente = data[7];
							
							$('#modalEditarCliente #formEditarCliente #clienteid').val(idcliente);
							$('#modalEditarCliente #formEditarCliente #nombrecliente').val(nombrecliente);
							$('#modalEditarCliente #formEditarCliente #razonsocialcliente').val(razonsocialcliente);
							$('#modalEditarCliente #formEditarCliente #telefonocliente').val(telefonocliente);
							$('#modalEditarCliente #formEditarCliente #direccioncliente').val(direccioncliente);
							$('#modalEditarCliente #formEditarCliente #emailcliente').val(emailcliente);
							$('#modalEditarCliente #formEditarCliente #cedularnccliente').val(cedularnccliente);
							$('#modalEditarCliente #formEditarCliente #notacliente').val(notacliente);
							
							
							$('#modalEditarCliente').fadeIn('fast');
							
						}else{
							$('#resultadosClientes .Order_table2 > tbody').append("<tr><td class=\"td-nombre\">No se ha encontrado el cliente</td><td class=\"td-telefono\"></td><td class=\"td-direccion\"></td><td></td></tr>");
						}
					});
					
					
					
				}
			 
				function siError(e){
					alert('Ocurrió un error al realizar la petición: '+e.statusText);
				}
			 
				function peticion(e){
					// Realizar la petición
					var parametros = {
						asunto: asunto,
						buscadorcliente: buscadorcliente
					};
			 
					var post = $.post("http://"+dominio+"/phpsql/clientes.php", parametros, siRespuesta, 'json');
			 
					/* Registrar evento de la petición (hay mas)
					   (no es obligatorio implementarlo, pero es muy recomendable para detectar errores) */
			 
					post.error(siError);         // Si ocurrió un error al ejecutar la petición se ejecuta "siError"
				}
				peticion();
				///searchPosition();
			
		});
		$('#modalEditarCliente #CancelarEditarCliente, #modalEditarCliente #closeModalEditarCliente').click(function(){
			$('#modalEditarCliente').fadeOut('fast');
		});
		//***************************************************/
		
		//***************************************************/
		$('#guardarCliente').click(function(ev) {
			ev.preventDefault();
			
				
				var dominio = document.domain;
				var buscadorcliente = $(this).val();
				var asunto = "guardarCliente";
				
				var nombrecliente 				= $('#formAgregarCliente #nombrecliente').val();
				var razonsocialcliente			= $('#formAgregarCliente #razonsocialcliente').val();
				var telefonocliente 			= $('#formAgregarCliente #telefonocliente').val();
				var direccioncliente 			= $('#formAgregarCliente #direccioncliente').val();
				var emailcliente				= $('#formAgregarCliente #emailcliente').val();
				var cedularnccliente 			= $('#formAgregarCliente #cedularnccliente').val();
				var fechacreacioncliente 		= getFecha();
				var localexteriorcliente 		= $('#formAgregarCliente #localexteriorcliente').val();
				var notacliente 				= $('#formAgregarCliente #notacliente').val();
				
				
				if(nombrecliente == ''){
					alert('No ha especificado un nombre!');
					return false;
				}
				
				
				//$('#resultadosClientes .Order_table2 > tbody tr').remove();
				
				function siRespuesta(r){
					// Crear HTML con las respuestas del servidor
					/*var rHtml = 'Razon Social: ' + r.razon + '<br/>';
						rHtml += 'Nombre: ' + r.nombre + '<br/>';
						rHtml += 'Direccion: ' + r.direccion;*/
			 
					//$('#respuesta').html(rHtml);   // Mostrar la respuesta del servidor en el div con el id "respuesta"
					
					$('#resultadosClientes .Order_table2 > tbody tr').remove();
					
					var data = r.split(";@+;");
					
					// $('#resultadosClientes .Order_table2 > tbody').append("<tr><td class=\"td-nombre\"><i class=\"fa fa-user\"></i>" + data[0] + "</td><td class=\"td-telefono\">" + data[1] + "</td><td class=\"td-direccion\">" + data[2] + "</td><td></td></tr>");
					$('#resultadosClientes .Order_table2 > tbody').append("<tr class='clienteData' data-ctecodigo=\"" + data[0] + "\" data-ctenombre=\"" + data[1] + "\" data-ctetelefono=\"" + data[2] + "\" data-ctedireccion=\"" + data[3] + "\" data-cteidentificacion=\"" + data[4] + "\" data-ctecorreo=\"" + data[5] + "\"><td class=\"td-nombre\" style='min-width:150px;'><i class=\"fa fa-user\"></i><span style=\" font-weight:bold;color:#2BBBAD; \"> " + data[1] + "</span><br/>" + data[2] + "</td><td class=\"td-telefono\"></td><td class=\"td-direccion\">" + data[3] + "</td><td></td></tr>");
						
					$('#modalAgregarCliente').fadeOut('fast');
					$('#modalBuscarCliente').fadeIn('fast');
					
					$('#formAgregarCliente #nombrecliente').val('');
					$('#formAgregarCliente #razonsocialcliente').val('');
					$('#formAgregarCliente #telefonocliente').val('');
					$('#formAgregarCliente #direccioncliente').val('');
					$('#formAgregarCliente #emailcliente').val('');
					$('#formAgregarCliente #cedularnccliente').val('');
					$('#formAgregarCliente #localexteriorcliente').val('');
					$('#formAgregarCliente #notacliente').val('');
					
				}
			 
				function siError(e){
					alert('Ocurrió un error al realizar la petición: '+e.statusText + '\n' + e.responseText);
				}
			 
				function peticion(e){
					// Realizar la petición
					var parametros = {
						asunto: asunto,
						nombrecliente: nombrecliente,
						razonsocialcliente: razonsocialcliente,
						telefonocliente: telefonocliente,
						direccioncliente: direccioncliente,
						emailcliente: emailcliente,
						cedularnccliente: cedularnccliente,
						fechacreacioncliente: fechacreacioncliente,
						localexteriorcliente: localexteriorcliente,
						notacliente: notacliente
					};
			 
					var post = $.post("http://"+dominio+"/phpsql/clientes.php", parametros, siRespuesta, 'json');
			 
					/* Registrar evento de la petición (hay mas)
					   (no es obligatorio implementarlo, pero es muy recomendable para detectar errores) */
			 
					post.error(siError);         // Si ocurrió un error al ejecutar la petición se ejecuta "siError"
				}
				peticion();
				///searchPosition();
			
		});
		//***************************************************/
		
		//***************************************************/
		$('#guardarEditarCliente').click(function(ev) {
			ev.preventDefault();
			
				
				var dominio = document.domain;
				var buscadorcliente = $(this).val();
				var asunto = "guardarEditarCliente";
				
				var idcliente = $('#modalEditarCliente #formEditarCliente #clienteid').val();
				var nombrecliente = $('#modalEditarCliente #formEditarCliente #nombrecliente').val();
				var razonsocialcliente = $('#modalEditarCliente #formEditarCliente #razonsocialcliente').val();
				var telefonocliente = $('#modalEditarCliente #formEditarCliente #telefonocliente').val();
				var direccioncliente = $('#modalEditarCliente #formEditarCliente #direccioncliente').val();
				var emailcliente = $('#modalEditarCliente #formEditarCliente #emailcliente').val();
				var cedularnccliente = $('#modalEditarCliente #formEditarCliente #cedularnccliente').val();
				var notacliente = $('#modalEditarCliente #formEditarCliente #notacliente').val();
				
				
				if(nombrecliente == ''){
					alert('No ha especificado un nombre!');
					return false;
				}
				
				
				//$('#resultadosClientes .Order_table2 > tbody tr').remove();
				
				function siRespuesta(r){
					// Crear HTML con las respuestas del servidor
					/*var rHtml = 'Razon Social: ' + r.razon + '<br/>';
						rHtml += 'Nombre: ' + r.nombre + '<br/>';
						rHtml += 'Direccion: ' + r.direccion;*/
			 
					//$('#respuesta').html(rHtml);   // Mostrar la respuesta del servidor en el div con el id "respuesta"
					
					$('#resultadosClientes .Order_table2 > tbody tr').remove();
					
					var data = r.split(";@+;");
					
					// $('#resultadosClientes .Order_table2 > tbody').append("<tr><td class=\"td-nombre\"><i class=\"fa fa-user\"></i>" + data[0] + "</td><td class=\"td-telefono\">" + data[1] + "</td><td class=\"td-direccion\">" + data[2] + "</td><td></td></tr>");
					$('#resultadosClientes .Order_table2 > tbody').append("<tr class='clienteData' data-ctecodigo=\"" + data[0] + "\" data-ctenombre=\"" + data[1] + "\" data-ctetelefono=\"" + data[2] + "\" data-ctedireccion=\"" + data[3] + "\" data-cteidentificacion=\"" + data[4] + "\" data-ctecorreo=\"" + data[5] + "\"><td class=\"td-nombre\" style='min-width:150px;'><i class=\"fa fa-user\"></i><span style=\" font-weight:bold;color:#2BBBAD; \"> " + data[1] + "</span><br/>" + data[2] + "</td><td class=\"td-telefono\"></td><td class=\"td-direccion\">" + data[3] + "</td><td></td></tr>");
						
					$('#modalEditarCliente').fadeOut('fast');
					$('#modalBuscarCliente').fadeIn('fast');
					
					$('#formEditarCliente #nombrecliente').val('');
					$('#formEditarCliente #razonsocialcliente').val('');
					$('#formEditarCliente #telefonocliente').val('');
					$('#formEditarCliente #direccioncliente').val('');
					$('#formEditarCliente #emailcliente').val('');
					$('#formEditarCliente #cedularnccliente').val('');
					$('#formEditarCliente #notacliente').val('');
					
				}
			 
				function siError(e){
					alert('Ocurrió un error al realizar la petición: '+e.statusText + '\n' + e.responseText);
				}
			 
				function peticion(e){
					// Realizar la petición
					var parametros = {
						asunto: asunto,
						idcliente: idcliente,
						nombrecliente: nombrecliente,
						razonsocialcliente: razonsocialcliente,
						telefonocliente: telefonocliente,
						direccioncliente: direccioncliente,
						emailcliente: emailcliente,
						cedularnccliente: cedularnccliente,
						notacliente: notacliente
					};
			 
					var post = $.post("http://"+dominio+"/phpsql/clientes.php", parametros, siRespuesta, 'json');
			 
					/* Registrar evento de la petición (hay mas)
					   (no es obligatorio implementarlo, pero es muy recomendable para detectar errores) */
			 
					post.error(siError);         // Si ocurrió un error al ejecutar la petición se ejecuta "siError"
				}
				peticion();
				///searchPosition();
			
		});
		//***************************************************/
		
		//***************************************************/
		$(document).on('dblclick','#resultadosClientes .Order_table2 > tbody .clienteData',function(){
			
			$('.Order_box .Order_table .Order_caption .clienteDataVenta').text($(this).attr('data-ctenombre'));
			$('.Order_box .Order_table .Order_caption .clienteDataVenta').attr('data-codigocliente',$(this).attr('data-ctecodigo'));
			$('.Order_box .Order_table .Order_caption .clienteDataVenta').attr('data-nombrecliente',$(this).attr('data-ctenombre'));
			$('.Order_box .Order_table .Order_caption .clienteDataVenta').attr('data-telefonocliente',$(this).attr('data-ctetelefono'));
			$('.Order_box .Order_table .Order_caption .clienteDataVenta').attr('data-direccioncliente',$(this).attr('data-ctedireccion'));
			$('.Order_box .Order_table .Order_caption .clienteDataVenta').attr('data-identificacioncliente',$(this).attr('data-cteidentificacion'));
			$('.Order_box .Order_table .Order_caption .clienteDataVenta').attr('data-emailcliente',$(this).attr('data-ctecorreo'));
			
			$('.Order_box .Order_table .Order_caption .clienteDataVenta').attr('title',$(this).attr('data-ctenombre'));
			$('.Order_box .Order_table .Order_caption .clienteDataVenta').attr('data-hascliente','1');
			
			$('#modalBuscarCliente').fadeOut('fast');
		});
		//***************************************************/
		
		
		//***************************************************/
		function callModalAccessKey(id){
			$('#modalAccessKey #formAccessKey #id').val(id);
			$('#modalAccessKey').fadeIn('fast');
			$('#modalAccessKey #formAccessKey #accessKey').val('');
			$('#modalAccessKey #formAccessKey #accessKey').focus();
		}
		$('#modalAccessKey #CancelarAccessKey, #modalAccessKey #closeModalAccessKey').click(function(){
			$('#modalAccessKey #formAccessKey #accessKey').val('');
			$('#modalAccessKey').fadeOut('fast');
		});
		$('#modalAccessKey #formAccessKey #accessKey').keydown(function(event){
			if(event.which == 13){
				$('#modalAccessKey #GuardarAccessKey').click();
			}
		});
		$('#modalAccessKey #GuardarAccessKey').click(function(){
			var id = $('#modalAccessKey #formAccessKey #id').val();
			
			var accesskey = $('#modalAccessKey #formAccessKey #accessKey').val();
				
			var dominio = document.domain;
			var asunto = 'grantAccessByKey';
			
			var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
			{ 
				asunto: asunto,
				accesskey: accesskey
			}, function(data,status){
				if(status == "success"){
					if(data.status == "success"){
						$('#modalAccessKey').fadeOut('fast');
						$('#modalAccessKey #formAccessKey #accessKey').val('');
						$('#'+id).show();
					}else{
						alert("wrong password");
					}
				}
			});
		});
		//***************************************************/
		
		//** modalScreenKeyboard ****************************/
		//***************************************************/
		var objectClass = 'textEditing';
		$(document).on('focus','.withScreenKeyboard',function(){
			$('.' + objectClass).removeClass(objectClass);
			$(this).addClass(objectClass);
			$('#modalScreenKeyboard #formScreenKeyboard #id').val(objectClass);
			$('#modalScreenKeyboard').slideDown('fast');
			return false;
		});
		$(document).on('keydown','.withScreenKeyboard',function(event){
			if(event.which == 9){
				$('#modalScreenKeyboard').slideUp('slow');
				$('.' + objectClass).blur();
				return false;
			}
		});
		$(document).on('click','.withScreenKeyboard',function(){
			$('#modalScreenKeyboard').slideDown('fast');
			return false;
		});
		
		$(document).mouseup(function (e)
		{
			var container = $("#modalScreenKeyboard");

			if (!container.is(e.target) // if the target of the click isn't the container...
				&& container.has(e.target).length === 0) // ... nor a descendant of the container
			{
				var container2 = $(".withScreenKeyboard");
				if(!container2.is(e.target) // if the target of the click isn't the container...
					&& container2.has(e.target).length === 0){
					container.slideUp('slow');
					$('.' + objectClass).removeClass(objectClass);
				}
			}
		});
		
		$('#modalScreenKeyboard #formScreenKeyboard a').click(function(){
			event.preventDefault();
			var key = $(this).attr('id');
			if(key == 'ESC'){
				// $('.' + objectClass).trigger(jQuery.Event('keyCode', {which: 13}));
				var e = jQuery.Event("keydown");
				e.which = 27; // Enter
				$('.' + objectClass).trigger(e);
				
				return false;
			}else if(key == 'ENTER'){
				// $('.' + objectClass).trigger(jQuery.Event('keyCode', {which: 13}));
				var e = jQuery.Event("keydown");
				e.which = 13; // Enter
				$('.' + objectClass).trigger(e);
			}else if(key == 'BACK'){
				var texto = $('.' + objectClass).val();
				texto = texto.substring(0,texto.length-1);
				$('.' + objectClass).val(texto);
			}else if(key == 'TAB'){
				$('.' + objectClass).blur();
				
				return false;
			}else{
				
				var text = $('.' + objectClass).val();
				var newText = text + '' + key;

				$('.' + objectClass).val(newText);
			}
			$('.' + objectClass).focus();
			
			return false;
		});
		$('#modalScreenKeyboard #inhabilitarScreenKeyboard').click(function(){
			$('#modalScreenKeyboard').slideUp('fast');
			$('#modalScreenKeyboard').attr('id','modalScreenKeyboardHidden');
			$('#habilitarScreenKeyboard').slideDown('fast');
		});
		$('#habilitarScreenKeyboard').click(function(){
			$('#modalScreenKeyboardHidden').attr('id','modalScreenKeyboard');
			$('#modalScreenKeyboard').slideDown('fast');
			$('#habilitarScreenKeyboard').slideUp('fast');
		});
		//***************************************************/
		
		//** Funciones para las sesiones de caja ************/
		//***************************************************/
		
			
		
			$(document).on('click','#modalAbrirCajaSesionActualOtherPC #GuardarModalAbrirCaja',function(){
				var idsesion = $('#modalAbrirCajaSesionActualOtherPC #formAbrirCajaSesionActualOtherPC #idsesion').val();
				var ipaddress = $('#modalAbrirCajaSesionActualOtherPC #formAbrirCajaSesionActualOtherPC #ip').val();
				
				var dominio = document.domain;
				var asunto = 'enterCajaActualSesion';
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					idsesion: idsesion,
					ipaddress: ipaddress
				}, function(data,status){
					if(status == "success"){
						if(data.status == "success"){
							
							$('#wrapper').fadeIn('fast');
							$('#todo').fadeIn('fast');
							$('#modalAbrirCajaSesionActualOtherPC').fadeOut('fast');
							$('#modalSeleccionCaja').fadeOut('fast');
							
						}
					}
				});
			});
			
			if ($('#modalAbrirCajaSesionActualThisPC').length){
				
				$('#wrapper').fadeIn('fast');
				$('#todo').fadeIn('fast');
				$('#modalAbrirCajaSesionActualThisPC').fadeOut('fast');
				$('#modalSeleccionCaja').fadeOut('fast');
				
			}else if ($('#modalAbrirCajaSesionActualOtherPC').length){
				
				$('#modalAbrirCajaSesionActualOtherPC').hide();
				
				callModalAccessKey('modalAbrirCajaSesionActualOtherPC');
				//$('#modalSeleccionCaja').fadeIn('fast');
				
			}else{
				$('#modalSeleccionCaja').fadeIn('fast');
			}
			
			
			
			$(document).on('click','#modalSeleccionCaja .caja-disponible',function(){
				var idcaja = $(this).attr('data-id');
				var ipaddress = $(this).attr('data-ip');
				
				$('#modalAbrirCaja #formAbrirCaja #id').val(idcaja);
				
				var dominio = document.domain;
				var asunto = 'getSelectedCajaLastSesion';
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					idcaja: idcaja
				}, function(data,status){
					if(status == "success"){
						if(data.status == "success"){
							
							var userID = data.data[0]['userID'];
							var fechaInicialCaja = data.data[0]['fechaInicialCaja'];
							var fechaFinalCaja = data.data[0]['fechaFinalCaja'];
							var valorInicialCaja = data.data[0]['valorInicialCaja'];
							
							$('#modalAbrirCaja #formAbrirCaja .userID').text(userID);
							$('#modalAbrirCaja #formAbrirCaja .fechaInicialSesion').text(fechaInicialCaja);
							$('#modalAbrirCaja #formAbrirCaja .fechaFinalSesion').text(fechaFinalCaja);
							$('#modalAbrirCaja #formAbrirCaja .valorInicialCajaSpan').text('RD$' + parseFloat(valorInicialCaja).toFixed(2));
							$('#modalAbrirCaja #formAbrirCaja .valorInicialCaja').val(valorInicialCaja);
							$('#modalAbrirCaja #formAbrirCaja .valorInicialCajaSpan').show();
							$('#modalAbrirCaja #formAbrirCaja .valorInicialCaja').hide();
							
							callModalAccessKey('modalAbrirCaja');
						}else if(data.status == "error" && data.data == "nothing_found"){
							
							$('#modalAbrirCaja #formAbrirCaja .userID').text('--');
							$('#modalAbrirCaja #formAbrirCaja .fechaInicialSesion').text('--');
							$('#modalAbrirCaja #formAbrirCaja .fechaFinalSesion').text('--');
							$('#modalAbrirCaja #formAbrirCaja .valorInicialCajaSpan').text('--');
							
							$('#modalAbrirCaja #formAbrirCaja .valorInicialCaja').show();
							$('#modalAbrirCaja #formAbrirCaja .valorInicialCajaSpan').hide();
							
							
							callModalAccessKey('modalAbrirCaja');
						}
					}
				});
			});
			
			$(document).on('click','#modalSeleccionCaja .caja-ocupada',function(){
				var idcaja = $(this).attr('data-id');
				var ipaddress = $(this).attr('data-ip');
				
				$('#modalAbrirCaja #formAbrirCaja #id').val(idcaja);
				
				var dominio = document.domain;
				var asunto = 'getSelectedCajaOcupada';
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					idcaja: idcaja
				}, function(data,status){
					if(status == "success"){
						if(data.status == "success"){
							
							var userID = data.data[0]['userID'];
							var fechaInicialCaja = data.data[0]['fechaInicialCaja'];
							var fechaFinalCaja = data.data[0]['fechaFinalCaja'];
							var valorInicialCaja = data.data[0]['valorInicialCaja'];
							
							$('#modalAbrirCaja #formAbrirCaja .userID').text(userID);
							$('#modalAbrirCaja #formAbrirCaja .fechaInicialSesion').text(fechaInicialCaja);
							$('#modalAbrirCaja #formAbrirCaja .fechaFinalSesion').text(fechaFinalCaja);
							$('#modalAbrirCaja #formAbrirCaja .valorInicialCajaSpan').text('RD$' + parseFloat(valorInicialCaja).toFixed(2));
							$('#modalAbrirCaja #formAbrirCaja .valorInicialCaja').val(valorInicialCaja);
							$('#modalAbrirCaja #formAbrirCaja .valorInicialCajaSpan').show();
							$('#modalAbrirCaja #formAbrirCaja .valorInicialCaja').hide();
							
							callModalAccessKey('modalAbrirCaja');
						}else if(data.status == "error" && data.data == "nothing_found"){
							
							// $('#modalAbrirCaja #formAbrirCaja .userID').text('--');
							// $('#modalAbrirCaja #formAbrirCaja .fechaInicialSesion').text('--');
							// $('#modalAbrirCaja #formAbrirCaja .fechaFinalSesion').text('--');
							// $('#modalAbrirCaja #formAbrirCaja .valorInicialCajaSpan').text('--');
							
							// $('#modalAbrirCaja #formAbrirCaja .valorInicialCaja').show();
							// $('#modalAbrirCaja #formAbrirCaja .valorInicialCajaSpan').hide();
							
							
							// callModalAccessKey('modalAbrirCaja');
						}
					}
				});
			});
			
			
			
			$(document).on('click','#modalAbrirCaja #CancelarAbrirCaja, #modalAbrirCaja #closeModalAbrirCaja',function(){
				$('#modalAbrirCaja').fadeOut('fast');
			});
			$(document).on('click','#modalAbrirCaja #GuardarModalAbrirCaja',function(){
				var idcaja = $('#modalAbrirCaja #formAbrirCaja #id').val();
				var ipaddress = $('#modalAbrirCaja #formAbrirCaja #ip').val();
				var valorinicialcaja = $('#modalAbrirCaja #formAbrirCaja #valorInicialCaja').val();
				var fechainicialcaja = getFecha();
				
				var dominio = document.domain;
				var asunto = 'iniciarSesionCaja';
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					idcaja: idcaja,
					ipaddress: ipaddress,
					valorinicialcaja: valorinicialcaja,
					fechainicialcaja: fechainicialcaja
				}, function(data,status){
					if(status == "success"){
						if(data.status == "success"){
							
							$('#wrapper').fadeIn('fast');
							$('#todo').fadeIn('fast');
							$('#modalAbrirCajaSesionActualOtherPC').fadeOut('fast');
							$('#modalSeleccionCaja').fadeOut('fast');
							$('#modalAbrirCaja').fadeOut('fast');
							
							
						}
					}
				});
			});
			
			
			
			//** Cierre de caja *******************************************/
			$('.cierreCaja').click(function(){
				
				var dominio = document.domain;
				var asunto = 'getDatosSesionCaja';
				
				var idcaja = $('#modalAbrirCaja #formAbrirCaja #id').val();
				
				var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
				{ 
					asunto: asunto,
					idcaja: idcaja
				}, function(data,status){
					if(status == "success"){
						if(data.status == "success"){
							var valorVentaTotal = data.data[0]['valorVentaTotal'] != '' ? data.data[0]['valorVentaTotal'] : 0 ;
							$('#modalCierreCaja #formCierreCaja .totalVentacaja .valortotal').attr('data-valor',valorVentaTotal);
							$('#modalCierreCaja #formCierreCaja .totalVentacaja .valortotal').text(addCommas(parseFloat(valorVentaTotal).toFixed(2)));
							
							var valorInicialCaja = data.data[0]['valorInicialCaja'] != '' ? data.data[0]['valorInicialCaja'] : 0 ;
							$('#modalCierreCaja #formCierreCaja .inicialcaja .valortotal').attr('data-valor',valorInicialCaja);
							$('#modalCierreCaja #formCierreCaja .inicialcaja .valortotal').text(addCommas(parseFloat(valorInicialCaja).toFixed(2)));
							
							sumasValoresCierre();
							
							callModalAccessKey('modalCierreCaja');
						}
					}
				});
			});
			$('#modalCierreCaja #closeModalCierreCaja, #modalCierreCaja #CancelarCierreCaja').click(function(){
				$('#modalCierreCaja').fadeOut('fast');
			});
			$('#modalCierreCaja #GuardarModalCierreCaja').click(function(){
				var diferencia = parseFloat($('#modalCierreCaja #formCierreCaja .diferenciacaja .valortotal').attr('data-valor'));
				
					var efectivocaja = 0;
					$('#modalCierreCaja #formCierreCaja .efectivo .subTotalValor').each(function(index,element){
						efectivocaja += (parseFloat($(element).attr('data-subtotalvalor')) > 0) ? parseFloat($(element).attr('data-subtotalvalor')) : 0;
						console.log(efectivocaja);
					});
					var tarjetacaja = $('#modalCierreCaja #formCierreCaja .tarjeta #tarjetavalor').val();
					var creditocaja = $('#modalCierreCaja #formCierreCaja .credito #creditovalor').val();
					var chequecaja = 0;
					var fechacierrecaja = getFecha();
					var idcaja = $('#modalAbrirCaja #formAbrirCaja #id').val();
					
					var dominio = document.domain;
					var asunto = 'cerrarSesionCaja';
					
					var jqxhrd = $.post( "http://" + dominio + "/SmartDeliveryC/operador/takeorder",  
					{ 
						asunto: asunto,
						idcaja: idcaja,
						efectivocaja: efectivocaja,
						tarjetacaja: tarjetacaja,
						creditocaja: creditocaja,
						chequecaja: chequecaja,
						fechacierrecaja: fechacierrecaja
						
					}, function(data,status){
						if(status == "success"){
							if(data.status == "success"){
								var datos = data.data[0];
								
								var fondoApertura = parseFloat(datos['valorInicialCaja'] != '' ? datos['valorInicialCaja'] : '0.00');
								var descuentos = parseFloat(datos['valorDescuentoTotal'] != '' ? datos['valorDescuentoTotal'] : '0.00');
								var efectivo = parseFloat(datos['valorEfectivoCaja'] != '' ? datos['valorEfectivoCaja'] : '0.00') - fondoApertura;
								var credito = parseFloat(datos['valorCreditoCaja'] != '' ? datos['valorCreditoCaja'] : '0.00');
								var tarjeta = parseFloat(datos['valorTarjetaCaja'] != '' ? datos['valorTarjetaCaja'] : '0.00');
								var egresosCaja = parseFloat(data.cantidadcomanda) !='' ? (parseFloat(data.cantidadcomanda) * 10) : 0 ;
								var ingresosCaja = 0;
								var ventasBrutas = efectivo + credito + tarjeta;
								var VBMasEgresosMenosIngresos = ventasBrutas + egresosCaja - ingresosCaja;
								var itbis = parseFloat(datos['valorImpuestoTotal'] != '' ? datos['valorImpuestoTotal'] : '0.00');
								var ventasNetas = ventasBrutas - itbis;
								var noFacturas = parseFloat(datos['cantFacturasCaja'] != '' ? datos['cantFacturasCaja'] : '0.00');
								var promedio = VBMasEgresosMenosIngresos/noFacturas;
								var diferenciaEfectivo = parseFloat($('#modalCierreCaja #formCierreCaja .diferenciacaja .valortotal').attr('data-valor'));
								var diferenciaTarjeta = 0;
								
								$('#toPrintCierre .fecha_print').html(datos['fechaFinalCaja']);
								$('#toPrintCierre .fondoapertura_print').html(addCommas(fondoApertura.toFixed(2)));
								$('#toPrintCierre .descuento_print').html(addCommas(descuentos.toFixed(2)));
								$('#toPrintCierre .efectivo_print').html(addCommas(efectivo.toFixed(2)));
								$('#toPrintCierre .tarjeta_print').html(addCommas(tarjeta.toFixed(2)));
								$('#toPrintCierre .credito_print').html(addCommas(credito.toFixed(2)));
								$('#toPrintCierre .egresoscaja_print').html(addCommas(egresosCaja.toFixed(2)));
								$('#toPrintCierre .ingresoscaja_print').html(addCommas(ingresosCaja.toFixed(2)));
								$('#toPrintCierre .ventasbrutas_print').html(addCommas(ventasBrutas.toFixed(2)));
								$('#toPrintCierre .masegresosmenosingresos_print').html(addCommas(VBMasEgresosMenosIngresos.toFixed(2)));
								$('#toPrintCierre .itbis_print').html(addCommas(itbis.toFixed(2)));
								$('#toPrintCierre .ventasnetas_print').html(addCommas(ventasNetas.toFixed(2)));
								$('#toPrintCierre .nofacturas_print').html(noFacturas.toFixed(2));
								$('#toPrintCierre .promedio_print').html(addCommas(promedio.toFixed(2)));
								$('#toPrintCierre .novisitantes_print').html('');
								$('#toPrintCierre .diferenciaefectivo_print').html(addCommas(diferenciaEfectivo.toFixed(2)));
								$('#toPrintCierre .diferenciatarjeta_print').html(addCommas(diferenciaTarjeta.toFixed(2)));
								
								
								/*******************************************************/
								
								var datos2 = data.data2;
								$('#toPrintProductosCierre .fecha_print').html(datos['fechaFinalCaja']);
								$('#toPrintProductosCierre .productList .producto').remove();
								
								var datosProducto = "";
								$.each(datos2, function ( index, value ) {
									datosProducto += "<span class='producto' style=\"display:block;width:300px;\">" + value['nombreProducto'] + " (" + value['cantidad'] + ") " + "<span style=\"float:right;\">" + addCommas(parseFloat(value['total']).toFixed(2)) + "</span></span>";
								});
								
								
								$('#toPrintProductosCierre .productList').append(datosProducto);
								
								/*******************************************************/
								
								imprSelecCierre('#toPrintCierre');
								
								$('#modalCierreCaja').fadeOut('fast');
								
								window.location.reload();
							}
						}
					});
				
			});
			
			sumasValoresCierre(); // Sumar de entrada
			function sumasValoresCierre(){
				
				var totalefectivo = 0;
				var totaltarjeta = 0;
				var totalcredito = 0;
				var totalcaja = 0;
				var totalventa = 0;
				var inicialcaja = 0;
				var diferenciacaja = 0;
				
				$('#modalCierreCaja #formCierreCaja .efectivo .subTotalValor').each(function(index,element){
					totalefectivo += (parseFloat($(element).attr('data-subtotalvalor')) > 0) ? parseFloat($(element).attr('data-subtotalvalor')) : 0;
					console.log(totalefectivo);
				});
				
				totaltarjeta = parseFloat($('#modalCierreCaja #formCierreCaja .tarjeta #tarjetavalor').val());
				totalcredito = parseFloat($('#modalCierreCaja #formCierreCaja .credito #creditovalor').val());
				
				totalcaja += (totalefectivo > 0) ? totalefectivo : 0;
				totalcaja += (totaltarjeta > 0) ? totaltarjeta : 0;
				totalcaja += (totalcredito > 0) ? totalcredito : 0;
				
				totalventa = parseFloat($('#modalCierreCaja #formCierreCaja .totalVentacaja .valortotal').attr('data-valor'));
				inicialcaja = parseFloat($('#modalCierreCaja #formCierreCaja .inicialcaja .valortotal').attr('data-valor'));
				
				$('#modalCierreCaja #formCierreCaja .totalcaja .valortotal').attr('data-valor',totalcaja);
				$('#modalCierreCaja #formCierreCaja .totalcaja .valortotal').text(addCommas(totalcaja.toFixed(2)));
				
				diferenciacaja = totalcaja - (totalventa + inicialcaja);
				$('#modalCierreCaja #formCierreCaja .diferenciacaja .valortotal').attr('data-valor',diferenciacaja);
				$('#modalCierreCaja #formCierreCaja .diferenciacaja .valortotal').text(addCommas(diferenciacaja.toFixed(2)));
				
				if(diferenciacaja < 0){
					$('#modalCierreCaja #formCierreCaja .diferenciacaja .valortotal').css('color','red');
				}else{
					$('#modalCierreCaja #formCierreCaja .diferenciacaja .valortotal').css('color','green');
				}
			}
			
			$('#modalCierreCaja #formCierreCaja .efectivo #cantidadvalor').on("change paste keyup blur focusin",function(){
				var villeteCantidad = (parseFloat($(this).val()) > 0) ? parseFloat($(this).val()) : 0;
				var villeteValue = (parseFloat($(this).attr('data-valor')) > 0) ? parseFloat($(this).attr('data-valor')) : 0;
				var subtotal = parseFloat(villeteCantidad) * parseFloat(villeteValue);
				
				var parent = $(this).parent();
				$(this).parent().siblings('.subTotalValor').attr('data-subtotalvalor',subtotal);
				$(this).parent().siblings('.subTotalValor').text('= RD$' + addCommas(subtotal.toFixed(2)));
				
				sumasValoresCierre();
			});
			
			$('#modalCierreCaja #formCierreCaja .tarjeta #tarjetavalor, #modalCierreCaja #formCierreCaja .credito #creditovalor').on("change paste keyup blur focusin",function(){
				sumasValoresCierre();
			});
		
		//***************************************************/
		
	});
</script>

</div>