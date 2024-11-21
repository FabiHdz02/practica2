@extends("menu2")

@section("contenido2")

<div class="container text-center">
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>

    @if ($accion == 'C')
        <h2>Registrando Documentación</h2>
        <form action="{{ route('documentacions.store') }}" method="POST" enctype="multipart/form-data">
    @elseif ($accion == 'E')
        <h2>Editando Documentación</h2>
        <form action="{{ route('documentacions.update', $documentacion->id) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
    @elseif ($accion == 'D')
        <h2>Eliminar Documentación</h2>
        <form action="{{ route('documentacions.destroy', $documentacion->id) }}" method="POST">
        @method('DELETE')
    @endif

    @csrf

    <div class="row mb-3">
        <label for="curp" class="col-sm-3 col-form-label">CURP:</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" id="curp" name="curp" accept=".pdf, .jpg, .jpeg, .png" {{ $des }}>
            @if ($accion == 'E' || $accion == 'D')
                <p>Archivo actual: 
                    <a href="{{ asset('storage/documentaciones/' . $documentacion->curp) }}" target="_blank">
                        {{ $documentacion->curp }}
                    </a>
                </p>
            @endif
            @error("curp")
                <p class="text-danger">Error en: {{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="certificado" class="col-sm-3 col-form-label">Certificado:</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" id="certificado" name="certificado" accept=".pdf, .jpg, .jpeg, .png" {{ $des }}>
            @if ($accion == 'E' || $accion == 'D')
                <p>Archivo actual: 
                    <a href="{{ asset('storage/documentaciones/' . $documentacion->certificado) }}" target="_blank">
                        {{ $documentacion->certificado }}
                    </a>
                </p>
            @endif
            @error("certificado")
                <p class="text-danger">Error en: {{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="cdomi" class="col-sm-3 col-form-label">Comprobante de Domicilio:</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" id="cdomi" name="cdomi" accept=".pdf, .jpg, .jpeg, .png" {{ $des }}>
            @if ($accion == 'E' || $accion == 'D')
                <p>Archivo actual: 
                    <a href="{{ asset('storage/documentaciones/' . $documentacion->cdomi) }}" target="_blank">
                        {{ $documentacion->cdomi }}
                    </a>
                </p>
            @endif
            @error("cdomi")
                <p class="text-danger">Error en: {{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="actanac" class="col-sm-3 col-form-label">Acta de Nacimiento:</label>
        <div class="col-sm-9">
            <input type="file" class="form-control" id="actanac" name="actanac" accept=".pdf, .jpg, .jpeg, .png" {{ $des }}>
            @if ($accion == 'E' || $accion == 'D')
                <p>Archivo actual: 
                    <a href="{{ asset('storage/documentaciones/' . $documentacion->actanac) }}" target="_blank">
                        {{ $documentacion->actanac }}
                    </a>
                </p>
            @endif
            @error("actanac")
                <p class="text-danger">Error en: {{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="tipoinsc_id" class="col-sm-3 col-form-label">Tipo de Inscripción:</label>
        <div class="col-sm-9">
            <select class="form-select" id="tipoinsc_id" name="tipoinsc_id" {{ $des }}>
                <option value="">Seleccione un tipo de inscripción</option>
                @foreach ($tipoinscs as $tipoinsc)
                    <option value="{{ $tipoinsc->id }}" {{ old('tipoinsc_id', $documentacion->tipoinsc_id) == $tipoinsc->id ? 'selected' : '' }}>
                        {{ $tipoinsc->tipo }}
                    </option>
                @endforeach
            </select>
            @error("tipoinsc_id")
                <p class="text-danger">Error en: {{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="row mb-3">
        <label for="alumnos_id" class="col-sm-3 col-form-label">Alumno:</label>
        <div class="col-sm-9">
            <select class="form-select" id="alumnos_id" name="alumnos_id" {{ $des }}>
                <option value="">Seleccione un alumno</option>
                @foreach ($alumnos as $alumno)
                    <option value="{{ $alumno->id }}" {{ old('alumnos_id', $documentacion->alumnos_id) == $alumno->id ? 'selected' : '' }}>
                        {{ $alumno->nombre }}
                    </option>
                @endforeach
            </select>
            @error("alumnos_id")
                <p class="text-danger">Error en: {{ $message }}</p>
            @enderror
        </div>
    </div>

    <div class="text-center">
        @if(!empty($txtbtn))
            <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
        @endif
        <a href="{{ route('documentacions.index') }}" class="btn btn-secondary">Regresar</a>
    </div>
    </form>
</div>

@endsection