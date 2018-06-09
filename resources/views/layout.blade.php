<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <link rel="icon" href={{asset('favicon.ico')}}>
    <link rel="stylesheet" href={{asset('css/bootstrap.min.css')}}>
    <link rel="stylesheet" href={{asset('css/sty.css')}}>
</head>
<body>
<div class="container-fluid">
<header class="row">
    <div class="col">
        <nav class="navbar navbar-toggle navbar-light bg-dark">
            <ul class="nav mr-auto">
                <li class="navbar-item">
                    <a class="nav-link "  href="{{route('inicio')}}">Inicio</a>
                </li>
                @if(auth()->check())
                    @if(auth()->user()->hasRoles(['administrador','supervisor']))
                    <li class="navbar-item">
                        <a class="nav-link " href="{{route('usuarios')}}">Usuarios</a>
                    </li>
                    @endif
                    <li class="navbar-item">
                        <a class="nav-link " href="{{route('cliente')}}">Clientes</a>
                    </li>
                    <li class="dropdown navbar-item">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{auth()->user()->name}}</a>
                        <ul class="dropdown-menu bg-dark">
                            <li class="navbar-item">
                                <a href="{{route('detalle',['id'=>auth()->user()->id])}}" class="nav-link">Mi cuenta</a>
                                <a class="nav-link" href="{{route('logout')}}">cerrar sesion</a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="navbar-item">
                        <a class="nav-link" href="{{route('login')}}">iniciar sesion</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>
</div>
<div class="container">
    <div class="row">
        <div class="col">
            @yield('contenido')
           <!-- <h1>{{request()->is('/')?'estas en home':'no estas en home'}}</h1>-->
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <footer class="footer">
            <div class="container">
                <h2 class="font-italic">LARAVEL</h2>
            </div>
        </footer>
    </div>
</div>
<script src={{asset('js/popper.min.js')}}></script>
<script src={{asset('js/jquery-3.3.1.min.js')}}></script>
<script src={{asset('js/bootstrap.min.js')}}></script>
</body>
</html>