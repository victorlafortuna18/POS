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
        padding: 16 16 16 0;
    }
	
	.container-dir {
        padding: 0 0 16 16;
    }
	
	#dropdown-menu h2 {
		padding: 14px;
		margin: 0;
		font-size: 16px;
		font-weight: 400;
	}
	
	#dropdown-menu .sample {
		width: 200px;
	}
	
	#dropdown-menu .form-group {
		margin: 30px 0;
	}
	
	.h2-body { 
		display: block;
		font-size: 3.5em;
		margin-top: 0.83em;
		margin-bottom: 0.83em;
		margin-left: 0;
		margin-right: 0;
		font-weight: bold;
		text-align: center;
	}
	
	input:-webkit-autofill {
		-webkit-box-shadow: 0 0 0 1000px white inset;
	}
</style>
@section('page-title')
	Dashboard
@stop

	<?php 
		//Generando datos de la cuenta
		//*************************************
		$idCuenta = 0;
		$nombreCuenta = '';
	?>
	@if (empty($cuentas))
		
	@else
		@foreach($cuentas as $cuenta)
			<?php 
				$idCuenta = $cuenta->id;
				$nombreCuenta = $cuenta->cuentaID;
			?>
		@endforeach
	@endif
	
	<?php 
		//Generando datos de la localidad
		//*************************************
		$idSucursal = 0;
		$nombreLocalidad = '';
		$direccionLocalidad = '';
		$idLocalidad = 0;
	?>
	@if (empty($localidades))
		
	@else
		@foreach($localidades as $localidad)
			<?php 
				$idSucursal = $localidad->idSucursal;
				$nombreLocalidad = $localidad->nombreLocalidad;
				$direccionLocalidad = $localidad->direccionLocalidad;
				$idLocalidad = $localidad->id;
			?>
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
			@if($orden->cuentaid == $nombreCuenta)
				@if($orden->sucursalid == $idSucursal)
					<?php $conteoOrdenes++; ?>
				@endif
			@endif
		@endforeach
	@endif
	
	



