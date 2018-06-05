@extends('layout')

@section('contenido')
    <h1>Login</h1>
    <form class="col-7" method="POST" action="{{route('loginPost')}}">
        {!! csrf_field() !!}<!--siempre añadir el token--->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Iniciar sesion</button>
        </div>
    </form>

@endsection