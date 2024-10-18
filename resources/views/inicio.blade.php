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
        @include("menu2")
        @yield("contenido2")
    @else
        @include("menu1")
        @yield("contenido1")
    @endif
</body>
</html>

