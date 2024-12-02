@extends("menu2")

@section("contenido2")
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- Mensajes de error -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <strong>¡Por favor corrige los siguientes errores!</strong>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Encabezado dinámico -->
            <h2 class="text-center mb-4">{{ $accion == 'C' ? 'Crear Grupo' : 'Editar Grupo' }}</h2>

            <!-- Formulario -->
            <form 
                action="{{ $accion == 'C' ? route('grupos21343.store') : route('grupos21343.update', $grupo->id) }}" 
                method="POST"
                class="card p-4 shadow-sm"
            >
                @csrf
                @if ($accion == 'E')
                    @method('PUT')
                @endif

                <!-- Grupo -->
                <div class="mb-3">
                    <label for="grupo" class="form-label">Grupo</label>
                    <input type="text" class="form-control" id="grupo" name="grupo" placeholder="Ingresa el código del grupo" value="{{ old('grupo', $grupo->grupo) }}">
                </div>

                <!-- Descripción -->
                <div class="mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Ingresa una descripción">{{ old('descripcion', $grupo->descripcion) }}</textarea>
                </div>

                <!-- Máximo de Alumnos -->
                <div class="mb-3">
                    <label for="maxalumnos" class="form-label">Máximo de Alumnos</label>
                    <input type="number" class="form-control" id="maxalumnos" name="maxalumnos" min="1" placeholder="Número máximo de alumnos" value="{{ old('maxalumnos', $grupo->maxalumnos) }}">
                </div>

                <!-- Fecha -->
                <div class="mb-3">
                    <label for="fecha" class="form-label">Fecha</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $grupo->fecha) }}">
                </div>

                <!-- Periodo -->
                <div class="mb-3">
                    <label for="periodo_id" class="form-label">Periodo</label>
                    <select name="periodo_id" id="periodo_id" class="form-select">
                        <option value="" disabled selected>Selecciona un Periodo</option>
                        @foreach ($periodos as $periodo)
                            <option value="{{ $periodo->id }}" {{ old('periodo_id', $grupo->periodo_id) == $periodo->id ? 'selected' : '' }}>
                                {{ $periodo->periodo }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Materia Abierta -->
                <div class="mb-3">
                    <label for="materia_abierta_id" class="form-label">Materia Abierta</label>
                    <select name="materia_abierta_id" id="materia_abierta_id" class="form-select">
                        <option value="" disabled selected>Selecciona una Materia</option>
                        @foreach ($materiasa as $mate)
                            <option value="{{ $mate->id }}" {{ old('materia_abierta_id', $grupo->materia_abierta_id) == $mate->id ? 'selected' : '' }}>
                                {{ $mate->materia->nombremateria }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Docente -->
                <div class="mb-3">
                    <label for="personal_id" class="form-label">Docente</label>
                    <select name="personal_id" id="personal_id" class="form-select">
                        <option value="" {{ old('personal_id', $grupo->personal_id) === null ? 'selected' : '' }}>Sin Asignar Docente</option>
                        @foreach ($personales as $personal)
                            <option value="{{ $personal->id }}" {{ old('personal_id', $grupo->personal_id) == $personal->id ? 'selected' : '' }}>
                                {{ $personal->nombres }} {{ $personal->apellidop }} {{ $personal->apellidom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Botones -->
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary px-4">Guardar</button>
                    <a href="{{ route('grupos21343.index21343') }}" class="btn btn-secondary px-4">Cancelar</a>
                </div>
            </form>

            <!-- Formulario de Horarios -->
            @if (isset($grupo->id))
                @include('grupohorarios21343.frm', ['grupo_id' => $grupo->id])
            @endif
        </div>
    </div>
</div>
@endsection