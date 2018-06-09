@extends('layout')

@section('contenido')
    <h1 class="display-3 font-weight-bold text-center ">No esta Autorizado</h1>
    <img  class="img-fluid" src="{{asset('img/403.jpg')}}">
    <br><br>
    <a href="{{route('inicio')}}">ir al inicio</a>
@endsection