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
                <div class="col-md-12">
                    <h4>{{ Session::get('error') }}</h4>
                </div>
            @endif
            <div class="row ">
                <div class="input-field col-md-12" style="display:none;">
                    <span style="float:left;margin-left:45px;font-weight:bold;color:#aaa;">Cuenta</span><br/>
					<i class="material-icons prefix">home</i>
                    <input name="cuenta" id="icon_prefix" type="text" class="validate" value="kfc">
                    
                </div>
				<style type="text/css">
					.selected {
						font-weight:bold;
						color:#ffffff !important;
						background:green !important;
					}
				</style>
                <div class="input-field col-md-12">
                    <span style="display:;float:left;margin-left:45px;font-weight:bold;color:#aaa;">Usuario</span><br/>
					<i class="material-icons prefix" style="display:none;">person</i>
                    <input  name="user" class="userID" id="icon_prefix" type="hidden" class="validate" autocomplete="off">
					
					<div class="selectUsuarios" style="display:block;margin-left:40px;background:#aaa;width:500px;height:250px;overflow:auto;">
						@foreach($cajeros as $cajero)
							<a href="#" data-userid="{{ $cajero->userID }}" style="display:block;padding:3px;background:#f1f1f1;text-align:left;color:#000;font-size:18px;border-bottom:1px solid #e8e8e8;">{{ $cajero->nombreUsuario }}</a>
						@endforeach
					</div>
                    
                </div>
                <div class="input-field col-md-12">
                    <span style="float:left;margin-left:45px;font-weight:bold;color:#aaa;">Contraseña</span><br>
					<i class="material-icons prefix">https</i>
                    <input name="pass" id="icon_prefix" type="password" class="validate" autocomplete="off">
                    
                </div>
            </div>
            <div class="center">
                <p class="center">
                    <input type="checkbox" class="" id="filled-in-box" checked="checked" />
                    <label >Mantenerme conectado</label>
                </p>
                <Button type="submit" class="btn btn-default waves-effect waves-light">Iniciar Sesión</Button>
            </div>
        </form>
    </div>
@stop

@section('custom-js')
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
<script type="text/javascript" src="{{ asset('public/assets/js/jquery.dataTables.min.js') }}"></script>
@stop

<script type="text/javascript" src="{{ asset('public/assets/js/jquery-2.2.2.js') }}"></script>

<script>
	$(document).ready(function(){
		$('.selectUsuarios a').click(function(){
			$('.selectUsuarios a').removeClass('selected');
			$(this).addClass('selected');
			
			$('.userID').val($(this).attr('data-userid'));
		});
	});
</script>