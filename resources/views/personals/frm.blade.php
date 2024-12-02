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

    .container h5 {
        font-weight: 600;
        font-size: 1.25rem;
        margin-bottom: 10px;
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
        <div class="col-lg-10">
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
                        Registrando Personal
                    @elseif ($accion == 'E')
                        Editando Personal
                    @elseif ($accion == 'D')
                        Eliminando Personal
                    @endif
                </h2>
            </div>

            <!-- Formulario -->
            <form 
                action="{{ 
                    $accion == 'C' ? route('personals.store') : 
                    ($accion == 'E' ? route('personals.update', $personal->id) : 
                    route('personals.destroy', $personal)) 
                }}" 
                method="POST" 
                class="p-5 rounded shadow-lg bg-gradient"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E') @method('PUT') @endif
                @if ($accion == 'D') @method('DELETE') @endif

                <!-- Sección 1: Información Básica -->
                <h5 class="fw-bold">Información Básica</h5>
                <hr class="section-divider">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="RFC" class="form-label">RFC</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="RFC" 
                            name="RFC" 
                            value="{{ old('RFC', $personal->RFC) }}" 
                            {{ $des }}
                        >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nombres" class="form-label">Nombres</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="nombres" 
                            name="nombres" 
                            value="{{ old('nombres', $personal->nombres) }}" 
                            {{ $des }}
                        >
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="apellidop" class="form-label">Apellido Paterno</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="apellidop" 
                            name="apellidop" 
                            value="{{ old('apellidop', $personal->apellidop) }}" 
                            {{ $des }}
                        >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="apellidom" class="form-label">Apellido Materno</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="apellidom" 
                            name="apellidom" 
                            value="{{ old('apellidom', $personal->apellidom) }}" 
                            {{ $des }}
                        >
                    </div>
                </div>

                <!-- Sección 2: Educación -->
                <h5 class="fw-bold">Educación</h5>
                <hr class="section-divider">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="licenciatura" class="form-label">Licenciatura</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="licenciatura" 
                            name="licenciatura" 
                            value="{{ old('licenciatura', $personal->licenciatura) }}" 
                            {{ $des }}
                        >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="lictit" class="form-label">Titulado</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="lictit" 
                            name="lictit" 
                            {{ $des }}
                        >
                            <option value="0" {{ old('lictit', $personal->lictit) == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('lictit', $personal->lictit) == 1 ? 'selected' : '' }}>Sí</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="especializacion" class="form-label">Especialización</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="especializacion" 
                            name="especializacion" 
                            value="{{ old('especializacion', $personal->especializacion) }}" 
                            {{ $des }}
                        >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="esptit" class="form-label">Titulado Especialización</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="esptit" 
                            name="esptit" 
                            {{ $des }}
                        >
                            <option value="0" {{ old('esptit', $personal->esptit) == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('esptit', $personal->esptit) == 1 ? 'selected' : '' }}>Sí</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="maestria" class="form-label">Maestría</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="maestria" 
                            name="maestria" 
                            value="{{ old('maestria', $personal->maestria) }}" 
                            {{ $des }}
                        >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="maetit" class="form-label">Titulado Maestría</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="maetit" 
                            name="maetit" 
                            {{ $des }}
                        >
                            <option value="0" {{ old('maetit', $personal->maetit) == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('maetit', $personal->maetit) == 1 ? 'selected' : '' }}>Sí</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="doctorado" class="form-label">Doctorado</label>
                        <input 
                            type="text" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="doctorado" 
                            name="doctorado" 
                            value="{{ old('doctorado', $personal->doctorado) }}" 
                            {{ $des }}
                        >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="doctit" class="form-label">Titulado Doctorado</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="doctit" 
                            name="doctit" 
                            {{ $des }}
                        >
                            <option value="0" {{ old('doctit', $personal->doctit) == 0 ? 'selected' : '' }}>No</option>
                            <option value="1" {{ old('doctit', $personal->doctit) == 1 ? 'selected' : '' }}>Sí</option>
                        </select>
                    </div>
                </div>
                <!-- Sección 3: Puesto y Departamento -->
                <h5 class="fw-bold">Asignación</h5>
                <hr class="section-divider">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="depto_id" class="form-label">Departamento</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="depto_id" 
                            name="depto_id" 
                            {{ $des }}
                        >
                            @foreach ($deptos as $depto)
                                <option value="{{ $depto->id }}" {{ old('depto_id', $personal->depto_id) == $depto->id ? 'selected' : '' }}>
                                    {{ $depto->nombredepto }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="puesto_id" class="form-label">Puesto</label>
                        <select 
                            class="form-select {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="puesto_id" 
                            name="puesto_id" 
                            {{ $des }}
                        >
                            @foreach ($puestos as $puesto)
                                <option value="{{ $puesto->id }}" {{ old('puesto_id', $personal->puesto_id) == $puesto->id ? 'selected' : '' }}>
                                    {{ $puesto->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <!-- Sección 3: Otros -->
                <h5 class="fw-bold">Otros Datos</h5>
                <hr class="section-divider">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="fechaingsep" class="form-label">Fecha Ingreso SEP</label>
                        <input 
                            type="date" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="fechaingsep" 
                            name="fechaingsep" 
                            value="{{ old('fechaingsep', $personal->fechaingsep) }}" 
                            {{ $des }}
                        >
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="fechaingins" class="form-label">Fecha Ingreso Institución</label>
                        <input 
                            type="date" 
                            class="form-control {{ $accion == 'D' ? 'bg-light' : '' }}" 
                            id="fechaingins" 
                            name="fechaingins" 
                            value="{{ old('fechaingins', $personal->fechaingins) }}" 
                            {{ $des }}
                        >
                    </div>
                </div>

                <!-- Botones -->
                <div class="text-center mt-4">
                    @if (!empty($txtbtn))
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">{{ $txtbtn }}</button>
                    @endif
                    <a href="{{ route('personals.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection