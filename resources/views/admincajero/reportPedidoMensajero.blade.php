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
								<a href="../dashboard"><i class="fa fa-home"></i> Admin</a> >> <a href="#">Pedidos x Mensajero</a>
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
				<div class="panel-heading"> Pedidos encontrados ( {{ $conteoPedidos }} ) </div>
				<div class="panel-body">
					<div class="panel-body" style="position:relative;">
                        @if (Session::has('message_create'))
                            <div class=" {{ Session::get('alert_class') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('message_create') }}
                            </div>
                        @endif
						
						<form method="post" action="pedidoMensajero" style="position:absolute;left:15px;top:0px;z-index:10000;">
							<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<input type="hidden" name="asunto" value="buscarPedidos">
							<?php
								//$desde = date('Y-m-d', strtotime( '-1 days' ));
								$desde = date('Y-m-d');
								$hasta = date('Y-m-d', strtotime( '+1 days' ));
							?>
							@if(isset($_POST['desde']))
								<?php $desde = $_POST['desde']; ?>							
							@endif
							@if(isset($_POST['hasta']))
								<?php $hasta = $_POST['hasta']; ?>
							@endif
							
							<input id="desde" type="date" name="desde" value="{{ $desde }}"  style="max-width:150px;" placeholder="Desde">
							<input id="hasta" type="date" name="hasta" value="{{ $hasta }}"  style="max-width:150px;" placeholder="Hasta">
							
							<!--
							<div class="input-group input-daterange">
								<input type="text" name="desde" class="form-control" value="{{ $desde }}">
								<span class="input-group-addon">Hasta</span>
								<input type="text" name="hasta" class="form-control" value="{{ $hasta }}">
							</div>
							-->
							<input type="submit" id="buscarPedidos" type="button" value="search" class="btn btn-success" data-dismiss="modal">
							
						</form>
						
						<div class="list-group">
							<table id="tablaReportePedidoMensajero" class="display" cellspacing="0" width="100%">
								<thead>
									<tr>
										<th class="active">Mensajero</th>
										<th class="active">Cant. Pedidos</th>
										<th class="active">Cant. a Tiempo</th>
										<th class="active">Cant. Sobre Tiempo</th>
										<th class="active">Tiempo Promedio</th>
										<th class="active"></th>
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
									</tr>
								</tbody>
								@else
									@foreach($mensajeros as $mensajero)
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
										
											@foreach($pedidos as $pedido)
												@if($mensajero->id == $pedido->usuarioID)
													@if($pedido->estadoPedidoID == 2)
														<?php $conteoPedidoMensajero++; ?>
														<?php
															//**************************
															$fechaInicial=$pedido->created_at;
															$fechaFinal=$pedido->updated_at;
															$segundos=strtotime($fechaFinal) - strtotime($fechaInicial);
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
													@endif
												@endif
											@endforeach
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
											<a href="{{ url('admincajero/reporte/pedidoMensajeroDetalle/'.$mensajero->id.'?desde='.$desde.'&hasta='.$hasta) }}" id="itemMensajero" name="{{$mensajero->id}}">{{$mensajero->nombreUsuario}}</a> 
										</td>
										<td>{{$conteoPedidoMensajero}}</td>
										
										<!--Cantidad de pedidos a tiempo-->
										<td style="font-weight:bold;color:green;">{{ number_format($conteoPedidoTiempo,0) }}</td>
										
										<!--Cantidad de pedidos fuera de tiempo-->
										<td style="font-weight:bold;color:red;">{{ number_format($conteoPedidoAtrasado,0) }}</td>
										
										<!--Tiempo promedio-->
										@if($tiempoPromedioMinutos < 15)
											<td style="font-weight:bold;color:green;">{{ $tiempoPromedio }}</td>
										@elseif($tiempoPromedioMinutos < 30)
											<td style="font-weight:bold;color:#FF8000;">{{ $tiempoPromedio }}</td>
										@else
											<td style="font-weight:bold;color:red;">{{ $tiempoPromedio }}</td>
										@endif
										
										<!--Porcentaje de tiempo promedio en barra-->
										@if($tiempoPromedioMinutos < 15)
											<td><div style="font-weight:bold;color:transparent;width:130px;"><div class="porcentaje" data-tiempoPromedio="{{ $tiempoPromedioSegundos }}" style="background:green;">&nbsp;</div></div></td>
										@elseif($tiempoPromedioMinutos < 30)
											<td><div style="font-weight:bold;color:transparent;width:130px;"><div class="porcentaje" data-tiempoPromedio="{{ $tiempoPromedioSegundos }}" style="background:#FF8000;">&nbsp;</div></div></td>
										@else
											<td><div style="font-weight:bold;color:transparent;width:130px;"><div class="porcentaje" data-tiempoPromedio="{{ $tiempoPromedioSegundos }}" style="background:red;">&nbsp;</div></div></td>
										@endif
										
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
		/*
		$('.input-daterange input').each(function() {
			$(this).datepicker("clearDates");
		});
		*/
		
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
		
		
		//***************************************/
	});
</script>

