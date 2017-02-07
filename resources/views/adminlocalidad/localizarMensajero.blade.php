@extends('adminlocalidad.template.template')
@section('page-title')
	 Localizar Motorizado
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
		//header("Refresh: 30");
	?>

	<?php
		//Campos que seran llenados para cargar la data del pedido del cliente 
		//$tracking_id;
	?>
	@foreach($mensajeros as $mensajero)
		<?php 
			//tiempo transcurrido en cada pedido
			/*
			$fechaInicial=$pedido->created_at;
			$fechaFinal=$pedido->updated_at;
			$segundos=strtotime(date("Y-m-d H:i:s")) - strtotime($fechaInicial);
			*/
			//Direfencia de tiempo
			/*$diferencia_segundos=intval($segundos);
			$diferencia_minutos=intval($segundos/60);
			$diferencia_horas=intval($segundos/60/60);
			$diferencia_dias=intval($segundos/60/60/24);
			
			$diferencia_real = $diferencia_horas . ":" . ($diferencia_minutos - ($diferencia_horas * 60)) . ":" . ($diferencia_segundos - ($diferencia_minutos * 60));
			*/
		?>
		<?php
			
			$nombreUsuario = $mensajero->nombreUsuario;
			$userID = $mensajero->userID;
			$telefonoUsuario = $mensajero->telefonoUsuario;
			$latitud = $mensajero->lastLat;
			$longitud = $mensajero->lastLong;
			$estatus = $mensajero->EstatusActual;
		?>
		
		@foreach($sucursales as $sucursal)
			@if($sucursal->id == $mensajero->localidadID)
				<?php
					$nombresucursal = $sucursal->nombreLocalidad;
				?>
			@endif
		@endforeach
		<input name="mensajero" id="mensajero" class="mensajero" type="hidden" data-id="{{$mensajero->id}}" data-nombreusuario="{{$nombreUsuario}}" data-telefonoUsuario="{{$telefonoUsuario}}" data-localidad="{{$nombresucursal}}" data-longitud="{{$longitud}}" data-latitud="{{$latitud}}" data-estatus="{{$estatus}}">
	@endforeach
	
	
	
	<input name="timestamp2" id="timestamp2" type="hidden" value="">
	
	<input name="order_number" id="orderID" type="hidden" value="-1">
    <input id="latitud" type="hidden" value="-1">
    <input id="longitud" type="hidden" value="-1">
		
	<div class="container" style="height:0px;position:absolute;left:;top:;z-index:100000;">	
		<div class="panel panel-default col-md-4 center" style="float:right;position:absolute;top:25px;right:40px;width:250px;background:rgba(255,255,255,0.95);">
			<span style="font-size:14px;">Actualizar&aacute; en </span> <span class="text" id="contadorDesc" style="font-size:20px;">30</span>
			<i id="playpause" data-playpause="1" class="fa fa-pause" style="margin-left:10px;" aria-hidden="true"></i>
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
			
			
			//***************************************/
			
			
		});


		var contadorDesc = 30;
		function contador_onload(){
			$("#contadorDesc").text(contadorDesc);

			contadorDesc = contadorDesc - 1;
			
			if(contadorDesc < 1){
				document.location.reload();
			}
			/*
			if(contadorDesc < 20){
				clearInterval(intervalo);
			}
			
			intervalo = setInterval();
			*/
		}
		var intervalo = setInterval(contador_onload, 1000);
		
		$(document).on('click', '#playpause',function () {
			if($(this).attr('data-playpause') == '1'){
				clearInterval(intervalo);
				
				$(this).removeClass('fa-pause');
				$(this).addClass('fa-play');
				
				$(this).attr('data-playpause', '0');
			}else{
				intervalo = setInterval(contador_onload, 1000);
				
				$(this).removeClass('fa-play');
				$(this).addClass('fa-pause');
				
				$(this).attr('data-playpause', '1');
			}
		});
		
		function initMap() {
			
			
			var dominio = document.domain;
			
			var longitud2 = -78.486128;
			var latitud2 = -0.191043;
			var positionGeo;
			
			var map = new google.maps.Map(document.getElementById('map'), {
				zoom: 14,
				center: {lat: latitud2, lng: longitud2}
			  });
			
			//$(document).on('click', '.itemOrden',function (index) {
			$(".mensajero").each(function(index) {
					nombreUsuario = $(this).attr('data-nombreusuario');
					telefonoUsuario = $(this).attr('data-telefonoUsuario');
					sucursal = $(this).attr('data-localidad');
					estatus = $(this).attr('data-estatus');
					estatusActual = "";
					
					latitud2 = parseFloat($(this).attr('data-latitud'));
					longitud2 = parseFloat($(this).attr('data-longitud')); 
					//var titleMarker = $(this).attr('data-nombreCliente');
					
					
					
					if($(this).attr('data-latitud') != "" && $(this).attr('data-longitud') != ""){
						var marker;
						
						if(estatus == 0){
							var image = "http://" + dominio + "/SmartDelivery/public/assets/images/markers/green_MarkerD.png";
							estatusActual = "<span style=\"color:#01DF3A;\" title=\"Disponible\"><i class=\"fa fa-user\" aria-hidden=\"true\"></i> Disponible</span>";
						}else if(estatus == 1){
							var image = "http://" + dominio + "/SmartDelivery/public/assets/images/markers/orange_MarkerA.png";
							estatusActual = "<span style=\"color:#FF8000;\" title=\"Asignado\"><i class=\"fa fa-user\" aria-hidden=\"true\"></i> Asignado</span>";
						}else if(estatus == 2){
							var image = "http://" + dominio + "/SmartDelivery/public/assets/images/markers/red_MarkerO.png";
							estatusActual = "<span style=\"color:#FF0000;\" title=\"Ocupado\"><i class=\"fa fa-user\" aria-hidden=\"true\"></i> Ocupado</span>";
						}else if(estatus == 3){
							var image = "http://" + dominio + "/SmartDelivery/public/assets/images/markers/paleblue_MarkerF.png";
							estatusActual = "<span style=\"color:#01DFD7;\" title=\"Fuera de linea\"><i class=\"fa fa-user\" aria-hidden=\"true\"></i> Fuera de linea</span>";
						}
						
						//Place each marker
						  marker = new google.maps.Marker({
							map: map,
							draggable: false,
							icon: image,
							//animation: google.maps.Animation.DROP,
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
								content: '<i class="fa fa-street-view" aria-hidden="true"></i> <strong>' + nombreUsuario + '</strong><br>'
								//+ direccionCliente 
								+ estatusActual
								+ '<hr style="margin-top:0px;">'
								//+ imagenCliente
								//+ 'Identificacion: <strong>' + identificacion + '</strong><br>'
								+ 'Telefono: <strong>' + telefonoUsuario + '</strong><br>'
								+ 'Localidad: <strong>' + sucursal + '</strong><br>'
								//+ 'Total: <strong>$' + total + '</strong><br>'
								//+ '<p>&nbsp;</p>'
								//+ 'Mensajero: <strong>' + nombreUsuario + '</strong><br>'
								//+ '<hr style="margin-bottom:0px;">'
								//+ '<a href="http://' + dominio + '/SmartDelivery/adminlocalidad/consultorder/' + tracking_id + '">Ver Pedido</a>'
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
					}
				});
				map.setCenter(marker);
				
		}
		
		
		
	</script>

