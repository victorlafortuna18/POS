@extends('admin.template.template')
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
	?>
	
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
	
	
	
	<input name="timestamp2" id="timestamp2" type="hidden" value="">
	
	<input name="order_number" id="orderID" type="hidden" value="-1">
    <input id="latitud" type="hidden" value="-1">
    <input id="longitud" type="hidden" value="-1">
	
	<div class="container" style="height:0px;position:absolute;left:;top:;z-index:100000;">
		<div class="input-field col-md-8" style="display:flex;width:0px;">
			
			<input name="client_number" id="client_number" type="hidden" value="" class="validate valid">
			
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
	
	<p>&nbsp;</p>
	 <!-- Modal -->
	<div class="modal fade" id="not_found" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content" style="position:relative;top:100px;">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle fa-2x"></i> Orden no encontrada</h4>
				</div>
				<div class="modal-body">
					Al parecer esta orden ya fue entregada.
				</div>
				<div class="modal-footer">
					<div class="col-md-12">
						<a id="elim" href="{{ url('adminlocalidad/dashboard') }}" type="button" class="btn btn-default">Aceptar</a>
						<!--<button id="elim" type="button" class="btn btn-info waves-effect waves-light btn-default" data-dismiss="modal">Aceptar</button>-->
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
<script type="text/javascript" src="{{ asset('public/assets/js/jquery-2.2.2.js') }}"></script>