<!-- resources/views/menu1/contacto.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contáctanos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

    <!-- Encabezado -->
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1 class="display-4">Contáctanos</h1>
            <p class="lead">Estamos aquí para ayudarte. Completa el formulario a continuación.</p>
        </div>
    </header>

    <!-- Formulario de Contacto -->
    <section class="py-5">
        <div class="container">
            <form>
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre</label>
                    <input type="text" class="form-control" id="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" required>
                </div>
                <div class="mb-3">
                    <label for="mensaje" class="form-label">Mensaje</label>
                    <textarea class="form-control" id="mensaje" rows="4" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>
        </div>
    </section>

    <!-- Pie de página -->
    <footer class="bg-dark text-white text-center py-4">
        <div class="container">
            <p>&copy; 2024 Mi Sitio Web. Todos los derechos reservados.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
