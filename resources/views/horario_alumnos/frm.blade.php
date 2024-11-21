@extends("menu2")

@section("contenido2")

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li class="text-danger">{{ $error }}</li>
                @endforeach
            </ul>

            @if ($accion == 'C')
                <h2 class="text-center">Asignando Horario a Alumno</h2>
                <form action="{{ route('horario_alumnos.store') }}" method="POST">
            @elseif ($accion == 'E')
                <h2 class="text-center">Editando Asignación de Horario</h2>
                <form action="{{ route('horario_alumnos.update', $horarioAlumno->id) }}" method="POST">
                @csrf
                @method('PUT')
            @endif

            @csrf

            <!-- Campo para seleccionar el Alumno -->
            <div class="row mb-3">
                <label for="alumno_id" class="col-sm-3 col-form-label">Alumno:</label>
                <div class="col-sm-9">
                    <select class="form-select" id="alumno_id" name="alumno_id" required>
                        <option value="" disabled selected>Seleccione un alumno</option>
                        @foreach ($alumnos as $alumno)
                            <option value="{{ $alumno->id }}" {{ old('alumno_id', $horarioAlumno->alumno_id ?? '') == $alumno->id ? 'selected' : '' }}>
                                {{ $alumno->nombre }} {{ $alumno->apellidop }} {{ $alumno->apellidom }}
                            </option>
                        @endforeach
                    </select>
                    @error("alumno_id")
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Tabla para seleccionar el Grupo Horario -->
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Seleccionar Grupo Horario:</label>
                <div class="col-sm-9">
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>Seleccionar</th>
                                <th>Grupo</th>
                                <th>Semestre</th>
                                <th>Materia</th>
                                <th>Docente</th>
                                <th>Dia</th>
                                <th>Hora</th>
                                <th>Salón</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupoHorarios as $grupoHorario)
                                <tr>
                                    <td class="text-center">
                                        <input type="radio" name="grupo_horario_id" value="{{ $grupoHorario->id }}"
                                            {{ old('grupo_horario_id', $horarioAlumno->grupo_horario_id ?? '') == $grupoHorario->id ? 'checked' : '' }}>
                                    </td>
                                    <td>{{ $grupoHorario->grupo->grupo ?? 'No definido' }}</td>
                                    <td>{{ $grupoHorario->grupo->materiaAbierta?->materia?->semestre }}</td>
                                    <td>{{ $grupoHorario->grupo->materiaAbierta?->materia?->nombremateria ?? 'No asignada' }}</td>
                                    <td>{{ $grupoHorario->grupo->personal?->nombres ?? 'Sin Asignar Docente' }}
                                        {{ $grupoHorario->grupo->personal?->apellidop }}
                                        {{ $grupoHorario->grupo->personal?->apellidom }}
                                    </td>
                                    @php
                                        $dias = [
                                            1 => 'Lunes',
                                            2 => 'Martes',
                                            3 => 'Miércoles',
                                            4 => 'Jueves',
                                            5 => 'Viernes'
                                        ];
                                    @endphp
                                    <td>{{ $dias[$grupoHorario->dia] ?? 'Día no válido' }}</td>
                                    <td>{{ $grupoHorario->hora ?? 'No definida' }}</td>
                                    <td>{{ $grupoHorario->lugar->nombrecorto ?? 'No definida' }}</td>
                                </tr>
                            @endforeach
                        </tbody>                                             
                    </table>
                    @error("grupo_horario_id")
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Botones -->
            <div class="text-center">
                @if ($accion == 'C' || $accion == 'E')
                    <button type="submit" class="btn btn-primary">{{ $accion == 'C' ? 'Registrar' : 'Actualizar' }}</button>
                @endif
                <a href="{{ route('horario_alumnos.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
