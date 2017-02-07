@extends('admin.template.template')
@section('page-title')
	 Mis Operadores
@stop
@section('body')
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
								<a href="dashboard"><i class="fa fa-home"></i> Admin</a> >> <a href="#">Operadores</a>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
						
					</div>
				
			</div> 
			<!-- /.panel -->
		</div>
	</div>
	<!-- Sucursales -->
	<a href="{{ url('admin/sucursal') }}" class="row conteo btn-primary" style="margin-left:10px;" data-toggle="tooltip">
		<div id="tooltip">Sucursales</div>
		<i class="fa fa-building-o"></i><br> <span class="cantidad">{{ $conteoSucursales }}</span>	
	</a>
	<!-- Operadores -->
	<a href="#" class="row conteo btn-primary" data-toggle="tooltip">
		<div id="tooltip">Operadores</div>
		<i class="fa fa-user"></i><br> <span class="cantidad">{{ $conteoUsuarios }}</span>	
	</a>
	<!-- Mensajeros -->
	<a href="{{ url('admin/mensajero') }}" class="row conteo btn-primary" data-toggle="tooltip">
		<div id="tooltip">Mensajeros</div>
		<i class="fa fa-motorcycle"></i><br> <span class="cantidad">{{ $conteoMensajeros }}</span>	
	</a>
	<!-- Pedidos -->
	<a href="{{ url('admin/pedido') }}" class="row conteo btn-warning" data-toggle="tooltip">
		<div id="tooltip">Pedidos</div>
		<i class="fa fa-list-ul"></i><br> <span class="cantidad">{{ $conteoPedidos }}</span>	
	</a>
	<!-- Reportes -->
	<a href="{{ url('admin/reporte/pedidoMensajero') }}" class="row conteo btn-success" data-toggle="tooltip">
		<div id="tooltip">Reportes</div>
		<i class="fa fa-bar-chart"></i><br> <span class="cantidad">R</span>	
	</a>

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"> Operadores encontrados ( {{ $conteoUsuarios }} ) <a href="#" id="agregarUsuario" style="cursor:pointer;">Agregar nuevo</a></div>
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
									</tr>
								</thead>
								
								@if (empty($usuarios))
								<tbody>
									<tr>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>
								</tbody>
								@else
								@foreach($usuarios as $usuario)
								<tr data-url="edit-sucursal" data-id="{{ $usuario->id }}" data-edit="{{ $usuario->userID }}">
									<td>
										<span id="itemOperador" name="{{$usuario->id}}">{{$usuario->userID}}</span>
										
										<a href="#" id="eliminarUsuario" class="eliminarUsuario" data-id="{{ $usuario->id }}" data-userID="{{ $usuario->userID }}" style="font-weight:bold;float:right;position:relative;top:-3px;">&times;</a>
										<a href="#" id="editarUsuario" class="editarUsuario" data-id="{{ $usuario->id }}" data-userID="{{ $usuario->userID }}" data-telefono="{{ $usuario->telefonoUsuario }}" data-localidadID="{{ $usuario->localidadID }}" data-nombreUsuario="{{ $usuario->nombreUsuario }}" style="margin-right:15px;float:right;"><i class="fa fa-pencil-square-o"></i></a>
										<a href="#" id="editarUsuarioPassword" class="editarUsuarioPassword" data-id="{{ $usuario->id }}" data-userID="{{ $usuario->userID }}" data-telefono="{{ $usuario->telefonoUsuario }}" data-localidadID="{{ $usuario->localidadID }}" data-nombreUsuario="{{ $usuario->nombreUsuario }}" style="margin-right:15px;float:right;"><i class="fa fa-lock"></i></a>
									</td>
									<td>{{$usuario->nombreUsuario}}</td>
									<td>{{$usuario->telefonoUsuario}}</td>
									<?php $nombreSucursal = '---'; ?>
									@foreach($sucursales as $sucursal)
										@if($sucursal->id == $usuario->localidadID)
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
	<div id="modalAgregarUsuario" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalAgregarUsuario" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Agregar Usuario</h4>
				</div>
				<form id="formAgregarUsuario" action="usuario" method="post">
					<div class="modal-body">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="guardarUsuario">
							<i class="fa fa-building-o" style="font-size:20px;"></i>
							<select name="localidadID" class="text select">
								<option value=" ">- Selecciona una sucursal -</option>
								@foreach($sucursales as $sucursal)
									<option value="{{ $sucursal->id }}">{{ $sucursal->nombreLocalidad }}</option>
								@endforeach
							</select>
							<input id="nombreUsuario" type="text" name="nombreUsuario" class="text" value="" placeholder="Nombre de usuario">
							<input id="telefonoUsuario" type="text" name="telefonoUsuario" class="text" value="" placeholder="Telefono">
							<input id="userID" type="text" name="userID" class="text" value="" placeholder="Username">
							<input id="password" type="password" name="password" class="text" value="" placeholder="Contrase&ntilde;a">
						
					</div>
					<div class="modal-footer">
						<a id="CancelarGuardarUsuario" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<input type="submit" id="GuardarUsuario" type="button" value="Guardar" class="btn btn-success" data-dismiss="modal">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="modalEditarUsuario" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalEditarUsuario" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Editar Usuario</h4>
				</div>
				<form id="formEditarUsuario" action="usuario" method="post">
					<div class="modal-body">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="editarUsuario">
							<input type="hidden" name="id" id="id" value="">
							<i class="fa fa-building-o" style="font-size:20px;"></i>
							<select name="localidadID" id="localidadID" class="text select">
								<option value=" ">- Selecciona una sucursal -</option>
								@foreach($sucursales as $sucursal)
									<option value="{{ $sucursal->id }}">{{ $sucursal->nombreLocalidad }}</option>
								@endforeach
							</select>
							<input id="nombreUsuario" type="text" name="nombreUsuario" class="text" value="" placeholder="Nombre de usuario">
							<input id="telefonoUsuario" type="text" name="telefonoUsuario" class="text" value="" placeholder="Telefono">
							<input id="userID" type="text" name="userID" class="text" value="" placeholder="Username">
					</div>
					<div class="modal-footer">
						<a id="CancelarEditarUsuario" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<input type="submit" id="GuardarEditarUsuario" type="button" value="Guardar" class="btn btn-success" data-dismiss="modal">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="modalEditarUsuarioPassword" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalEditarUsuarioPassword" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Editar Contrase&ntilde;a</h4>
				</div>
				<form id="formEditarUsuarioPassword" action="usuario" method="post">
					<div class="modal-body">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="editarUsuarioPassword">
							<input type="hidden" name="id" id="id" value="">
							<input id="nombreUsuario" type="text" name="nombreUsuario" class="text" value="" readonly="true" placeholder="Nombre de usuario">
							<input id="password" type="password" name="password" class="text" value="" placeholder="Contrase&ntilde;a">
					</div>
					<div class="modal-footer">
						<a id="CancelarEditarUsuarioPassword" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<input type="submit" id="GuardarEditarUsuarioPassword" type="button" value="Guardar" class="btn btn-success" data-dismiss="modal">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="modalEliminarUsuario" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalEliminarUsuario" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle fa-2x"></i> Eliminar Usuario</h4>
				</div>
				<form id="formEliminarUsuario" action="usuario" method="post">
					<div class="modal-body">
							Desea eliminar <span id="modalEliminarUsuarioTitle"></span>?
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="eliminarUsuario">
							<input id="id" type="hidden" name="id" class="text" value="">
						
					</div>
					<div class="modal-footer">
						<a id="CancelarEliminarUsuario" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<input type="submit" id="borrarUsuario" type="button" value="Eliminar" class="btn btn-success" data-dismiss="modal">
					</div>
				</form>
			</div>
		</div>
	</div>
	
