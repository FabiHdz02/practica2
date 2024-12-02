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
                        Registrar Puesto
                    @elseif ($accion == 'E')
                        Editar Puesto
                    @elseif ($accion == 'D')
                        Eliminar Puesto
                    @endif
                </h2>
            </div>

            <!-- Formulario -->
            <form 
                action="{{ 
                    $accion == 'C' ? route('puestos.store') : 
                    ($accion == 'E' ? route('puestos.update', $puesto->id) : 
                    route('puestos.destroy', $puesto->id)) 
                }}" 
                method="POST" 
                class="p-5 rounded shadow-lg bg-gradient"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E') @method('PUT') @endif
                @if ($accion == 'D') @method('DELETE') @endif

                <!-- Sección: Detalles del Puesto -->
                <h5 class="fw-bold">Detalles del Puesto</h5>
                <hr class="section-divider">
                <div class="row">
                    <!-- ID Puesto -->
                    <div class="col-md-6 mb-3">
                        <label for="idpuesto" class="form-label">ID Puesto</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="idpuesto" 
                            name="idpuesto" 
                            value="{{ old('idpuesto', $puesto->idpuesto ?? '') }}" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                        @error("idpuesto")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Nombre -->
                    <div class="col-md-6 mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="nombre" 
                            name="nombre" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                            <option value="">Seleccione un puesto</option>
                            <option value="Docente" {{ old('nombre', $puesto->nombre ?? '') == 'Docente' ? 'selected' : '' }}>Docente</option>
                            <option value="No docente" {{ old('nombre', $puesto->nombre ?? '') == 'No docente' ? 'selected' : '' }}>No docente</option>
                            <option value="Director" {{ old('nombre', $puesto->nombre ?? '') == 'Director' ? 'selected' : '' }}>Director</option>
                            <option value="Subdirector académico" {{ old('nombre', $puesto->nombre ?? '') == 'Subdirector académico' ? 'selected' : '' }}>Subdirector académico</option>
                            <option value="Subdirector de plantación" {{ old('nombre', $puesto->nombre ?? '') == 'Subdirector de plantación' ? 'selected' : '' }}>Subdirector de plantación</option>
                            <option value="Auxiliar de laboratorio" {{ old('nombre', $puesto->nombre ?? '') == 'Auxiliar de laboratorio' ? 'selected' : '' }}>Auxiliar de laboratorio</option>
                            <option value="Auxiliar de biblioteca" {{ old('nombre', $puesto->nombre ?? '') == 'Auxiliar de biblioteca' ? 'selected' : '' }}>Auxiliar de biblioteca</option>
                            <option value="Auxiliar de taller" {{ old('nombre', $puesto->nombre ?? '') == 'Auxiliar de taller' ? 'selected' : '' }}>Auxiliar de taller</option>
                            <option value="Jefe de recursos humanos" {{ old('nombre', $puesto->nombre ?? '') == 'Jefe de recursos humanos' ? 'selected' : '' }}>Jefe de recursos humanos</option>
                            <option value="Jefe académico" {{ old('nombre', $puesto->nombre ?? '') == 'Jefe académico' ? 'selected' : '' }}>Jefe académico</option>
                            <option value="Jefe división de estudiosos" {{ old('nombre', $puesto->nombre ?? '') == 'Jefe división de estudiosos' ? 'selected' : '' }}>Jefe división de estudiosos</option>
                        </select>
                        @error("nombre")
                            <p class="text-danger">Error en: {{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <!-- Tipo -->
                    <div class="col-md-12 mb-3">
                        <label for="tipo" class="form-label">Tipo</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="tipo" 
                            name="tipo" 
                            {{ $accion == 'D' ? 'disabled' : '' }}
                        >
                            <option value="" disabled {{ old('tipo', $puesto->tipo ?? '') == '' ? 'selected' : '' }}>Selecciona Tipo</option>
                            <option value="Docente" {{ old('tipo', $puesto->tipo ?? '') == 'Docente' ? 'selected' : '' }}>Docente</option>
                            <option value="Direccion" {{ old('tipo', $puesto->tipo ?? '') == 'Direccion' ? 'selected' : '' }}>Direccion</option>
                            <option value="Auxiliar" {{ old('tipo', $puesto->tipo ?? '') == 'Auxiliar' ? 'selected' : '' }}>Auxiliar</option>
                            <option value="Administrativo" {{ old('tipo', $puesto->tipo ?? '') == 'Administrativo' ? 'selected' : '' }}>Administrativo</option>
                        </select>
                        @error("tipo")
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
                    <a href="{{ route('puestos.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection