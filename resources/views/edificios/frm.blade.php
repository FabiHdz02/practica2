@extends("menu2")

@section("contenido2")

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Formulario */
    .container h2, 
    .container label, 
    .container .form-control, 
    .container .btn {
        font-family: 'Poppins', sans-serif;
    }

    /* Encabezados */
    .container h2 {
        font-weight: 700;
        font-size: 2rem;
        margin-bottom: 20px;
    }

    /* Etiquetas */
    .form-label {
        font-weight: 500;
        font-size: 0.95rem;
    }

    /* Campos de entrada */
    .form-control {
        font-weight: 400;
        font-size: 0.9rem;
        padding: 10px 15px;
    }

    /* Botones */
    .btn {
        font-weight: 600;
        font-size: 0.95rem;
        text-transform: uppercase;
    }

    /* Línea de sección */
    .section-divider {
        width: 60px;
        height: 4px;
        background: #007bff;
        margin-top: -5px;
        margin-bottom: 20px;
        border-radius: 2px;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <!-- Errores de validación -->
            @if ($errors->any())
                <div class="alert alert-danger shadow rounded mb-4">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Título dinámico -->
            <div class="text-center mb-4">
                <h2 class="text-dark fw-bold">
                    @if ($accion == 'C')
                        Registrar Edificio
                    @elseif ($accion == 'E')
                        Editar Edificio
                    @elseif ($accion == 'D')
                        Eliminar Edificio
                    @endif
                </h2>
            </div>

            <!-- Formulario -->
            <form 
                action="{{ 
                    $accion == 'C' ? route('edificios.store') : 
                    ($accion == 'E' ? route('edificios.update', $edificio->id) : 
                    route('edificios.destroy', $edificio->id)) 
                }}" 
                method="POST" 
                class="p-5 rounded shadow-lg bg-gradient"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E') @method('PUT') @endif
                @if ($accion == 'D') @method('DELETE') @endif

                <!-- Sección: Información del Edificio -->
                <h5 class="fw-bold">Información del Edificio</h5>
                <hr class="section-divider">
                <div class="row">
                    <!-- Nombre Edificio -->
                    <div class="col-md-6 mb-3">
                        <label for="nombreedificio" class="form-label">Nombre Edificio</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="nombreedificio" 
                            name="nombreedificio" 
                            value="{{ old('nombreedificio', $edificio->nombreedificio) }}" 
                            {{ $des }}
                        >
                        @error("nombreedificio")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nombre Corto -->
                    <div class="col-md-6 mb-3">
                        <label for="nombrecorto" class="form-label">Nombre Corto</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="nombrecorto" 
                            name="nombrecorto" 
                            value="{{ old('nombrecorto', $edificio->nombrecorto) }}" 
                            {{ $des }}
                        >
                        @error("nombrecorto")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="text-center mt-4">
                    @if (!empty($txtbtn))
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">{{ $txtbtn }}</button>
                    @endif
                    <a href="{{ route('edificios.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection