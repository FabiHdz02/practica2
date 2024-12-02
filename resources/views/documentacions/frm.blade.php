@extends("menu2")

@section("contenido2")

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    h3 {
        font-size: 1.8rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 20px;
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
    .alert-danger {
        font-size: 0.9rem;
    }
    .section-divider {
        width: 60px;
        height: 4px;
        background: #007bff;
        margin: 20px auto;
        border-radius: 2px;
    }
    .text-muted {
        font-size: 0.85rem;
    }
</style>

<div class="container mt-5" style="max-width: 800px;">
    <!-- Título -->
    <h3>
        {{ $accion == 'C' ? 'Registrar Documentación' : 'Editar Documentación' }}
    </h3>
    <hr class="section-divider">

    <!-- Errores -->
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
        action="{{ $accion == 'C' ? route('documentacions.store') : route('documentacions.update', $documentacion->id) }}" 
        method="POST" 
        enctype="multipart/form-data" 
        class="p-5 rounded shadow-lg bg-gradient"
        style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
    >
        @csrf
        @if ($accion == 'E') @method('PUT') @endif

        <!-- Redirección -->
        @if ($redirectTo)
            <input type="hidden" name="redirect_to" value="{{ $redirectTo }}">
        @endif

        <!-- Alumno -->
        <div class="row mb-3">
            <label for="alumno_id" class="col-sm-4 form-label">Alumno:</label>
            <div class="col-sm-8">
                <select class="form-select" id="alumno_id" name="alumno_id" required>
                    <option value="" disabled selected>Seleccione un alumno</option>
                    @foreach ($alumnos as $alumno)
                        <option value="{{ $alumno->id }}" {{ old('alumno_id', $documentacion->alumno_id ?? '') == $alumno->id ? 'selected' : '' }}>
                            {{ $alumno->nombre }} {{ $alumno->apellidop }}
                        </option>
                    @endforeach
                </select>
                @error('alumno_id')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
        </div>

        <!-- Tipo de Inscripción -->
        <div class="row mb-3">
            <label for="tipoinsc_id" class="col-sm-4 form-label">Tipo de Inscripción:</label>
            <div class="col-sm-8">
                @if ($tipoinscSeleccionado && $accion == 'E')
                    <p id="tipoInscText" class="form-control-plaintext">{{ $tipoinscSeleccionado->tipo }}</p>
                    <input type="hidden" id="tipoinsc_id" name="tipoinsc_id" value="{{ $tipoinscSeleccionado->id }}">
                @else
                    <p id="tipoInscText" class="form-control-plaintext">Seleccione un alumno para determinar el tipo de inscripción</p>
                    <input type="hidden" id="tipoinsc_id" name="tipoinsc_id">
                @endif
            </div>
        </div>

        <!-- Archivos -->
        @foreach (['curp' => 'CURP', 'certificado' => 'Certificado', 'cdomi' => 'Comprobante de Domicilio', 'actanac' => 'Acta de Nacimiento'] as $field => $label)
            <div class="row mb-3">
                <label for="{{ $field }}" class="col-sm-4 form-label">{{ $label }}:</label>
                <div class="col-sm-8">
                    <input 
                        type="file" 
                        class="form-control" 
                        id="{{ $field }}" 
                        name="{{ $field }}" 
                        accept=".pdf, .jpg, .jpeg, .png" 
                        {{ $documentacion->$field ? 'data-existing-file="true"' : '' }}
                    >
                    @if ($documentacion->$field)
                        <p class="text-muted mt-2">
                            Archivo actual: 
                            <a href="{{ asset('storage/' . $documentacion->$field) }}" target="_blank">{{ basename($documentacion->$field) }}</a>
                        </p>
                    @endif
                    @error($field)
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
        @endforeach

        <!-- Botones -->
        <div class="text-center">
            <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">{{ $txtbtn }}</button>
            <a href="{{ route('documentacions.index') }}" id="regresarButton" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>

            <script>
                // Obtener la URL de referencia
                const referer = document.referrer;
            
                // Verificar si la URL contiene 'horario_alumnos'
                if (referer.includes('horario_alumnos')) {
                    // Si contiene 'horario_alumnos', modificar el enlace para redirigir a 'horario_alumnos.index'
                    document.getElementById('regresarButton').setAttribute('href', '{{ route('horario_alumnos.index') }}');
                }
                // Agrega más condiciones si es necesario para otros casos específicos, por ejemplo:
                else if (referer.includes('alumnos')) {
                    // Si la URL contiene 'alumnos', puedes redirigir a una ruta diferente, si lo deseas
                    document.getElementById('regresarButton').setAttribute('href', '{{ route('alumnos.index') }}');
                }
            </script>
            
            @if ($accion == 'E' && $pago)
                <a 
                    href="{{ route('pagos.edit', ['pago' => $pago->id, 'redirect_to' => $redirectTo]) }}" 
                    id="nextButton" 
                    class="btn btn-success px-4 py-2 rounded-pill shadow-sm" 
                    aria-disabled="true"
                >
                    Siguiente
                </a>
            @endif
        </div>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alumnoSelect = document.getElementById('alumno_id');
        const tipoInscText = document.getElementById('tipoInscText');
        const tipoInscInput = document.getElementById('tipoinsc_id');

        if (alumnoSelect) {
            alumnoSelect.addEventListener('change', function () {
                const alumnoId = this.value;

                if (!alumnoId) {
                    tipoInscText.textContent = 'Seleccione un alumno para determinar el tipo de inscripción';
                    tipoInscInput.value = '';
                    return;
                }

                fetch('{{ route('tipoinsc.get') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    },
                    body: JSON.stringify({ alumno_id: alumnoId }),
                })
                .then(response => response.json())
                .then(data => {
                    tipoInscText.textContent = data.error ? 'Error: ' + data.error : data.tipo;
                    tipoInscInput.value = data.id || '';
                })
                .catch(() => tipoInscText.textContent = 'Ocurrió un error al obtener el tipo de inscripción');
            });
        }
    });
</script>

@endsection