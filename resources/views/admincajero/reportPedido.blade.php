@extends('admincajero.template.template')
@section('page-title')
	 Reportes de Pedidos
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
	@if (empty($pedidos))
		
	@else
		@foreach($pedidos as $pedido)
			@if($pedido->estadoPedidoID == 2)
				<?php $conteoPedidos++; ?>
			@endif
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
								<a href="../dashboard"><i class="fa fa-home"></i> Admin</a> >> <a href="#">Reporte de Pedidos</a>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
						
					</div>
				
			</div> 
			<!-- /.panel -->
		</div>
	</div>
	<!-- Sucursales -->
	<a href="{{ url('admincajero/sucursal') }}" class="row conteo btn-primary" style="margin-left:10px;" data-toggle="tooltip">
		<div id="tooltip">Sucursales</div>
		<i class="fa fa-building-o"></i><br> <span class="cantidad">{{ $conteoSucursales }}</span>	
	</a>
	<!-- Operadores -->
	<a href="{{ url('admincajero/usuario') }}" class="row conteo btn-primary" data-toggle="tooltip">
		<div id="tooltip">Operadores</div>
		<i class="fa fa-user"></i><br> <span class="cantidad">{{ $conteoUsuarios }}</span>	
	</a>
	<!-- Mensajeros -->
	<a href="{{ url('admincajero/mensajero') }}" class="row conteo btn-primary" data-toggle="tooltip">
		<div id="tooltip">Mensajeros</div>
		<i class="fa fa-motorcycle"></i><br> <span class="cantidad">{{ $conteoMensajeros }}</span>	
	</a>
	<!-- Pedidos -->
	<a href="{{ url('admincajero/pedido') }}" class="row conteo btn-warning" data-toggle="tooltip">
		<div id="tooltip">Pedidos</div>
		<i class="fa fa-list-ul"></i><br> <span class="cantidad">{{ $conteoPedidos }}</span>	
	</a>
	<!-- Reportes -->
	<a href="{{ url('admincajero/reporte/pedidoMensajero') }}" class="row conteo btn-success" data-toggle="tooltip">
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
					<div class="panel-body" style="position:relative;">
                        @if (Session::has('message_create'))
                            <div class=" {{ Session::get('alert_class') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('message_create') }}
                            </div>
                        @endif
						
						<form method="post" action="pedido" style="position:absolute;left:15px;top:0px;z-index:10000;">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="buscarPedidos">
							<?php
								//$desde = date('Y-m-d', strtotime( '-1 days' ));
								$desde = date('Y-m-d');
								$hasta = date('Y-m-d', strtotime( '+1 days' ));
							?>
							@if(isset($_POST['desde']))
								<?php $desde = $_POST['desde']; ?>							
							@elseif(isset($_GET['desde']))
								<?php $desde = $_GET['desde']; ?>							
							@endif
							@if(isset($_POST['hasta']))
								<?php $hasta = $_POST['hasta']; ?>
							@elseif(isset($_GET['hasta']))
								<?php $hasta = $_GET['hasta']; ?>
							@endif
							<input id="desde" type="date" name="desde" value="{{ $desde }}" style="max-width:150px;" placeholder="Desde">
							<input id="hasta" type="date" name="hasta" value="{{ $hasta }}" style="max-width:150px;" placeholder="Hasta">
							<input type="submit" id="buscarPedidos" type="button" value="search" class="btn btn-success" data-dismiss="modal">
							
						</form>
						
						<div class="list-group">
							<table id="tablaReportePedidoMensajero" class="display" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th class="active">Pedido</th>
										<th class="active">Cliente</th>
										<th class="active">Identificacion</th>
										<th class="active">Hora Inicial</th>
										<th class="active">Hora Final</th>
										<th class="active">Tiempo</th>
										<th class="active">Foto</th>
										<th class="active">Firma</th>
									</tr>
								</thead>
								<?php $tiempoPromedioCalculoMasAlto = 0; ?>
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
											$trackingID = '-';
											$nombreCliente = '-';
											$identificacion = '-';
											$subtotal = '-';
											$impuesto = '-';
											$total = '-';
											$direccioncliente = '-';
											$mensajeronombre = '-';
											$sucursalnombre = '-';
										?>
										@foreach($clientes as $cliente)
											@if($pedido->clienteID == $cliente->id)
												<?php 
													$trackingID = $pedido->tracking_id;
													$nombreCliente = $cliente->nombreCliente;
													$identificacion = $cliente->identificacion;
													$subtotal = $pedido->subtotal;
													$impuesto = $pedido->impuesto;
													$total = $pedido->total;
												?>
											@endif
										@endforeach
										@foreach($direcciones as $direccion)
											@if($pedido->clienteID == $direccion->clienteID)
												<?php 
													$direccioncliente = $direccion->direccionOrigen;
												?>
											@endif
										@endforeach
										@foreach($sucursales as $sucursal)
											@if($pedido->localidadID == $sucursal->id)
												<?php 
													$sucursalnombre = $sucursal->nombreLocalidad;
												?>
											@endif
										@endforeach
										@foreach($mensajeros as $mensajero)
											@if($pedido->usuarioID == $mensajero->id)
												<?php 
													$mensajeronombre = $mensajero->nombreUsuario;
												?>
											@endif
										@endforeach
										
										
										
										<?php $conteoPedidoMensajero = 0; ?>
										<?php $conteoPedidoTiempo = 0; ?>
										<?php $conteoPedidoAtrasado = 0; ?>
										<?php $tiempoPromedioCalculo = 0; ?>
										<?php $tiempoPromedio = ''; ?>
										<?php 
											$tiempoPromedioSegundos = 0;
											$tiempoPromedioMinutos = 0;
											$tiempoPromedioHoras = 0;
										?>
										
											
											
													
														<?php $conteoPedidoMensajero++; ?>
														<?php
															//**************************
															$fechaInicial=$pedido->created_at;
															$fechaFinal=$pedido->updated_at;
															$fechaCreated=$pedido->timeCreated;
															
															
															/***********************************/
															$dateString = preg_replace("/\([^)]+\)/","",$fechaCreated);
															//now, get your date object
															$date = new DateTime($dateString);
															$segundosFechaCreated = strtotime($date->format('Y-m-d H:i:s'));
															/***********************************/
															
															$segundos=strtotime($fechaFinal) - strtotime($fechaInicial);
															//Hora Inicial de cada pedido
															$fechaCreated = date("Y-m-d H:i:s", $segundosFechaCreated);
															//Hora Final de cada pedido
															$fechaUpdated = date("Y-m-d H:i:s", ($segundosFechaCreated + $segundos));
															
															
															
															 
															
															
															$diferencia_segundos=intval($segundos);
															$diferencia_minutos=intval($segundos/60);
															$diferencia_horas=intval($segundos/60/60);
															$diferencia_dias=intval($segundos/60/60/24);
															//echo "<b>".$diferencia_minutos."</b><br/>";
															
															if($diferencia_minutos < 30){
																$conteoPedidoTiempo ++;
															}else{
																$conteoPedidoAtrasado ++;
															}
															$tiempoPromedioCalculo += $diferencia_segundos;
														?>	
													
												
											
										<?php 
											if($conteoPedidoMensajero > 0){
												$tiempoPromedioSegundos = intval($tiempoPromedioCalculo/$conteoPedidoMensajero);
												$tiempoPromedioMinutos = intval($tiempoPromedioSegundos/60);
												$tiempoPromedioHoras = intval($tiempoPromedioSegundos/60/60);
												
												$tiempoPromedioMinSalida = intval($tiempoPromedioMinutos - ($tiempoPromedioHoras*60));
												$tiempoPromedioSegSalida = intval($tiempoPromedioSegundos - ($tiempoPromedioMinutos*60));
												
												$tiempoPromedio = ($tiempoPromedioHoras != 0) ? $tiempoPromedioHoras . ':' : '0:';
												$tiempoPromedio .= ($tiempoPromedioMinSalida <= 9) ? '0' . $tiempoPromedioMinSalida . ':' : $tiempoPromedioMinSalida . ':';
												$tiempoPromedio .= ($tiempoPromedioSegSalida <= 9) ? '0' . $tiempoPromedioSegSalida : $tiempoPromedioSegSalida;
												
												if($tiempoPromedioCalculoMasAlto < $tiempoPromedioCalculo){
													$tiempoPromedioCalculoMasAlto = $tiempoPromedioCalculo;
												}
											}
										?>
									<tr>
										<td>
											<a href="#" id="itemPedido" class="itemPedido" 
											data-nombrecliente="{{$nombreCliente}}" 
											data-direccion="{{$direccioncliente}}" 
											data-impuesto="{{$impuesto}}" 
											data-subtotal="{{$subtotal}}" 
											data-total="{{$total}}" 
											data-orden="{{$pedido->orden}}" 
											data-tiempo="{{$tiempoPromedio}}" 
											data-mensajero="{{$mensajeronombre}}" 
											data-sucursal="{{$sucursalnombre}}">{{$pedido->orden}}</a> 
										</td>
										<!--Cliente-->
										<td>{{$nombreCliente}}</td>
										<!--Identificacion-->
										<td>{{$identificacion}}</td>
										
										<td>{{$fechaCreated}}</td>
										
										<!--Cantidad de pedidos a tiempo-->
										<td>{{ $fechaUpdated }}</td>
										
										<!--Tiempo promedio-->
										@if($tiempoPromedioMinutos < 15)
											<td style="font-weight:bold;color:green;">{{ $tiempoPromedio }}</td>
										@elseif($tiempoPromedioMinutos < 30)
											<td style="font-weight:bold;color:#FF8000;">{{ $tiempoPromedio }}</td>
										@else
											<td style="font-weight:bold;color:red;">{{ $tiempoPromedio }}</td>
										@endif
										
										<td>
										<?php 
											$image_path = $pedido->image_path;
										?>
											@if(!File::exists(public_path($image_path)))
												<a class="showImage" href="{{ url($image_path) }}" title="{{$nombreCliente}}"><i class="fa fa-file-image-o" aria-hidden="true"></i></a>
											@endif
										</td>
										<td>
										<?php 
											$rubrica_path = $pedido->signature_path;
										?>
											@if(!File::exists(public_path($rubrica_path)))
												<a class="showRubrica" href="{{ url($rubrica_path) }}" title="{{$nombreCliente}}"><img src="{{ asset($rubrica_path) }}" width="35px"></a>
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

	

	<div id="modalDetallePedido" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:510px;">
			<div class="modal-content">
				<div class="modal-header">
					<button id="closeModalDetallePedido" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil-square-o"></i> Detalles de Pedido</h4>
				</div>
				
					
					<div class="modal-body" style="width:500px;background:;float:left;">
						<span class="dataTitle" style="display:none;font-weight:bold;font-size:20px;">Datos del cliente</span>
						<i class="fa fa-user" aria-hidden="true"></i> <span id="nombreCliente" style="font-weight:bold;color:#039BE5;" class="data">--</span><br/>
						
						<i class="fa fa-map-marker" aria-hidden="true"></i> <span id="identificacion" style="font-weight:;font-size:;" class="data">--</span><br/>
					</div>
					<div class="modal-body" style="width:250px;background:;float:left;">
						<i class="fa fa-list" aria-hidden="true"></i> <span style="font-weight:bold;"></span> <span id="ordenid" class="data">--</span><br/>
						<span style="font-weight:bold;">Subtotal: $</span> <span id="subtotal" class="data">--</span><br/>
						<span style="font-weight:bold;">Impuesto: $</span> <span id="impuesto" class="data">--</span><br/>
						<span style="font-weight:bold;">Total: $</span> <span id="total" class="data">--</span><br/>
						
					</div>
					<div class="modal-body" style="width:250px;background:;float:left;">
						
						<span style="font-weight:bold;">Sucursal: </span> <span id="sucursalnombre" class="data">--</span><br/>
						<span style="font-weight:bold;">Mensajero: </span> <span id="mensajeronombre" class="data">--</span><br/>
						<br/>
						<span style="font-weight:bold;">Completado en </span> <span id="tiempo" class="data">--</span><br/>
					</div>
					<div class="modal-footer" style="background:;">
						<a id="CancelarDetallePedido" type="button" class="btn btn-default" data-dismiss="modal">Aceptar</a>
					</div>
				
			</div>
		</div>
	</div>
	
	<div id="modalImagenDisplay" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;width:510px;">
			<div class="modal-content">
				<button id="closeModalImagenDisplay" type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:5px;margin-right:10px;"><span aria-hidden="true">&times;</span></button>
					
				<div class="modal-body" style="width:500px;background:;float:left;">
					<img id="imagenDisplay" src="" width="100%">
				</div>
				<div class="modal-footer" style="background:;">
					
				</div>
			</div>
		</div>
	</div>

