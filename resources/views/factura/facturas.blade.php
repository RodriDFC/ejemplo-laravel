@extends('layout')

@section('contenido')
    <h1 class="display-4">Lista de Facturas</h1>
    @if($facturas->isNotEmpty())
        <table class="table ">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre Cliente</th>
                <th scope="col">CI</th>
                <th scope="col">Fecha</th>
                <th scope="col">Modo de Pago</th>
                <th scope="col">Acciones</th>
            </tr>
            </thead>
            <tbody>
            @foreach($facturas as $factura)
                <tr>
                    <th scope="row">{{$factura->id}}</th>
                    <td>{{$factura->cliente->nombre_completo}}</td>
                    <td>{{$factura->cliente->carnet_identidad}}</td>
                    <td>{{$factura->fecha}}</td>
                    <td>{{$factura->modo_pago}}</td>
                    <td>
                        <a href="{{route('detalleFactura',$factura)}}" class="btn btn-info">Detalle</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
        <li>No hay Facturas</li>
    @endif

@endsection