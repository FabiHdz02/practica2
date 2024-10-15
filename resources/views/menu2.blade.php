<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu S</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
        .icon {
            width: 24px; /* Tamaño del icono */
            height: 24px; /* Tamaño del icono */
            margin-right: 8px; /* Espaciado a la derecha del icono */
            vertical-align: middle; /* Alinear verticalmente el icono con el texto */
        }
        .btn-logout {
            color: #ffffff; /* Texto blanco */
            transition: background-color 0.3s, color 0.3s; /* Transiciones suaves */
        }
        .btn-logout:hover {
            background-color: #ffd740; /* Fondo amarillo al pasar el mouse */
            color: #5c6bc0; /* Texto azul formal */
        }
    </style>
</head>
<body>

    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Web App</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catálogos
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Periodos</a></li>
                            <li><a class="dropdown-item" href="#">Plazas</a></li>
                            <li><a class="dropdown-item" href="#">Puestos</a></li>
                            <li><a class="dropdown-item" href="#">Personal</a></li>
                            <li><a class="dropdown-item" href="#">Deptos.</a></li>
                            <li><a class="dropdown-item" href="#">Carreras</a></li>
                            <li><a class="dropdown-item" href="#">Retículas</a></li>
                            <li><a class="dropdown-item" href="#">Materias</a></li>
                            <li><a class="dropdown-item" href="#">Alumnos</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Horarios
                        </a>
                        <ul class="dropdown-menu">
                            <li class="d-flex justify-content-around">
                                <a class="dropdown-item" href="#">Docentes</a>
                                <a class="dropdown-item" href="#">Alumnos</a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Proyectos Individuales
                        </a>
                        <ul class="dropdown-menu">
                            <li class="d-flex justify-content-around">
                                <a class="dropdown-item" href="#">Capacitación</a>
                                <a class="dropdown-item" href="#">Asesorías Doc.</a>
                                <a class="dropdown-item" href="#">Proyectos</a>
                                <a class="dropdown-item" href="#">Material Didáctico</a>
                                <a class="dropdown-item" href="#">Docencia e Inv.</a>
                                <a class="dropdown-item" href="#">Asesoría Proyectos Ext.</a>
                                <a class="dropdown-item" href="#">Asesoría a S.S.</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Instrumentación</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Tutorías</a>
                    </li>
                    <li class="nav-item" style="display: flex; align-items: center;">
                        <label class="nav-link" for="periodo-select" style="cursor: pointer; margin-right: 10px;">Periodo:</label>
                        <select id="periodo-select" class="form-select" style="width: auto;">
                            <option value="ene-jun-24">Ene-Jun 24</option>
                            <option value="ago-dic-24">Ago-Dic 24</option>
                            <option value="ene-jun-25">Ene-Jun 25</option>
                        </select>
                    </li>                    
                    @auth
                        <li class="nav-item" role="presentation">
                          <form action="{{route('logout')}}" method="post" class="d-inline">
                            @csrf
                            <button class="btn btn-logout" type="submit">Cerrar Sesión</button>
                          </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4 jumbotron">
        <h1 class="display-4">Descripción del Sistema</h1>
        <p class="lead">Esta aplicación te permitirá acceder a catálogos, horarios y más.</p>
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container">
            <span class="text-muted">Email: {{ Auth::user()->email }} | Usuario: {{ Auth::user()->name }}</span>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
