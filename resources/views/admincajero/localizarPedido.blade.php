@extends('admincajero.template.template')
@section('page-title')
	 Localizar Pedidos
@stop


@section('body')


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


	<?php
		//Campos que seran llenados para cargar la data del pedido del cliente 
		//$tracking_id;
	?>
	@foreach($pedidos as $pedido)
		<?php 
			//tiempo transcurrido en cada pedido
			$fechaInicial=$pedido->created_at;
			$fechaFinal=$pedido->updated_at;
			$segundos=strtotime(date("Y-m-d H:i:s")) - strtotime($fechaInicial);
			
			//Direfencia de tiempo
			$diferencia_segundos=intval($segundos);
			$diferencia_minutos=intval($segundos/60);
			$diferencia_horas=intval($segundos/60/60);
			$diferencia_dias=intval($segundos/60/60/24);
			
			$diferencia_real = $diferencia_horas . ":" . ($diferencia_minutos - ($diferencia_horas * 60)) . ":" . ($diferencia_segundos - ($diferencia_minutos * 60));
		?>
		<?php
			$latitud = 0;
			$longitud = 0;
			$telefonoCliente = '';
			$identificacion = '';
			$direccionCliente = '';
			$nombreCliente = '';
			$nombreUsuario = '';
			$tracking_id = $pedido->tracking_id;
		?>
		@foreach($direcciones as $direccion)
			@if($pedido->clienteID == $direccion->clienteID)
				<?php
					$direccionCliente = $direccion->direccion;
					$latitud = $direccion->latitud;
					$longitud = $direccion->longitud;
				?>
			@endif
		@endforeach
		@foreach($clientes as $cliente)
			@if($pedido->clienteID == $cliente->id)
				<?php
					$nombreCliente = $cliente->nombreCliente;
					$identificacion = $cliente->identificacion;
					$telefonoCliente = $cliente->telefonoCliente;
					//$longitud = $direccion->longitud;
				?>
			@endif
		@endforeach
		@foreach($mensajeros as $mensajero)
			@if($pedido->usuarioID == $mensajero->id)
				<?php
					$nombreUsuario = $mensajero->nombreUsuario;
					//$longitud = $direccion->longitud;
				?>
			@endif
		@endforeach
		<input name="pedido" id="pedido" class="pedido" type="hidden" data-id="{{$pedido->id}}" data-tracking-id="{{$tracking_id}}" data-usuarioID="{{$pedido->usuarioID}}" data-nombreusuario="{{$nombreUsuario}}" data-clienteID="{{$pedido->clienteID}}" data-nombreCliente="{{$nombreCliente}}" data-telefonoCliente="{{$telefonoCliente}}" data-identificacion="{{$identificacion}}"data-direccionCliente="{{$direccionCliente}}" data-localidadID="{{$pedido->localidadID}}" data-longitud="{{$longitud}}" data-latitud="{{$latitud}}" data-cuentaID="{{$pedido->cuentaID}}" data-timeCreated="{{$pedido->timeCreated}}" data-minutos="{{$diferencia_minutos}}" data-total="{{$pedido->total}}">
	@endforeach
	
	
	
	<input name="timestamp2" id="timestamp2" type="hidden" value="">
	
	<input name="order_number" id="orderID" type="hidden" value="-1">
    <input id="latitud" type="hidden" value="-1">
    <input id="longitud" type="hidden" value="-1">
	
	<div class="container" style="display:none;">
		<div class="input-field col-md-8" style="display:flex">
			
			<input name="client_number" id="client_number" type="hidden" value="" class="validate valid">
			
		</div>
		<div class="panel panel-default col-md-4 center">
			<h5>Tiempo transcurrido</h5>
			<p class="text" id="time">00:00</p>
		</div>
	</div>
		
	<div class="container">
		<div class="panel panel-default">
			<div class="panel-body"><div id="map"></div></div>
		</div>
	</div> 
	
	
	 <!-- Modal -->
	<div class="modal fade" id="not_found" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle fa-2x"></i> Orden no encontrada</h4>
				</div>
				<div class="modal-body">
					¿Esta seguro/a de que escribio el numero correctamente?
				</div>
				<div class="modal-footer">
					<div class="col-md-12">
						<button id="elim" type="button" class="btn btn-info waves-effect waves-light btn-default" data-dismiss="modal">Volver a intentar</button>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop


	
	<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKnxouLftDsdQYJwChLKvRzMSNaxntk90&callback=initMap" async defer></script>-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCodL6hA8VlvpsL2a8DFE9f8yCWaCAIGqA&callback=initMap" async defer></script>
	<script type="text/javascript" src="{{ asset('public/assets/js/jquery-2.2.2.js') }}"></script>
	<script>
		var map;
		var isRunning = false;
		var directionsDisplay;
		var i = 0;

		$( document ).ready(function() {
			
			//searchClientOrder();
			initMap();
			
		});



		function initMap() {
			
			
			var dominio = document.domain;
			
			var longitud2 = -78.486128;
			var latitud2 = -0.191043;
			var positionGeo;
			
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 12,
				center: {lat: latitud2, lng: longitud2}
			  });
			
			//$(document).on('click', '.itemOrden',function (index) {
			$(".pedido").each(function(index) {
					//Taking each position from inputs data attribute
					//Taking data from inputs that will be show on each marker
					nombreUsuario = $(this).attr('data-nombreusuario');
					nombreCliente = $(this).attr('data-nombreCliente');
					direccionCliente = $(this).attr('data-direccionCliente');
					telefonoCliente = $(this).attr('data-telefonoCliente');
					identificacion = $(this).attr('data-identificacion');
					tracking_id = $(this).attr('data-tracking-id');
					minutos = $(this).attr('data-minutos');
					total = $(this).attr('data-total');
					img = "public/assets/images/cliente.png";
					//img2 = "{{ asset('" + "public/assets/images/cliente.png" + "') }}";
					imagenCliente = "<img src=\"http://" + dominio + "/SmartDelivery/" + img + "\" style=\"margin-right:5px;width:50px;height:50px;float:left;\">";
					
					latitud2 = parseFloat($(this).attr('data-latitud'));
					longitud2 = parseFloat($(this).attr('data-longitud')); 
					//var titleMarker = $(this).attr('data-nombreCliente');
			
						var marker;


						
						if(minutos > 29 ){
							var image = "http://" + dominio + "/SmartDelivery/public/assets/images/markers/red_MarkerA.png";
						}else if(minutos > 14 && minutos < 30){
							var image = "http://" + dominio + "/SmartDelivery/public/assets/images/markers/orange_MarkerA.png";
						}else if(minutos < 15){
							var image = "http://" + dominio + "/SmartDelivery/public/assets/images/markers/green_MarkerA.png";
						}
						//Place each marker
						  marker = new google.maps.Marker({
							map: map,
							draggable: false,
							icon: image,
							animation: google.maps.Animation.DROP,
							position: {lat: latitud2, lng: longitud2},
							//title: titleMarker
						  });
						  
						  //Setting up listeners of each marker
						  marker.addListener('rightclick', toggleBounce);
						  marker.addListener('click', toggleDetails);
						  
						  //Center map since last position
						  map.setCenter(marker.getPosition());
						  //map.setZoom(14);
						  //map.panTo(marker.getPosition());
						  
						  //Setting up the information of each marker
						  var infowindow = new google.maps.InfoWindow({
								content: '<i class="fa fa-street-view" aria-hidden="true"></i> <strong>' + nombreCliente + '</strong><br>'
								+ direccionCliente 
								+ '<hr style="margin-top:0px;">'
								//+ imagenCliente
								+ 'Identificacion: <strong>' + identificacion + '</strong><br>'
								+ 'Telefono: <strong>' + telefonoCliente + '</strong><br>'
								+ 'Total: <strong>$' + total + '</strong><br>'
								+ '<p>&nbsp;</p>'
								+ 'Mensajero: <strong>' + nombreUsuario + '</strong><br>'
								+ '<hr style="margin-bottom:0px;">'
								+ '<a href="http://' + dominio + '/SmartDelivery/admincajero/consultorder/' + tracking_id + '">Ver Pedido</a>'
							});

						function toggleBounce() {
						  if (marker.getAnimation() !== null) {
							marker.setAnimation(null);
						  } else {
							marker.setAnimation(google.maps.Animation.BOUNCE);
							//infowindow.open(map,marker);
						  }
						}
						
						function toggleDetails() {
							infowindow.open(map,marker);
						}
				});
				map.setCenter(marker);
				
		}
		
	</script>

