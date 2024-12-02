@extends("menu2")

@section("contenido2")

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }

    .container h2 {
        font-size: 2rem;
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
        <div class="col-lg-6">
            <!-- Título -->
            <h2>
                @if ($accion == 'C')
                    Registrando Materia
                @elseif ($accion == 'E')
                    Editando Materia
                @elseif ($accion == 'D')
                    Eliminar Materia
                @endif
            </h2>

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
                action="{{ $accion == 'C' ? route('materias.store') : ($accion == 'E' ? route('materias.update', $materia->id) : route('materias.destroy', $materia)) }}" 
                method="POST" 
                class="p-5 rounded shadow-lg bg-gradient"
                style="background: linear-gradient(135deg, #f8f9fa, #e9ecef);"
            >
                @csrf
                @if ($accion == 'E') @method('PUT') @endif
                @if ($accion == 'D') @method('DELETE') @endif

                <!-- ID y Nombre -->
                <h5 class="fw-bold">Detalles de la Materia</h5>
                <hr class="section-divider">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="idmateria" class="form-label">ID Materia</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="idmateria" 
                            name="idmateria" 
                            value="{{ old('idmateria', $materia->idmateria) }}" 
                            {{ $des }}
                        >
                        @error("idmateria")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror 
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="nombremateria" class="form-label">Nombre de la Materia</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="nombremateria" 
                            name="nombremateria" 
                            value="{{ old('nombremateria', $materia->nombremateria) }}" 
                            {{ $des }}
                        >
                        @error("nombremateria")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Nivel y Semestre -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nivel" class="form-label">Nivel</label>
                        <select 
                            class="form-select" 
                            id="nivel" 
                            name="nivel" 
                            {{ $des }}
                        >
                            <option value="" disabled {{ old('nivel', $materia->nivel) == '' ? 'selected' : '' }}>Selecciona el nivel</option>
                            @for ($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" {{ old('nivel', $materia->nivel) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error("nivel")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="semestre" class="form-label">Semestre</label>
                        <select 
                            class="form-select" 
                            id="semestre" 
                            name="semestre" 
                            {{ $des }}
                        >
                            <option value="" disabled {{ old('semestre', $materia->semestre) == '' ? 'selected' : '' }}>Selecciona Semestre</option>
                            @for ($i = 1; $i <= 10; $i++)
                                <option value="{{ $i }}" {{ old('semestre', $materia->semestre) == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('semestre')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <!-- Nombre Corto y Modalidad -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="nombrecorto" class="form-label">Nombre Corto</label>
                        <input 
                            type="text" 
                            class="form-control" 
                            id="nombrecorto" 
                            name="nombrecorto" 
                            value="{{ old('nombrecorto', $materia->nombrecorto) }}" 
                            {{ $des }}
                        >
                        @error("nombrecorto")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="modalidad" class="form-label">Modalidad</label>
                        <select 
                            class="form-select" 
                            id="modalidad" 
                            name="modalidad" 
                            {{ $des }}
                        >
                            <option value="" disabled {{ old('modalidad', $materia->modalidad) == '' ? 'selected' : '' }}>Selecciona Modalidad</option>
                            <option value="L" {{ old('modalidad', $materia->modalidad) == 'L' ? 'selected' : '' }}>L</option>
                            <option value="E" {{ old('modalidad', $materia->modalidad) == 'E' ? 'selected' : '' }}>E</option>
                        </select>
                        @error('modalidad')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="credito" class="form-label">Crédito</label>
                        <input 
                            type="number" 
                            class="form-control" 
                            id="credito" 
                            name="credito" 
                            value="{{ old('credito', $materia->credito) }}" 
                            {{ $des }}
                            min="1" max="10"
                        >
                        @error("credito")
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                
                <!-- Retícula -->
                <div class="mb-3">
                    <label for="reticula_id" class="form-label">Retícula</label>
                    <select 
                        class="form-select" 
                        id="reticula_id" 
                        name="reticula_id" 
                        {{ $des }}
                    >
                        <option value="" disabled {{ old('reticula_id', $materia->reticula_id) == '' ? 'selected' : '' }}>Selecciona Retícula</option>
                        @foreach($reticulas as $reticula)
                            <option value="{{ $reticula->id }}" {{ old('reticula_id', $materia->reticula_id) == $reticula->id ? 'selected' : '' }}>
                                {{ $reticula->descripcion }}
                            </option>
                        @endforeach
                    </select>
                    @error('reticula_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Botones -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill shadow-sm">
                        {{ $txtbtn }}
                    </button>
                    <a href="{{ route('materias.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill shadow-sm">Regresar</a>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection