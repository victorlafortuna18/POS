@extends('operador.template.template')
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
	Dashboard
@stop


@section('body')

	<input name="timeCreated" id="timeCreated" type="hidden" value="-1">
	<input name="timestamp" id="timestamp" type="hidden" value="-1">
	<input name="timestamp2" id="timestamp2" type="hidden" value="-1">
	<input name="order_number" id="clientID" type="hidden" value="-1">
	<input name="order_number" id="orderID" type="hidden" value="-1">
    <input id="latitud" type="hidden" value="-1">
    <input id="longitud" type="hidden" value="-1">
	
	<div class="container">
		<div class="input-field col-md-8" style="display:flex">
			<i class="material-icons prefix">user</i>
			<input name="client_number" id="client_number" type="text" class="validate valid">
			<label for="icon_prefix" class="active">Identificacion del cliente</label>
			<div class="input-field col-md-4">
				<a id="search-path" type="button" class="btn btn-info waves-effect waves-light btn-medium" href="#">BUSCAR</a>
		    </div>
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
					¿Esta seguro/a de que escribio la identificacion correctamente?
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

@section('custom-js')
	<script src="{{ asset('public/assets/js/consultorder.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKnxouLftDsdQYJwChLKvRzMSNaxntk90&callback=initMap" async defer></script>
@stop
