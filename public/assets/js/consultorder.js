var map;
var isRunning = false;
var directionsDisplay;
var i = 0;

$( document ).ready(function() {
	
	$('#order_number').keyup(function(ev) {
		if (ev.which === 13 ) {
		
			if( $('#order_number').val() == "" ) {
				alert('Introduzca el ID de la orden');
				return;
			}
			
			if(isRunning) {
				return;
			}
			
			// search order id by order tracking order_number
			searchClientPhonenumber($('#order_number').val());
				
			
			
			// from  order id call pedidoUbicacion and redraw all
		}
	});
	
	
	$('#search-path').click(function(e){
		
		if($('#order_number').val() == "") {
			alert('Introduzca el ID de la orden');
			return;
		}
		
		if(isRunning) {
			return;
		}
		
		// search order id by order tracking order_number
		searchClientPhonenumber($('#client_number').val());
		
	});
	
	
	
});




function contador_onload(){
	//now=new Date();
	
	Number.prototype.padLeft = function(base,chr){
		var  len = (String(base || 10).length - String(this).length)+1;
		return len > 0? new Array(len).join(chr || '0')+this : this;
	}
	/*
	var now = new Date,
		nowFormat = [now.getHours().padLeft(),
				   now.getMinutes().padLeft(),
				   now.getSeconds().padLeft()].join(':');
				   
				   console.log('Date-> ' + now);
	*/	
	var comenzar = new Date(document.getElementById('timeCreated').value);
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
	out+=((minsElapsed<10)?"":"")+(minsElapsed)+"<span class=\"dot\">:</span>";
	out+=((secsM<10)?"":"")+secsM+"<span class=\"dot\">:</span>";
	out+=((hunsElapsed<10)?"":"")+hunsElapsed;
	document.getElementById('time').innerHTML=out;
	stopID=setTimeout("contador_onload()",10);
	
	document.getElementById('timestamp2').value = now;
}

// Función para calcular los días transcurridos entre dos fechas
function restaFechas()
 {
	 
	//mostrar_fecha();
	contador_onload();
	//contador_onload();
	// Set the unit values in milliseconds.


	// Mostrar el resultado.
	//document.write(days + " days, " + hours + " hours, " + minutes + " minutes, " + seconds + " seconds.");
	//***********document.getElementById('time').innerHTML = c;
	//console.log('minutes: ' + minutes + ' | seconds: ' + seconds);
	//console.log(document.getElementById('timestamp').value + ' | ' + dateMsec );
	//Output: 164 días, 23 horas, 0 minutos, 0 segundos.
 }


function searchClientPhonenumber(phoneNumber)
{

	var dominio = document.domain;

	var jqxhr = $.post("http://" + dominio + "/SmartDelivery/api/v1/consultorder",  
	{
		phone: phoneNumber

	}, function(data, status) {
		//var jsons = JSON.parse(data);
		if(status == "success") {
			
			if(data.status_message == "success") {
				$('#clientID').val(data.posts.pedido[0].clienteID);
				$('#latitud').val(data.posts.pedido[0].latitud);
				$('#longitud').val(data.posts.pedido[0].longitud);
				$('#orderID').val(data.posts.pedido[0].tracking_id);
				$('#timeCreated').val(data.posts.pedido[0].timestamp);
				setInterval(nextNotice, 4000);
				//setInterval(restaFechas, 1000);
				restaFechas();
			} else {
				$('#not_found').modal('show');
			}
		} 
	});
}


function nextNotice() {

	setInitialDisplayCoordinate();
	//restaFechas();
	isRunning = true;
}

// ----------------- functions definitions

// initialize static google map
function initMap() {
	map = new google.maps.Map(document.getElementById('map'), {
		zoom: 16,
		center: { lat: 18.4748692, lng: -69.9365542 },
		scrollwheel: true,
		zoomControl: true,
		scaleControl: true,
		mapTypeControl: true,
		mapTypeControlOptions: {
			style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
			position: google.maps.ControlPosition.TOP_CENTER
		}
	});
	
	// initialize direction renderer
	directionsDisplay = new google.maps.DirectionsRenderer({
		map: map
	});	
}


function setInitialDisplayCoordinate() {
	

	var dominio = document.domain;
	
	directionsDisplay.setMap(null);
	
	directionsDisplay = new google.maps.DirectionsRenderer({
		map: map
	});

	// Get loc from tracking_id
	var _id =  document.getElementById('orderID').value;


	var jqxhr = $.post("http://" + dominio + "/SmartDelivery/api/v1/getloc",  
	{
		tracking_id: _id

	}, function(data, status) {
		//var jsons = JSON.parse(data);
		if(status == "success") {
			
			//console.log(data);
			if(data.status_message == "successful") {

				var latitud 	=  data.posts[0].values[0].latitud;
				var longitud 	=  data.posts[0].values[0].longitud;


				console.log('latitud: ' + latitud + ' | longitud: ' + longitud);
				var clientCoordinate = new google.maps.LatLng($('#latitud').val(), $('#longitud').val());
				
				var deliveryCoordinate = new google.maps.LatLng(latitud, longitud);		

				// Set destination, origin and travel mode.
				var request = {
					origin: deliveryCoordinate,
					destination: clientCoordinate,
					travelMode: google.maps.TravelMode.DRIVING
				};
				
				// Pass the directions request to the directions service.
				var directionsService = new google.maps.DirectionsService();
				
				directionsService.route(request, function(response, status) {
					if (status == google.maps.DirectionsStatus.OK) {
						// Display the route on the map.
						directionsDisplay.setDirections(response);
					}
				});

			} else {
				console.log('error getting new location');
			}
		} 
	});


	
	
	
}



	
	
	
	
	
	
	
	
	