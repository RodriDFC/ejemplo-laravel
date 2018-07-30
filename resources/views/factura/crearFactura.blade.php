@extends('layout')
@section('contenido')
    @if($errors ->any())
        <div class="alert-danger">
            <h3>Se tiene los siguientes errores en el formulario</h3>
            <ul>
                @foreach($errors->all() as $errors)
                    <li>{{$errors}}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1 class="display-2">Crear Factura</h1>
    <form method="POST" action="{{route('guardarFactura')}}">
        {!! csrf_field() !!}
        <div class="form-group row">
            <div class="col-6">
                <label for="nombre_completo">Nombre cliente</label>
                <input type="text" class="form-control" name="nombre_completo" id="nombre_completo" value="{{old('nombre_completo')}}">
            </div>
            <div class="col-6">
                <label for="carnet_identidad">Carnet de Identidad</label>
                <input type="number" class="form-control" name="carnet_identidad" id="carnet_identidad" value="{{old('carnet_identidad')}}">
            </div>
        </div>
        <div class="form-group row">
            <div class="col-8">
                <label for="direccion">Direccion cliente</label>
                <input type="text" class="form-control" name="direccion" id="direccion" value="{{old('direccion')}}">
            </div>
            <div class="col-4">
                <label for="telefono">Telefono</label>
                <input type="number" class="form-control" name="telefono" id="telefono" value="{{old('telefono')}}">
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-3">
                <label for="nombre_producto">Producto</label>
                <select class="form-control" id="nombre_producto" name="nombre_producto" >
                    <option>seleccione una opcion</option>
                    @foreach($productos as $producto)
                        <option>{{$producto}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-2 offset-1">
                <label for="precio_unitario">precio unitario</label>
                <input type="number" class="form-control" name="precio_unitario" id="precio_unitario" value="">
            </div>
            <div class="col-2 offset-1">
                <label for="cantidad">Cantidad</label>
                <input type="number" class="form-control" name="cantidad" id="cantidad" value="">
            </div>
            <div class="col-2 offset-1">
                <label for="precio_total_producto">total producto</label>
                <input type="number" class="form-control" name="precio_total_producto" id="precio_total_producto" value="">
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <div class="col-3">
                <label for="fecha">Fecha Emision</label>
                <input type="date" class="form-control" name="fecha" id="fecha" value="{{old('fecha')}}">
            </div>
            <div class="col-4 offset-1">
                <label for="modo_pago">Modo de Pago</label>
                <select class="form-control" id="modo_pago" name="modo_pago" >
                    <option>seleccione una opcion</option>
                    <option>efectivo</option>
                    <option>cheque</option>
                    <option>tarjeta de credito</option>
                </select>
            </div>
            <div class="col-3 offset-1">
                <label for="total_pago">Total Factura</label>
                <input type="number" class="form-control" name="total_pago" id="total_pago" value="">
            </div>
        </div>
        <hr>
        <div class="form-group row">
            <button type="submit" class="btn btn-primary btn-block btn-lg">Crear Factura</button>
        </div>
    </form>


@endsection