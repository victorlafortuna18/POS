<!DOCTYPE html>

<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<meta http-equiv="cache-control" content="max-age=0" />
		<meta http-equiv="cache-control" content="no-cache" />
		<meta http-equiv="cache-control" content="no-store" />
		<meta http-equiv="cache-control" content="must-revalidate" />
		<meta http-equiv="expires" content="0" />
		<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
		<meta http-equiv="pragma" content="no-cache" />
		<link href="{{ asset('public/assets/images/ic_launcher.png') }}" rel='shortcut icon' type='image/x-icon'>
		<title>SmartDelivery - @yield('page-title')</title>

		<!-- Material Design Icons -->
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
		<!-- Font Awesome -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
		<!-- Bootstrap core CSS -->
		<link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet">
		<link href="{{ asset('public/assets/css/bootstrap.min.min.css') }}" rel="stylesheet">
		
		<!-- MDB core CSS -->
		<link href="{{ asset('public/assets/css/mdb.css') }}" rel="stylesheet">
		<link href="{{ asset('public/assets/css/style.css') }}" rel="stylesheet">
		<style>
			@keyframes notific {
				0% {opacity: 1;top:60px;}
				20% {opacity: 1;top:60px;}
				40% {opacity: 1;top:60px;}
				60% {opacity: 1;top:60px;}
				80% {opacity: 1;top:60px;}
				100% {opacity: 0;top:0px;}
			}
			
			.notificacion {
				top:-200px !important;
				z-index:1000;
				animation-name: notific;
				animation-duration: 6s;
				animation-delay: 0s;
			}
		</style>
		
	</head>
	
	<header>
		<nav class="navbar" style="z-index:10000;">
				<div class="container-fluid default-color">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						
						<a id="back" class="navbar-brand waves-effect waves-light" href="#"><i class="material-icons">arrow_back</i></a>
						<a class="navbar-brand waves-effect waves-light" href="{{ url('admin/dashboard') }}">Smart delivery</a> 
						<a class="navbar-brand waves-effect waves-light" href="#" onclick="location.reload();">  @yield('page-title')</a>
						
					</div>
				<a class="navbar-brand waves-effect waves-light" href="{{ url('logout') }}" style="float:right;">Cerrar sesion</a>
				</div>
				
			</nav>
	</header>

	<!-- Notificaciones -->
	@if(isset($_GET['agregado']))
		@if($_GET['agregado'] == 'success')
			<div class="notificacionesSuccess notificacion"><div class="btn-success">Agregada exitosamente!  <a href="#" class="cerrarNotificacion" style="float:right;font-weight:bold;">&times;</a></div></div>
		@elseif($_GET['agregado'] == 'error')
			<div class="notificacionesError notificacion"><div class="btn-warning">Error al agregar!  <a href="#" class="cerrarNotificacion" style="float:right;font-weight:bold;">&times;</a></div></div>
		@endif
	@endif
	
	@if(isset($_GET['editado']))
		@if($_GET['editado'] == 'success')
			<div class="notificacionesSuccess notificacion"><div class="btn-success">Editado exitosamente!  <a href="#" class="cerrarNotificacion" style="float:right;font-weight:bold;">&times;</a></div></div>
		@elseif($_GET['editado'] == 'error')
			<div class="notificacionesError notificacion"><div class="btn-warning">Error al editar. No se realizaron cambios!  <a href="#" class="cerrarNotificacion" style="float:right;font-weight:bold;">&times;</a></div></div>
		@endif
	@endif
	
	@if(isset($_GET['eliminado']))
		@if($_GET['eliminado'] == 'success')
			<div class="notificacionesSuccess notificacion"><div class="btn-success">Eliminado exitosamente!  <a href="#" class="cerrarNotificacion" style="float:right;font-weight:bold;">&times;</a></div></div>
		@elseif($_GET['eliminado'] == 'error')
			<div class="notificacionesError notificacion"><div class="btn-warning">Error al eliminar. Esto se debe a que esta siendo usada internamente!  <a href="#" class="cerrarNotificacion" style="float:right;font-weight:bold;">&times;</a></div></div>
		@endif
	@endif
	
	<body>
	
		{{-- Container: Body --}}
		@yield('body')
		
		
		<!-- SCRIPTS -->
		
		<script>
			$(document).ready(function(){
				//Functions Notificaciones
				$('.cerrarNotificacion').click(function(){
					$(this).parents('.notificacion').fadeToggle('fast');
				});
			});
			
			document.getElementById('back').onclick=function(){
				goBack()
			}
			
			function goBack(){
				window.history.back();
			}
		</script>
		
		<!-- JQuery -->
		<script type="text/javascript" src="{{ asset('public/assets/js/jquery-2.2.2.js') }}"></script>
		<!-- Bootstrap core JavaScript -->
		<script type="text/javascript" src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
		<!-- MDB core JavaScript -->
		<script type="text/javascript" src="{{ asset('public/assets/js/mdb.js') }}"></script>
		
		@yield('custom-js')
	</body>

	<!-- <footer class="page-footer center-on-small-only wrap footer">
		<div class="footer-copyright">
			<div class="container">
				© 2015 Copyright 
				<a class="grey-text text-lighten-4 right" href="#!">Octagono</a>
			</div>
		</div>
	</footer> -->
</html>