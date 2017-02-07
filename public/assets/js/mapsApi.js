// global variables
var map;
var markers = [];
var marker;
var geocoder; 

$( document ).ready(function() {
	
	var dominio = document.domain;
	
	
	// initialize static google map
	function initMap() {
		map = new google.maps.Map(document.getElementById('map'), {
			zoom: 16,
			center: {lat: -0.191105, lng: -78.485989}
		});
	}
	
	$('#direccion').keyup(function(ev) {
		if (ev.which === 13 ) {
			geocodeAddress(geocoder, map);
		}		
	});
	
	
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
					
					
					saveMarkerPosition(results[0].formatted_address, evt.latLng.lat().toFixed(7), evt.latLng.lng().toFixed(7));
				} else {
					console.log("Geocode was not successful for the following reason: " + status);
				}
			});
		});
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
						
			deleteMarkers();
			markers.push(marker);
			addListerners();
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
	
	
	
});