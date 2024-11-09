@extends("menu2")

@section("contenido2")

<div class="container" style="max-width: 600px; margin: auto;">
    <!-- Errores de validación -->
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

    @if ($accion == 'C')
        <h2>Registrando Personal Plaza</h2>
        <form action="{{ route('personalplazas.store') }}" method="POST">
    @elseif ($accion == 'E')
        <h2>Editando Personal Plaza</h2>
        <form action="{{ route('personalplazas.update', $personalPlaza->id) }}" method="POST">
            @method('PUT')
    @elseif ($accion == 'D')
        <h2>Eliminar Personal Plaza</h2>
        <form action="{{ route('personalplazas.destroy', $personalPlaza) }}" method="POST">
    @endif

    @csrf

    <!-- Tipo de Nombramiento -->
    <div class="mb-3">
        <label for="tiponombramiento" class="form-label">Tipo de Nombramiento: </label>
        <input type="text" class="form-control" id="tiponombramiento" name="tiponombramiento" 
               value="{{ old('tiponombramiento', isset($personalPlaza) ? $personalPlaza->tiponombramiento : '') }}" {{ isset($des) ? $des : '' }}>
        @error("tiponombramiento")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <!-- Plaza -->
    <div class="mb-3">
        <label for="plaza_id" class="form-label">Plaza: </label>
        <select class="form-select" id="plaza_id" name="plaza_id" {{ isset($des) ? $des : '' }}>
            @foreach ($plazas as $plaza)
                <option value="{{ $plaza->id }}" 
                    {{ old('plaza_id', isset($personalPlaza) ? $personalPlaza->plaza_id : '') == $plaza->id ? 'selected' : '' }}>
                    {{ $plaza->idplaza }}
                </option>
            @endforeach
        </select>
        @error("plaza_id")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <!-- Personal -->
    <div class="mb-3">
        <label for="personal_id" class="form-label">Personal: </label>
        <select class="form-select" id="personal_id" name="personal_id" {{ isset($des) ? $des : '' }}>
            @foreach ($personales as $personal)
                <option value="{{ $personal->id }}" 
                    {{ old('personal_id', isset($personalPlaza) ? $personalPlaza->personal_id : '') == $personal->id ? 'selected' : '' }}>
                    {{ $personal->nombres }} {{ $personal->apellidop }} {{ $personal->apellidom }}
                </option>
            @endforeach
        </select>
        @error("personal_id")
            <p class="text-danger">Error en: {{ $message }}</p>
        @enderror
    </div>

    <!-- Botones -->
    <div class="text-center">
        @if(!empty($txtbtn))
            <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
        @endif
        <a href="{{ route('personalplazas.index') }}" class="btn btn-secondary">Regresar</a>
    </div>
    </form>
</div>

@endsection
