<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos</title>
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
        }

        .nav-link:hover {
            color: var(--primary-color);
        }

        .hero-section {
            padding: 6rem 0;
            background: linear-gradient(120deg, #f0f9ff 0%, #e0f2fe 100%);
            border-radius: 0 0 3rem 3rem;
            margin-bottom: 4rem;
            text-align: center;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 2rem;
            color: #1e293b;
        }

        footer {
            background: #1e293b;
            color: white;
            padding: 3rem 0;
            margin-top: 4rem;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Barra de navegación -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand animate__animated animate__fadeIn" href="#">TecnoBugs</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarScroll">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeIn" href="{{ url('/') }}">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link animate__animated animate__fadeIn active" href="{{ url('/contactanos') }}">Contáctanos</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Encabezado -->
    <section class="hero-section">
        <div class="container">
            <h1 class="display-4 animate__animated animate__fadeInDown">Contáctanos</h1>
            <p class="lead animate__animated animate__fadeInUp">Estamos aquí para ayudarte. Completa el formulario y nos pondremos en contacto contigo.</p>
        </div>
    </section>

    <!-- Sección de Contacto -->
    <section class="py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="section-title">Envíanos un Mensaje</h2>
                    <form>
                        <div class="mb-3">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" class="form-control" id="name" placeholder="Tu nombre completo">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" placeholder="tuemail@ejemplo.com">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Mensaje</label>
                            <textarea class="form-control" id="message" rows="5" placeholder="Escribe tu mensaje aquí"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h2 class="section-title">Información de Contacto</h2>
                    <ul class="list-unstyled">
                        <li><strong>Dirección:</strong> Av. Tecnológico 123, Piedras Negras, Coahuila</li>
                        <li><strong>Teléfono:</strong> +52 878 123 4567</li>
                        <li><strong>Email:</strong> soporte@tecnobugs.com</li>
                        <li><strong>Horario:</strong> Lunes a Viernes, 9:00 AM - 5:00 PM</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Pie de página -->
    <footer>
        <div class="container">
            <p>&copy; 2024 TecnoBugs. Todos los derechos reservados. Desarrollado con orgullo en el Instituto Tecnológico de Piedras Negras.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
