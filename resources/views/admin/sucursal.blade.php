@extends('admin.template.template')
@section('page-title')
	 Mis Sucursales
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
		
		#itemSucursal:focus { 
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
		$cuentaID = 0;
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


	<!-- Page Heading -->
	<!-- <div class="row">
		<div class="col-lg-12">
			<h1 class="page-header">
				<i class="fa fa-building-o"></i> Mis Sucursales
			</h1>
		</div>
	</div> -->
	
	
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
								<a href="dashboard"><i class="fa fa-home"></i> Admin</a> >> <a href="#">Sucursales</a>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
						
					</div>
				
			</div> 
			<!-- /.panel -->
		</div>
	</div>
	<!-- Sucursales -->
	<a href="#" class="row conteo btn-primary" style="margin-left:10px;" data-toggle="tooltip">
		<div id="tooltip">Sucursales</div>
		<i class="fa fa-building-o"></i><br> <span class="cantidad">{{ $conteoSucursales }}</span>	
	</a>
	<!-- Operadores -->
	<a href="{{ url('admin/usuario') }}" class="row conteo btn-primary" data-toggle="tooltip">
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
	<!-- /.row -->

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"> Sucursales encontradas ( {{ $conteoSucursales }} ) <a href="#" id="agregarSucursal" style="cursor:pointer;">Agregar nuevo</a></div>
				<div class="panel-body">
					<div class="panel-body">
                        @if (Session::has('message_create'))
                            <div class=" {{ Session::get('alert_class') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('message_create') }}
                            </div>
                        @endif
						<div class="list-group">
							<table id="tabla" class="display" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th class="active">Sucursal</th>
										<th class="active">Gerente</th>
										<th class="active">Operadores</th>
										<th class="active">Mensajeros</th>
									</tr>
								</thead>
								
								@if (empty($sucursales))
								<tbody>
									<tr>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>
								</tbody>
								@else
								@foreach($sucursales as $sucursal)
									
									<?php $conteoOperadorPorSucursal = 0; ?>
										@foreach($usuarios as $usuario)
											@if($usuario->localidadID == $sucursal->id)
												<?php $conteoOperadorPorSucursal++; ?>
											@endif
										@endforeach
										
									<?php $conteoMensajerosPorSucursal = 0; ?>
										@foreach($mensajeros as $mensajero)
											@if($mensajero->localidadID == $sucursal->id)
												<?php $conteoMensajerosPorSucursal++; ?>
											@endif
										@endforeach
								
								<tr data-url="edit-sucursal" data-id="{{ $sucursal->id }}" data-longitud="{{ $sucursal->longitud }}" data-latitud="{{ $sucursal->latitud }}">
									<td>
										<span id="itemSucursal" name="{{$sucursal->id}}">{{$sucursal->nombreLocalidad}}</span> 
										
										<a href="#" id="eliminarSucursal" class="eliminarSucursal" data-id="{{ $sucursal->id }}" data-name="{{ $sucursal->nombreLocalidad }}" style="font-weight:bold;float:right;position:relative;top:-3px;">&times;</a>
										<a href="#" id="editarSucursal" class="editarSucursal" data-id="{{ $sucursal->id }}" data-name="{{ $sucursal->nombreLocalidad }}" data-gerente="{{ $sucursal->nombreGerente }}" data-direccion="{{ $sucursal->direccionLocalidad }}" data-latitud="{{ $sucursal->latitud }}" data-longitud="{{ $sucursal->longitud }}" data-mensajeros="{{ $conteoMensajerosPorSucursal }}" data-operadores="{{ $conteoOperadorPorSucursal }}" style="margin-right:15px;float:right;"><i class="fa fa-pencil-square-o"></i></a>
									</td>
									<td>{{$sucursal->nombreGerente}}</td>
									
									
									<td>
										@if($conteoOperadorPorSucursal == 0)
											<a href="{{ url('admin/usuario')}}">Agregar</a> <a href="{{ url('admin/usuario')}}" style="float:right;"><i class="fa fa-plus-square"></i></a>
										@else
											{{$conteoOperadorPorSucursal}} <a href="{{ url('admin/usuario')}}" style="float:right;"><i class="fa fa-plus-square"></i></a>
										@endif
									</td>
									
									
									<td>
										@if($conteoMensajerosPorSucursal == 0)
											<a href="{{ url('admin/mensajero')}}">Agregar</a> <a href="{{ url('admin/mensajero')}}" style="float:right;"><i class="fa fa-plus-square"></i></a>
										@else
											{{$conteoMensajerosPorSucursal}} <a href="{{ url('admin/mensajero')}}" style="float:right;"><i class="fa fa-plus-square"></i></a>
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
	<div id="modalAgregarSucursal" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalAgregarSucursal" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Agregar Sucursal</h4>
				</div>
				<form id="formAgregarSucursal" action="sucursal" method="post">
					<div class="modal-body">
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="guardarSucursal">
							<input id="nombreSucursal" type="text" name="nombreSucursal" class="text" value="" placeholder="Sucursal">
							<input id="nombreGerente" type="text" name="nombreGerente" class="text" value="" placeholder="Nombre del Gerente">
						
					</div>
					<div class="modal-footer">
						<a id="CancelarGuardarSucursal" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<input type="submit" id="GuardarSucursal" type="button" value="Guardar" class="btn btn-success" data-dismiss="modal">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="modalEditarSucursal" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:50px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalEditarSucursal" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Editar Sucursal</h4>
				</div>
				<form id="formEditarSucursal" action="sucursal" method="post">
					<div class="modal-body">
							<div id="formEditarConteoMensajeros" style="display:none;padding:5px;margin-right:10px;float:left;border-radius: 3px;border: 1px solid #d1d1d1;color: #fff;background-color: #337ab7;border-color: #2e6da4;font-weight: bold;"><i class="fa fa-motorcycle"></i> <span class="contador">0</span></div>
							<div id="formEditarConteoOperadores" style="display:none;padding:5px;margin-right:10px;float:left;border-radius: 3px;border: 1px solid #d1d1d1;color: #fff;background-color: #337ab7;border-color: #2e6da4;font-weight: bold;"><i class="fa fa-user"></i> <span class="contador">0</span></div>
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="editarSucursal">
							<input id="longitud" class="autoFillableLongitud" type="hidden" name="longitud" value="">
							<input id="latitud" class="autoFillableLatitud" type="hidden" name="latitud" value="">
							<input id="idSucursal" type="hidden" name="idSucursal" value="">
							<input id="nombreSucursal" type="text" name="nombreSucursal" class="text" value="" placeholder="Sucursal">
							<input id="nombreGerente" type="text" name="nombreGerente" class="text" value="" placeholder="Nombre del Gerente">
							<input id="direccion" type="text" name="direccion" class="text direccion" value="" placeholder="Direcci&oacute;n">
						<div id="map" style="width:100%;height:400px;"></div>
					</div>
					<div class="modal-footer">
						<a id="CancelarEditarSucursal" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<input type="submit" id="GuardarEditarSucursal" type="button" value="Guardar" class="btn btn-success" data-dismiss="modal">
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<!-- Modal -->
	<div id="modalEliminarSucursal" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalEliminarSucursal" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle fa-2x"></i> Eliminar Sucursal</h4>
				</div>
				<form id="formEliminarSucursal" action="sucursal" method="post">
					<div class="modal-body">
							Desea eliminar <span id="modalEliminarSucursalTitle"></span>?
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="eliminarSucursal">
							<input id="idSucursal" type="hidden" name="idSucursal" class="text" value="">
						
					</div>
					<div class="modal-footer">
						<a id="CancelarEliminarSucursal" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<input type="submit" id="borrarSucursal" type="button" value="Eliminar" class="btn btn-success" data-dismiss="modal">
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
	<script src="{{ asset('public/assets/js/takeorder.js') }}"></script>
	<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKnxouLftDsdQYJwChLKvRzMSNaxntk90&callback=initMap" async defer></script>-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCodL6hA8VlvpsL2a8DFE9f8yCWaCAIGqA&callback=initMap" async defer></script>
