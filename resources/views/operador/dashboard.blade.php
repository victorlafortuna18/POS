@extends('operador.template.template')
@section('page-title')
	Dashboard
@stop

@section('body')
	<div class="main center">
        <div class="center">
            <h1 class="title"><span class="color-naranja">Smart</span><span class="text-color"> <i class="fa fa-truck fa-2x"></i>  </span><br><span class="color-azul"> Delivery</span></h1>
        </div>
       <a type="button" class="btn btn-primary waves-effect waves-light btn-large" href="{{ url('operador/takeorder') }}">TOMAR ORDEN</a>
       <a type="button" class="btn btn-warning waves-effect waves-light btn-large" href="{{ url('operador/consultorder') }}">CONSULTAR ORDEN</a>
       <a type="button" class="btn btn-success waves-effect waves-light btn-large" href="{{ url('operador/reportes') }}">REPORTES</a>
    </div>
@stop







