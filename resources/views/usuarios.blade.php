@extends('layout')

@section('contenido')
    <h1 class="display-3">Usuarios</h1>
    <div class="row">
        <div class="col-2">
            <a href="{{route('crear')}}" class="btn btn-primary mb-3">Crear Usuario</a>
        </div>
        <div class="col-3 offset-7">
            <form method="GET" action="{{route('usuarios')}}" class="form-check-inline">
                <input class="form-control mr-sm-2" type="search" name="name" placeholder="Buscar Usuario" aria-label="Search">
                <button class="btn btn-outline-primary my-2 my-sm-0" type="submit">Buscar</button>
            </form>
        </div>
    </div>

@if($user->isNotEmpty())
<table class="table table-hover table-bordered text-center">
    <thead class="thead-dark">
    <tr>
        <th scope="col">#</th>
        <th scope="col">Nombre</th>
        <th scope="col">Rol Usuario</th>
        <th scope="col">Acciones</th>
    </tr>
    </thead>
    <tbody>
    @foreach($user as $us)
    <tr>
        <th scope="row">{{$us->id}}</th>
        <td>{{$us->name}}</td>
        <td>{{$us->role->name_rol}}</td>
        <td>
            <form method="POST" action="{{route('eliminar',$us)}}">
                {{method_field('DELETE')}}
                {!! csrf_field() !!}
                <a href="{{route('detalle',['id'=>$us->id])}}" class="btn btn-link">Detalle</a>
                <a href="{{route('editar',$us)}}" class="btn btn-link">Editar</a>
                <button type="submit" class="btn btn-link">Eliminar</button>
            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>
@else
    <li>No hay usuarios</li>
@endif
@endsection