@extends('layout')

@section('contenido')
    <h1 class="display-3 font-weight-bold">Detalle Factura: {{$factura->id}}</h1>
    <h3>Nombre del cliente: </h3>{{$factura->cliente->nombre_completo}}
    <h3>Carnet identidad cliente: </h3>{{$factura->cliente->carnet_identidad}}
    <h3>direccion Cliente: </h3>{{$factura->cliente->direccion}}
    <h3>telefono cliente: </h3>{{$factura->cliente->telefono}}
    <hr class="bg-white">
    <table class="table">
       <thead class="thead-dark">
           <tr>
               <th scope="col">nombre producto</th>
               <th scope="col">precio unitario</th>
               <th scope="col">cantidad</th>
               <th scope="col">precio total producto</th>
           </tr>
       </thead>
       <tbody>
       @foreach($factura->productos as $producto)
           <tr>
               <td>{{$producto->nombre_producto}}</td>
               <td>{{$producto->precio}}</td>
               <td>{{$producto->pivot->cantidad}}</td>
               <td>{{$producto->pivot->precio_total_producto}}</td>
           </tr>
       @endforeach
       </tbody>
    </table>
    <hr class="bg-white">
    <h3>Fecha: </h3>{{$factura->fecha}}
    <h3>Modo de Pago: </h3>{{$factura->modo_pago}}
    <h3>Total a Pagar: </h3>{{$factura->total_pago}}
    <br><br>

@endsection
