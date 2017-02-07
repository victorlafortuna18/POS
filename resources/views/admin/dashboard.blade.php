@extends('admin.template.templateDashboard')
@section('page-title')
	Dashboard
@stop

@section('body')
	<style type="text/css">
		.cantidad {
			font-size:40px;
			font-weight:bold;
		}
	</style>
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
		//Generando un conteo de los sucursales
		//*************************************
	?>
	@if (empty($sucursales))
		<?php $conteoSucursales = 0; ?>
	@else
		<?php $conteoSucursales = 0; ?>
		@foreach($sucursales as $sucursal)
			<?php $conteoSucursales++; ?>
		@endforeach
	@endif
	
	
	<?php 
		//Generando un conteo de los operadores
		//*************************************
	?>
	@if (empty($usuarios))
		<?php $conteoUsuarios = 0; ?>
	@else
		<?php $conteoUsuarios = 0; ?>
		@foreach($usuarios as $usuario)
			<?php $conteoUsuarios++; ?>
		@endforeach
	@endif
	
	
	<?php 
		//Generando un conteo de los mensajeros
		//*************************************
	?>
	@if (empty($mensajeros))
		<?php $conteoMensajeros = 0; ?>
	@else
		<?php $conteoMensajeros = 0; ?>
		@foreach($mensajeros as $mensajero)
			<?php $conteoMensajeros++; ?>
		@endforeach
	@endif
	
	
	<?php 
		//Generando un conteo de los ordenes
		//*************************************
	?>
	@if (empty($ordenes))
		<?php $conteoOrdenes = 0; ?>
	@else
		<?php $conteoOrdenes = 0; ?>
		@foreach($ordenes as $orden)
			@if($orden->cuentaid == $cuentaID)
				<?php $conteoOrdenes++; ?>
			@endif
		@endforeach
	@endif
	
	
	<?php 
		//Generando un conteo de los pedidos
		//*************************************
	?>
	@if (empty($pedidos))
		<?php $conteoPedidos = 0; ?>
	@else
		<?php $conteoPedidos = 0; ?>
		@foreach($pedidos as $pedido)
			<?php $conteoPedidos++; ?>
		@endforeach
	@endif
	
	<?php 
		header("Refresh: 30");
	?>
	
	<div class="main center" style="width:900px;">
        <div class="center">
            <h1 class="title"><span class="color-naranja">Smart</span><span class="text-color"> <i class="fa fa-truck fa-2x"></i>  </span><br><span class="color-azul"> Delivery</span></h1>
        </div>
       <a type="button" class="btn btn-primary waves-effect waves-light btn-large" style="width:200px;margin:;float:left;" href="{{ url('admin/configuracionCuenta') }}">Config. de Cuenta <br> <span class="cantidad"> <i class="fa fa-cog" style="font-size:40px;"></i> </span> </a>
       <a type="button" class="btn btn-primary waves-effect waves-light btn-large" style="width:200px;margin:;float:left;" href="{{ url('admin/sucursal') }}">SUCURSALES <br> <span class="cantidad">{{ $conteoSucursales }}</span> </a>
	   <a type="button" class="btn btn-primary waves-effect waves-light btn-large" style="width:200px;margin:;float:left;" href="{{ url('admin/usuario') }}">OPERADORES <br> <span class="cantidad">{{ $conteoUsuarios }}</span> </a>
       <a type="button" class="btn btn-primary waves-effect waves-light btn-large" style="width:200px;margin:;float:left;" href="{{ url('admin/mensajero') }}">MENSAJEROS <br> <span class="cantidad">{{ $conteoMensajeros }}</span> </a>
	   <!--<a type="button" class="btn btn-success waves-effect waves-light btn-large" style="width:200px;margin:;float:left;" href="{{ url('admin/verorder') }}">VER ORDENES <br> <span class="cantidad">{{ $conteoOrdenes }}</span> </a>-->
       <a type="button" class="btn btn-warning waves-effect waves-light btn-large" style="width:200px;margin:;float:left;" href="{{ url('admin/ordenes') }}">ORDENES <br> <span class="cantidad">{{ $conteoOrdenes }}</span> </a>
       <a type="button" class="btn btn-warning waves-effect waves-light btn-large" style="width:200px;margin:;float:left;" href="{{ url('admin/pedido') }}">PEDIDOS <br> <span class="cantidad">{{ $conteoPedidos }}</span> </a>
	   <a type="button" class="btn btn-warning waves-effect waves-light btn-large" style="width:200px;margin:;float:left;" href="{{ url('admin/localizarPedido') }}">LOCALIZAR PEDIDOS <br> <span class="cantidad">{{ $conteoPedidos }}</span> </a>
	   <a type="button" class="btn btn-warning waves-effect waves-light btn-large" style="width:200px;margin:;float:left;" href="{{ url('admin/localizarMensajero') }}">LOCALIZAR MOTORIZADO <br> <span class="cantidad">{{ $conteoMensajeros }}</span> </a>
	   <a type="button" class="btn btn-success waves-effect waves-light btn-large" style="width:200px;margin:;float:left;" href="{{ url('admin/reporte/pedido') }}">REPORTES PEDIDOS<br> <span class="cantidad"><i class="fa fa-bar-chart" style="font-size:40px;"></i></span> </a>
       <a type="button" class="btn btn-success waves-effect waves-light btn-large" style="width:200px;margin:;float:left;" href="{{ url('admin/reporte/pedidoMensajero') }}">REPORTES MENSAJEROS<br> <span class="cantidad"><i class="fa fa-bar-chart" style="font-size:40px;"></i></span> </a>
       <!--<a type="button" class="btn btn-success waves-effect waves-light btn-large" style="width:200px;margin:;float:left;" href="{{ url('admin/reportes') }}">REPORTES <br> <span class="cantidad"><i class="fa fa-bar-chart" style="font-size:40px;"></i></span> </a>-->
    </div>
@stop