<!-- <div>

</div> -->
@stop
@section('custom-js')

<script type="text/javascript" src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
@stop

<script type="text/javascript" src="{{ asset('public/assets/js/jquery-2.2.2.js') }}"></script>
<script>
	$(document).ready(function(){
		
		$('#tablaUsuarios').DataTable({
			"dom": '<"top"f>rt<"bottom"p><"clear">',
			//"paging":   false,
			//"ordering": false,
			"info":     true
		});
		
		//Functions modalAgregarUsuario
			$('#agregarUsuario').click(function(){
				event.preventDefault();
				$('#modalAgregarUsuario').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalAgregarUsuario, #CancelarGuardarUsuario').click(function(){
				event.preventDefault();
				$('#modalAgregarUsuario').fadeToggle('fast');
			});
			//Validaciones
			$('#GuardarUsuario').click(function(){
				var nombreUsuario = $('#formAgregarUsuario #nombreUsuario').val();
				var telefonoUsuario = $('#formAgregarUsuario #telefonoUsuario').val();
				var userID = $('#formAgregarUsuario #userID').val();
				var password = $('#formAgregarUsuario #password').val();
				
				if(nombreUsuario == ''){
					alert('No ha especificado un nombre!');
					return false;
				}
				
				if(userID == ''){
					alert('Debe introducir el username del operador!');
					return false;
				}
				
				if(password == ''){
					alert('Debe introducir una clave!');
					return false;
				}
			});
		//***************************************/
		
		//Functions modalEditarUsuario
			$(document).on('click', '.editarUsuario',function () {
			//$('.editarUsuario').click(function(){
				event.preventDefault();
				$('#formEditarUsuario #id').val($(this).attr('data-id'));
				$('#formEditarUsuario #localidadID option').removeAttr('selected');
				document.getElementById('localidadID').value = $(this).attr('data-localidadid');
				//$('#formEditarUsuario #localidadID option[value="'+ $(this).attr('data-localidadID') +'"]').attr('selected', 'selected' );
				
				$('#formEditarUsuario #nombreUsuario').val($(this).attr('data-nombreUsuario'));
				$('#formEditarUsuario #telefonoUsuario').val($(this).attr('data-telefono'));
				$('#formEditarUsuario #userID').val($(this).attr('data-userID'));
				
				$('#modalEditarUsuario').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalEditarUsuario, #CancelarEditarUsuario').click(function(){
				event.preventDefault();
				$('#modalEditarUsuario').fadeToggle('fast');
			});
			$('#GuardarEditarSucursal').click(function(){
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
		
		//Functions modalEditarUsuarioPassword
			$(document).on('click', '.editarUsuarioPassword',function () {
			//$('.editarUsuarioPassword').click(function(){
				event.preventDefault();
				$('#formEditarUsuarioPassword #id').val($(this).attr('data-id'));
				
				$('#formEditarUsuarioPassword #nombreUsuario').val($(this).attr('data-nombreUsuario'));
				
				$('#modalEditarUsuarioPassword').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalEditarUsuarioPassword, #CancelarEditarUsuarioPassword').click(function(){
				event.preventDefault();
				$('#modalEditarUsuarioPassword').fadeToggle('fast');
			});
			$('#GuardarEditarUsuarioPassword').click(function(){
				var password = $('#formEditarUsuarioPassword #password').val();
				
				if(password.length < 6){
					alert('El password debe contener minimo 6 caracteres!');
					return false;
				}
			});
		//***************************************/
		
		//Functions modalEliminarSucursal
			$(document).on('click', '.eliminarUsuario',function () {
			//$('.eliminarUsuario').click(function(){
				event.preventDefault();
				$('#formEliminarUsuario #id').val($(this).attr('data-id'));
				$('#formEliminarUsuario #modalEliminarUsuarioTitle').text($(this).attr('data-userID'));
				$('#modalEliminarUsuario').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalEliminarUsuario, #CancelarEliminarUsuario').click(function(){
				event.preventDefault();
				$('#modalEliminarUsuario').fadeToggle('fast');
			});
			$('#borrarUsuario').click(function(){
				var id = $('#formEliminarUsuario #id').val();
				
				if(id == ''){
					alert('No se ha podido identificar este operador');
					return false;
				}
			});
		//***************************************/
		
	});
</script>

