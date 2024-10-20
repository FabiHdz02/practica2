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
                <h2 class="text-center">Registrando Retícula</h2>
                <form action="{{ route('reticulas.store') }}" method="POST">
            @elseif ($accion == 'E')
                <h2 class="text-center">Editando Retícula</h2>
                <form action="{{ route('reticulas.update', $reticula->id) }}" method="POST">
                @method('PUT')  <!-- Aquí agregas el método PUT -->
            @elseif ($accion == 'D')
                <h2 class="text-center">Eliminar Retícula</h2>
                <form action="{{ route('reticulas.destroy', $reticula) }}" method="POST">
                @method('DELETE')
            @endif

            @csrf

            <div class="mb-3">
                <label for="idreticula" class="form-label">ID Retícula</label>
                <input type="text" class="form-control" id="idreticula" name="idreticula" value="{{ old('idreticula', $reticula->idreticula) }}" {{ $des }}>
                @error("idreticula")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror 
            </div>

            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" value="{{ old('descripcion', $reticula->descripcion) }}" {{ $des }}>
                @error("descripcion")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="fechavigor" class="form-label">Fecha de Vigencia</label>
                <input type="date" class="form-control" id="fechavigor" name="fechavigor" value="{{ old('fechavigor', $reticula->fechavigor) }}" {{ $des }}>
                @error("fechavigor")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="carrera_id" class="form-label">Carrera:</label>
                <select class="form-select" id="carrera_id" name="carrera_id" {{ $des }}>
                    <option value="" disabled {{ old('carrera_id', $reticula->carrera_id) == '' ? 'selected' : '' }}>Selecciona Carrera</option>
                    @foreach($carreras as $carrera)
                        <option value="{{ $carrera->id }}" {{ old('carrera_id', $reticula->carrera_id) == $carrera->id ? 'selected' : '' }}>
                            {{ $carrera->nombrecarrera }}
                        </option>
                    @endforeach
                </select>
                @error('carrera_id')
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>            

            <div class="text-center">
                @if(!empty($txtbtn))
                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                @endif
                <a href="{{ route('reticulas.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
    </div>
</div>

@endsection
