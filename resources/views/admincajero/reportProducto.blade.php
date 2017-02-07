@extends('admincajero.template.template')
@section('page-title')
	 Reportes de productos
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
		
		.btn_excel a{
			
			float:right;
			
			
			position: relative;
			display: inline-block;
			box-sizing: border-box;
			
			
			border: 1px solid #999;
			border-radius: 2px;
			cursor: pointer;
			font-size: 0.88em;
			color: black;
			white-space: nowrap;
			overflow: hidden;
			background-color: #e9e9e9;
			background-image: -webkit-linear-gradient(top, #fff 0%, #e9e9e9 100%);
			background-image: -moz-linear-gradient(top, #fff 0%, #e9e9e9 100%);
			background-image: -ms-linear-gradient(top, #fff 0%, #e9e9e9 100%);
			background-image: -o-linear-gradient(top, #fff 0%, #e9e9e9 100%);
			background-image: linear-gradient(to bottom, #fff 0%, #e9e9e9 100%);
			filter: progid:DXImageTransform.Microsoft.gradient(GradientType=0,StartColorStr='white', EndColorStr='#e9e9e9');
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
			text-decoration: none;
			outline: none;
		}
		
		.btn_excel .dt-buttons a {
			display:block;
			padding:10px;
			height:35px;
			margin-left:20px;
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
		//Generando un conteo de los pedidos
		//*************************************
		$conteoFacturas = 0;
	?>
	@if (empty($productos))
		
	@else
		@foreach($productos as $producto)
			
				<?php $conteoFacturas++; ?>
			
		@endforeach
	@endif
	
	
	
	
	
	
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
								<a href="../dashboard"><i class="fa fa-home"></i> Admin</a> >> <a href="#">Reporte de productos</a>
							</div><!-- /input-group -->
						</div><!-- /.col-lg-6 -->
						
					</div>
				
			</div> 
			<!-- /.panel -->
		</div>
	</div>
	

	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<!-- Default panel contents -->
				<div class="panel-heading"> Productos encontradas ( {{ $conteoFacturas }} ) </div>
				<div class="panel-body">
					<div class="panel-body" style="position:relative;">
                        @if (Session::has('message_create'))
                            <div class=" {{ Session::get('alert_class') }}">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                {{ Session::get('message_create') }}
                            </div>
                        @endif
						
						<form method="post" action="producto" style="display:;position:absolute;left:15px;top:0px;z-index:10000;">
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
										
										<th class="active">Producto</th>
										<th class="active">Cantidad</th>
										<th class="active">Valor</th>
										<th class="active">Subtotal</th>
										
									</tr>
								</thead>
								<?php $tiempoPromedioCalculoMasAlto = 0; ?>
								@if (empty($productos))
								<tbody>
									<tr>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										<td>-</td>
										
									</tr>
								</tbody>
								@else
									@foreach($productos as $producto)
										<?php
											$nombreProducto = $producto->nombreProducto;
											
											$cantidad = $producto->cantidad;
											$valor = $producto->costoProducto;
											$subtotal = $producto->total;
											
										?>
										
										
										
										
									<tr>
										<td>{{ $nombreProducto }}</td>
										<td>
											{{ $cantidad }}
										</td>
										
										
										<td align="right">{{$valor}}</td>
										
										
										
										
										
											<td> {{$subtotal}} </td>
									</tr>
									@endforeach
								@endif
							</table>
							
							<style>
								.pagination {
									
									float:right;
								}
								
								.pagination .active span {
									color: #333 !important;
									border: 1px solid #979797;
									background-color: white;
									background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #fff), color-stop(100%, #dcdcdc));
									background: -webkit-linear-gradient(top, #fff 0%, #dcdcdc 100%);
									background: -moz-linear-gradient(top, #fff 0%, #dcdcdc 100%);
									background: -ms-linear-gradient(top, #fff 0%, #dcdcdc 100%);
									background: -o-linear-gradient(top, #fff 0%, #dcdcdc 100%);
									background: linear-gradient(to bottom, #fff 0%, #dcdcdc 100%);
								}
								
								.pagination li a:hover {
									color: white !important;
									border: 1px solid #111;
									background-color: #585858;
									background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #585858), color-stop(100%, #111));
									background: -webkit-linear-gradient(top, #585858 0%, #111 100%);
									background: -moz-linear-gradient(top, #585858 0%, #111 100%);
									background: -ms-linear-gradient(top, #585858 0%, #111 100%);
									background: -o-linear-gradient(top, #585858 0%, #111 100%);
									background: linear-gradient(to bottom, #585858 0%, #111 100%);
								}
								
								.pagination .disabled span {
									padding:0px;
									background-color: #fff;
									border: 0px;
									cursor: text !important;
								}
							</style>
							
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
	
	
	
	<!-- Modal -->
	<div id="modalMemorySize" style="display:none;position:absolute;top:0px;left:0px;width:100%;height:100%;background:rgba(0,0,0,0.7);box-sizing:border-box;z-index:1000000;">
		<div class="modal-dialog" role="document" style="margin:0px auto;margin-top:100px;">
			<div class="modal-content">
				<div class="modal-header">
					<button  id="closeModalMemorySize" type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle fa-2x"></i> Uso de memoria </h4>
				</div>
				<form id="formMemorySize" action="sucursal" method="post">
					<div class="modal-body">
							{{ 'Memoria usada: ' . round(memory_get_usage() / 1024,1) . ' KB de ' . round(memory_get_usage(1) / 1024,1) . ' KB' }}
					</div>
					<div class="modal-footer">
						<a id="CancelarMemorySize" type="button" class="btn btn-default" data-dismiss="modal">Aceptar</a>
						
					</div>
				</form>
			</div>
		</div>
	</div>
@stop

@section('custom-js')
		<!-- dataTables core JQuery -->
	<script type="text/javascript" src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.2.1/js/dataTables.buttons.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.2.1/js/buttons.html5.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.2.1/js/buttons.flash.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/jszip/dist/jszip.js') }}"></script>
	<script src="{{ asset('public/assets/js/takeorder.js') }}"></script>
	
@stop
<script type="text/javascript" src="{{ asset('public/assets/js/jquery-2.2.2.js') }}"></script>
<script>
	$(document).ready(function(){
		
		$('.pagination li a').each(function(index){
			str = $(this).attr('href');
			inputget = "&" + "desde=" + $("#desde").val() + "&" + "hasta=" + $("#hasta").val();
			href= str+inputget;
			$(this).attr('href',href);
		});
		
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
		
		
		var table = $('#tablaReportePedidoMensajero').DataTable({
			"dom": '<"btn_excel"B><"top"f>rt<"bottom"p><"clear">',
			"paging":   true,
			// "scrollY":  "410px",
			// "scrollCollapse": true,
			//"ordering": false,
			"info":     true,
			"buttons": [
				'excel',
				{
					extend: 'print',
					//message: 'This print was produced using the Print button for DataTables',
					//autoPrint: true
					customize: function ( win ) {
						$(win.document.body)
							.css( 'font-size', '11px' )
							.prepend(
								'<img src="http://localhost/SmartDeliveryC/public/assets/images/ic_launcher.png" style="opacity:0.1;position:absolute; top:0; left:0;transform:rotate(-30deg);webkit-transform:rotate(-30deg);mos-transform:rotate(-30deg);ms-transform:rotate(-30deg);" />'
							);
 
						$(win.document.body).find( 'table' )
							.addClass( 'compact' )
							.css( 'font-size', 'inherit' );
							
						$(win.document.body).find( 'h1' )
							.replaceWith('<div id="headerdiv"></div>');
						
						var header = $('#datosSesion').html();
						
						$(win.document.body).find( '#headerdiv' )
							.addClass( 'compact2' )
							.css( 'font-size', '20px' )
							.html( header );
					}
				}
			]
		});
		
		/*$('<div class="btn_excel"><div class="dt-buttons"><a href="#">Imprimir</a></div></div>')
        .prependTo( '#tablaReportePedidoMensajero_wrapper' )
        .on( 'click', function () {
            
			event.preventDefault();
				function imprSelec(id) {
					var div, imp, Order_box_width;
					Order_box_width = $(id).width();
					div = $(id).html();//seleccionamos el objeto
					imp = window.open(" ","Formato de Impresion"); //damos un titulo
					imp.document.open();					//abrimos
					var style = '';
					$('style').each(function(index,element){
						style = style + $(element).text();
					});
					imp.document.write('<style>' + style + '</style>'); //tambien podriamos agregarle un <link ...
					imp.document.write("<style>"); 
					imp.document.write(".top {display:none;} "); 
					imp.document.write(".bottom {display:none;} "); 
					imp.document.write(".btn_excel {display:none;} "); 
					imp.document.write("tr th{border-bottom:1px solid #000;} "); 
					imp.document.write("tr th:nth-child(3) {display:none;} "); 
					imp.document.write("tr td:nth-child(3) {display:none;} "); 
					imp.document.write("tr th:nth-child(5) {display:none;} "); 
					imp.document.write("tr td:nth-child(5) {display:none;} ");  
					imp.document.write("tr th:nth-child(6) {display:none;} "); 
					imp.document.write("tr td:nth-child(6) {display:none;} "); 
					imp.document.write("</style>"); 
					imp.document.write(div);//agregamos el objeto;
					//imp.document.write("<div style=\" display:block;width:100%; \">Efectivo </div>");//agregamos el objeto;
					//imp.document.write("<div style=\" display:block;width:100%; \">Credito </div>");//agregamos el objeto;
					//imp.document.write("<div style=\" display:block;width:100%; \">Tarjeta </div>");//agregamos el objeto;
					imp.document.close();
					imp.print();   //Abrimos la opcion de imprimir
					imp.close(); //cerramos la ventana nueva
				}
				imprSelec('#tablaReportePedidoMensajero_wrapper');
				return false;
			
        } );*/
		
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
		
		
		//***************************************/
		$(window).keydown(function(event) {
			
			if(event.which == 113) { //F2
				
				$('#modalMemorySize').fadeIn('fast');
				
				
				return false;
			}
			else if(event.which == 27) { //ESC
				//resetView();
				$('#modalMemorySize').fadeOut('fast');
				return false;
			}
		});
		//***************************************/
	});
</script>

