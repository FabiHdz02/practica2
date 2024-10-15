<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Principal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9; /* Fondo gris claro */
        }
        .navbar {
            background-color: #5c6bc0; /* Azul formal */
        }
        .navbar-brand, .nav-link {
            color: #ffffff !important; /* Texto blanco en la barra de navegación */
        }
        .navbar-brand:hover, .nav-link:hover {
            color: #ffd740 !important; /* Color amarillo al pasar el mouse */
        }
        .jumbotron {
            background-color: #c5cae9; /* Azul pastel */
            border-radius: 10px;
            padding: 40px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px; /* Espaciado superior */
        }
        .display-4 {
            color: #1a237e; /* Color azul oscuro para el título */
        }
        .lead {
            color: #424242; /* Color gris oscuro para el texto secundario */
        }
        footer a:hover {
            text-decoration: underline; /* Subrayado al pasar el mouse sobre el enlace */
        }
        .icon {
            width: 24px; /* Tamaño del icono */
            height: 24px; /* Tamaño del icono */
            margin-right: 8px; /* Espaciado a la derecha del icono */
            vertical-align: middle; /* Alinear verticalmente el icono con el texto */
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg navbar-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Web App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Acerca de</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contáctanos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ayuda</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('login')}}">Iniciar Sesión</a>
                    </li>
                    @endguest
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('register')}}">Registrarte</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="jumbotron">
            <h1 class="display-4 text-center">¡Bienvenido a la Web App!</h1>
            <p class="lead text-center">Aquí encontrarás información importante para tu desarrollo.</p>
        </div>
    </div>

    <footer class="py-3">
        <div class="container">
            <h5>Recursos y Tecnologías Utilizadas:</h5>
            <ul class="list-unstyled">
                <li>
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" alt="Bootstrap" class="icon">
                    <a href="https://getbootstrap.com/" target="_blank">Bootstrap</a>
                </li>
                <li>
                    <img src="https://laravel.com/img/logotype.min.svg" alt="Laravel" class="icon">
                    <a href="https://laravel.com/" target="_blank">Laravel</a>
                </li>
                <li>
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg" alt="Vue.js" class="icon">
                    <a href="https://vuejs.org/" target="_blank">Vue.js</a>
                </li>
                <li>
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jquery/jquery-original.svg" alt="jQuery" class="icon">
                    <a href="https://jquery.com/" target="_blank">jQuery</a>
                </li>
                <li>
                    <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP" class="icon">
                    <a href="https://www.php.net/" target="_blank">PHP</a>
                </li>
            </ul>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
