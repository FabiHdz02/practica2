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

        /* Aseguramos que el contenido ocupe el 100% de la altura de la ventana */
        html, body {
            height: 100%;
            margin: 0;
        }

        /* Flexbox para la estructura de la página */
        body {
            display: flex;
            flex-direction: column;
            font-family: 'Segoe UI', system-ui, -apple-system, sans-serif;
            background: linear-gradient(135deg, var(--background-light) 0%, #ffffff 100%);
        }

        .content {
            flex-grow: 1; /* Esto hace que el contenido principal ocupe el espacio disponible */
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
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand animate__animated animate__fadeIn" href="http://practica2.test/">TecnoBugs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav me-auto my-2 my-lg-0">
                   
                </ul>
            </div>
            @auth
            <form action="{{route('logout')}}" method="post" class="d-inline">
                @csrf
                <button class="btn btn-logout" type="submit">Cerrar Sesión</button>
            </form>
            @endauth
        </div>
    </nav>

    <div style="margin-top: 5rem;">
        <!-- Texto de bienvenida condicional -->
        @hasSection('contenido2')
            @yield("contenido2")
        @else
            <div class="content" style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 100vh; text-align: center;">
                <h1 class="animate__animated animate__fadeIn" style="font-size: 3rem; font-weight: bold;">¡Bienvenido, {{ Auth::user()->name }}!</h1>
                <p class="animate__animated animate__fadeIn" style="font-size: 1.5rem; margin-top: 1rem;">Aqui podrás gestionar tu horario escolar.</p>
                
                <!-- Botón que redirige a la página de horarios -->
                <a href="{{ route('horario_alumnos.index') }}" class="btn btn-primary animate__animated animate__fadeIn" style="margin-top: 2rem; font-size: 1.2rem;">Continuar</a>
            </div>
        @endif
    </div>
    
    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <span>Email: {{ Auth::user()->email }} | Usuario: {{ Auth::user()->name }}</span>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
