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
                        Registrar Alumno
                    @elseif ($accion == 'E')
                        Editar Alumno
                    @elseif ($accion == 'D')
                        Eliminar Alumno
                    @endif
                </h2>
            </div>

            <!-- Formulario -->
            <form 
                action="{{ 
                    $accion == 'C' ? route('alumnos.store') : 
                    ($accion == 'E' ? route('alumnos.update', $alumno->id) : 
                    route('alumnos.destroy', $alumno->id)) 
                }}" 
                method="POST" 
                class="p-5 rounded shadow-lg bg-gradient"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E') @method('PUT') @endif
                @if ($accion == 'D') @method('DELETE') @endif

                <!-- Sección: Información del Alumno -->
                <h5 class="fw-bold">Información del Alumno</h5>
                <hr class="section-divider">
                <div class="row">
                    <!-- No Control -->
                    <div class="col-md-6 mb-3">
                        <label for="noctrl" class="form-label">No Control</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="noctrl" 
                            name="noctrl" 
                            value="{{ old('noctrl', $alumno->noctrl) }}" 
                            {{ $des }}
                        >
                        @error("noctrl")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="nombre" 
                            name="nombre" 
                            value="{{ old('nombre', $alumno->nombre) }}" 
                            {{ $des }}
                        >
                        @error("nombre")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <!-- Apellido Paterno -->
                    <div class="col-md-6 mb-3">
                        <label for="apellidop" class="form-label">Apellido Paterno</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="apellidop" 
                            name="apellidop" 
                            value="{{ old('apellidop', $alumno->apellidop) }}" 
                            {{ $des }}
                        >
                        @error("apellidop")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Apellido Materno -->
                    <div class="col-md-6 mb-3">
                        <label for="apellidom" class="form-label">Apellido Materno</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="apellidom" 
                            name="apellidom" 
                            value="{{ old('apellidom', $alumno->apellidom) }}" 
                            {{ $des }}
                        >
                        @error("apellidom")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <!-- Sexo -->
                    <div class="col-md-6 mb-3">
                        <label for="sexo" class="form-label">Sexo</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="sexo" 
                            name="sexo" 
                            {{ $des }}
                        >
                            <option value="" disabled {{ old('sexo', $alumno->sexo) == '' ? 'selected' : '' }}>Selecciona sexo</option>
                            <option value="M" {{ old('sexo', $alumno->sexo) == 'M' ? 'selected' : '' }}>M</option>
                            <option value="F" {{ old('sexo', $alumno->sexo) == 'F' ? 'selected' : '' }}>F</option>
                        </select>
                        @error("sexo")
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
                            {{ $des }}
                        >
                            <option value="">Selecciona una carrera</option>
                            @foreach ($carreras as $carrera)
                                <option value="{{ $carrera->id }}" {{ old('carrera_id', $alumno->carrera_id) == $carrera->id ? 'selected' : '' }}>
                                    {{ $carrera->nombrecarrera }}
                                </option>
                            @endforeach
                        </select>
                        @error("carrera_id")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Semestre -->
                @if ($accion == 'E')
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="semestre" class="form-label">Semestre</label>
                            <input 
                                type="text" 
                                class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                                id="semestre" 
                                name="semestre" 
                                value="{{ old('semestre', $alumno->semestre) }}" 
                                {{ $des }}
                            >
                            @error("semestre")
                                <p class="text-danger">Error en: {{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                @else
                    <input type="hidden" id="semestre" name="semestre" value="1">
                @endif

                <!-- Botones -->
                <div class="text-center mt-4">
                    @if (!empty($txtbtn))
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">{{ $txtbtn }}</button>
                    @endif
                    <a href="{{ route('alumnos.index') }}" id="regresarButton" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>

                    <script>
                        // Obtener la URL de referencia
                        const referer = document.referrer;
                        if (referer.includes('horario_alumnos')) {
                            document.getElementById('regresarButton').setAttribute('href', '{{ route('horario_alumnos.index') }}');
                        }
                    </script>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection