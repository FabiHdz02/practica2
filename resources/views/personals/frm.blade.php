@extends("menu2")

@section("contenido2")

<div class="container" style="max-width: 600px; margin: auto;">
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>

    @if ($accion == 'C')
        <h2>Registrando Personal</h2>
        <form action="{{ route('personals.store') }}" method="POST">
    @elseif ($accion == 'E')
        <h2>Editando Personal</h2>
        <form action="{{ route('personals.update', $personal->id) }}" method="POST">
            @method('PUT')
    @elseif ($accion == 'D')
        <h2>Eliminar Personal</h2>
        <form action="{{ route('personals.destroy', $personal) }}" method="POST">
    @endif

    @csrf
    <div class="mb-3">
        <label for="RFC" class="form-label">RFC: </label>
        <input type="text" class="form-control" id="RFC" name="RFC" value="{{ old('RFC', $personal->RFC) }}" {{ $des }}>
        @error("RFC")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nombres" class="form-label">Nombres: </label>
        <input type="text" class="form-control" id="nombres" name="nombres" value="{{ old('nombres', $personal->nombres) }}" {{ $des }}>
        @error("nombres")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="apellidop" class="form-label">Apellido Paterno: </label>
        <input type="text" class="form-control" id="apellidop" name="apellidop" value="{{ old('apellidop', $personal->apellidop) }}" {{ $des }}>
        @error("apellidop")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="apellidom" class="form-label">Apellido Materno: </label>
        <input type="text" class="form-control" id="apellidom" name="apellidom" value="{{ old('apellidom', $personal->apellidom) }}" {{ $des }}>
        @error("apellidom")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="licenciatura" class="form-label">Licenciatura: </label>
        <input type="text" class="form-control" id="licenciatura" name="licenciatura" value="{{ old('licenciatura', $personal->licenciatura) }}" {{ $des }}>
        @error("licenciatura")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="lictit" class="form-label">Licenciatura Titulado: </label>
        <select class="form-select" id="lictit" name="lictit" {{ $des }}>
            <option value="0" {{ old('lictit', $personal->lictit) == 0 ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('lictit', $personal->lictit) == 1 ? 'selected' : '' }}>Sí</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="especializacion" class="form-label">Especialización: </label>
        <input type="text" class="form-control" id="especializacion" name="especializacion" value="{{ old('especializacion', $personal->especializacion) }}" {{ $des }}>
        @error("especializacion")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="esptit" class="form-label">Especialización Titulado: </label>
        <select class="form-select" id="esptit" name="esptit" {{ $des }}>
            <option value="0" {{ old('esptit', $personal->esptit) == 0 ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('esptit', $personal->esptit) == 1 ? 'selected' : '' }}>Sí</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="maestria" class="form-label">Maestría: </label>
        <input type="text" class="form-control" id="maestria" name="maestria" value="{{ old('maestria', $personal->maestria) }}" {{ $des }}>
        @error("maestria")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="maetit" class="form-label">Maestría Titulado: </label>
        <select class="form-select" id="maetit" name="maetit" {{ $des }}>
            <option value="0" {{ old('maetit', $personal->maetit) == 0 ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('maetit', $personal->maetit) == 1 ? 'selected' : '' }}>Sí</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="doctorado" class="form-label">Doctorado: </label>
        <input type="text" class="form-control" id="doctorado" name="doctorado" value="{{ old('doctorado', $personal->doctorado) }}" {{ $des }}>
        @error("doctorado")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="doctit" class="form-label">Doctorado Titulado: </label>
        <select class="form-select" id="doctit" name="doctit" {{ $des }}>
            <option value="0" {{ old('doctit', $personal->doctit) == 0 ? 'selected' : '' }}>No</option>
            <option value="1" {{ old('doctit', $personal->doctit) == 1 ? 'selected' : '' }}>Sí</option>
        </select>
    </div>

    <div class="mb-3">
        <label for="fechaingsep" class="form-label">Fecha Ingreso SEP: </label>
        <input type="date" class="form-control" id="fechaingsep" name="fechaingsep" value="{{ old('fechaingsep', $personal->fechaingsep) }}" {{ $des }}>
        @error("fechaingsep")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="fechaingins" class="form-label">Fecha Ingreso Institución: </label>
        <input type="date" class="form-control" id="fechaingins" name="fechaingins" value="{{ old('fechaingins', $personal->fechaingins) }}" {{ $des }}>
        @error("fechaingins")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="depto_id" class="form-label">Departamento: </label>
        <select class="form-select" id="depto_id" name="depto_id" {{ $des }}>
            @foreach ($deptos as $depto)
                <option value="{{ $depto->id }}" {{ old('depto_id', $personal->depto_id) == $depto->id ? 'selected' : '' }}>
                    {{ $depto->nombredepto }}
                </option>
            @endforeach
        </select>
        @error("depto_id")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="puesto_id" class="form-label">Puesto: </label>
        <select class="form-select" id="puesto_id" name="puesto_id" {{ $des }}>
            @foreach ($puestos as $puesto)
                <option value="{{ $puesto->id }}" {{ old('puesto_id', $personal->puesto_id) == $puesto->id ? 'selected' : '' }}>
                    {{ $puesto->nombre}}
                </option>
            @endforeach
        </select>
        @error("puesto_id")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="text-center">
        @if(!empty($txtbtn))
            <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
        @endif
        <a href="{{ route('personals.index') }}" class="btn btn-secondary">Regresar</a>
    </div>
    </form>
</div>

@endsection

