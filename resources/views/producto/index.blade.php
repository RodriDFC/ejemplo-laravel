@extends('layout')

@section('contenido')
    <h1 class="display-4">Lista de Productos</h1>
    @if($producto->isNotEmpty())
        <table class="table ">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Precio</th>
                <th scope="col">stock</th>
            </tr>
            </thead>
            <tbody>
            @foreach($producto as $prod)
                <tr>
                    <th scope="row">{{$prod->id}}</th>
                    <td>{{$prod->nombre_producto}}</td>
                    <td>{{$prod->precio}}</td>
                    <td>{{$prod->stock}}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <li>No hay Productos</li>
    @endif

@endsection