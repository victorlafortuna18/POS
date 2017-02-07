@extends('adminoperador.template.template')
@section('page-title')
	 Mis Mensajeros
@stop
@section('body')
<link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">

<link href="{{ asset('public/assets/css/jquery.dataTables.min.css') }}" rel="stylesheet">
<div class="container-fluid">
	<style type="text/css">
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
		
	</style>
	
	
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

	
	
	
	
	<!-- Search -->
	<div class="row" style="width:75%;float:left;">
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
								<a href="dashboard"><i class="fa fa-home"></i> Admin</a> >> <a href="#">Mensajeros</a>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
						
					</div>
				
			</div> 
			<!-- /.panel -->
		</div>
	</div>
	<!-- Sucursales -->
	<a href="{{ url('adminlocalidad/sucursal') }}" class="row conteo btn-primary" style="margin-left:10px;" data-toggle="tooltip">
		<div id="tooltip">Sucursales</div>
		<i class="fa fa-building-o"></i><br> <span class="cantidad">{{ $conteoSucursales }}</span>	
	</a>
	<!-- Operadores -->
	<a href="{{ url('adminlocalidad/usuario') }}" class="row conteo btn-primary" data-toggle="tooltip">
		<div id="tooltip">Operadores</div>
		<i class="fa fa-user"></i><br> <span class="cantidad">{{ $conteoUsuarios }}</span>	
	</a>
	<!-- Mensajeros -->
	<a href="#" class="row conteo btn-primary" data-toggle="tooltip">
		<div id="tooltip">Mensajeros</div>
		<i class="fa fa-motorcycle"></i><br> <span class="cantidad">{{ $conteoMensajeros }}</span>	
	</a>
	<!-- Pedidos -->
	<a href="{{ url('adminlocalidad/pedido') }}" class="row conteo btn-warning" data-toggle="tooltip">
		<div id="tooltip">Pedidos</div>
		<i class="fa fa-list-ul"></i><br> <span class="cantidad">{{ $conteoPedidos }}</span>	
	</a>
	<!-- Reportes -->
	<a href="{{ url('adminlocalidad/reporte/pedidoMensajero') }}" class="row conteo btn-success" data-toggle="tooltip">
		<div id="tooltip">Reportes</div>
		<i class="fa fa-bar-chart"></i><br> <span class="cantidad">R</span>	
	</a>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"> Mensajeros encontrados ( {{ $conteoMensajeros }} ) <a href="#" id="agregarMensajero" style="cursor:pointer;">Agregar nuevo</a></div>
				<div class="panel-body">
					<div class="panel-body">
                        @if (Session::has('message_create'))
                            <div class=" {{ Session::get('alert_class') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('message_create') }}
                            </div>
                        @endif
						<div class="list-group">
							<table id="tablaUsuarios" class="display" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th class="active">Username</th>
										<th class="active">Nombre</th>
										<th class="active">Telefono</th>
										<th class="active">Sucursal</th>
										<th class="active">Estatus</th>
										<th class="active">Activo</th>
									</tr>
								</thead>
								
								@if (empty($usuarios))
								<tbody>
									<tr>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>
								</tbody>
								@else
								@foreach($mensajeros as $mensajero)
								<tr data-url="edit-sucursal" data-id="{{ $mensajero->id }}" data-edit="{{ $mensajero->userID }}">
									<td>
										<span id="itemMensajero" name="{{$mensajero->id}}">{{$mensajero->userID}}</span>
										
										<a href="#" id="eliminarMensajero" class="eliminarMensajero" data-id="{{ $mensajero->id }}" data-userID="{{ $mensajero->userID }}" style="font-weight:bold;float:right;position:relative;top:-3px;">&times;</a>
										<a href="#" id="editarMensajero" class="editarMensajero" data-id="{{ $mensajero->id }}" data-userID="{{ $mensajero->userID }}" data-telefono="{{ $mensajero->telefonoUsuario }}" data-localidadID="{{ $mensajero->localidadID }}" data-nombreMensajero="{{ $mensajero->nombreUsuario }}" style="margin-right:15px;float:right;"><i class="fa fa-pencil-square-o"></i></a>
										<a href="#" id="editarMensajeroPassword" class="editarMensajeroPassword" data-id="{{ $mensajero->id }}" data-userID="{{ $mensajero->userID }}" data-telefono="{{ $mensajero->telefonoUsuario }}" data-localidadID="{{ $mensajero->localidadID }}" data-nombreMensajero="{{ $mensajero->nombreUsuario }}" style="margin-right:15px;float:right;"><i class="fa fa-lock"></i></a>
									</td>
									<td>{{$mensajero->nombreUsuario}}</td>
									<td>{{$mensajero->telefonoUsuario}}</td>
									<?php $nombreSucursal = '---'; ?>
									@foreach($sucursales as $sucursal)
										@if($sucursal->id == $mensajero->localidadID)
											<?php $nombreSucursal = $sucursal->nombreLocalidad; ?>
										@endif
									@endforeach
									<td>
										@if($nombreSucursal == '---')
											<a href="#">Asignar</a>
										@else
											{{$nombreSucursal}}
										@endif
									</td>
									<td>
										@if($mensajero->EstatusActual == 0)
											<span style="color:#00FF40;" title="Disponible"><i class="fa fa-user" aria-hidden="true"></i> Disponible</span>
										@elseif($mensajero->EstatusActual == 1)
											<span style="color:#FF8000;" title="Asignado"><i class="fa fa-user" aria-hidden="true"></i> Asignado</span>
										@elseif($mensajero->EstatusActual == 2)
											<span style="color:#FF0000;" title="Ocupado"><i class="fa fa-user" aria-hidden="true"></i> Ocupado</span>
										@elseif($mensajero->EstatusActual == 3)
											<span style="color:#01DFD7;" title="Fuera de linea"><i class="fa fa-user" aria-hidden="true"></i> Fuera de linea</span>
										@endif
									</td>
									<td>
										@if($mensajero->activo == 1)
											<input type="checkbox" class="switchestatusmensajero" checked data-toggle="toggle" data-mensajeroid="{{$mensajero->id}}" data-estatus="0" data-on="<i class='fa fa-user'></i> On" data-off="<i class='fa fa-user-times'></i> Off" data-size="mini">
										@else
											<input type="checkbox" class="switchestatusmensajero" data-toggle="toggle" data-mensajeroid="{{$mensajero->id}}" data-estatus="1" data-on="<i class='fa fa-user'></i> On" data-off="<i class='fa fa-user-times'></i> Off" data-size="mini">
										@endif
									</td>
								</tr>
								@endforeach
								@endif
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>                
	</div>
	
	<!-- Modal -->
	<div id="modalAgregarMensajero" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalAgregarMensajero" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Agregar Mensajero</h4>
				</div>
				<form id="formAgregarMensajero" action="mensajero" method="post">
					<div class="modal-body">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="guardarMensajero">
							<i class="fa fa-building-o" style="font-size:20px;"></i>
							<select name="localidadID" class="text select">
								<!--<option value=" ">- Selecciona una sucursal -</option>-->
								@foreach($sucursales as $sucursal)
									<option value="{{ $sucursal->id }}">{{ $sucursal->nombreLocalidad }}</option>
								@endforeach
							</select>
							<input id="nombreMensajero" type="text" name="nombreUsuario" class="text" value="" placeholder="Nombre de mensajero">
							<input id="telefonoMensajero" type="text" name="telefonoUsuario" class="text" value="" placeholder="Telefono">
							<input id="userID" type="text" name="userID" class="text" value="" placeholder="Username">
							<input id="password" type="password" name="password" class="text" value="" placeholder="Contrase&ntilde;a">
						
					</div>
					<div class="modal-footer">
						<a id="CancelarGuardarMensajero" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<input type="submit" id="GuardarMensajero" type="button" value="Guardar" class="btn btn-success" data-dismiss="modal">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="modalEditarMensajero" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalEditarMensajero" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Editar Usuario</h4>
				</div>
				<form id="formEditarMensajero" action="mensajero" method="post">
					<div class="modal-body">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="editarMensajero">
							<input type="hidden" name="id" id="id" value="">
							<i class="fa fa-building-o" style="font-size:20px;"></i>
							<select name="localidadID" id="localidadID" class="text select">
								<option value=" ">- Selecciona una sucursal -</option>
								@foreach($sucursales as $sucursal)
									<option value="{{ $sucursal->id }}">{{ $sucursal->nombreLocalidad }}</option>
								@endforeach
							</select>
							<input id="nombreMensajero" type="text" name="nombreUsuario" class="text" value="" placeholder="Nombre de mensajero">
							<input id="telefonoMensajero" type="text" name="telefonoUsuario" class="text" value="" placeholder="Telefono">
							<input id="userID" type="text" name="userID" class="text" value="" placeholder="Username">
					</div>
					<div class="modal-footer">
						<a id="CancelarEditarMensajero" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<input type="submit" id="GuardarEditarMensajero" type="button" value="Guardar" class="btn btn-success" data-dismiss="modal">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="modalEditarMensajeroPassword" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalEditarMensajeroPassword" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Editar Contrase&ntilde;a</h4>
				</div>
				<form id="formEditarMensajeroPassword" action="mensajero" method="post">
					<div class="modal-body">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="editarMensajeroPassword">
							<input type="hidden" name="id" id="id" value="">
							<input id="nombreMensajero" type="text" name="nombreUsuario" class="text" value="" readonly="true" placeholder="Nombre de mensajero">
							<input id="password" type="password" name="password" class="text" value="" placeholder="Contrase&ntilde;a">
					</div>
					<div class="modal-footer">
						<a id="CancelarEditarMensajeroPassword" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<input type="submit" id="GuardarEditarMensajeroPassword" type="button" value="Guardar" class="btn btn-success" data-dismiss="modal">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="modalEliminarMensajero" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalEliminarMensajero" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle fa-2x"></i> Eliminar Usuario</h4>
				</div>
				<form id="formEliminarMensajero" action="mensajero" method="post">
					<div class="modal-body">
							Desea eliminar <span id="modalEliminarMensajeroTitle"></span>?
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="eliminarMensajero">
							<input id="id" type="hidden" name="id" class="text" value="">
						
					</div>
					<div class="modal-footer">
						<a id="CancelarEliminarMensajero" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<input type="submit" id="borrarMensajero" type="button" value="Eliminar" class="btn btn-success" data-dismiss="modal">
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!-- <div>

