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
<h2 class="text-center">Registrando Materia</h2>
<form action="{{ route('materias.store') }}" method="POST">
@elseif ($accion == 'E')
<h2 class="text-center">Editando Materia</h2>
<form action="{{ route('materias.update', $materia->id) }}" method="POST">
    @csrf
    @method('PUT')
@elseif ($accion == 'D')
<h2 class="text-center">Eliminar Materia</h2>
<form action="{{ route('materias.destroy', $materia) }}" method="POST">
    @csrf
    @method('DELETE') 
@endif
        

            @csrf

            <div class="mb-3">
                <label for="idmateria" class="form-label">ID Materia</label>
                <input type="text" class="form-control" id="idmateria" name="idmateria" value="{{ old('idmateria', $materia->idmateria) }}" {{ $des }}>
                @error("idmateria")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror 
            </div>

            <div class="mb-3">
                <label for="nombremateria" class="form-label">Nombre de la Materia</label>
                <input type="text" class="form-control" id="nombremateria" name="nombremateria" value="{{ old('nombremateria', $materia->nombremateria) }}" {{ $des }}>
                @error("nombremateria")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="nivel" class="form-label">Nivel</label>
                <select class="form-select" id="nivel" name="nivel" {{ $des }}>
                    <option value="" disabled {{ old('nivel', $materia->nivel) == '' ? 'selected' : '' }}>Selecciona el nivel</option>
                    <option value="1" {{ old('nivel', $materia->nivel) == 1 ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('nivel', $materia->nivel) == 2 ? 'selected' : '' }}>2</option>
                    <option value="3" {{ old('nivel', $materia->nivel) == 3 ? 'selected' : '' }}>3</option>
                    <option value="4" {{ old('nivel', $materia->nivel) == 4 ? 'selected' : '' }}>4</option>
                </select>
                @error("nivel")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>
            

            <div class="mb-3">
                <label for="nombrecorto" class="form-label">Nombre Corto</label>
                <input type="text" class="form-control" id="nombrecorto" name="nombrecorto" value="{{ old('nombrecorto', $materia->nombrecorto) }}" {{ $des }}>
                @error("nombrecorto")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="modalidad" class="form-label">Modalidad:</label>
                <select class="form-select" id="modalidad" name="modalidad" {{ $des }}>
                    <option value="" disabled {{ old('modalidad', $materia->modalidad) == '' ? 'selected' : '' }}>Selecciona Modalidad</option>
                    <option value="L" {{ old('modalidad', $materia->modalidad) == 'L' ? 'selected' : '' }}>L</option>
                    <option value="E" {{ old('modalidad', $materia->modalidad) == 'E' ? 'selected' : '' }}>E</option>
                </select>
                @error('modalidad')
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="reticula_id" class="form-label">Retícula:</label>
                <select class="form-select" id="reticula_id" name="reticula_id" {{ $des }}>
                    <option value="" disabled {{ old('reticula_id', $materia->reticula_id) == '' ? 'selected' : '' }}>Selecciona Retícula</option>
                    @foreach($reticulas as $reticula)
                        <option value="{{ $reticula->id }}" {{ old('reticula_id', $materia->reticula_id) == $reticula->id ? 'selected' : '' }}>
                            {{ $reticula->descripcion }}
                        </option>
                    @endforeach
                </select>
                             
                @error('reticula_id')
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                @if(!empty($txtbtn))
                    <button type="submit" class="btn btn-primary">{{ $txtbtn }}</button>
                @endif
                <a href="{{ route('materias.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
    </div>
</div>

@endsection
