@extends('template.template')
@section('page-title')
	Iniciar sesión
@stop


@section('body')
	<div class="main z-depth-2 center">
        <div class="center">
            <h1 class="title"><span class="color-naranja">Smart</span><span class="text-color"> <i class="fa fa-truck fa-2x"></i>  </span><br><span class="color-azul"> Delivery</span></h1>
        </div>
		<form method="post" action="try">
			{!! csrf_field() !!}
			<!-- if there are login errors, show them here -->
			@if(Session::has('error'))
				<div class="alert-box success">
					<h2>{{ Session::get('error') }}</h2>
				</div>
			@endif
			<div class="row ">
				<div class="input-field col-md-12">
					<i class="material-icons prefix">home</i>
					<input name="cuenta" id="icon_prefix" type="text" class="validate">
					<label for="icon_prefix">Cuenta</label>
				</div>
				<div class="input-field col-md-12">
					<i class="material-icons prefix">person</i>
					<input  name="user" id="icon_prefix" type="text" class="validate">
					<label for="icon_prefix">Usuario</label>
				</div>
				<div class="input-field col-md-12">
					<i class="material-icons prefix">https</i>
					<input name="pass" id="icon_prefix" type="password" class="validate">
					<label for="icon_prefix">Contraseña</label>
				</div>
			</div>
			<div class="center">
				<p class="center">
					<input type="checkbox" class="" id="filled-in-box" checked="checked" />
					<label >Mantenerme conectado</label>
				</p>
				<p>¿Olvido su contraseña?</p>
				<Button type="submit" class="btn btn-default waves-effect waves-light">Iniciar Sesión</Button>
			</div>  
        </form>
	</div>
@stop