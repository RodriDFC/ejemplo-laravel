@extends('layout')

@section('contenido')
    <div class="card">
        <h1 class="card-header">Crear Usuario</h1>
        <div class="card-body">
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
            <form method="POST" action="{{route('guardar')}}">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="name">nombre</label>
                    <input type="text" class="form-control" name="name" id="name" value="{{old('name')}}">
                </div>
                <div class="form-group">
                    <label for="email">email</label>
                    <input type="email" class="form-control" name="email" id="email" value="{{old('email')}}">
                </div>
                <div class="form-group">
                    <label for="password">password</label>
                    <input type="password" class="form-control" name="password" id="password">
                </div>
                <div class="form-group">
                    <label for="profesion_id">Profesion</label>
                    <select class="form-control" id="profesion_id" name="profesion_id" value="{{old('profesion_id')}}">
                        <option>seleccione una opcion</option>
                        @foreach($professions as $profession)
                            <option>{{$profession->titulo}}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">crear usuario</button>
                <a class="btn btn-link" href="{{route('usuarios')}}">Regresar al listado de Usuarios</a>
            </form>

        </div>
    </div>
@endsection