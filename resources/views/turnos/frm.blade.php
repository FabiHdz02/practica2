@extends('menu2')

@section('contenido2')

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <ul class="list-unstyled">
                @foreach ($errors->all() as $error)
                    <li class="text-danger">
                        {{ $error }}
                    </li>
                @endforeach
            </ul>

            @if ($accion == 'C')
                <h2 class="text-center">Registrar Turno</h2>
                <form action="{{ route('turnos.store') }}" method="POST">
            @elseif ($accion == 'E')
                <h2 class="text-center">Editar Turno</h2>
                <form action="{{ route('turnos.update', $turno->id) }}" method="POST">
                @csrf
                @method('PUT')
            @endif

            @csrf

            <div class="row mb-3">
                <label for="fecha" class="col-sm-4 col-form-label">Fecha:</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $turno->fecha ?? '') }}" required>
                    @error('fecha')
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="hora" class="col-sm-4 col-form-label">Hora:</label>
                <div class="col-sm-8">
                    <input type="time" class="form-control" id="hora" name="hora" value="{{ old('hora', $turno->hora ?? '') }}" required>
                    @error('hora')
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="codigocanal" class="col-sm-4 col-form-label">Código Canal:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="codigocanal" name="codigocanal" value="{{ old('codigocanal', $turno->codigocanal ?? '') }}" required>
                    @error('codigocanal')
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="alumno_id" class="col-sm-4 col-form-label">Alumno:</label>
                <div class="col-sm-8">
                    <select class="form-select" id="alumno_id" name="alumno_id" required>
                        <option value="" disabled selected>Seleccione un alumno</option>
                        @foreach ($alumnos as $alumno)
                            <option value="{{ $alumno->id }}" {{ old('alumno_id', $turno->alumno_id ?? '') == $alumno->id ? 'selected' : '' }}>
                                {{ $alumno->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('alumno_id')
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <a href="{{ route('turnos.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection

