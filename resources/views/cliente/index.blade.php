@extends('layout')

@section('contenido')
    <h1 class="display-4">Lista de clientes</h1>
    @if($clients->isNotEmpty())
        <table class="table ">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Carnet Identidad</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($clients as $client)
                <tr>
                    <th scope="row">{{$client->id}}</th>
                    <td>{{$client->nombre_completo}}</td>
                    <td>{{$client->carnet_identidad}}</td>
                    <td>

                    </td>
                </tr>
            @endforeach
            {!! $clients->links('pagination::bootstrap-4')  !!}
            </tbody>
        </table>
    @else
        <li>No hay usuarios</li>
    @endif
@endsection