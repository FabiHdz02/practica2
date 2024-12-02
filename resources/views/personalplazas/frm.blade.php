@extends("menu2")

@section("contenido2")

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif; /* Aplica la fuente a toda la página */
    }

    /* Formulario */
    .container h2, 
    .container h5, 
    .container label, 
    .container .form-control, 
    .container .btn {
        font-family: 'Poppins', sans-serif; /* Aplica la fuente solo al formulario */
    }

    /* Encabezados */
    .container h2 {
        font-weight: 700; /* Más grueso */
        font-size: 2rem;
    }

    .container h5 {
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 10px;
    }

    /* Etiquetas */
    .form-label {
        font-weight: 500; /* Peso medio */
        font-size: 0.95rem;
    }

    /* Campos de entrada */
    .form-control, .form-select {
        font-weight: 400; /* Ligero */
        font-size: 0.9rem;
        padding: 10px 15px;
    }

    /* Botones */
    .btn {
        font-weight: 600;
        font-size: 0.95rem;
        text-transform: uppercase; /* Convierte el texto en mayúsculas */
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
        <div class="col-md-8">
            <!-- Mensajes de éxito -->
            @if(session('mensaje'))
                <div class="alert alert-info alert-dismissible fade show text-center shadow rounded-pill" role="alert">
                    {{ session('mensaje') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Errores de validación -->
            @if ($errors->any())
                <div class="alert alert-danger shadow rounded">
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
                        Registrar Personal Plaza
                    @elseif ($accion == 'E')
                        Editar Personal Plaza
                    @elseif ($accion == 'D')
                        Eliminar Personal Plaza
                    @endif
                </h2>
            </div>

            <!-- Formulario -->
            <form 
                action="{{ 
                    $accion == 'C' ? route('personalplazas.store') : 
                    ($accion == 'E' ? route('personalplazas.update', $personalPlaza->id) : 
                    route('personalplazas.destroy', $personalPlaza->id)) 
                }}" 
                method="POST" 
                class="p-5 rounded shadow-lg bg-gradient"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E') @method('PUT') @endif
                @if ($accion == 'D') @method('DELETE') @endif

                <!-- Sección 1: Información Básica -->
                <h5 class="fw-bold mb-3">Información Básica</h5>
                <hr class="section-divider">
                <!-- Tipo de Nombramiento -->
                <div class="mb-3">
                    <label for="tiponombramiento" class="form-label fw-bold">
                        <i class="fas fa-id-card-alt text-primary me-1"></i> Tipo de Nombramiento
                    </label>
                    <input 
                        type="number" 
                        class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                        id="tiponombramiento" 
                        name="tiponombramiento" 
                        value="{{ old('tiponombramiento', $personalPlaza->tiponombramiento ?? '') }}" 
                        {{ $accion == 'D' ? 'disabled' : '' }} 
                        required
                    >
                </div>

                <!-- Plaza -->
                <div class="mb-3">
                    <label for="plaza_id" class="form-label fw-bold">
                        <i class="fas fa-building text-success me-1"></i> Plaza
                    </label>
                    <select 
                        class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                        id="plaza_id" 
                        name="plaza_id" 
                        {{ $accion == 'D' ? 'disabled' : '' }} 
                        required
                    >
                        <option value="" disabled selected>Seleccione una plaza</option>
                        @foreach ($plazas as $plaza)
                            <option value="{{ $plaza->id }}" {{ old('plaza_id', $personalPlaza->plaza_id ?? '') == $plaza->id ? 'selected' : '' }}>
                                {{ $plaza->idplaza }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Personal -->
                <div class="mb-3">
                    <label for="personal_id" class="form-label fw-bold">
                        <i class="fas fa-user text-info me-1"></i> Personal
                    </label>
                    <select 
                        class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                        id="personal_id" 
                        name="personal_id" 
                        {{ $accion == 'D' ? 'disabled' : '' }} 
                        required
                    >
                        <option value="" disabled selected>Seleccione un personal</option>
                        @foreach ($personales as $personal)
                            <option value="{{ $personal->id }}" {{ old('personal_id', $personalPlaza->personal_id ?? '') == $personal->id ? 'selected' : '' }}>
                                {{ $personal->nombres }} {{ $personal->apellidop }} {{ $personal->apellidom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botones -->
                <div class="text-center mt-4">
                    @if($accion == 'C' || $accion == 'E')
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                            {{ $accion == 'C' ? 'Registrar' : 'Actualizar' }}
                        </button>
                    @elseif($accion == 'D')
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill shadow-sm">
                            Eliminar
                        </button>
                    @endif
                    <a href="{{ route('personalplazas.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection