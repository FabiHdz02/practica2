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
                        Registrar Carrera
                    @elseif ($accion == 'E')
                        Editar Carrera
                    @elseif ($accion == 'D')
                        Eliminar Carrera
                    @endif
                </h2>
            </div>

            <!-- Formulario -->
            <form 
                action="{{ 
                    $accion == 'C' ? route('carreras.store') : 
                    ($accion == 'E' ? route('carreras.update', $carrera->id) : 
                    route('carreras.destroy', $carrera->id)) 
                }}" 
                method="POST" 
                class="p-5 rounded shadow-lg bg-gradient"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E') @method('PUT') @endif
                @if ($accion == 'D') @method('DELETE') @endif

                <!-- Sección: Detalles de la Carrera -->
                <h5 class="fw-bold">Detalles de la Carrera</h5>
                <hr class="section-divider">
                <div class="row">
                    <!-- ID Carrera -->
                    <div class="col-md-6 mb-3">
                        <label for="idcarrera" class="form-label">ID Carrera</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="idcarrera" 
                            name="idcarrera" 
                            value="{{ old('idcarrera', $carrera->idcarrera) }}" 
                            {{ $des }}
                        >
                        @error("idcarrera")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nombre Completo -->
                    <div class="col-md-6 mb-3">
                        <label for="nombrecarrera" class="form-label">Nombre Completo</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="nombrecarrera" 
                            name="nombrecarrera" 
                            value="{{ old('nombrecarrera', $carrera->nombrecarrera) }}" 
                            {{ $des }}
                        >
                        @error("nombrecarrera")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <!-- Nombre Mediano -->
                    <div class="col-md-6 mb-3">
                        <label for="nombremediano" class="form-label">Nombre Mediano</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="nombremediano" 
                            name="nombremediano" 
                            value="{{ old('nombremediano', $carrera->nombremediano) }}" 
                            {{ $des }}
                        >
                        @error("nombremediano")
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
                            value="{{ old('nombrecorto', $carrera->nombrecorto) }}" 
                            {{ $des }}
                        >
                        @error("nombrecorto")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Departamento -->
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label for="depto_id" class="form-label">Departamento</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="depto_id" 
                            name="depto_id" 
                            {{ $des }}
                        >
                            @foreach ($deptos as $depto)
                                <option value="{{ $depto->id }}" {{ old('depto_id', $carrera->depto_id) == $depto->id ? 'selected' : '' }}>
                                    {{ $depto->nombredepto }}
                                </option>
                            @endforeach
                        </select>
                        @error("depto_id")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Botones -->
                <div class="text-center mt-4">
                    @if (!empty($txtbtn))
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">{{ $txtbtn }}</button>
                    @endif
                    <a href="{{ route('carreras.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection