@extends('adminlocalidad.template.template')
@section('page-title')
	Pedidos
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
		
		td > div {
			width:250px;
			overflow:hidden;
			white-space:nowrap;
			text-overflow: ellipsis;
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
	@if (empty($pedidosPendientes))
		
	@else
		@foreach($pedidosPendientes as $pedidopendiente)
			<?php $conteoPedidos++; ?>
		@endforeach
	@endif

	<?php 
		header("Refresh: 30");
	?>
	
	
	
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
								<a href="dashboard"><i class="fa fa-home"></i> Admin</a> >> <a href="#">Pedidos</a>
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
	<a href="{{ url('adminlocalidad/mensajero') }}" class="row conteo btn-primary" data-toggle="tooltip">
		<div id="tooltip">Mensajeros</div>
		<i class="fa fa-motorcycle"></i><br> <span class="cantidad">{{ $conteoMensajeros }}</span>	
	</a>
	<!-- Pedidos -->
	<a href="#" class="row conteo btn-warning" data-toggle="tooltip">
		<div id="tooltip">Pedidos</div>
		<i class="fa fa-list-ul"></i><br> <span class="cantidad">{{ $conteoPedidos }}</span>	
	</a>
	<!-- Reportes -->
	<a href="{{ url('adminlocalidad/reporte/pedidoMensajero') }}" class="row conteo btn-success" data-toggle="tooltip">
		<div id="tooltip">Reportes</div>
		<i class="fa fa-bar-chart"></i><br> <span class="cantidad">R</span>	
	</a>
	<!-- /.row -->

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"> Pedidos encontrados ( {{ $conteoPedidos }} ) <a href="#" id="agregarPedido" style="display:none;cursor:pointer;">Agregar nuevo</a></div>
				<div class="panel-body">
					<div class="panel-body">
                        @if (Session::has('message_create'))
                            <div class=" {{ Session::get('alert_class') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('message_create') }}
                            </div>
                        @endif
						<div class="list-group">
							<table id="tablaPedidos" class="display" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th class="active">Orden</th>
										<th class="active">Cliente</th>
										<th class="active">Identificacion</th>
										<th class="active">Direccion</th>
										<th class="active">Total</th>
										<th class="active">Mensajeros</th>
										<th class="active">Tiempo</th>
										<th class="active">Estado</th>
										<th class="active"></th>
									</tr>
								</thead>
								
								@if (empty($pedidos))
								<tbody>
									<tr>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>
								</tbody>
								@else
								@foreach($pedidos as $pedido)
									<?php 
										//tiempo transcurrido en cada pedido
										$fechaInicial=$pedido->created_at;
										$fechaFinal=$pedido->updated_at;
										$segundos=strtotime($fechaFinal) - strtotime($fechaInicial);
										
										//Direfencia de tiempo
										$diferencia_segundos=intval($segundos);
										$diferencia_minutos=intval($segundos/60);
										$diferencia_horas=intval($segundos/60/60);
										$diferencia_dias=intval($segundos/60/60/24);
										
										$diferencia_real = $diferencia_horas . ":" . ($diferencia_minutos - ($diferencia_horas * 60)) . ":" . ($diferencia_segundos - ($diferencia_minutos * 60));
									?>
									<?php $mensajeroPorPedido = "---"; ?>
										@foreach($mensajeros as $mensajero)
											@if($mensajero->id == $pedido->usuarioID)
												<?php $mensajeroPorPedido = $mensajero->nombreUsuario; ?>
											@endif
										@endforeach
										
										<?php $clientePorPedido = "---"; ?>
										@foreach($clientes as $cliente)
											@if($cliente->id == $pedido->clienteID)
												<?php $clientePorPedido = $cliente->nombreCliente; ?>
												<?php $clienteIdentificacion = $cliente->identificacion; ?>
											@endif
										@endforeach
										
										<?php $direccionClientePorPedido = "---"; ?>
										@foreach($direcciones as $direccion)
											@if($direccion->clienteID == $pedido->clienteID)
												<?php $direccionClientePorPedido = $direccion->direccion; ?>
											@endif
										@endforeach
										
										<?php $estadoPorPedido = "---"; ?>
										@foreach($estado_pedidos as $estado_pedido)
											@if($estado_pedido->id == $pedido->estadoPedidoID)
												<?php $estadoPorPedido = $estado_pedido->estadoPedido; ?>
											@endif
										@endforeach
								
								<tr>
									<td>
										<a href="{{ url('adminlocalidad/consultorder/'.$pedido->tracking_id) }}" id="itemPedido" name="{{$pedido->id}}">{{$pedido->orden}}</a> 
										
										<!--<a href="#" id="eliminarPedido" class="eliminarPedido" data-id="{{ $pedido->id }}" data-orden="{{ $pedido->orden }}" style="font-weight:bold;float:right;position:relative;top:-3px;">&times;</a>-->
										
									</td>
									
									
									<!--Filtrar el nombre del cliente en esta celda-->
									<td>{{ $clientePorPedido }}</td>
									
									<td>{{ $clienteIdentificacion }}</td>
									
									<!--Filtrar la direccion del cliente en esta celda-->
									<td><div>{{ $direccionClientePorPedido }}</div></td>
									
									<!--Filtrar el monto total de la orden del cliente en esta celda-->
									<td>{{ $pedido->total }}</td>
									
									<!--Filtrar el nombre del usuario o mensajero asignado en esta celda-->
									<td>
										{{ $mensajeroPorPedido }} 
										<a href="#" id="editarMensajero" class="editarMensajero" data-id="{{ $pedido->id }}" data-idMensajero="{{ $pedido->usuarioID }}" data-orden="{{ $pedido->orden }}" data-tracking-id="{{ $pedido->tracking_id }}" style="margin-right:15px;float:right;"><i class="fa fa-pencil-square-o"></i></a>
									</td>
									
									<!--Filtrar el tiempo transcurrido en esta celda-->
									<td style="text-align:right;"><span class="timeElapsed" data-id="{{ $pedido->id }}" data-comenzar="{{ $pedido->timeCreated }}">{{ $diferencia_real }}</span></td>
									
									<!--Filtrar el el estado del pedido en esta celda-->
									<td style="font-weight:bold;font-size:14px;"><span class="estado" id="{{ $pedido->id }}">{{ $estadoPorPedido }}</span></td>
									
									<td style="font-weight:bold;font-size:14px;"><a class="completarpedido" data-id="{{ $pedido->id }}"><i class="fa fa-check-square" aria-hidden="true"></i></a></td>
									
									
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
	<div id="modalEditarMensajero" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalEditarMensajero" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Editar Mensajero</h4>
				</div>
				<form id="formEditarMensajero" action="pedido" method="post">
					<div class="modal-body">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input id="asunto" type="hidden" name="asunto" value="editarMensajero">
						<input id="idPedido" type="hidden" name="idPedido" value="">
						<select name="idMensajero" id="idMensajero" class="text select idMensajero" style="padding:10px;border:1px solid #777777;">
							<option value=" "> </option>
							@foreach($mensajeros as $mensajero)
								<option value="{{ $mensajero->id }}" style="padding:5px;">{{ $mensajero->nombreUsuario }}</option>
							@endforeach
						</select>
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
	<div id="modalCompletarPedido" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalCompletarPedido" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Completar Pedido</h4>
				</div>
				<form id="formCompletarPedido" action="pedido" method="post">
					<div class="modal-body">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input id="asunto" type="hidden" name="asunto" value="completarPedido">
						<input id="idPedido" type="hidden" name="idPedido" value="">
						<span>Esta opcion indicara que el mensajero a entregado el pedido. Desea terminar este pedido? </span>
					</div>
					<div class="modal-footer">
						<a id="" type="button" class="btn btn-default" style="display:none;" data-dismiss="modal">.</a>
						<a id="CancelarCompletarPedido" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<input type="submit" id="GuardarCompletarPedido" type="button" value="Aceptar" class="btn btn-success" data-dismiss="modal">
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
		<!-- dataTables core JQuery -->
	<script type="text/javascript" src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/takeorder.js') }}"></script>
	
@stop
<script type="text/javascript" src="{{ asset('public/assets/js/jquery-2.2.2.js') }}"></script>
<script>
	$(document).ready(function(){

		$('#tablaPedidos').DataTable({
			"dom": '<"top"f>rt<"bottom"p><"clear">',
			//"paging":   false,
			//"ordering": false,
			"info":     true
		});
		
		//Functions modalEditarMensajero
			$(document).on('click', '.editarMensajero',function () {
			//$('.editarMensajero').click(function(){
				event.preventDefault();
				$('#formEditarMensajero #idPedido').val($(this).attr('data-id'));
				$('#formEditarMensajero #idMensajero option').removeAttr('selected');
				$('#formEditarMensajero #idMensajero option[value="'+ $(this).attr('data-idMensajero') +'"]').attr('selected', 'selected' );
				
				$('#modalEditarMensajero').fadeToggle('fast');
				//initMap();
				return false;
			});
			$('#closeModalEditarMensajero, #CancelarEditarMensajero').click(function(){
				event.preventDefault();
				$('#modalEditarMensajero').fadeToggle('fast');
			});
			$('#GuardarEditarMensajero').click(function(){
				var idMensajero = $('#formEditarMensajero #idMensajero').val();
				
				if(idMensajero == ''){
					alert('No ha especificado un mensajero');
					return false;
				}
			});
		//***************************************/
		
		//Functions modalCompletarPedido
			$(document).on('click', '.completarpedido',function () {
			//$('.editarMensajero').click(function(){
				event.preventDefault();
				$('#formCompletarPedido #idPedido').val($(this).attr('data-id'));
				
				$('#modalCompletarPedido').fadeIn('fast');
				//initMap();
				return false;
			});
			$('#closeModalCompletarPedido, #CancelarCompletarPedido').click(function(){
				event.preventDefault();
				$('#modalCompletarPedido').fadeOut('fast');
			});
		//***************************************/
		
		//Functions modalEliminarSucursal
			$(document).on('click', '.eliminarMensajero',function () {
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
		
		//***************************************/
		function contador_onload(){
			//now=new Date();
			//$(document).on('each', '.timeElapsed',function () {
			$(".timeElapsed").each(function(index) 
			{	
				if($('#'+$(this).attr('data-id')).text() != 'completo'){
					var comenzar = new Date($(this).attr('data-comenzar'));
					var now=new Date();
					
					timeElapsed=now.getTime()-comenzar.getTime();
					delete now;
					minsElapsed=0;
					secsElapsed=0;
					secsM=0;
					hunsElapsed=0;
					out="";
					minsElapsed=Math.floor((timeElapsed/1000)/60);
					//secsM=timeElapsed%1;
					
					secsElapsed=Math.floor(timeElapsed/1000);
					secsM = secsElapsed - (minsElapsed * 60);
					timeElapsed=timeElapsed%1000;
					hunsElapsed=Math.floor(timeElapsed/10);
					timeElapsed=timeElapsed%10;
					out+=((minsElapsed<10)?"0":"")+(minsElapsed)+":";
					out+=((secsM<10)?"0":"")+secsM+"";
					//out+=((hunsElapsed<10)?"":"")+hunsElapsed;
					$(this).text(out);
					if(minsElapsed<15){
						$('#'+$(this).attr('data-id')).css("color", "green");
						$('#'+$(this).attr('data-id')).text("A TIEMPO");
					}else if (minsElapsed<30){
						$('#'+$(this).attr('data-id')).css("color", "#FF8000");
						$('#'+$(this).attr('data-id')).text("ATRASADO");
					}else {
						$('#'+$(this).attr('data-id')).css("color", "RED");
						$('#'+$(this).attr('data-id')).text("PERDIDO");
					}
				
				}
				//stopID=setTimeout("contador_onload()",1000);
				
				//document.getElementById('timestamp2').value = now;
			 });
		}
		setInterval(contador_onload, 1000);
		//***************************************/
	});
</script>

