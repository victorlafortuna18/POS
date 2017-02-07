@extends('adminoperador.template.template')
@section('page-title')
	 Ordenes Por Despachar
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
		
		$idSucursal = 0;
		$nombreLocalidad = '';
		$direccionLocalidad = '';
		$idLocalidad = 0;
	?>
	@if (empty($sucursales))
		
	@else
		@foreach($sucursales as $sucursal)
			<?php $conteoSucursales++; ?>
			<?php 
				$idSucursal = $sucursal->idSucursal;
				$nombreLocalidad = $sucursal->nombreLocalidad;
				$direccionLocalidad = $sucursal->direccionLocalidad;
				$idLocalidad = $sucursal->id;
			?>
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
		$lastOrdenID = 0; 
	?>
	@if (empty($ordenes))
		
	@else
		@foreach($ordenes as $orden)
			@if($orden->cuentaid == $cuentaID)
				@if($orden->sucursalid == $idSucursal)
					<?php $lastOrdenID = $orden->id; ?>
					<?php $conteoOrdenes++; ?>
				@endif
			@endif
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
		//Generando un conteo de los pedidosPendientes
		//*************************************
		$conteoPedidosPendientes = 0;
	?>
	@if (empty($pedidosPendientes))
		
	@else
		@foreach($pedidosPendientes as $pedidoPendiente)
			<?php $conteoPedidosPendientes++; ?>
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
								<a href="dashboard"><i class="fa fa-home"></i> Admin</a> >> <a href="#">Ordenes</a>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
						
					</div>
				
			</div> 
			<!-- /.panel -->
		</div>
	</div>
	
	<!-- Mensajeros -->
	<a href="{{ url('adminoperador/mensajero') }}" class="row conteo btn-primary" data-toggle="tooltip">
		<div id="tooltip">Mensajeros</div>
		<i class="fa fa-motorcycle"></i><br> <span class="cantidad">{{ $conteoMensajeros }}</span>	
	</a>
	<!-- Pedidos -->
	<a href="#" class="row conteo btn-warning" data-toggle="tooltip">
		<div id="tooltip">Ordenes</div>
		<i class="fa fa-list-ol"></i><br> <span class="cantidad">{{ $conteoOrdenes }}</span>	
	</a>
	<!-- Pedidos -->
	<a href="{{ url('adminoperador/pedido') }}" class="row conteo btn-warning" data-toggle="tooltip">
		<div id="tooltip">Pedidos</div>
		<i class="fa fa-list-ul"></i><br> <span class="cantidad">{{ $conteoPedidosPendientes }}</span>	
	</a>
	<!-- Reportes
	<a href="{{ url('adminoperador/reporte/pedidoMensajero') }}" class="row conteo btn-success" data-toggle="tooltip">
		<div id="tooltip">Reportes</div>
		<i class="fa fa-bar-chart"></i><br> <span class="cantidad">R</span>	
	</a>
	<!-- /.row -->
	
	
	
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"> Ordenes encontradas ( <span id="contadordinamico">{{ $conteoOrdenes }}</span> ) 
				<input type="hidden" name="lastordenid" id="lastordenid" value="{{ $lastOrdenID }}">
				<input type="hidden" name="idsucursal" id="idsucursal" value="{{ $idSucursal }}">
				<input type="hidden" name="cuentaid" id="cuentaid" value="{{ $cuentaID }}">
				<input type="hidden" name="rol" id="rol" value="adminoperador">
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
										<th class="active">Orden</th>
										<th class="active">Cliente</th>
										<th class="active">Identificacion</th>
										<th class="active">Direccion</th>
										<th class="active">Total</th>
									</tr>
								</thead>
								
								@if (empty($ordenes))
								<tbody>
									<tr>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
									</tr>
								</tbody>
								@else
								@foreach($ordenes as $orden)
									@if($orden->cuentaid == $cuentaID)
										@if($orden->sucursalid == $idSucursal)
											<tr class="{{ $orden->id }}" data-url="edit-orden" data-id="{{ $orden->id }}" data-ordenid="{{ $orden->ordenid }}">
												<td>
													<a href="#" id="itemOrden" class="itemOrden" name="{{$orden->id}}" data-ordenid="{{$orden->ordenid}}" data-nombreCliente="{{$orden->cliente}}" data-telefonoCliente="{{$orden->telefono}}" data-email="{{$orden->mail}}" data-identificacion="{{$orden->identificacion}}" data-tipo-documento="{{$orden->tip_iden}}" data-subtotal="{{$orden->subtotal}}" data-impuesto="{{$orden->impuesto}}" data-total="{{$orden->total}}" data-direccion="{{$orden->direccion.', '.$orden->ciudad.' '.$orden->pais}}">{{$orden->ordenid}}</a> 
													
													<!--<a href="#" id="eliminarOrden" class="eliminarOrden" data-id="{{ $orden->id }}" data-ordenid="{{ $orden->ordenid }}" style="font-weight:bold;float:right;position:relative;top:-3px;">&times;</a>-->
													
												</td>
												<td>{{$orden->cliente}}</td>
												
												<td>{{$orden->identificacion}}</td>
												
												
												<td class="td_direccion">
													{{$orden->direccion.', '.$orden->ciudad.' '.$orden->pais}}
												</td>
												
												
												<td>
													{{'$' . $orden->total}}
												</td>
												
											</tr>
										@endif
									@endif
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
		<div class="modal fade" id="tracking_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="margin-top:100px;z-index:1000000;">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel"><i class="fa  fa-check-square-o fa-2x"></i> Pedido confirmado</h4>
					</div>
					<div class="modal-body">
						<label class="h2-body">Código de seguimiento:</label><br/>
						<label id="tracking-id" class="h2-body" style="margin:0px auto;font-weight:bold;font-size:25px;color:#000;">000000</label>
					</div>
					<div class="modal-footer">
						<div class="col-md-12">
							<a href="#" id="verPedido" type="button" class="btn btn-default">Ver pedido</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	
	<!-- Modal -->
	<div id="modalAsignarOrden" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:800px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalAsignarOrden" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Asignar Orden</h4>
				</div>
				<form id="formAsignarOrden" action="ordenes" method="post">
					<div class="modal-body">
							<div id="map" style="width:100%;height:400px;"></div>
							
							
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="crearorder">
							
							<input type="hidden" id="clienteID" name="clienteID" value="-1">
							<input type="hidden" id="nombre" name="nombre" value="">
							<input type="hidden" id="nombre_cliente" name="nombre_cliente" value="">
							<input type="hidden" id="telefono_cliente" name="telefono_cliente" value="">
							<input type="hidden" id="tel" name="tel" value="">
							<input type="hidden" id="latitud" class="autoFillableLatitud" name="latitud" value="">
							<input type="hidden" id="longitud" class="autoFillableLongitud" name="longitud" value="">
							<input type="hidden" id="direccion_cliente" name="direccion_cliente" value="">
							<input type="hidden" id="direccionorigen" name="direccionorigen" value="">
							<input type="hidden" id="tipodocumento_cliente" name="tipodocumento_cliente" value="">
							<input type="hidden" id="identificacion_cliente" name="identificacion_cliente" value="">
							<input type="hidden" id="email_cliente" name="email_cliente" value="">
							
							<input type="hidden" id="new_order" name="new_order" value="">
							<input type="hidden" id="subtotal" name="subtotal" value="">
							<input type="hidden" id="impuesto" name="impuesto" value="">
							<input type="hidden" id="total" name="total" value="">
							
							<input type="hidden" id="mensajeroID" name="mensajeroID" value="">
							
							<input id="direccion" type="text" name="direccion" class="text direccion" value="" placeholder="Direcci&oacute;n">
							
					</div>
					<div class="modal-body" style="width:270px;background:;float:left;">
						<span class="dataTitle" style="display:none;font-weight:bold;font-size:20px;">Datos del cliente</span>
						<i class="fa fa-user" aria-hidden="true"></i> <span id="nombreCliente" style="font-weight:bold;color:#039BE5;" class="data">--</span><br/>
						<i class="fa fa-phone" aria-hidden="true"></i> <span id="telefonoCliente" style="font-weight:;font-size:;" class="data">--</span><br/>
						<i class="fa fa-indent" aria-hidden="true"></i> <span id="identificacion" style="font-weight:;font-size:;" class="data">--</span><br/>
					</div>
					<div class="modal-body" style="width:270px;background:;float:left;">
						<i class="fa fa-list" aria-hidden="true"></i> <span style="font-weight:bold;">Orden:</span> <span id="ordenid" class="data">--</span><br/>
						<span style="font-weight:bold;">Subtotal: $</span> <span id="subtotal" class="data">--</span><br/>
						<span style="font-weight:bold;">Impuesto: $</span> <span id="impuesto" class="data">--</span><br/>
						<span style="font-weight:bold;">Total: $</span> <span id="total" class="data">--</span><br/>
					</div>
					<div class="modal-body" style="width:250px;background:;float:left;">
						<i class="fa fa-motorcycle"></i> <span style="font-weight:bold;">Mensajero</span>
						<div id="selectMensajero" style="display:block;position:relative;overflow:auto;width:100%;height:100px;">
							@if (empty($mensajeros))
								
							@else
								@foreach($mensajeros as $mensajero)
									@if($mensajero->EstatusActual == 0)
										<a href="#" style="display:block;padding:3px;margin-bottom:3px;border-left: 5px solid #00FF40;font-weight:bold;box-sizing:border-box;" name="{{ $mensajero->id }}" data-mensajeroID="{{ $mensajero->id }}" data-estatus="0" title="Disponible">{{ $mensajero->nombreUsuario }}</a>
									@endif
								@endforeach
								@foreach($mensajeros as $mensajero)
									@if($mensajero->EstatusActual == 1)
										<a href="#" style="display:block;padding:3px;margin-bottom:3px;border-left: 5px solid #FF8000;font-weight:bold;box-sizing:border-box;" name="{{ $mensajero->id }}" data-mensajeroID="{{ $mensajero->id }}" data-estatus="1" title="Asignado">{{ $mensajero->nombreUsuario }}</a>
									@endif
								@endforeach
								@foreach($mensajeros as $mensajero)
									@if($mensajero->EstatusActual == 2)
										<span style="display:block;padding:3px;margin-bottom:3px;border-left: 5px solid #FF0000;font-weight:bold;box-sizing:border-box;color:#BDBDBD;" name="{{ $mensajero->id }}" data-mensajeroID="{{ $mensajero->id }}" data-estatus="2" title="Ocupado">{{ $mensajero->nombreUsuario }}</span>
									@endif
								@endforeach
								@foreach($mensajeros as $mensajero)
									@if($mensajero->EstatusActual == 3)
										<a href="#" style="display:block;padding:3px;margin-bottom:3px;border-left: 5px solid #01DFD7;font-weight:bold;box-sizing:border-box;" name="{{ $mensajero->id }}" data-mensajeroID="{{ $mensajero->id }}" data-estatus="3" title="Semi Disponible">{{ $mensajero->nombreUsuario }}</a>
									@endif
								@endforeach
							@endif
						</div>
					</div>
					<div class="modal-footer" style="background:;">
						<a id="CancelarAsignarOrden" type="button" class="btn btn-default" data-dismiss="modal">Cancelar</a>
						<a id="GuardarAsignarOrden" type="button" class="btn btn-success" data-dismiss="modal">Asignar</a>
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
		
		//$('#tracking_modal').modal('show');
		
		var tabledata = $('#tabla').DataTable({
			"dom": '<"top"f>rt<"bottom"p><"clear">',
			//"paging":   false,
			//"ordering": false,
			"info":     true
		});
		
		setInterval(function() {
			refreshOrdenes();
		}, 10000);
		
		
		//Search for new orders and add to the datatable
		function refreshOrdenes(){
			
			var dominio = document.domain;
			var asunto = 'searchnewoerders';
			
			var jqxhrd = $.post( "http://" + dominio + "/SmartDelivery/operador/takeorder",  
			{ 
				asunto: asunto
			}, function(data, status){
				if(status == "success"){
					var datos = data.data;
					//alert("Hello");
					var orden = "-";	
					var cliente = "-";	
					var direccion = "-";	
					var total = "-";
					
					var contador = 0;
					$.each(datos, function( index, value ) {
					  //alert( value['cliente'] );
						if(document.getElementById('cuentaid').value == value['cuentaid']){
							if(document.getElementById('idsucursal').value == value['sucursalid']){
								
								contador++;
								if(parseInt(document.getElementById('lastordenid').value) < parseInt(value['id'])){
							
									var orden = "<a href=\"#\" id=\"itemOrden\" class=\"itemOrden\" name=\"" + value['ordenid'] + "\" data-ordenid=\"" + value['ordenid'] + "\" data-nombreCliente=\"" + value['cliente'] + "\" data-telefonoCliente=\"" + value['telefono'] + "\" data-email=\"" + value['mail'] + "\" data-identificacion=\"" + value['identificacion'] + "\" data-tipo-documento=\"" + value['tip_iden'] + "\" data-subtotal=\"" + value['subtotal'] + "\" data-impuesto=\"" + value['impuesto'] + "\" data-total=\"" + value['total'] + "\" data-direccion=\"" + value['direccion'] + ", " + value['ciudad'] + " " + value['pais'] + "\">" + value['ordenid'] + "</a>";	
									var cliente = value['cliente'];	
									var identificacion = value['identificacion'];	
									var direccion = value['direccion'] + ", " + value['ciudad'] + " " + value['pais'];	
									var total = "$" + value['total'];
									
									tabledata.row.add( [
										orden,
										cliente,
										identificacion,
										direccion,
										total
									] ).draw( false );
									
									document.getElementById('lastordenid').value = value['id'];
							
								}
							}
						}
					});
					$('#contadordinamico').html(contador);
				}
				if(status == "error"){
					
				}
			});
		}
		
		//Functions modalAgregarSucursal
			$('#selectMensajero a').click(function(){
				event.preventDefault();
				$('#selectMensajero a').css({"background":"#FFF","color":"#039BE5"});
				$(this).css({"background":"#55B947","color":"#FFF"});
				document.getElementById('mensajeroID').value = $(this).attr('data-mensajeroID');
				
				return false;
			});
		//*****************************************/
			
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
		
		//Functions initmap
		function initMapOrdenes() {
			var dominio = document.domain;
			
			var longitud2 = -78.485989;
			var latitud2 = -0.191105;
			
			if($('#longitud').val()){
				if($('#longitud').val().length > 0){
					var longitud2 = parseFloat($('#longitud').val());
				}
			}
			if($('#latitud').val()){
				if($('#latitud').val().length > 0){
					var latitud2 = parseFloat($('#latitud').val());
				}
			}
			
			map = new google.maps.Map(document.getElementById('map'), {
				zoom: 16,
				center: {lat: latitud2, lng: longitud2}
			});
			
			var image = "http://" + dominio + "/SmartDelivery/public/assets/images/markers/red_MarkerA.png";
			var myLatLng = {lat: latitud2, lng: longitud2};
			var marker = new google.maps.Marker({
				position: myLatLng,
				draggable: true,
				animation: google.maps.Animation.DROP,
				map: map,
				icon: image,
				title: ''
			  });
			  
			deleteMarkers();
			markers.push(marker);
			setMapOnAll(map,latitud, longitud);
			  
			  addListerners();

		}
		
		//***************************************/
		
		//Functions modalAsignarOrden
			$(document).on('click', '.itemOrden',function () {
			//$('.itemOrden').click(function(){
				event.preventDefault();
				
				document.getElementById('clienteID').value = -1;
				
				$('#GuardarAsignarOrden').html("Asignar");
				$('#GuardarAsignarOrden').attr("disabled", false);
				
				//Fill all visual texts we need
				document.getElementById('direccionorigen').value = $(this).attr('data-direccion');
				document.getElementById('direccion').value = $(this).attr('data-direccion');
				document.getElementById('nombre').value = $(this).attr('data-nombreCliente');
				document.getElementById('tel').value = $(this).attr('data-telefonoCliente');
				document.getElementById('new_order').value = $(this).attr('data-ordenid');
				document.getElementById('subtotal').value = $(this).attr('data-subtotal');
				document.getElementById('impuesto').value = $(this).attr('data-impuesto');
				document.getElementById('total').value = $(this).attr('data-total');
				
				//Fill all hidden texts we need - I don't know the difference, but I'll try to fix it.
				document.getElementById('direccion_cliente').value = $(this).attr('data-direccion');
				document.getElementById('nombre_cliente').value = $(this).attr('data-nombrecliente');
				document.getElementById('telefono_cliente').value = $(this).attr('data-telefono');
				document.getElementById('email_cliente').value = $(this).attr('data-email');
				
				$('#selectMensajero a').css({"background":"#FFF","color":"#039BE5"});
				document.getElementById('mensajeroID').value = "";
				
				document.getElementById('tipodocumento_cliente').value = $(this).attr('data-tipo-documento');
				document.getElementById('identificacion_cliente').value = $(this).attr('data-identificacion');
				
				var direccion_cliente = $(this).attr('data-direccion');
				var nombre_cliente = $(this).attr('data-nombreCliente');
				var telefono_cliente = $(this).attr('data-telefonoCliente');
				var orden = $(this).attr('data-ordenid');
				var subtotal = $(this).attr('data-subtotal');
				var impuesto = $(this).attr('data-impuesto');
				var total = $(this).attr('data-total');
				var identificacion_cliente = $(this).attr('data-identificacion');
				
				$('#formAsignarOrden #nombreCliente').text($(this).attr('data-nombreCliente'));
				$('#formAsignarOrden #telefonoCliente').text($(this).attr('data-telefonocliente'));
				$('#formAsignarOrden #identificacion').text($(this).attr('data-identificacion'));
				$('#formAsignarOrden #subtotal').text($(this).attr('data-subtotal'));
				$('#formAsignarOrden #impuesto').text($(this).attr('data-impuesto'));
				$('#formAsignarOrden #total').text($(this).attr('data-total'));
				$('#formAsignarOrden #ordenid').text($(this).attr('data-ordenid'));
				
				$('#formAsignarOrden #direccion').val($(this).attr('data-direccion'));
				$('#modalAsignarOrden').fadeToggle('fast');
				initMap();
				// initMapOrdenes();
				
				
				//geocodeAddress(geocoder, map);
				
				searchPosition();
				//addListerners();
				
				return false;
			});
			$('#closeModalAsignarOrden, #CancelarAsignarOrden').click(function(){
				event.preventDefault();
				$('#modalAsignarOrden').fadeToggle('fast');
			});
			$('#GuardarAsignarOrden').click(function(){
				var direccion = $('#formAsignarOrden #direccion').val();
			
				
				if(direccion == ''){
					alert('No ha especificado una direccion');
					return false;
				}
			});
		//***************************************/
		
		//Functions modalEliminarSucursal
			$('.eliminarSucursal').click(function(){
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
		//***************************************/
		//***************************************/
		//***************************************/
		//***************************************/
		//***************************************/
		//***************************************/
		
		
		
		//Add clients into Clients
	function guardarClienteOrdenes(){
		var search = false;
		var dominio = document.domain;
		var asunto = 'crearcliente';
		//$('#guardarCliente')

		//var tel = document.getElementById('tel').value;
		var nombrecliente = document.getElementById('nombre').value;
		var telefonocliente = document.getElementById('tel').value;
		var direccioncliente = document.getElementById('direccion_cliente').value; 
		var direccionorigen = document.getElementById('direccionorigen').value; 
		var tipodocumento = document.getElementById('tipodocumento_cliente').value; 
		var identificacion = document.getElementById('identificacion_cliente').value; 
		var email = document.getElementById('email_cliente').value; 
		
		var jqxhrd = $.post( "http://" + dominio + "/SmartDelivery/operador/takeorder",  
		{ 
			asunto: asunto,
			nombre: nombrecliente,
			telefono: telefonocliente,
			tipo: tipodocumento,
			identificacion: identificacion,
			email: email,
			direccion: direccioncliente,
			direccionorigen: direccionorigen
		}, function(data, status){
			//var jsons = JSON.parse(data);
			if(status == "success"){
				$('#clienteID').val(data.id);
				//searchPosition();
				search = true;
				
				//$('#crear').hide();
				//$('#createClienteSuccess').modal('show');
			}
		});
		geocodeAddress(geocoder, map);
		addListerners();
		
		if(search == true){
			//searchPosition();
		}
	}
	
	$('#reload-btn').click( function() {
		
		var dominio = document.domain;
		
		window.location.replace("http://" + dominio + "/SmartDelivery/operador");
	});
		
		
//******************************************************************************************************************************/





	function searchPosition() {
	
		var dominio = document.domain;
		var guardar = false;
		
		$('#search').html("\<i class='fa fa-spinner fa-spin'\>\</i\>  buscando");


			var telNumber = document.getElementById('tel').value;
			var xhr = new XMLHttpRequest();
			xhr.open("POST" , "http://" + dominio + "/SmartDelivery/api/v1/cliente/"+telNumber, true);
			xhr.setRequestHeader('token', 'A');
			xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');

				// send the collected data as JSON
				xhr.send(JSON.stringify(telNumber));
				xhr.onreadystatechange = function() {
					if (xhr.readyState == 4 && xhr.status == 200) {
						
						var json = JSON.parse(xhr.responseText);
						
						if(json.posts[0].data == "not found"){
							document.getElementById('clienteID').value = -1;
							deleteMarkers();
							
							//Here is where add a client instead of show any modal
							//$('#myModal').modal('show');
							//guardarCliente();
							guardarClienteOrdenes();
							//guardar = true;
							return;
						}
						
						document.getElementById('clienteID').value = json.posts[1].values[0].clienteID;
						
						if(json.posts[1].values[0].direccion.length > 5){
							document.getElementById('direccion').value = json.posts[1].values[0].direccion;
						}
						document.getElementById('nombre').value = json.posts[1].values[0].nombreCliente;
						
						
						var latitud = json.posts[1].values[0].latitud;
						var longitud = json.posts[1].values[0].longitud;
						
						var image = "http://" + dominio + "/SmartDelivery/public/assets/images/markers/";
						var isDraggable;
						
						if(json.posts[1].values[0].posicionDefinitiva == 0) {
							image += "red_MarkerA.png";
							isDraggable = true;
						}
						else {
							image += "darkgreen_MarkerA.png";
							isDraggable = false;
						}
						
						var center = new google.maps.LatLng(latitud, longitud);
						marker = new google.maps.Marker({
							map: map,
							draggable: isDraggable,
							animation: google.maps.Animation.DROP,
							position: center,
							icon: image
						});
						
						deleteMarkers();
						markers.push(marker);
						setMapOnAll(map,latitud, longitud);
						addListerners();

						console.log(json);
					}
					else if (xhr.readyState == 4 && xhr.status == 500) {
						//$('#myModal').modal('show');
						//$('#search').html("buscar");
						
						/*
							document.getElementById('calle').value = "";
							document.getElementById('sector').value = "";
							document.getElementById('ciudad').value = "";
							document.getElementById('pais').value = "";
						*/
					} 
					
					else {
						//$('#search').html("buscar");
						/*
							document.getElementById('calle').value = "";
							document.getElementById('sector').value = "";
							document.getElementById('ciudad').value = "";
							document.getElementById('pais').value = "";
						*/
						console.log("error");
					}
				}
				
				//Si es necesario guardar entonces guardamos datos del cliente
				/*if(guardar == true){
					guardarCliente();
				}*/
	}
		
		
	});
</script>

