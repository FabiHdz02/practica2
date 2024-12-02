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
    .form-control {
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
        <div class="col-lg-8">
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
                        Registrar Periodo
                    @elseif ($accion == 'E')
                        Editar Periodo
                    @elseif ($accion == 'D')
                        Eliminar Periodo
                    @endif
                </h2>
            </div>

            <!-- Formulario -->
            <form 
                action="{{ 
                    $accion == 'C' ? route('periodos.store') : 
                    ($accion == 'E' ? route('periodos.update', $periodo->id) : 
                    route('periodos.destroy', $periodo->id)) 
                }}" 
                method="POST" 
                class="p-5 rounded shadow-lg bg-gradient"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E') @method('PUT') @endif
                @if ($accion == 'D') @method('DELETE') @endif

                <!-- Sección 1: Información básica -->
                <h5 class="fw-bold mb-3">Información Básica</h5>
                <hr class="section-divider">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="periodo" class="form-label fw-bold">
                            <i class="fas fa-calendar-alt text-primary me-1"></i> Periodo
                        </label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="periodo" 
                            name="periodo" 
                            value="{{ old('periodo', $periodo->periodo ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }} 
                            required
                        >
                    </div>
                    <div class="col-md-6">
                        <label for="desccorta" class="form-label fw-bold">
                            <i class="fas fa-file-alt text-success me-1"></i> Descripción Corta
                        </label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="desccorta" 
                            name="desccorta" 
                            value="{{ old('desccorta', $periodo->desccorta ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }} 
                            required
                        >
                    </div>
                </div>

                <!-- Sección 2: Fechas -->
                <h5 class="fw-bold mb-3">Fechas</h5>
                <hr class="section-divider">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fechaini" class="form-label fw-bold">
                            <i class="fas fa-play-circle text-primary me-1"></i> Fecha de Inicio
                        </label>
                        <input 
                            type="date" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="fechaini" 
                            name="fechaini" 
                            value="{{ old('fechaini', $periodo->fechaini ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }} 
                            required
                        >
                    </div>
                    <div class="col-md-6">
                        <label for="fechafin" class="form-label fw-bold">
                            <i class="fas fa-stop-circle text-danger me-1"></i> Fecha de Fin
                        </label>
                        <input 
                            type="date" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="fechafin" 
                            name="fechafin" 
                            value="{{ old('fechafin', $periodo->fechafin ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }} 
                            required
                        >
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="fechaapertura" class="form-label fw-bold">
                            <i class="fas fa-door-open text-success me-1"></i> Fecha de Apertura
                        </label>
                        <input 
                            type="date" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="fechaapertura" 
                            name="fechaapertura" 
                            value="{{ old('fechaapertura', $periodo->fechaapertura ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }} 
                            required
                        >
                    </div>
                    <div class="col-md-6">
                        <label for="fechacierre" class="form-label fw-bold">
                            <i class="fas fa-door-closed text-danger me-1"></i> Fecha de Cierre
                        </label>
                        <input 
                            type="date" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="fechacierre" 
                            name="fechacierre" 
                            value="{{ old('fechacierre', $periodo->fechacierre ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }} 
                            required
                        >
                    </div>
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
                    <a href="{{ route('periodos.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection