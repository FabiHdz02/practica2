@extends("menu2")

@section("contenido2")

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    /* Formulario */
    .container h2, 
    .container h5, 
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
                        Registrar Retícula
                    @elseif ($accion == 'E')
                        Editar Retícula
                    @elseif ($accion == 'D')
                        Eliminar Retícula
                    @endif
                </h2>
            </div>

            <!-- Formulario -->
            <form 
                action="{{ 
                    $accion == 'C' ? route('reticulas.store') : 
                    ($accion == 'E' ? route('reticulas.update', $reticula->id) : 
                    route('reticulas.destroy', $reticula->id)) 
                }}" 
                method="POST" 
                class="p-5 rounded shadow-lg bg-gradient"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E') @method('PUT') @endif
                @if ($accion == 'D') @method('DELETE') @endif

                <!-- Sección: Detalles de la Retícula -->
                <h5 class="fw-bold">Detalles de la Retícula</h5>
                <hr class="section-divider">
                <div class="row">
                    <!-- ID Retícula -->
                    <div class="col-md-6 mb-3">
                        <label for="idreticula" class="form-label">ID Retícula</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="idreticula" 
                            name="idreticula" 
                            value="{{ old('idreticula', $reticula->idreticula ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                        @error("idreticula")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Descripción -->
                    <div class="col-md-6 mb-3">
                        <label for="descripcion" class="form-label">Descripción</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="descripcion" 
                            name="descripcion" 
                            value="{{ old('descripcion', $reticula->descripcion ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                        @error("descripcion")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <!-- Fecha de Vigencia -->
                    <div class="col-md-6 mb-3">
                        <label for="fechavigor" class="form-label">Fecha de Vigencia</label>
                        <input 
                            type="date" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="fechavigor" 
                            name="fechavigor" 
                            value="{{ old('fechavigor', $reticula->fechavigor ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                        @error("fechavigor")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Carrera -->
                    <div class="col-md-6 mb-3">
                        <label for="carrera_id" class="form-label">Carrera</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="carrera_id" 
                            name="carrera_id" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                            <option value="" disabled selected>Selecciona una Carrera</option>
                            @foreach ($carreras as $carrera)
                                <option 
                                    value="{{ $carrera->id }}" 
                                    {{ old('carrera_id', $reticula->carrera_id ?? '') == $carrera->id ? 'selected' : '' }}
                                >
                                    {{ $carrera->nombrecarrera }}
                                </option>
                            @endforeach
                        </select>
                        @error("carrera_id")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="text-center mt-4">
                    @if ($accion == 'C' || $accion == 'E')
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                            {{ $accion == 'C' ? 'Registrar' : 'Actualizar' }}
                        </button>
                    @elseif ($accion == 'D')
                        <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill shadow-sm">Eliminar</button>
                    @endif
                    <a href="{{ route('reticulas.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
