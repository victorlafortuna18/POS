@extends('adminlocalidad.template.template')
@section('page-title')
	 Reportes
@stop
@section('body')

    <meta charset="utf-8">
    <title>Reportes</title>
   

    <!-- Le styles -->
    <link href="{{ asset('public/assets/assets/css/bootstrap.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/assets/css/main.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/assets/css/font-style.css') }}" rel="stylesheet">
    <link href="{{ asset('public/assets/assets/css/flexslider.css') }}" rel="stylesheet">
    
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

    <style type="text/css">
      body {
        padding-top: ;
      }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{ asset('public/assets/assets/ico/apple-touch-icon-144-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{ asset('public/assets/assets/ico/apple-touch-icon-114-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{ asset('public/assets/assets/ico/apple-touch-icon-72-precomposed.png') }}">
    <link rel="apple-touch-icon-precomposed" href="{{ asset('public/assets/assets/ico/apple-touch-icon-57-precomposed.png') }}">

  	<!-- Google Fonts call. Font Used Open Sans & Raleway -->
	<link href="http://fonts.googleapis.com/css?family=Raleway:400,300" rel="stylesheet" type="text/css">
  	<link href="http://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css">

<script type="text/javascript">
$(document).ready(function () {

    $("#btn-blog-next").click(function () {
      $('#blogCarousel').carousel('next')
    });
     $("#btn-blog-prev").click(function () {
      $('#blogCarousel').carousel('prev')
    });

     $("#btn-client-next").click(function () {
      $('#clientCarousel').carousel('next')
    });
     $("#btn-client-prev").click(function () {
      $('#clientCarousel').carousel('prev')
    });
    
});

 $(window).load(function(){

    $('.flexslider').flexslider({
        animation: "slide",
        slideshow: true,
        start: function(slider){
          $('body').removeClass('loading');
        }
    });  
});

</script>

<?php 
		//Generando un conteo de los sucursales
		//*************************************
		$conteoSucursales = 0;
	?>
	@if (empty($sucursales))
		
	@else
		@foreach($sucursales as $sucursal)
			<?php $conteoSucursales++; ?>
		@endforeach
	@endif
	
	<?php 
		//Generando datos de cuenta
		//*************************
		$id = 0;
		$cuentaID = 'None';
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
		//Generando un conteo de los operadores
		//*************************************
		$conteoUsuarios = 0;
	?>
	@if (empty($usuarios))
		
	@else
		@foreach($usuarios as $usuario)
			<?php $conteoUsuarios++; ?>
		@endforeach
	@endif
	
	
	<?php 
		//Generando un conteo de los mensajeros
		//*************************************
		$conteoMensajeros = 0;
	?>
	@if (empty($mensajeros))
		
	@else
		@foreach($mensajeros as $mensajero)
			<?php $conteoMensajeros++; ?>
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
			<?php $conteoOrdenes++; ?>
		@endforeach
	@endif
	
	
	<?php 
		//Generando un conteo de los pedidos
		//*************************************
		$conteoPedidos = 0;
	?>
	@if (empty($pedidos))
		
	@else
		@foreach($pedidos as $pedido)
			<?php $conteoPedidos++; ?>
		@endforeach
	@endif
	
	<?php 
		//Generando un conteo de los pedidos
		//*************************************
		$totalPedidosTerminados = 0;
		$conteoPedidosEnTiempo = 0;
		$conteoPedidosFueraDeTiempo = 0;
	?>
	@if (empty($pedidosTerminados))
		
	@else
		@foreach($pedidosTerminados as $pedidoTerminado)
			<?php
				$totalPedidosTerminados++;
				//**************************
				$fechaInicial=$pedidoTerminado->created_at;
				$fechaFinal=$pedidoTerminado->updated_at;
				$segundos=strtotime($fechaFinal) - strtotime($fechaInicial);
				$diferencia_segundos=intval($segundos);
				$diferencia_minutos=intval($segundos/60);
				$diferencia_horas=intval($segundos/60/60);
				$diferencia_dias=intval($segundos/60/60/24);
				//echo "<b>".$diferencia_minutos."</b><br/>";
				
				if($diferencia_minutos < 30){
					$conteoPedidosEnTiempo ++;
				}else{
					$conteoPedidosFueraDeTiempo ++;
				}
				//$tiempoPromedioCalculo += $diferencia_segundos;
			?>	
			
		@endforeach
		
		<?php
			//$conteoPedidosEnTiempo = $conteoPedidosEnTiempo/($totalPedidosTerminados/100);
			//$conteoPedidosFueraDeTiempo = $conteoPedidosFueraDeTiempo/($totalPedidosTerminados/100);
		?>
	@endif
    
  
  
  	<!-- NAVIGATION MENU -->

  

    <div class="container">

	  <!-- FIRST ROW OF BLOCKS -->     
      <div class="row">

      <!-- USER PROFILE BLOCK -->
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
	      		<dtitle>User Profile</dtitle>
	      		<hr>
				<div class="thumbnail">
					<!-- <img src="assets/img/face80x80.jpg" alt="Marcel Newman" class="img-circle"> -->
				</div><!-- /thumbnail -->
				<h1 style="font-weight:bold;font-size:30px;">{{ $cuentaID }}</h1>
				<h3>Admin</h3>
				<br>
					<div class="info-user">
						<span aria-hidden="true" class="li_user fs1"></span>
						<span aria-hidden="true" class="li_settings fs1"></span>
						<span aria-hidden="true" class="li_mail fs1"></span>
						<span aria-hidden="true" class="li_key fs1"></span>
					</div>
				</div>
        </div>
		
		<div class="col-sm-3 col-lg-3">
       <!-- MAIL BLOCK -->
      		<div class="dash-unit">
      		<dtitle>Pedidos ({{ $conteoPedidos }})</dtitle>
      		<hr>
      		<div class="framemail">
    			<div class="window">
			        <ul class="mail">
			            @if (empty($pedidos))
		
						@else
							@foreach($pedidos as $pedido)
								<li>
									<i class="unread"></i>
									<img class="avatar" src="assets/img/photo01.jpeg" alt="avatar">
									<p class="sender">{{ $pedido->tracking_id }}</p>
										<?php 
											$nombreCliente = '';
											$telefonoCliente = '';
											$identificacionCliente = '';
										?>
										@foreach($clientes as $cliente)
											@if($pedido->clienteID == $cliente->id)
												<?php 
													$nombreCliente = $cliente->nombreCliente;
													$telefonoCliente = $cliente->telefonoCliente;
													$identificacionCliente = $cliente->identificacion;
												?>
											@endif
										@endforeach
									<p class="message"><strong>{{ $nombreCliente }}</strong> - {{ $telefonoCliente }}</p>
									<div class="actions">
										<a><img src="http://png-1.findicons.com/files//icons/2232/wireframe_mono/16/undo.png" alt="reply"></a>
										<a><img src="http://png-1.findicons.com/files//icons/2232/wireframe_mono/16/star_fav.png" alt="favourite"></a>
										<a><img src="http://png-4.findicons.com/files//icons/2232/wireframe_mono/16/tag.png" alt="label"></a>
										<a><img src="http://png-4.findicons.com/files//icons/2232/wireframe_mono/16/trash.png" alt="delete"></a>
									</div>
								</li>
							@endforeach
						@endif
			        </ul>
    			</div>
			</div>
		</div><!-- /dash-unit -->
    </div><!-- /span3 -->

      <!-- DONUT CHART BLOCK -->
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
		  		<dtitle>Site Bandwidth</dtitle>
		  		<hr>
	        	<div id="pedidos_chart" data-pedidosEnTiempo="{{$conteoPedidosEnTiempo}}" data-pedidosFueraDeTiempo="{{$conteoPedidosFueraDeTiempo}}" style="width:160px;height:160px;margin:0px auto;"></div>
	        	<h2>{{$conteoPedidosEnTiempo}}%</h2>
			</div>
        </div>

      <!-- DONUT CHART BLOCK -->
       
	   <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
		  		<dtitle>Disk Space</dtitle>
		  		<hr>
	        	<div id="space"></div>
	        	<h2>65%</h2>
			</div>
        </div>
		
        
       
      </div><!-- /row -->
      
      
	  <!-- SECOND ROW OF BLOCKS -->     
      <div class="row">
        <div class="col-sm-3 col-lg-3">
       <!-- MAIL BLOCK -->
      		<div class="dash-unit">
      		<dtitle>Ordenes ({{ $conteoOrdenes }})</dtitle>
      		<hr>
      		<div class="framemail">
    			<div class="window">
			        <ul class="mail">
			            @if (empty($ordenes))
		
						@else
							@foreach($ordenes as $orden)
								<li>
									<i class="unread"></i>
									<img class="avatar" src="assets/img/photo01.jpeg" alt="avatar">
									<p class="sender">{{ $orden->nombre }}</p>
									<p class="message"><strong>{{ $orden->telefono }}</strong> - {{ $orden->direccion }}</p>
									<div class="actions">
										<a><img src="http://png-1.findicons.com/files//icons/2232/wireframe_mono/16/undo.png" alt="reply"></a>
										<a><img src="http://png-1.findicons.com/files//icons/2232/wireframe_mono/16/star_fav.png" alt="favourite"></a>
										<a><img src="http://png-4.findicons.com/files//icons/2232/wireframe_mono/16/tag.png" alt="label"></a>
										<a><img src="http://png-4.findicons.com/files//icons/2232/wireframe_mono/16/trash.png" alt="delete"></a>
									</div>
								</li>
							@endforeach
						@endif
			        </ul>
    			</div>
			</div>
		</div><!-- /dash-unit -->
    </div><!-- /span3 -->
	

	  <!-- GRAPH CHART - lineandbars.js file -->     
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
      		<dtitle>Other Information</dtitle>
      		<hr>
			    <div class="section-graph">
			      <div id="importantchart"></div>
			      <br>
			      <div class="graph-info">
			        <i class="graph-arrow"></i>
			        <span class="graph-info-big">634.39</span>
			        <span class="graph-info-small">+2.18 (3.71%)</span>
			      </div>
			    </div>
			</div>
        </div>

	  <!-- LAST MONTH REVENUE -->     
        <div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
	      		<dtitle>Last Month Revenue</dtitle>
	      		<hr>
	      		<div class="cont">
					<p><bold>$879</bold> | <ok>Approved</ok></p>
					<br>
					<p><bold>$377</bold> | Pending</p>
					<br>
					<p><bold>$156</bold> | <bad>Denied</bad></p>
					<br>
					<p><img src="assets/img/up-small.png" alt=""> 12% Compared Last Month</p>

				</div>

			</div>
        </div>
		 <div class="col-sm-3 col-lg-3" style="display:;">

      <!-- LOCAL TIME BLOCK -->
      		<div class="half-unit">
	      		<dtitle>Local Time</dtitle>
	      		<hr>
		      		<div class="clockcenter">
			      		<digiclock>12:45:25</digiclock>
		      		</div>
			</div>

      <!-- SERVER UPTIME -->
			<div class="half-unit">
	      		<dtitle>Server Uptime</dtitle>
	      		<hr>
	      		<div class="cont">
					<p><img src="assets/img/up.png" alt=""> <bold>Up</bold> | 356ms.</p>
				</div>
			</div>

        </div>
      </div><!-- /row -->
     
 
	  <!-- THIRD ROW OF BLOCKS -->     
      <div class="row" style="display:none;">
      	<div class="col-sm-3 col-lg-3">
	  
	  <!-- BARS CHART - lineandbars.js file -->     
      		<div class="half-unit">
	      		<dtitle>Stock Information</dtitle>
	      		<hr>
	      		<div class="cont">
	      		 <div class="info-aapl">
			        <h4>AAPL</h4>
			        <ul>
			          <li><span class="orange" style="height: 37.5%"></span></li>
			          <li><span class="orange" style="height: 47.5%"></span></li>
			          <li><span class="orange" style="height: 70%"></span></li>
			          <li><span class="orange" style="height: 85%"></span></li>
			          <li><span class="green" style="height: 75%"></span></li>
			          <li><span class="green" style="height: 50%"></span></li>
			          <li><span class="green" style="height: 15%"></span></li>
			        </ul>
			      </div>
			      </div>
      		</div>

	  <!-- TO DO LIST -->     
      		<div class="half-unit">
	      		<dtitle>To Do List</dtitle>
	      		<hr>
	      		<div class="cont">
					<p><bold>13</bold> | Pending Tasks</p>
				</div>
		             <div class="progress">
				        <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width:60%;"><span class="sr-only">60% Complete</span>
					        
				        </div>
				     </div>
      		</div>
      	</div>

      	<div class="col-sm-3 col-lg-3">

	  <!-- LIVE VISITORS BLOCK -->     
      		<div class="half-unit">
	      		<dtitle>Live Visitors</dtitle>
	      		<hr>
	      		<div class="cont">
      			<p><bold>388</bold></p>
      			<p><img src="assets/img/up-small.png" alt=""> 412 Max. | <img src="assets/img/down-small.png" alt=""> 89 Min.</p>
	      		</div>
      		</div>
      		
	  <!-- PAGE VIEWS BLOCK -->     
      		<div class="half-unit">
	      		<dtitle>Page Views</dtitle>
	      		<hr>
	      		<div class="cont">
      			<p><bold>145.0K</bold></p>
      			<p><img src="assets/img/up-small.png" alt=""> 23.88%</p>
	      		</div>
      		</div>
      	</div>

      	<div class="col-sm-3 col-lg-3">
	  <!-- TOTAL SUBSCRIBERS BLOCK -->     
      		<div class="half-unit">
	      		<dtitle>Total Subscribers</dtitle>
	      		<hr>
	      		<div class="cont">
      			<p><bold>14.744</bold></p>
      			<p>98 Subscribed Today</p>
	      		</div>
      		</div>
      		
	  <!-- FOLLOWERS BLOCK -->     
      		<div class="half-unit">
	      		<dtitle>Twitter Followers</dtitle>
	      		<hr>
	      		<div class="cont">
      			<p><bold>17.833 Followers</bold></p>
      			<p>@SomeUser</p>
	      		</div>
      		</div>
      	</div>

	  <!-- LATEST NEWS BLOCK -->     
      	<div class="col-sm-3 col-lg-3">
      		<div class="dash-unit">
	      		<dtitle>Latest News</dtitle>
	      		<hr>
				<div class="info-user">
					<span aria-hidden="true" class="li_news fs2"></span>
				</div>
				<br>
      			<div class="text">
      				<p><b>Alvarez.is:</b> A beautiful new Dashboard theme has been realised by Carlos Alvarez. Please, visit <a href="http://alvarez.is">Alvarez.is</a> for more details.</p>
      				<p><grey>Last Update: 5 minutes ago.</grey></p>
      			</div>
      		</div>
      	</div>
      </div><!-- /row -->
      
	  <!-- FOURTH ROW OF BLOCKS -->     
	<div class="row" style="display:none;">
	
	  <!-- TWITTER WIDGET BLOCK -->     
		<div class="col-sm-3 col-lg-3">
			<div class="dash-unit">
	      		<dtitle>Twitter Widget</dtitle>
	      		<hr>
				<div class="info-user">
					<span aria-hidden="true" class="li_megaphone fs2"></span>
				</div>
				<br>
		 		<div id="jstwitter" class="clearfix">
					<ul id="twitter_update_list"></ul>
				</div>
				<script src="http://twitter.com/javascripts/blogger.js"></script><!-- Script Needed to load the Tweets -->
				<script src="http://api.twitter.com/1/statuses/user_timeline/wrapbootstrap.json?callback=twitterCallback2&amp;count=1"></script>
				<!-- To show your tweets replace "wrapbootstrap", in the line above, with your user. -->
				<div class="text">
				<p><grey>Show your tweets here!</grey></p>
				</div>
			</div>
		</div>

	  <!-- NOTIFICATIONS BLOCK -->     
		<div class="col-sm-3 col-lg-3">
			<div class="dash-unit">
	      		<dtitle>Notifications</dtitle>
	      		<hr>
	      		<div class="info-user">
					<span aria-hidden="true" class="li_bubble fs2"></span>
				</div>
	      		<div class="cont">
	      			<p><button class="btnnew noty" data-noty-options="{&quot;text&quot;:&quot;This is a success notification&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}">Top Right</button></p>
	      			<p><button class="btnnew noty" data-noty-options="{&quot;text&quot;:&quot;This is an informaton notification&quot;,&quot;layout&quot;:&quot;topLeft&quot;,&quot;type&quot;:&quot;information&quot;}">Top Left</button></p>
	      			<p><button class="btnnew noty" data-noty-options="{&quot;text&quot;:&quot;This is an alert notification with fade effect.&quot;,&quot;layout&quot;:&quot;topCenter&quot;,&quot;type&quot;:&quot;alert&quot;,&quot;animateOpen&quot;: {&quot;opacity&quot;: &quot;show&quot;}}">Top Center (fade)</button></p>
	      		</div>
			</div>
		</div>

	  <!-- SWITCHES BLOCK -->     
		<div class="col-sm-3 col-lg-3">
			<div class="dash-unit">
	      		<dtitle>Switches</dtitle>
	      		<hr>
	      		<div class="info-user">
					<span aria-hidden="true" class="li_params fs2"></span>
				</div>
				<br>
				<div class="switch">
					<input type="radio" class="switch-input" name="view" value="on" id="on" checked="">
					<label for="on" class="switch-label switch-label-off">On</label>
					<input type="radio" class="switch-input" name="view" value="off" id="off">
					<label for="off" class="switch-label switch-label-on">Off</label>
					<span class="switch-selection"></span>
				</div>
				<div class="switch switch-blue">
					<input type="radio" class="switch-input" name="view2" value="week2" id="week2" checked="">
					<label for="week2" class="switch-label switch-label-off">Week</label>
					<input type="radio" class="switch-input" name="view2" value="month2" id="month2">
					<label for="month2" class="switch-label switch-label-on">Month</label>
					<span class="switch-selection"></span>
				</div>
				
				<div class="switch switch-yellow">
					<input type="radio" class="switch-input" name="view3" value="yes" id="yes" checked="">
					<label for="yes" class="switch-label switch-label-off">Yes</label>
					<input type="radio" class="switch-input" name="view3" value="no" id="no">
					<label for="no" class="switch-label switch-label-on">No</label>
					<span class="switch-selection"></span>
				</div>
			</div>
		</div>

	  <!-- GAUGE CHART BLOCK -->     
		<div class="col-sm-3 col-lg-3">
			<div class="dash-unit">
	      		<dtitle>Gauge Chart</dtitle>
	      		<hr>
	      		<div class="info-user">
					<span aria-hidden="true" class="li_lab fs2"></span>
				</div>
				<canvas id="canvas" width="300" height="300">
			</canvas></div>
		</div>
	
	</div><!--/row -->     
      
 	  
     
      
      
	</div> <!-- /container -->
	


    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script type="text/javascript" src="{{ asset('public/assets/assets/js/bootstrap.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/assets/js/lineandbars.js') }}"></script>
    
	<script type="text/javascript" src="{{ asset('public/assets/assets/js/dash-charts.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/assets/js/gauge.js') }}"></script>
	
	<!-- NOTY JAVASCRIPT -->
	<script type="text/javascript" src="{{ asset('public/assets/assets/js/noty/jquery.noty.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/assets/js/noty/layouts/top.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/assets/js/noty/layouts/topLeft.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/assets/js/noty/layouts/topRight.js') }}"></script>
	<script type="text/javascript" src="{{ asset('public/assets/assets/js/noty/layouts/topCenter.js') }}"></script>
	
	<!-- You can add more layouts if you want -->
	<script type="text/javascript" src="{{ asset('public/assets/assets/js/noty/themes/default.js') }}"></script>
    <!-- <script type="text/javascript" src="assets/js/dash-noty.js"></script> This is a Noty bubble when you init the theme-->
	<script type="text/javascript" src="http://code.highcharts.com/highcharts.js"></script>
	<script src="{{ asset('public/assets/assets/js/jquery.flexslider.js') }}" type="text/javascript"></script>

    <script type="text/javascript" src="{{ asset('public/assets/assets/js/admin.js') }}"></script>
<script>
	$(document).ready(function() {
		
		var pedidosEnTiempo = $(".pedidos_chart").attr('data-pedidosEnTiempo');
		var pedidosFueraDeTiempo = $(".pedidos_chart").attr('data-pedidosFueraDeTiempo');
		
		info = new Highcharts.Chart({
			chart: {
				renderTo: 'pedidos_chart',
				margin: [0, 0, 0, 0],
				backgroundColor: null,
                plotBackgroundColor: 'none',
							
			},
			
			title: {
				text: null
			},

			tooltip: {
				formatter: function() { 
					return this.point.name +': '+ this.y +' %';
						
				} 	
			},
		    series: [
				{
				borderWidth: 2,
				borderColor: '#F1F3EB',
				shadow: false,	
				type: 'pie',
				name: 'Income',
				innerSize: '65%',
				data: [
					{ name: 'load percentage', y: pedidosEnTiempo, color: '#b2c831' },
					//{ name: 'load percentage2', y: 16.0, color: 'blue' },
					{ name: 'rest', y: pedidosFueraDeTiempo, color: '#3d3d3d' }
				],
				dataLabels: {
					enabled: false,
					color: '#000000',
					connectorColor: '#000000'
				}
			}]
		});
		
	});
</script>
	

@stop