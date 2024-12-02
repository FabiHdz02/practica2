<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TecnoBugs - Menú Principal</title>
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

        .hero-section {
            padding: 6rem 0;
            background: linear-gradient(120deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 0 0 3rem 3rem;
            margin-bottom: 4rem;
        }

        .hero-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }

        .hero-subtitle {
            font-size: 1.25rem;
            color: #475569;
            margin-bottom: 2rem;
        }

        .tech-stack {
            padding: 4rem 0;
            background: white;
            border-radius: 1.5rem;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        .tech-stack h2 {
            color: #1e293b;
            font-weight: 700;
            margin-bottom: 2rem;
            text-align: center;
        }

        .tech-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            margin: 0.5rem;
            background: white;
            border-radius: 1rem;
            transition: transform 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .tech-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.05);
        }

        .tech-item img {
            width: 2.5rem;
            height: 2.5rem;
            margin-right: 1rem;
        }

        .tech-item a {
            color: #4b5563;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .tech-item a:hover {
            color: var(--primary-color);
        }

        footer {
            background: #1e293b;
            color: white;
            padding: 3rem 0;
            margin-top: 4rem;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand animate__animated animate__fadeIn" href="#">TecnoBugs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeIn" href="{{ url('/acerca') }}">Acerca de</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeIn" href="{{ url('/contactanos') }}">Contáctanos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeIn" href="{{ url('/ayuda') }}">Ayuda</a>
                    </li>
                    @guest
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeIn" href="{{route('login')}}">Iniciar Sesión</a>
                    </li>
                    @endguest
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeIn" href="{{route('register')}}">Registrarte</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-8 mx-auto text-center">
                    <h1 class="hero-title animate__animated animate__fadeInUp">¡Bienvenido a TecnoBugs!</h1>
                    <p class="hero-subtitle animate__animated animate__fadeInUp animate__delay-1s">
                        Descubre lo que ofrecemos en nuestro sitio web, un sistema de horarios universitario.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <section class="tech-stack">
        <div class="container">
            <h2 class="animate__animated animate__fadeInUp">Tecnologías que utilizamos</h2>
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="tech-item animate__animated animate__fadeInUp">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/bootstrap/bootstrap-original.svg" alt="Bootstrap">
                        <a href="https://getbootstrap.com/" target="_blank">Bootstrap - Framework CSS moderno y responsivo</a>
                    </div>
                    <div class="tech-item animate__animated animate__fadeInUp">
                        <img src="https://laravel.com/img/logotype.min.svg" alt="Laravel">
                        <a href="https://laravel.com/" target="_blank">Laravel - El framework PHP para artesanos web</a>
                    </div>
                    <div class="tech-item animate__animated animate__fadeInUp">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg" alt="Vue.js">
                        <a href="https://vuejs.org/" target="_blank">Vue.js - Framework JavaScript progresivo</a>
                    </div>
                    <div class="tech-item animate__animated animate__fadeInUp">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jquery/jquery-original.svg" alt="jQuery">
                        <a href="https://jquery.com/" target="_blank">jQuery - Biblioteca JavaScript rápida y versátil</a>
                    </div>
                    <div class="tech-item animate__animated animate__fadeInUp">
                        <img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP">
                        <a href="https://www.php.net/" target="_blank">PHP - Lenguaje de programación del lado del servidor</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <p>&copy; 2024 TecnoBugs. Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>