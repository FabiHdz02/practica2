@extends("menu2")

@section("contenido2")

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">        
            <ul>
                @foreach ($errors->all() as $error)
                    <li>
                        {{ $error }}
                    </li>
                @endforeach
            </ul>

            @if ($accion == 'C')
                <h2 class="text-center">Registrando Tipo de Inscripción</h2>
                <form action="{{ route('tipoinscs.store') }}" method="POST">
            @elseif ($accion == 'E')
                <h2 class="text-center">Editando Tipo de Inscripción</h2>
                <form action="{{ route('tipoinscs.update', $tipoinsc->id) }}" method="POST">
                @method('PUT')
            @elseif ($accion == 'D')
                <h2 class="text-center">Eliminar Tipo de Inscripción</h2>
                <form action="{{ route('tipoinscs.destroy', $tipoinsc->id) }}" method="POST">
                @method('DELETE')
            @endif

            @csrf

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-select" id="tipo" name="tipo" {{ $des }}>
                    <option value="Inscripción" {{ old('tipo', $tipoinsc->tipo) == 'Inscripción' ? 'selected' : '' }}>Inscripción</option>
                    <option value="Reinscripción" {{ old('tipo', $tipoinsc->tipo) == 'Reinscripción' ? 'selected' : '' }}>Reinscripción</option>
                </select>
                @error("tipo")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha" name="fecha" value="{{ old('fecha', $tipoinsc->fecha) }}" {{ $des }}>
                @error("fecha")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="periodo_id" class="form-label">Periodo</label>
                <select class="form-select" id="periodo_id" name="periodo_id" {{ $des }}>
                    <option value="">Seleccione un periodo</option>
                    @foreach ($periodos as $periodo)
                        <option value="{{ $periodo->id }}" {{ old('periodo_id', $tipoinsc->periodo_id) == $periodo->id ? 'selected' : '' }}>
                            {{ $periodo->periodo }}
                        </option>
                    @endforeach
                </select>
                @error("periodo_id")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>            

            <div class="text-center">
                @if(!empty($txtbtn))
                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                @endif
                <a href="{{ route('tipoinscs.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
    </div>
</div>

@endsection
