@extends("menu2")

@section("contenido2")
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-5">
    <form action="{{ route('grupos.update', $grupoData->id) }}" method="POST" id="grupoForm">
        @csrf
        @method('PUT')
        <h2 class="text-center mb-4">Editar Grupo</h2>

        <!-- Información del Grupo -->
        <div class="card mb-4">
            <div class="card-header text-white bg-primary">
                Información del Grupo
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="fecha" class="form-label">Fecha:</label>
                        <input type="date" id="fecha" name="fecha" class="form-control form-control-sm" required value="{{ $grupoData->fecha }}">
                    </div>
                    <div class="col-md-4">
                        <label for="maxalumnos" class="form-label">Max. Alumnos:</label>
                        <input type="number" id="maxalumnos" name="maxalumnos" class="form-control form-control-sm" required value="{{ $grupoData->maxalumnos }}">
                    </div>
                    <div class="col-md-4">
                        <label for="descripcion" class="form-label">Descripción:</label>
                        <input type="text" id="descripcion" name="descripcion" class="form-control form-control-sm" required value="{{ $grupoData->descripcion }}">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4">
                        <label for="grupo" class="form-label">Grupo:</label>
                        <input id="grupo" name="grupo" type="text" class="form-control form-control-sm" required value="{{ $grupoData->grupo }}">
                    </div>
                    <div class="col-md-4">
                        <label for="periodo_id" class="form-label">Periodo:</label>
                        <select name="periodo_id" id="periodo_id" class="form-select form-select-sm">
                            @foreach ($materiasa->unique('periodo.periodo') as $peri)
                                <option value="{{ $peri->periodo->id }}" {{ $grupoData->periodo_id == $peri->periodo->id ? 'selected' : '' }}>
                                    {{ $peri->periodo->periodo }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="materia_abierta_id" class="form-label">Carrera:</label>
                        <select name="materia_abierta_id" id="materia_abierta_id" class="form-select form-select-sm">
                            @foreach ($materiasa->unique('carrera.nombrecarrera') as $carr)
                                <option value="{{ $carr->carrera->id }}" {{ $grupoData->materia_abierta_id == $carr->carrera->id ? 'selected' : '' }}>
                                    {{ $carr->carrera->nombrecarrera }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Selección de Semestre y Materias -->
        <div class="card mb-4">
            <div class="card-header text-white bg-secondary">
                Semestre y Materias
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <label for="semestreSelect" class="form-label">Semestre:</label>
                        <select name="semestre" id="semestreSelect" class="form-select form-select-sm">
                            <option value="" disabled selected>Selecciona un Semestre</option>
                            @foreach ($materiasa->unique('materia.semestre') as $materias)
                                <option value="{{ $materias->materia->semestre }}" {{ $grupoData->semestre == $materias->materia->semestre ? 'selected' : '' }}>
                                    Semestre: {{ $materias->materia->semestre }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8">
                        <label class="form-label">Materias:</label>
                        @foreach ($materiasa as $mate)
                            <div class="form-check">
                                <input type="radio" name="materia_abierta_id" id="materia_abierta_{{ $mate->id }}" value="{{ $mate->id }}" class="form-check-input" 
                                {{ $grupoData->materia_abierta_id == $mate->id ? 'checked' : '' }}>
                                <label for="materia_abierta_{{ $mate->id }}" class="form-check-label">{{ $mate->materia->nombremateria }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Departamento y Docentes -->
        <div class="card mb-4">
            <div class="card-header text-white bg-success">
                Departamento y Docentes
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <label for="departamento" class="form-label">Departamento:</label>
                        <select id="departamento" name="departamento" class="form-select">
                            <option value="" disabled {{ old('departamento', $grupoData->departamento) == '' ? 'selected' : '' }}>Seleccionar departamento</option>
                            @foreach($deptos as $depto)
                                <option value="{{ $depto->id }}" {{ old('departamento', $grupoData->departamento) == $depto->id ? 'selected' : '' }}>
                                    {{ $depto->nombredepto }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Docentes:</label>
                        @foreach ($personales as $personal)
                            <div class="form-check">
                                <input type="radio" name="personal_id" id="personal_{{ $personal->id }}" value="{{ $personal->id }}" class="form-check-input"
                                {{ $grupoData->personal_id == $personal->id ? 'checked' : '' }}>
                                <label for="personal_{{ $personal->id }}" class="form-check-label">
                                    {{ $personal->nombres }} {{ $personal->apellidop }} {{ $personal->apellidom }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    <!-- Horarios del Grupo -->
    <div class="card mb-4">
        <div class="card-header text-white bg-info">
            Editar Horarios del Grupo
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Día</th>
                        <th>Hora</th>
                        <th>Edificio</th>
                        <th>Lugar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($grupoHorarios as $horario)
                        <tr>
                            <td>
                                <select name="horarios[{{ $horario->id }}][dia]" class="form-select form-select-sm">
                                    @foreach (['Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes'] as $key => $dia)
                                        <option value="{{ $key }}" {{ $horario->dia == $key ? 'selected' : '' }}>
                                            {{ $dia }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <input type="time" name="horarios[{{ $horario->id }}][hora]" class="form-control form-control-sm"
                                    value="{{ $horario->hora }}">
                            </td>
                            <td>
                                <select name="horarios[{{ $horario->id }}][edificio_id]" class="form-select form-select-sm">
                                    @foreach ($edificios as $edificio)
                                        <option value="{{ $edificio->id }}" {{ optional($horario->lugar)->edificio_id == $edificio->id ? 'selected' : '' }}>
                                            {{ $edificio->nombreedificio }}
                                        </option>
                                    @endforeach
                                </select>
                            </td>
                            <td>
                                <select name="horarios[{{ $horario->id }}][lugar_id]" class="form-select form-select-sm">
                                    @if ($horario->lugar && $horario->lugar->edificio)
                                        @foreach ($horario->lugar->edificio->lugares as $lugar)
                                            <option value="{{ $lugar->id }}" {{ $horario->lugar_id == $lugar->id ? 'selected' : '' }}>
                                                {{ $lugar->nombrelugar }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

        <!-- Botón para Guardar -->
        <div class="text-end">
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
    </form>
</div>

@endsection