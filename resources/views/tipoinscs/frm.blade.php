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
    .form-control, .form-select {
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
                        Registrar Tipo de Inscripción
                    @elseif ($accion == 'E')
                        Editar Tipo de Inscripción
                    @elseif ($accion == 'D')
                        Eliminar Tipo de Inscripción
                    @endif
                </h2>
            </div>

            <!-- Formulario -->
            <form 
                action="{{ 
                    $accion == 'C' ? route('tipoinscs.store') : 
                    ($accion == 'E' ? route('tipoinscs.update', $tipoinsc->id) : 
                    route('tipoinscs.destroy', $tipoinsc->id)) 
                }}" 
                method="POST" 
                class="p-5 rounded shadow-lg bg-gradient"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E') @method('PUT') @endif
                @if ($accion == 'D') @method('DELETE') @endif

                <!-- Sección: Información del Tipo de Inscripción -->
                <h5 class="fw-bold">Información del Tipo de Inscripción</h5>
                <hr class="section-divider">
                <div class="row">
                    <!-- Tipo -->
                    <div class="col-md-6 mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="tipo" 
                            name="tipo" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                            <option value="Inscripción" {{ old('tipo', $tipoinsc->tipo ?? '') == 'Inscripción' ? 'selected' : '' }}>Inscripción</option>
                            <option value="Reinscripción" {{ old('tipo', $tipoinsc->tipo ?? '') == 'Reinscripción' ? 'selected' : '' }}>Reinscripción</option>
                        </select>
                        @error("tipo")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Fecha -->
                    <div class="col-md-6 mb-3">
                        <label for="fecha" class="form-label">Fecha</label>
                        <input 
                            type="date" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="fecha" 
                            name="fecha" 
                            value="{{ old('fecha', $tipoinsc->fecha ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                        @error("fecha")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Periodo -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="periodo_id" class="form-label">Periodo</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="periodo_id" 
                            name="periodo_id" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                            <option value="" disabled selected>Seleccione un periodo</option>
                            @foreach ($periodos as $periodo)
                                <option 
                                    value="{{ $periodo->id }}" 
                                    {{ old('periodo_id', $tipoinsc->periodo_id ?? '') == $periodo->id ? 'selected' : '' }}
                                >
                                    {{ $periodo->periodo }}
                                </option>
                            @endforeach
                        </select>
                        @error("periodo_id")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="text-center mt-4">
                    @if ($accion != 'D')
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">{{ $txtbtn }}</button>
                    @else
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill shadow-sm">Eliminar</button>
                    @endif
                    <a href="{{ route('tipoinscs.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection