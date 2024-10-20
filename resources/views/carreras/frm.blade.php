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
        <h2>Registrando Carrera</h2>
        <form action="{{ route('carreras.store') }}" method="POST">
    @elseif ($accion == 'E')
        <h2>Editando Carrera</h2>
        <form action="{{ route('carreras.update', $carrera->id) }}" method="POST">
            @method('PUT')
    @elseif ($accion == 'D')
        <h2>Eliminar Carrera</h2>
        <form action="{{ route('carreras.destroy', $carrera) }}" method="POST">
    @endif

    @csrf
    <div class="mb-3">
        <label for="idcarrera" class="form-label">ID Carrera: </label>
        <input type="text" class="form-control" id="idcarrera" name="idcarrera" value="{{ old('idcarrera', $carrera->idcarrera) }}" {{ $des }}>
        @error("idcarrera")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nombrecarrera" class="form-label">Nombre Completo: </label>
        <input type="text" class="form-control" id="nombrecarrera" name="nombrecarrera" value="{{ old('nombrecarrera', $carrera->nombrecarrera) }}" {{ $des }}>
        @error("nombrecarrera")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nombremediano" class="form-label">Nombre Mediano: </label>
        <input type="text" class="form-control" id="nombremediano" name="nombremediano" value="{{ old('nombremediano', $carrera->nombremediano) }}" {{ $des }}>
        @error("nombremediano")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="nombrecorto" class="form-label">Nombre Corto: </label>
        <input type="text" class="form-control" id="nombrecorto" name="nombrecorto" value="{{ old('nombrecorto', $carrera->nombrecorto) }}" {{ $des }}>
        @error("nombrecorto")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="mb-3">
        <label for="depto_id" class="form-label">Departamento: </label>
        <select class="form-select" id="depto_id" name="depto_id" {{ $des }}>
            @foreach ($deptos as $depto)
                <option value="{{ $depto->id }}" {{ old('depto_id', $carrera->depto_id) == $depto->id ? 'selected' : '' }}>
                    {{ $depto->nombredepto }}
                </option>
            @endforeach
        </select>
        @error("depto_id")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <div class="text-center">
        @if(!empty($txtbtn))
            <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
        @endif
        <a href="{{ route('carreras.index') }}" class="btn btn-secondary">Regresar</a>
    </div>
    </form>
</div>

@endsection

