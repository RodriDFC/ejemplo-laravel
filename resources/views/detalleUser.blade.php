@extends('layout')

@section('contenido')
    <h1 class="display-3 font-weight-bold">Detalle usuario {{$user->id}}</h1>
    <h3>Nombre: </h3>{{$user->name}}
    <h3>Email: </h3>{{$user->email}}
    <h3>Profesion:  </h3>{{$profession}}
    <h3>Rol de Usuario: </h3>{{$user->role->name_rol}}
    <br><br>

    @if($user->hasRoles(['administrador','supervisor']))
    <a href="{{route('usuarios')}}">Regresar al listado de Usuarios</a><br>
   @endif

    <a href="{{route('editar',$user)}}">Editar Usuario</a><!--['user'=>$user]-->
@endsection

