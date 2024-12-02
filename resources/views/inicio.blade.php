<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
    @if(Auth::check())
        {{-- Verificar el prefijo del correo del usuario --}}
        @php
            $email = Auth::user()->email;
        @endphp

        @if(str_starts_with($email, 'a'))
            {{-- Si el correo empieza con "a", incluir el menú de alumnos --}}
            @include("menu3")
            @yield("contenido3")
        @elseif(str_starts_with($email, 'd'))
            {{-- Si el correo empieza con "d", incluir el menú de docentes --}}
            @include("menu2")
            @yield("contenido2")
        @else
            {{-- Si no cumple con ninguna condición, mostrar un mensaje de acceso denegado --}}
            <p>Acceso denegado. No tienes permiso para acceder a este contenido.</p>
        @endif
    @else
        {{-- Usuario no autenticado, mostrar menú general --}}
        @include("menu1")
        @yield("contenido1")
    @endif
</body>
</html>
