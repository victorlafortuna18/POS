
// global variables
var map;
var markers = [];
var marker;
var geocoder; 

$( document ).ready(function() {

	//var href = $(location).attr('href');
	var dominio = document.domain;
	
 
	$('#goCrear').click(function(e){
		$('#myModal').modal('hide');
		$('#crear').modal('show');
	});
	
	$('.ordenOption2').click(function(e){
		e.preventDefault();
		
		//Fill all visual texts we need
		document.getElementById('direccion').value = $(this).attr('data-direccion');
		document.getElementById('nombre').value = $(this).attr('data-nombre');
		document.getElementById('tel').value = $(this).attr('data-telefono');
		document.getElementById('new_order').value = $(this).attr('data-orden');
		document.getElementById('subtotal').value = $(this).attr('data-subtotal');
		document.getElementById('impuesto').value = $(this).attr('data-impuesto');
		document.getElementById('total').value = $(this).attr('data-total');
		
		//Fill all hidden texts we need - I don't know the difference, but I'll try to fix it.
		document.getElementById('direccion_cliente').value = $(this).attr('data-direccion');
		document.getElementById('nombre_cliente').value = $(this).attr('data-nombre');
		document.getElementById('telefono_cliente').value = $(this).attr('data-telefono');
		document.getElementById('email_cliente').value = $(this).attr('data-email');
		
		document.getElementById('tipoDocumento_cliente').value = $(this).attr('data-tipo-documento');
		document.getElementById('identificacion_cliente').value = $(this).attr('data-identificacion');
		
		var direccion_cliente = $(this).attr('data-direccion');
		var nombre_cliente = $(this).attr('data-nombre');
		var telefono_cliente = $(this).attr('data-telefono');
		var orden = $(this).attr('data-orden');
		var subtotal = $(this).attr('data-subtotal');
		var impuesto = $(this).attr('data-impuesto');
		var total = $(this).attr('data-total');
		var identificacion_cliente = "00000000000";
		
		//searchPosition();
		geocodeAddress();
		
		$('#list_modal').fadeToggle('fast');
		//geocodeAddress(geocoder, map);
		//$('#crear').modal('show');
	});
	
	$('.closeListOrdenModal, .ocultarListOrdenModal').click(function(e){
		e.preventDefault();
		$('#list_modal').fadeOut('fast');
	});
	
	$( "#telefono_cliente" ).focus(function() {
	  document.getElementById('telefono_cliente').value = document.getElementById('tel').value;
	});

	// $('#').change();
	
	
	$('mensajeroID').change(function(){
		var Est = $('mensajeroID').attr('data-estatus');
		if(Est == '0'){
			$('mensajeroID').attr('background','#A9F5A9');
		}
		if(Est == '1'){
			$('mensajeroID').attr('background','#F5DA81');
		}
		if(Est == '2'){
			$('mensajeroID').attr('background','#F78181');
		}
	});
	
	
	$('#tel').keyup(function(ev) {
		if (ev.which === 13 ) {
			//ev.preventDefault();
			searchPosition();
		}
	});
	
	//Buscar cliente metodo con telefono
	$('#search').click( function() {
		searchPosition();	
	});
	
	//Buscar ordenes y desplegar lista en modal
	$('#verOrdenes').click( function(e) {
		e.preventDefault();
		$('#list_modal').fadeToggle('slow');
	});
	
	$('#direccion').keypress(function(ev) {
		if (ev.which === 13 ) {
			ev.preventDefault();
			geocodeAddress(geocoder, map);
			return false;
		}
		
	});
	
	$('#direccion').focusout(function(ev) {
		//geocodeAddress(geocoder, map);
		
	});
	
	/*
	$('#direccion').keyup(function(ev) {
		if ($('#direccion').val() >= 10 ) {
			//ev.preventDefault();
			geocodeAddress(geocoder, map);
		}		
	});
	*/
		
		
		
	$('#create-order').click( function() {
	
		var dominio = document.domain;
		var asunto = 'crearorder';
		$('#create-order')

		var tel = document.getElementById('tel').value;
		var new_order = document.getElementById('new_order').value;
		var clienteID = document.getElementById('clienteID').value;
		var usuarioID = document.getElementById('mensajeroID').value; 
		var email_cliente = document.getElementById('email_cliente').value;
		var subtotal = document.getElementById('subtotal').value;
		var impuesto = document.getElementById('impuesto').value;
		var total = document.getElementById('total').value;
		var now=new Date();
		if(new_order == "") {
			alert('Asigne el número de orden, gracias.');
			return;
		}
		
		if(tel == "") {
			alert('Asigne el número de telefono, gracias.');
			return;
		}
		
		var jqxhr = $.post( "http://" + dominio + "/SmartDelivery/operador/takeorder",  
		{
			asunto: asunto, 
			new_order: new_order, 
			clienteID: clienteID, 
			usuarioID: usuarioID,
			email_cliente: email_cliente,
			timeCreated: now,
			subtotal: subtotal,
			impuesto: impuesto,
			total: total,
			telefono_cliente: tel
		}, function(data, status){
			//var jsons = JSON.parse(data);
			if(status == "success"){
				$('#tracking-id').html(data.tracking_id);
				$('#tracking_modal').modal('show');
			}
		});
		
		var data1 = jqxhr;
	});	
	
	$('#GuardarAsignarOrden').click( function() {
	
		var dominio = document.domain;
		var asunto = 'crearorder';
		//$('#GuardarAsignarOrden').fadeTo("slow", 0.4);
		$('#GuardarAsignarOrden').html("Asignar...");
		$('#GuardarAsignarOrden').attr("disabled", true);
		
		
		function addZero(i) {
			if (i < 10) {
				i = "0" + i;
			}
			return i;
		}
		
		var today = new Date();
		
		var ss = addZero(today.getSeconds());
		var ii = addZero(today.getMinutes());
		var hh = addZero(today.getHours());
		
		var dd = addZero(today.getDate());
		var mm = addZero(today.getMonth()+1); //January is 0!

		var yyyy = today.getFullYear();
		 
		var today = yyyy+'-'+mm+'-'+dd+' '+hh+':'+ii+':'+ss;
		
		

		var tel = document.getElementById('tel').value;
		var new_order = document.getElementById('new_order').value;
		var clienteID = document.getElementById('clienteID').value;
		var usuarioID = document.getElementById('mensajeroID').value; 
		var email_cliente = document.getElementById('email_cliente').value;
		var subtotal = document.getElementById('subtotal').value;
		var impuesto = document.getElementById('impuesto').value;
		var total = document.getElementById('total').value;
		var now=new Date();
		
		
		
		if(usuarioID == "") {
			alert('Seleccione a un mensajero!');
			
			$('#GuardarAsignarOrden').html("Asignar");
			$('#GuardarAsignarOrden').removeAttr("disabled");
			return;
		}
		
		
		var jqxhr = $.post( "http://" + dominio + "/SmartDelivery/operador/takeorder",  
		{
			asunto: asunto, 
			new_order: new_order, 
			clienteID: clienteID, 
			usuarioID: usuarioID,
			email_cliente: email_cliente,
			timeCreated: now,
			today: today,
			subtotal: subtotal,
			impuesto: impuesto,
			total: total,
			telefono_cliente: tel
		}, function(data, status){
			//var jsons = JSON.parse(data);
			if(status == "success"){
				
				$('#tracking-id').html(data.tracking_id);
				var rol = $('#rol').attr('value');
				$('#verPedido').attr('href','http://' + dominio + '/SmartDelivery/' + rol + '/consultorder/' + data.tracking_id);
				$('#modalAsignarOrden').fadeOut('fast');
				$('#tracking_modal').modal('show');
				
				// I don't know if this works with a false return
				//return false;
			}
		});
		//$('#GuardarAsignarOrden').html("Asignar");
		//$('#GuardarAsignarOrden').attr("disabled", false);
		var data1 = jqxhr;
	});		
		
	//Add clients into Clients
	function guardarCliente(){
		var search = false;
		var dominio = document.domain;
		var asunto = 'crearcliente';
		//$('#guardarCliente')

		//var tel = document.getElementById('tel').value;
		var nombreCliente = document.getElementById('nombre_cliente').value;
		var telefonoCliente = document.getElementById('telefono_cliente').value;
		var direccionCliente = document.getElementById('direccion_cliente').value; 
		var tipoDocumento = document.getElementById('tipoDocumento_cliente').value; 
		var identificacion = document.getElementById('identificacion_cliente').value; 
		var email = document.getElementById('email_cliente').value; 
		/*
		if(telefonoCliente == "") {
			alert('Asigne un numero de telefono, gracias.');
			return;
		}
		
		if(nombreCliente == "") {
			alert('Asigne un nombre al cliente: '+ tel +', gracias.');
			return;
		}
		
		if(direccionCliente == "") {
			alert('Complete los campos Pais, Ciudad, Sector y calle, gracias.');
			return;
		}
		*/
		var jqxhrd = $.post( "http://" + dominio + "/SmartDelivery/operador/takeorder",  
		{ 
			asunto: asunto,
			nombre_cliente: nombreCliente,
			telefono_cliente: telefonoCliente,
			tipoDocumento_cliente: tipoDocumento,
			identificacion_cliente: identificacion,
			email_cliente: email,
			direccion_cliente: direccionCliente
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
		//addListerners();
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
					document.getElementById('direccion').value = json.posts[1].values[0].direccion;
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
			if(guardar == true){
				guardarCliente();
			}
}

//****************************************************/

});



function verOrdenes() {
	
	var dominio = document.domain;
	
	//$('#search').html("\<i class='fa fa-spinner fa-spin'\>\</i\>  buscando");


		var telNumber = document.getElementById('tel').value;
		var xhr = new XMLHttpRequest();
		xhr.open("POST" , "http://" + dominio + "/SmartDelivery/api/v1/cliente", true);
		xhr.setRequestHeader('token', 'A');
		xhr.setRequestHeader('Content-Type', 'application/json; charset=UTF-8');

			// send the collected data as JSON
			xhr.send(JSON.stringify(telNumber));
			xhr.onreadystatechange = function() {
				if (xhr.readyState == 4 && xhr.status == 200) {
					
					var json = JSON.parse(xhr.responseText);
					
					if(json.posts[0].data == "not found"){
						document.getElementById('nombre').value = -1;
						$('#myModal').modal('show');
						return;
					}
					
					var dhtml = "";
					for (json.posts[1].values[0] in data.datos) {
						dhtml+=' <p> Nombre: '+data.datos[datas].login+'</p>';
						//document.getElementById('orden').value = json.posts[1].values[0].orden;
						//document.getElementById('direccion').value = json.posts[1].values[0].direccion;
						//document.getElementById('nombre').value = json.posts[1].values[0].nombre;
					};
					/*
					document.getElementById('orden').value = json.posts[1].values[0].orden;
					document.getElementById('direccion').value = json.posts[1].values[0].direccion;
					document.getElementById('nombre').value = json.posts[1].values[0].nombre;
					*/
					
					/*
					if(json.posts[1].values[0].posicionDefinitiva == 0) {
						image += "red_MarkerA.png";
						isDraggable = true;
					}
					else {
						image += "darkgreen_MarkerA.png";
						isDraggable = false;
					}
					*/

					console.log(json);
				} 
				else if (xhr.readyState == 4 && xhr.status == 500) {
					$('#myModal').modal('show');
					$('#search').html("buscar");
					
					document.getElementById('calle').value = "";
					document.getElementById('sector').value = "";
					document.getElementById('ciudad').value = "";
					document.getElementById('pais').value = "";
				} 
				
				else {
					$('#search').html("buscar");
					document.getElementById('calle').value = "";
					document.getElementById('sector').value = "";
					document.getElementById('ciudad').value = "";
					document.getElementById('pais').value = "";
					console.log("error");
				}
			}
	
}

// ----------------- functions definitions

// initialize static google map
function initMap() {
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
	//setMapOnAll(map,latitud, longitud);
	  
	  addListerners();

}

// Show the address in the text 'direccion' when drag the marker
function addListerners() {
	google.maps.event.addListener(markers[0], 'dragend', function(evt){
	
		var geocoder = new google.maps.Geocoder();
		
		geocoder.geocode( { 'latLng': evt.latLng}, function(results, status) {

			if (status == google.maps.GeocoderStatus.OK) {
				document.getElementById('direccion').value = results[0].formatted_address;
				/*
				document.getElementById('sector').value = results[0].address_components[1].long_name;
				document.getElementById('ciudad').value = results[0].address_components[3].long_name;
				document.getElementById('pais').value = results[results.length-1].formatted_address;
				*/
				//$('.autoFillableLongitud').val(results[0].geometry.location.lng());
				//$('.autoFillableLatitud').val(results[0].geometry.location.lat());
				
				saveMarkerPosition(results[0].formatted_address, evt.latLng.lat().toFixed(7), evt.latLng.lng().toFixed(7));
				//Fill longitud and latitud hidden text
				
				//fillLatLngText(evt.latLng.lat().toFixed(7), evt.latLng.lng().toFixed(7));
			} else {
				console.log("Geocode was not successful for the following reason: " + status);
			}
		});
	});
}


function fillLatLngText(lat, lng) {
	//$('.autoFillableLatitud').attr('value') = lat;
	//$('.autoFillableLongitud').attr('value') = lng;
}
	
function saveMarkerPosition(street, lat, lng) {
	
	var dominio = document.domain;
	
	var id = document.getElementById('clienteID').value;
	
	if(id == -1){
		
		var tel = document.getElementById('tel').value;
		
		var jqxhr = $.post( "http://" + dominio + "/SmartDelivery/api/v1/create/client",  
		{
			telefono_cliente: tel
		}, function(data, status){
			console.log(data);
			 var id = document.getElementById('clienteID').value = data.posts[1].values.id;
			
			var jqxhr = $.post( "http://" + dominio + "/SmartDelivery/api/v1/saveMarkerPosition",  
			{
				clienteID: id , direccion: street, latitud: lat , longitud: lng
			}, function(data, status){
				//var jsons = JSON.parse(data);
		        console.log("Data: " + data + "\nStatus: " + status);
		    });
		});
		
	} else {
		var jqxhr = $.post( "http://" + dominio + "/SmartDelivery/api/v1/saveMarkerPosition",  
		{
			clienteID: id , direccion: street, latitud: lat , longitud: lng
		}, function(data, status){
			//var jsons = JSON.parse(data);
	        console.log("Data: " + data + "\nStatus: " + status);
	    });

	}
	
	// var jqxhr = $.post( "http://" + dominio + "/SmartDelivery/api/v1/saveMarkerPosition",  
	// {
	// 	clienteID: id , direccion: street, latitud: lat , longitud: lng
	// }, function(data, status){
	// 	//var jsons = JSON.parse(data);
 //        console.log("Data: " + data + "\nStatus: " + status);
 //    });
	
}


// Sets the map on all markers in the array and moves the marker and the map's center to the new point
function setMapOnAll(map, lat, lng) {
	for (var i = 0; i < markers.length; i++) {
		markers[i].setMap(map);
	}

	var center = new google.maps.LatLng(lat, lng);
	
	setTimeout( function(){ 
		map.panTo(center);
		map.setZoom(16);
		markers[0].setPosition(center);
		$('#search').html("buscar");
		addListerners();
	}, 1500 );
	
	
}

// geocode an address to a certain position and displays it on the map
function geocodeAddress(geocoder, resultsMap) {
	
	var dominio = document.domain;
	
  var address = document.getElementById('direccion').value;
  
  var geocoder = new google.maps.Geocoder();
  geocoder.geocode({'address': address}, function(results, status) {
    if (status === google.maps.GeocoderStatus.OK) {
      
	  resultsMap.setCenter(results[0].geometry.location);

	  var image = "http://" + dominio + "/SmartDelivery/public/assets/images/markers/red_MarkerA.png";
	  marker = new google.maps.Marker({
			map: map,
			draggable: true,
			animation: google.maps.Animation.DROP,
			position: results[0].geometry.location,
			icon: image
		});
			
		// document.getElementsByClassName("autoFillableLongitud").value = results[0].geometry.location.lng();
		// document.getElementsByClassName("autoFillableLatitud").value = results[0].geometry.location.lat();
				
		//alert (results[0].geometry.location.lng());
		//alert (results[0].geometry.location.lat());
		
		//$('#longitud').val(results[0].geometry.location.lng());
		//$('#latitud').val(results[0].geometry.location.lat());
		
		$('.autoFillableLongitud').val(results[0].geometry.location.lng());
		$('.autoFillableLatitud').val(results[0].geometry.location.lat());
		
		
		
		deleteMarkers();
		markers.push(marker);
		addListerners();
		saveMarkerPosition(address, results[0].geometry.location.lat(), results[0].geometry.location.lng());
		
		//console.log(results[0].geometry.location.latitud);
		//setMapOnAll(map, results[0].geometry.location.latitud, results[0].geometry.location.longitud);
    } else {
     console.log('Geocode was not successful for the following reason: ' + status);
    }
  });
}

// Removes the markers from the map, but keeps them in the array.
function clearMarkers() {
	setMapOnAll(null);
	
}

// Shows any markers currently in the array.
function showMarkers() {
	setMapOnAll(map);
}

// Deletes all markers in the array by removing references to them.
function deleteMarkers() {
	clearMarkers();
	markers = [];
}