</div> -->
@stop
@section('custom-js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
@stop

<script type="text/javascript" src="{{ asset('public/assets/js/jquery-2.2.2.js') }}"></script>
<script>
	$(document).ready(function(){
		
		$('#tablaUsuarios').DataTable({
			"dom": '<"top"f>rt<"bottom"p><"clear">',
			"paging":   false,
			"scrollY":  "410px",
			"scrollCollapse": true,
			//"ordering": false,
			"info":     true
		});
		
		$(document).on('click','.toggle.btn',function(){
			var dominio = document.domain;
			var asunto = 'switchestatususuario';
			var statusresult;
			
			var mensajeroid = $(this).children('.switchestatusmensajero').attr('data-mensajeroid');
			var estatus = $(this).children('.switchestatusmensajero').attr('data-estatus');
			
			if(estatus == '1'){
				statusresult = '0';
			}else{
				statusresult = '1';
			}
			/*
			function switchbutton(newestatus){
				$(this).children('.switchestatusmensajero').attr('data-estatus',newestatus);
			}
			*/
			$(this).children('.switchestatusmensajero').attr('data-estatus',statusresult);
			
			var jqxhrd = $.post( "http://" + dominio + "/SmartDelivery/operador/takeorder",  
			{ 
				asunto: asunto,
				usuarioid: mensajeroid,
				estatus: estatus
			}, function(data, status){
				if(status == "success"){
					//alert ("Success");
					//$(this).children('.switchestatusmensajero').attr('data-estatus',statusresult);
					//switchbutton(statusresult);
				}
				if(status == "error"){
					//alert ("Success");
					//$(this).children('.switchestatusmensajero').attr('data-estatus',estatus);
					//switchbutton(estatus);
				}
			});
			
		});
		
		//Functions modalAgregarUsuario
			$('#agregarMensajero').click(function(){
				event.preventDefault();
				$('#modalAgregarMensajero').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalAgregarMensajero, #CancelarGuardarMensajero').click(function(){
				event.preventDefault();
				$('#modalAgregarMensajero').fadeToggle('fast');
			});
			//Validaciones
			$('#GuardarMensajero').click(function(){
				var nombreMensajero = $('#formAgregarMensajero #nombreMensajero').val();
				var telefonoMensajero = $('#formAgregarMensajero #telefonoMensajero').val();
				var userID = $('#formAgregarMensajero #userID').val();
				var password = $('#formAgregarMensajero #password').val();
				
				if(nombreUsuario == ''){
					alert('No ha especificado un nombre!');
					return false;
				}
				
				if(userID == ''){
					alert('Debe introducir el username del mensajero!');
					return false;
				}
				
				if(password == ''){
					alert('Debe introducir una clave!');
					return false;
				}
			});
		//***************************************/
		
		//Functions modalEditarMensajero
			$(document).on('click', '.editarMensajero',function () {
			//$('.editarMensajero').click(function(){
				event.preventDefault();
				$('#formEditarMensajero #id').val($(this).attr('data-id'));
				$('#formEditarMensajero #localidadID option').removeAttr('selected');
				document.getElementById('localidadID').value = $(this).attr('data-localidadid');
				//$('#formEditarMensajero #localidadID option[value="'+ $(this).attr('data-localidadID') +'"]').attr('selected', 'selected' );
				
				$('#formEditarMensajero #nombreMensajero').val($(this).attr('data-nombreMensajero'));
				$('#formEditarMensajero #telefonoMensajero').val($(this).attr('data-telefono'));
				$('#formEditarMensajero #userID').val($(this).attr('data-userID'));
				
				$('#modalEditarMensajero').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalEditarMensajero, #CancelarEditarMensajero').click(function(){
				event.preventDefault();
				$('#modalEditarMensajero').fadeToggle('fast');
			});
			$('#GuardarEditarMensajero').click(function(){
				var nombreSucursal = $('#formEditarSucursal #nombreSucursal').val();
				var nombreGerente = $('#formEditarSucursal #nombreGerente').val();
				
				if(nombreSucursal == ''){
					alert('No ha especificado un nombre para la sucursal');
					return false;
				}
				
				if(nombreGerente == ''){
					alert('No ha especificado un nombre para el gerente');
					return false;
				}
			});
		//***************************************/
		
		//Functions modalEditarMensajeroPassword
			$(document).on('click', '.editarMensajeroPassword',function () {
			//$('.editarMensajeroPassword').click(function(){
				event.preventDefault();
				$('#formEditarMensajeroPassword #id').val($(this).attr('data-id'));
				
				$('#formEditarMensajeroPassword #nombreMensajero').val($(this).attr('data-nombreMensajero'));
				
				$('#modalEditarMensajeroPassword').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalEditarMensajeroPassword, #CancelarEditarMensajeroPassword').click(function(){
				event.preventDefault();
				$('#modalEditarMensajeroPassword').fadeToggle('fast');
			});
			$('#GuardarEditarMensajeroPassword').click(function(){
				var password = $('#formEditarMensajeroPassword #password').val();
				
				if(password.length < 6){
					alert('El password debe contener minimo 6 caracteres!');
					return false;
				}
			});
		//***************************************/
		
		//Functions modalEliminarMensajero
			$(document).on('click', '.eliminarMensajero',function () {
			//$('.eliminarMensajero').click(function(){
				event.preventDefault();
				$('#formEliminarMensajero #id').val($(this).attr('data-id'));
				$('#formEliminarMensajero #modalEliminarMensajeroTitle').text($(this).attr('data-userID'));
				$('#modalEliminarMensajero').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalEliminarMensajero, #CancelarEliminarMensajero').click(function(){
				event.preventDefault();
				$('#modalEliminarMensajero').fadeToggle('fast');
			});
			$('#borrarMensajero').click(function(){
				var id = $('#formEliminarMensajero #id').val();
				
				if(id == ''){
					alert('No se ha podido identificar este mensajero');
					return false;
				}
			});
		//***************************************/
		
	});
</script>

