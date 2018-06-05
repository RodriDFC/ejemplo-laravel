@extends('layout')

@section('contenido')
    <h1 class="display-3">Registrarse</h1>
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
    <form class="col-7" method="POST" action="{{route('registerPost')}}">
    {!! csrf_field() !!}<!--siempre añadir el token--->
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirmar Password</label>
            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Registrarse</button>
        </div>
    </form>
@endsection