@stop
<script type="text/javascript" src="{{ asset('public/assets/js/jquery-2.2.2.js') }}"></script>
<script>
	$(document).ready(function(){
		
		$('#tabla').DataTable({
			"dom": '<"top"f>rt<"bottom"p><"clear">',
			//"paging":   false,
			//"ordering": false,
			"info":     true
		});
		
		//Functions modalAgregarSucursal
			$('#agregarSucursal').click(function(){
				event.preventDefault();
				$('#modalAgregarSucursal').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalAgregarSucursal, #CancelarGuardarSucursal').click(function(){
				event.preventDefault();
				$('#modalAgregarSucursal').fadeToggle('fast');
			});
			$('#GuardarSucursal').click(function(){
				var nombreSucursal = $('#formAgregarSucursal #nombreSucursal').val();
				var nombreGerente = $('#formAgregarSucursal #nombreGerente').val();
				
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
		
		//Functions modalEditarSucursal
			$(document).on('click', '.editarSucursal',function () {
			//$('.editarSucursal').click(function(){
				event.preventDefault();
				$('#formEditarSucursal #idSucursal').val($(this).attr('data-id'));
				$('#formEditarSucursal #nombreSucursal').val($(this).attr('data-name'));
				$('#formEditarSucursal #nombreGerente').val($(this).attr('data-gerente'));
				$('#formEditarSucursal .autoFillableLatitud').val($(this).attr('data-latitud'));
				$('#formEditarSucursal .autoFillableLongitud').val($(this).attr('data-longitud'));
				$('#formEditarSucursal #direccion').val($(this).attr('data-direccion'));
				$('#formEditarSucursal #formEditarConteoMensajeros .contador').text($(this).attr('data-mensajeros'));
				$('#formEditarSucursal #formEditarConteoOperadores .contador').text($(this).attr('data-operadores'));
				$('#modalEditarSucursal').fadeToggle('fast');
				initMap();
				return false;
			});
			$('#closeModalEditarSucursal, #CancelarEditarSucursal').click(function(){
				event.preventDefault();
				$('#modalEditarSucursal').fadeToggle('fast');
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
		
		//Functions modalEliminarSucursal
			$(document).on('click', '.eliminarSucursal',function () {
			//$('.eliminarSucursal').click(function(){
				event.preventDefault();
				$('#formEliminarSucursal #idSucursal').val($(this).attr('data-id'));
				$('#formEliminarSucursal #modalEliminarSucursalTitle').text($(this).attr('data-name'));
				$('#modalEliminarSucursal').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalEliminarSucursal, #CancelarEliminarSucursal').click(function(){
				event.preventDefault();
				$('#modalEliminarSucursal').fadeToggle('fast');
			});
			$('#borrarSucursal').click(function(){
				var idSucursal = $('#formEliminarSucursal #idSucursal').val();
				//var nombreGerente = $('#formAgregarSucursal #nombreGerente').val();
				
				if(idSucursal == ''){
					alert('No se ha podido identificar esta sucursal');
					return false;
				}
			});
		//***************************************/
		
		
	});
</script>

