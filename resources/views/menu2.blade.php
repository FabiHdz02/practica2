<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Secundario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <style>
        :root {
            --primary-color: #2563eb;
            --secondary-color: #1e40af;
            --accent-color: #3b82f6;
            --background-light: #f8fafc;
        }

        body {
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, var(--background-light) 0%, #ffffff 100%);
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 1rem 2rem;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--primary-color);
            transition: color 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--secondary-color);
        }

        .nav-link {
            font-weight: 500;
            color: #4b5563;
            margin: 0 0.5rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 0;
            background-color: var(--primary-color);
            transition: width 0.3s ease;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .dropdown-menu {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .content {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 5rem 1rem;
        }

        footer {
            background: #1e293b;
            color: white;
            padding: 1rem 0;
        }

        .footer span {
            color: white;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand animate_animated animate_fadeIn" href="http://practica2.test/">TecnoBugs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0">
                    <!-- Validación para mostrar u ocultar opciones -->
                    @if (Str::lower(substr(Auth::user()->email, 0, 1)) === 'd')
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Catálogos</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="{{ route('periodos.index') }}">Periodos</a></li>
                                <li><a class="dropdown-item" href="{{ route('plazas.index') }}">Plazas</a></li>
                                <li><a class="dropdown-item" href="{{ route('personals.index') }}">Personal</a></li>
                                <li><a class="dropdown-item" href="{{ route('personalplazas.index') }}">Personal Plazas</a></li>
                                <li><a class="dropdown-item" href="{{ route('puestos.index') }}">Puestos</a></li>
                                <li><a class="dropdown-item" href="{{ route('deptos.index') }}">Deptos</a></li>
                                <li><a class="dropdown-item" href="{{ route('carreras.index') }}">Carreras</a></li>
                                <li><a class="dropdown-item" href="{{ route('reticulas.index') }}">Retículas</a></li>
                                <li><a class="dropdown-item" href="{{ route('materias.index') }}">Materias</a></li>
                                <li><a class="dropdown-item" href="{{ route('materiasa.index') }}">Materias Abiertas</a></li>
                                <li><a class="dropdown-item" href="{{ route('alumnos.index') }}">Alumnos</a></li>
                                <li><a class="dropdown-item" href="{{ route('edificios.index') }}">Edificios</a></li>
                                <li><a class="dropdown-item" href="{{ route('lugares.index') }}">Lugares</a></li>
                                <li><a class="dropdown-item" href="{{ route('tipoinscs.index') }}">Tipo Inscripcion</a></li>
                                <li><a class="dropdown-item" href="{{ route('tipopagos.index') }}">Tipo Pagos</a></li>
                                <li><a class="dropdown-item" href="{{ route('pagos.index') }}">Pagos</a></li>
                                <li><a class="dropdown-item" href="{{ route('turnos.index') }}">Turno</a></li>
                                <li><a class="dropdown-item" href="{{ route('documentacions.index') }}">Documentación</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">Horarios</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">Docentes</a></li>
                                <li><a class="dropdown-item" href="{{ route('grupos.index') }}">Grupo</a></li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">Proyectos Individuales</a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="">Capacitación</a></li>
                                <li><a class="dropdown-item" href="">Asesorías Doc.</a></li>
                                <li><a class="dropdown-item" href="">Proyectos</a></li>
                                <li><a class="dropdown-item" href="">Material Didáctico</a></li>
                                <li><a class="dropdown-item" href="">Docencia e Inv.</a></li>
                                <li><a class="dropdown-item" href="">Asesoría Proyectos Ext.</a></li>
                                <li><a class="dropdown-item" href="">Asesoría a S.S.</a></li>
                            </ul>
                        </li>
                    
                    <!-- Estas opciones se verán siempre -->
                    <li class="nav-item"><a class="nav-link" href="">Instrumentación</a></li>
                    <li class="nav-item"><a class="nav-link" href="">Tutorías</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('calificaciones.index') }}">Calificaciones</a></li>

                    <li class="nav-item" style="display: flex; align-items: center;">
                        <label class="nav-link" for="periodo-select" style="cursor: pointer; margin-right: 10px;">Periodo:</label>
                        <select id="periodo-select" class="form-select" style="width: auto;">
                            <option value="ene-jun-24">Ene-Jun 24</option>
                            <option value="ago-dic-24">Ago-Dic 24</option>
                            <option value="ene-jun-25">Ene-Jun 25</option>
                        </select>
                    </li>
                    @endif

                    @auth
                    <form action="{{route('logout')}}" method="post" class="d-inline">
                        @csrf
                        <button class="btn btn-logout" type="submit">Cerrar Sesión</button>
                    </form>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div style="margin-top: 5rem;">
        <!-- Texto de bienvenida condicional -->
        @hasSection('contenido2')
            @yield("contenido2")
        @else
            <div class="content" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh; text-align: center;">
                <h1 class="animate__animated animate__fadeIn" style="font-size: 3rem; font-weight: bold;">¡Bienvenido, {{ Auth::user()->name }}!</h1>
                <p class="animate__animated animate__fadeIn" style="font-size: 1.5rem; margin-top: 1rem;">Al sistema de horarios para docentes.</p>
                
            </div>
        @endif
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span>Email: {{ Auth::user()->email }} | Usuario: {{ Auth::user()->name }}</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Código para manejar dropdowns
        document.addEventListener("click", function(event) {
            const dropdowns = document.querySelectorAll(".dropdown-menu");
            dropdowns.forEach(function(dropdown) {
                if (!dropdown.parentNode.contains(event.target)) {
                    dropdown.classList.remove("show");
                }
            });
        });
    
        document.querySelectorAll(".dropdown").forEach(function(dropdown) {
            dropdown.addEventListener("mouseover", function() {
                const menu = dropdown.querySelector(".dropdown-menu");
                menu.classList.add("show");
            });
    
            dropdown.addEventListener("mouseout", function() {
                const menu = dropdown.querySelector(".dropdown-menu");
                menu.classList.remove("show");
            });
        });
    </script>
</body>
</html>
