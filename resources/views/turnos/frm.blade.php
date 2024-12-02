@extends('menu2')

@section('contenido2')

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .hero-section {
        padding: 30px 0;
        text-align: center;
    }

    .hero-title {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .container h1, 
    .container label, 
    .container .form-control, 
    .container .btn {
        font-family: 'Poppins', sans-serif;
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
    .form-label {
        font-weight: 500;
        font-size: 0.95rem;
    }

    .form-control, .form-select {
        font-weight: 400;
        font-size: 0.9rem;
        padding: 10px 15px;
    }

    .btn {
        font-weight: 600;
        font-size: 0.95rem;
        text-transform: uppercase;
    }

    .section-divider {
        width: 60px;
        height: 4px;
        background: #007bff;
        margin-top: -5px;
        margin-bottom: 20px;
        border-radius: 2px;
    }
</style>

<section class="hero-section">
    <div class="container">
        <h1 class="hero-title">
            @if ($accion == 'C')
                Registrar Turno
            @elseif ($accion == 'E')
                Editar Turno
            @endif
        </h1>
    </div>
</section>

<section class="tech-stack">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-lg-6">
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

                <!-- Formulario -->
                <form 
                    action="{{ $accion == 'C' ? route('turnos.store') : route('turnos.update', $turno->id) }}" 
                    method="POST" 
                    class="p-5 rounded shadow-lg bg-gradient"
                    style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
                >
                    @csrf
                    @if ($accion == 'E') @method('PUT') @endif

                    <!-- Fecha y Hora -->
                    <h5 class="fw-bold">Detalles del Turno</h5>
                    <hr class="section-divider">
                    <div class="row">
                        <!-- Fecha -->
                        <div class="col-md-6 mb-3">
                            <label for="fecha" class="form-label">Fecha</label>
                            <input 
                                type="date" 
                                class="form-control" 
                                id="fecha" 
                                name="fecha" 
                                value="{{ old('fecha', $turno->fecha ?? '') }}" 
                                required
                            >
                            @error('fecha')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Hora -->
                        <div class="col-md-6 mb-3">
                            <label for="hora" class="form-label">Hora</label>
                            <input 
                                type="time" 
                                class="form-control" 
                                id="hora" 
                                name="hora" 
                                value="{{ old('hora', $turno->hora ?? '') }}" 
                                required
                            >
                            @error('hora')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Código Canal -->
                    <div class="mb-3">
                        <label for="codigocanal" class="form-label">Código Canal</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="codigocanal" 
                            name="codigocanal" 
                            value="{{ old('codigocanal', $turno->codigocanal ?? '') }}" 
                            required
                        >
                        @error('codigocanal')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Alumno -->
                    <div class="mb-3">
                        <label for="alumno_id" class="form-label">Alumno</label>
                        <select 
                            class="form-select" 
                            id="alumno_id" 
                            name="alumno_id" 
                            required
                        >
                            <option value="" disabled selected>Seleccione un alumno</option>
                            @foreach ($alumnos as $alumno)
                                <option 
                                    value="{{ $alumno->id }}" 
                                    {{ old('alumno_id', $turno->alumno_id ?? '') == $alumno->id ? 'selected' : '' }}
                                >
                                    {{ $alumno->nombre }} {{ $alumno->apellidop }} {{ $alumno->apellidom }}
                                </option>
                            @endforeach
                        </select>
                        @error('alumno_id')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>

                    <!-- Botones -->
                    <div class="text-center mt-4">
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                            {{ $accion == 'C' ? 'Registrar' : 'Actualizar' }}
                        </button>
                        <a href="{{ route('turnos.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

@endsection