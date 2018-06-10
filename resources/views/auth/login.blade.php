@extends('layout')

@section('contenido')
    <h1>Login</h1>
    <form class="col-7" method="POST" action="{{route('loginPost')}}">
        {!! csrf_field() !!}<!--siempre añadir el token--->
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}" required>
                @if ($errors->has('email'))
                    <span class="alert-danger">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" name="password" id="password">
            @if ($errors->has('password'))
                <span class="alert-danger">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Iniciar sesion</button>
            <a class="btn btn-info" href="{{route('register')}}">Registrase</a><br>
        </div>
    </form>

@endsection