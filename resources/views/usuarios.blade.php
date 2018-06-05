@extends('layout')

@section('contenido')
<h1 class="display-3">usuarios</h1>
<a href="{{route('crear')}}" class="btn btn-primary mb-3">Crear Usuario</a>


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