@extends('layout')

@section('contenido')

    <h2>Hola  gracias por registrarte  !</h2>
    <p>Por favor confirma tu correo electrónico.</p>
    <p>Para ello simplemente debes hacer click en el siguiente enlace:</p>

    <a href="{{ url('/register/verify/' . $confirmation_code) }}">
        Clic para confirmar tu email
    </a>

@endsection