@stop

@section('custom-js')
		<!-- dataTables core JQuery -->
	<script type="text/javascript" src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
	<script src="{{ asset('public/assets/js/takeorder.js') }}"></script>
	
@stop
<script type="text/javascript" src="{{ asset('public/assets/js/jquery-2.2.2.js') }}"></script>
<script>
	$(document).ready(function(){
		var tiempoPromedioCalculoMasAlto = 0;
		$(".porcentaje").each(function(index){	
			var tiempoPromedio = parseFloat($(this).attr('data-tiempoPromedio'));
			if(tiempoPromedioCalculoMasAlto < tiempoPromedio){
				tiempoPromedioCalculoMasAlto = parseFloat(tiempoPromedio);
			}
		});
		$(".porcentaje").each(function(index){	
			var porcentaje = parseFloat($(this).attr('data-tiempoPromedio')) / (tiempoPromedioCalculoMasAlto / 100)
			$(this).text(parseInt(porcentaje) + '%');
			if(porcentaje < 1){
				porcentaje = 1;
			}
			$(this).css('width',porcentaje + '%');
		});
		
		
		$('#tablaReportePedidoMensajero').DataTable({
			"dom": '<"top"f>rt<"bottom"p><"clear">',
			//"paging":   false,
			//"ordering": false,
			"info":     true
		});
		
		$(document).on('click', '.itemPedido',function () {
			//$('.itemOrden').click(function(){
				event.preventDefault();
				
				
				//Fill all visual texts we need
				$('#nombreCliente').text($(this).attr('data-nombrecliente'));
				//$('#telefonoCliente').text($(this).attr('data-telefonocliente'));
				$('#identificacion').text($(this).attr('data-direccion'));
				$('#subtotal').text($(this).attr('data-subtotal'));
				$('#impuesto').text($(this).attr('data-impuesto'));
				$('#total').text($(this).attr('data-total'));
				$('#tiempo').text($(this).attr('data-tiempo'));
				$('#ordenid').text($(this).attr('data-orden'));
				$('#mensajeronombre').text($(this).attr('data-mensajero'));
				$('#sucursalnombre').text($(this).attr('data-sucursal'));
				
				$('#modalDetallePedido').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalDetallePedido, #CancelarDetallePedido').click(function(){
				event.preventDefault();
				$('#modalDetallePedido').fadeToggle('fast');
			});
		//***************************************/
		
		$(document).on('click', '.showImage',function () {
				event.preventDefault();
				$('#imagenDisplay').attr('src','');
				
				$('#modalImagenDisplay .modal-footer').html($(this).attr('title'));
				$('#imagenDisplay').attr('src',$(this).attr('href'));
				
				$('#modalImagenDisplay').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalImagenDisplay, #CancelarImagenDisplay').click(function(){
				event.preventDefault();
				$('#modalImagenDisplay').fadeOut('fast');
			});
			$('html').click(function() {
				$('#modalImagenDisplay').fadeOut('fast');
			});
			$('#modalImagenDisplay .modal-content').click(function(event){
				return false;
			});
		//***************************************/
		
		$(document).on('click', '.showRubrica',function () {
				event.preventDefault();
				$('#imagenDisplay').attr('src','');
				
				$('#modalImagenDisplay .modal-footer').html($(this).attr('title'));
				$('#imagenDisplay').attr('src',$(this).attr('href'));
				
				$('#modalImagenDisplay').fadeToggle('fast');
				
				return false;
			});
			$('#closeModalImagenDisplay, #CancelarImagenDisplay').click(function(){
				event.preventDefault();
				$('#modalImagenDisplay').fadeOut('fast');
			});
			$('html').click(function() {
				$('#modalImagenDisplay').fadeOut('fast');
			});
			$('#modalImagenDisplay .modal-content').click(function(event){
				return false;
			});
		//***************************************/
	});
</script>