@section('body')
<div class="container" style="display:flex">
	<div style="width:80%;">
		<div class="row">
			<input id="cliente_id" type="hidden" value="{{ Auth::user()->cuentaID }}">
				<div class="input-field col-md-8" style="display:none;">
					<i class="fa fa-phone" style="font-size:20px;"></i> <span>Numero de telefono</span>
					 <input id="tel2" type="text" class="validate valid" placeholder="Telefono">
					
				</div>
				<div class="input-field col-md-2" style="display:none;">
					<!--<a id="search" type="button" class="btn btn-info waves-effect waves-light btn-medium" href="#">BUSCAR</a>-->
				</div>
				<div class="input-field col-md-2" style="display:none;">
					<a id="verOrdenes2" type="button" class="btn btn-info waves-effect waves-light btn-medium" href="#">VER ORDENES</a>
				</div>
		</div>
		<div class="container row" style="height: 730px;">
			<div class="panel panel-default" style="height: 100%;">
			   <div class="panel-body" style="height: 100%;"><div id="map" style="height: 100%;"></div></div>
			</div>
		</div>
	</div>

	<div style="width:20%; padding:10px;">
		<div class="panel panel-default col-md-12 row" style="padding:-22px;padding-right: 0px;padding-left: 0px;">
			<a id="verOrdenes" type="button" class="btn btn-info waves-effect waves-light btn-medium" href="#" style="margin-left:;width:90%;">VER ORDENES</a>
		</div>
		<div class="panel panel-default col-md-12 row" style="padding:-22px;padding-right: 0px;padding-left: 0px;">
			<div class="panel-heading">Datos del cliente</div>
	        <div class="panel-body col-md-12">
				<div class="col-md-12" style="padding-left: 0px; padding-right: 0px;">
					<div class="input-field col-md-12">
						<!-- <i class="material-icons prefix active">home</i> -->
						<input id="nombre" type="text" class="validate valid" placeholder="Nombre">
						<!-- <label for="icon_prefix" class="active">Sector</label> -->
					</div>
					<div class="input-field col-md-12">
						<!-- <label for="icon_prefix" class="active">Calle</label> -->
						<!-- <i class="material-icons prefix active">directions</i> -->
						<input id="identificacion_cliente" type="text" class="validate valid" placeholder="Identificacion">
						
					</div>
					<div class="input-field col-md-12">
						<!-- <label for="icon_prefix" class="active">Calle</label> -->
						<!-- <i class="material-icons prefix active">directions</i> -->
						<input id="tel" type="text" class="validate valid" placeholder="Telefono">
						
					</div>
					<div class="input-field col-md-12">
						<!-- <label for="icon_prefix" class="active">Calle</label> -->
						<!-- <i class="material-icons prefix active">directions</i> -->
						<input id="direccion" type="text" class="validate valid" placeholder="Direcci&oacute;n">
						
					</div>
					
				</div>
	        </div>
		</div>
	
		<div class="panel panel-default col-md-12 row" style="padding:-22px;padding-right: 0px;padding-left: 0px;">
			<div class="panel-heading">Asignar delivery</div>
				<div class="panel-body col-md-12" style="padding:-22px;padding-right: 0px;padding-left: 0px;">
				{{-- <form method="post" action="{{ url('operador/takeorder') }}"> --}}
						{{--{!! csrf_field() !!} --}}
						<div class="col-md-12">
						
							<input id="subtotal" type="hidden" name="subtotal" class="form-control">
							<input id="impuesto" type="hidden" name="impuesto" class="form-control">
							<input id="total" type="hidden" name="total" class="form-control">
							<input id="usuarioID" type="hidden" name="usuarioID" class="form-control" value="{{ Auth::user()->id }}">
							<input id="clienteID" type="hidden" name="clienteID" class="form-control" value="-1">
							<input id="new_order" type="text"   name="new_order" class="form-control" placeholder="Orden" >
						</div>
						<div class="col-md-12">
							@if (empty($operadores))
								<select class="form-control" name="select_operadores">
									<option value="-1">Select</option>
								</select>
							@else
								<select class="form-control" id="mensajeroID" name="select_operadores" placeholder="Your favorite pastry">
									@foreach($operadores as $operador)
										
										@if($operador->EstatusActual == 0)
											<option style="background:#A9F5A9;" value="{{ $operador->id }}" data-estatus="0">{{ $operador->nombreUsuario }}</option>
										@elseif($operador->EstatusActual == 1)
											<option style="background:#FFEC7A;" value="{{ $operador->id }}" data-estatus="1">{{ $operador->nombreUsuario }}</option>
										@elseif($operador->EstatusActual == 2)
											<option style="background:#F78181;" value="{{ $operador->id }}" data-estatus="2">{{ $operador->nombreUsuario }}</option>
										@endif
									@endforeach
								</select>
							@endif
						</div>
						<button id="create-order" type="button" class="btn btn-warning waves-effect waves-light btn-medium right">DESPACHAR ORDEN</button>
					{{--</form> --}}
		  		</div>
		    </div>     
		</div>  
    </div>
</div>



  <!-- Modal -->
