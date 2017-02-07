@extends('cliente.template.template')
<style>

    html, body {
        height: 100%;
        margin: 0;
        padding: 0;
    }
    #map {
        height: 600px;
    }
    .container {
        padding: 0 16 16 0;
    }
    .text
    {
		font-size: 30px;
    }
    .center
    {
    	text-align: center;
    }
</style>
@section('page-title')
	Ver Pedido
@stop


@section('body')





	<?php
		//Campos que seran llenados para cargar la data del pedido del cliente 
		//$tracking_id;
		
		$latLocalidad = '-0.191109';
		$lngLocalidad = '-78.486048';
	?>
	@foreach($pedidos as $pedido)
		<?php //$tracking_id = $pedido->tracking_id; ?>
		<input name="tracking_id" id="tracking_id" type="hidden" value="{{$pedido->tracking_id}}">
		<input name="clienteID" id="clienteID" type="hidden" value="{{$pedido->clienteID}}">
		<input name="localidadID" id="localidadID" type="hidden" value="{{$pedido->localidadID}}">
		<input name="usuarioID" id="usuarioID" type="hidden" value="{{$pedido->usuarioID}}">
		<input name="timeCreated" id="timeCreated" type="hidden" value="{{$pedido->timeCreated}}">
		<input name="timestamp" id="timestamp" type="hidden" value="{{$pedido->created_at}}">
		
		@foreach($sucursales as $sucursal)
			@if($pedido->localidadID == $sucursal->id)
				<?php
					$latLocalidad = $sucursal->latitud;
					$lngLocalidad = $sucursal->longitud;
				?>
			@endif
		@endforeach
		<input name="latLocalidad" id="latLocalidad" type="hidden" value="{{$latLocalidad}}">
		<input name="lngLocalidad" id="lngLocalidad" type="hidden" value="{{$lngLocalidad}}">
	@endforeach
	<?php
		//Campos que seran llenados para cargar la data del pedido del cliente 
		//$tracking_id;
		$nombreCliente = '';
		$direccion = '';
		$tracking_id = '';
		$total = 0.00;
		
		//Datos del mensajero
		$nombreMensajero = '';
		$telefonoMensajero = '';
	?>
	@foreach($pedidos as $pedido)
		@foreach($clientes as $cliente)
			@if($cliente->id == $pedido->clienteID)
				<?php $nombreCliente = $cliente->nombreCliente; ?>
			@endif
		@endforeach
		@foreach($direccionclientes as $direccioncliente)
			@if($direccioncliente->clienteID == $pedido->clienteID)
				<?php $direccion = $direccioncliente->direccionOrigen; ?>
			@endif
		@endforeach
		@foreach($mensajeros as $mensajero)
			@if($mensajero->id == $pedido->usuarioID)
				<?php 
					$nombreMensajero = $mensajero->nombreUsuario;
					$telefonoMensajero = $mensajero->telefonoUsuario;
				?>
			@endif
		@endforeach
		<?php 
			$tracking_id = $pedido->tracking_id; 
			$total = $pedido->total;
		?>
	@endforeach
	
	
	<input name="timestamp2" id="timestamp2" type="hidden" value="">
	
	<input name="order_number" id="orderID" type="hidden" value="-1">
    <input id="latitud" type="hidden" value="-1">
    <input id="longitud" type="hidden" value="-1">
	
	<div class="container" style="height:0px;position:absolute;left:;top:;z-index:100000;">
		<div class="input-field col-md-8" style="display:flex;width:0px;">
			
			<input name="client_number" id="client_number" type="hidden" value="" class="validate valid">
			
		</div>
		<div class="panel panel-default col-md-4 center" style="padding:5px;position:absolute;top:25px;left:40px;text-align:left;float:left;width:330px;background:rgba(255,255,255,0.95);">
			
						<a href="#" id="toggleDataOrdenCliente" data-display="+" style="margin-right:5px;float:left;font-size:18px;color:#039be5;"><i class="fa fa-plus-square" aria-hidden="true"></i></a>  <span style="font-size:14px;color:#039be5;"> <strong>{{$nombreCliente}}</strong></span> 
					
				<div id="dataOrdenCliente" style="margin-top:0px;padding-top:5px;display:none;border-top:2px solid #f1f1f1;">
					<!--Orden: <span style="font-size:14px;color:#777;"><strong>{{$tracking_id}}</strong></span><br>-->
					<span style="font-size:12px;color:#039be5;">{{$direccion}}</span><br>
					<!--Subtotal: <span style="font-size:14px;color:rgba(255,0,0,0.5);">${{$pedido->subtotal}}</span><br>
					Impuesto: <span style="font-size:14px;color:rgba(255,0,0,0.5);">${{$pedido->impuesto}}</span><br>-->
					Total: <span style="font-size:14px;font-weight:bold;color:rgba(255,0,0,0.5);">${{$total}}</span><br>
					
					<p style="margin-top:10px;margin-bottom:3px;font-size:14px;font-weight:bold;">Mensajero</p>

					<span style="font-size:14px;color:rgba(0,0,0,0.5);">{{$nombreMensajero}}</span><br>
					<span style="font-size:14px;color:rgba(255,0,0,0.5);">{{$telefonoMensajero}}</span><br>
				</div>
			
		</div>
		<div class="panel panel-default col-md-4 center" style="float:right;position:absolute;top:25px;right:40px;width:250px;background:rgba(255,255,255,0.95);">
			<span style="font-size:14px;">Tiempo transcurrido</span> <span class="text" id="time" style="font-size:20px;">00:00</span>
		</div>
	</div>
		
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-body"><div id="map"></div></div>
		</div>
	</div> 
	
	
	<div class="modal fade" id="not_found" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="z-index:1000000;">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="position:relative;top:100px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle fa-2x"></i> Orden entregada!!</h4>
				</div>
				<div class="modal-footer">
					<div class="col-md-12">
						<button id="elim" type="button" class="btn btn-info waves-effect waves-light btn-default" data-dismiss="modal">Aceptar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('custom-js')
	<script src="{{ asset('public/assets/js/consultorder2.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKnxouLftDsdQYJwChLKvRzMSNaxntk90&callback=initMap" async defer></script>
@stop
