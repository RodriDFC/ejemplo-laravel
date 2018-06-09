@extends('layout')

@section('contenido')
<h1>Pagina no Encontrada</h1>
<img  class="img-fluid" src="{{asset('img/404.png')}}">
<br><br>
<a href="{{route('inicio')}}">ir al inicio</a>
@endsection