<div class="modal fade" id="tracking_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa  fa-check-square-o fa-2x"></i> Pedido confirmado</h4>
			</div>
			<div class="modal-body">
				<label class="h2-body">Código de seguimiento:</label>
				<label id="tracking-id" class="h2-body">000000</label>
			</div>
			<div class="modal-footer">
				<div class="col-md-12">
					<button id="reload-btn" type="button" class="btn btn-info waves-effect waves-light btn-default" data-dismiss="modal">Entendido</button>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="" id="list_modal" style="display:none;width:100%;height:100%;background:rgba(0,0,0,0.3);position:absolute;top:0px;left:0px;z-index:10000000000;">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close closeListOrdenModal" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa  fa-check-square-o fa-2x"></i> Ordenes pendientes ({{ $conteoOrdenes }})</h4>
			</div>
			<div class="resultado" style="padding:10px;display:block;width:580px;height:250px;background:white;overflow:auto;">
				@if (empty($ordenes))
					
				@else
					@foreach($ordenes as $orden)
						@if($orden->sucursalid == $idSucursal)
							<a href="#" class="ordenOption" data-orden="{{$orden->ordenid}}" data-subtotal="{{$orden->subtotal}}" data-impuesto="{{$orden->impuesto}}" data-total="{{$orden->total}}"  data-nombre="{{$orden->cliente}}"  data-direccion="{{$orden->direccion.', '.$orden->ciudad.', '.$orden->ciudad}}" data-telefono="{{$orden->telefono}}" data-email="{{$orden->mail}}" data-tipo-documento="{{$orden->tip_iden}}" data-identificacion="{{$orden->identificacion}}" style="font-weight:bold;">
								<li style="border-bottom: 1px solid #ccc;position: relative;margin:0px;margin-bottom:5px;margin-left:3px;list-style:none;">
									<p class="sender" style="margin:0px;font-size:20px;">{{ $orden->cliente }}</p>
									<p class="message" style="margin:0px;color:#aaa;"><strong>{{ $orden->telefono }}</strong> - <strong style="color:rgba(255,0,0,0.5);">${{ $orden->total }}</strong> - {{ $orden->direccion.', '.$orden->ciudad.', '.$orden->ciudad }}</p>
								</li>
							</a>
						@endif
					@endforeach
					@if($conteoOrdenes == 0)
						¡Felicidades! No tienes ordenes pendientes.
					@endif
				@endif
			</div>	
			<div class="modal-footer">
				<div class="col-md-12">
					<a href="#" id="" class="btn btn-info waves-effect waves-light btn-default ocultarListOrdenModal" data-dismiss="modal">Ocultar</a>
				</div>
			</div>
		</div>
	</div>
</div>  

 

<!-- Modal -->
<div class="modal fade" id="createClienteSuccess" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa  fa-check-square-o fa-2x"></i> Guardado con exito</h4>
			</div>
			<div class="modal-body">
				<label class="h2-body">Un nuevo cliente ha sido creado exitosamente</label>
			</div>
			<div class="modal-footer">
				<div class="col-md-12">
					<button id="reload-btn" type="button" class="btn btn-info waves-effect waves-light btn-default" data-dismiss="modal">Entendido</button>
				</div>
			</div>
		</div>
	</div>
</div>
 
 
 
 <!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle fa-2x"></i> Cliente no encontrado</h4>
			</div>
			<div class="modal-body">
				¿Desea crear este cliente en el sistema?
			</div>
			<div class="modal-footer">
				<div class="col-md-12">
					<button type="button" style="margin-bottom: 0; "class="btn btn-danger waves-effect waves-light btn-default" data-dismiss="modal">Cancelar</button>
					<button id="goCrear" type="button" class="btn btn-info waves-effect waves-light btn-default">Adelante</button>
				</div>
			</div>
		</div>
	</div>
</div>

 <!-- Modal -->
<div class="modal fade" id="crear" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class="fa fa-exclamation-triangle fa-2x"></i> Crear Cliente</h4>
			</div>
			<div class="modal-body">
				<div class="panel-body col-md-12">
					<div class="input-field col-md-12">
						<i class="material-icons prefix">home</i>
						<input id="tipoDocumento_cliente" class="validate" type="hidden" name="">
						<input id="identificacion_cliente" class="validate" type="hidden" name="">
						<input id="email_cliente" class="validate" type="hidden" name="">
						<input id="nombre_cliente" class="validate" type="text" name="">
						<label for="icon_prefix">Nombre</label>
					</div>
					<div class="input-field col-md-12">
						<i class="material-icons prefix">phone</i>
						<input id="telefono_cliente" class="validate" type="text" name="">
						<label for="icon_prefix">Telefono</label>
					</div>
					<div class="col-md-6">
						<input id="pais" type="text" name="" placeholder="Pais">					
						<input id="direccion_cliente"type="text" name="" placeholder="direccion">
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div class="col-md-12">
					<button type="button" style="margin-bottom: 0; "class="btn btn-danger waves-effect waves-light btn-default" data-dismiss="modal">Cancelar</button>
					<button id="guardarCliente" type="button" class="btn btn-success waves-effect waves-light btn-default">Guardar</button>
				</div>
			</div>
		</div>
	</div>
</div>
@stop

@section('custom-js')
	<script src="{{ asset('public/assets/js/takeorder.js') }}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKnxouLftDsdQYJwChLKvRzMSNaxntk90&callback=initMap" async defer></script>
@stop
