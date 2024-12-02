@extends("menu2")

@section("contenido2")

<style>
    body {
        font-family: 'Poppins', sans-serif;
    }
    h2 {
        font-size: 1.8rem;
        font-weight: bold;
        text-align: center;
        margin-bottom: 20px;
    }
    .section-divider {
        width: 60px;
        height: 4px;
        background: #007bff;
        margin: 10px auto 20px;
        border-radius: 2px;
    }
    .form-label {
        font-weight: 500;
    }
    .form-control, .form-select {
        font-size: 0.9rem;
        padding: 10px 15px;
    }
    .btn {
        font-weight: bold;
        text-transform: uppercase;
    }
</style>

<div class="container mt-5" style="max-width: 800px;">
    <!-- Título -->
    <h2>{{ $accion == 'C' ? 'Registrar Lugar' : ($accion == 'E' ? 'Editar Lugar' : 'Eliminar Lugar') }}</h2>
    <div class="section-divider"></div>

    <!-- Errores -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario -->
    <form 
        action="{{ $accion == 'C' ? route('lugares.store') : ($accion == 'E' ? route('lugares.update', $lugar->id) : route('lugares.destroy', $lugar->id)) }}" 
        method="POST" 
        class="p-4 bg-white rounded shadow-sm"
    >
        @csrf
        @if ($accion == 'E') @method('PUT') @endif
        @if ($accion == 'D') @method('DELETE') @endif

        <!-- Nombre Lugar -->
        <div class="mb-3">
            <label for="nombrelugar" class="form-label">Nombre Lugar:</label>
            <input 
                type="text" 
                class="form-control" 
                id="nombrelugar" 
                name="nombrelugar" 
                value="{{ old('nombrelugar', $lugar->nombrelugar ?? '') }}" 
                {{ $accion == 'D' ? 'disabled' : 'required' }}
            >
        </div>

        <!-- Nombre Corto -->
        <div class="mb-3">
            <label for="nombrecorto" class="form-label">Nombre Corto:</label>
            <input 
                type="text" 
                class="form-control" 
                id="nombrecorto" 
                name="nombrecorto" 
                value="{{ old('nombrecorto', $lugar->nombrecorto ?? '') }}" 
                {{ $accion == 'D' ? 'disabled' : 'required' }}
            >
        </div>

        <!-- Edificio -->
        <div class="mb-3">
            <label for="edificio_id" class="form-label">Edificio:</label>
            <select 
                class="form-select" 
                id="edificio_id" 
                name="edificio_id" 
                {{ $accion == 'D' ? 'disabled' : 'required' }}
            >
                <option value="" disabled {{ old('edificio_id', $lugar->edificio_id ?? '') == '' ? 'selected' : '' }}>Seleccione un edificio</option>
                @foreach ($edificios as $edificio)
                    <option 
                        value="{{ $edificio->id }}" 
                        {{ old('edificio_id', $lugar->edificio_id ?? '') == $edificio->id ? 'selected' : '' }}
                    >
                        {{ $edificio->nombreedificio }}
                    </option>
                @endforeach
            </select>
            @error('edificio_id')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <!-- Botones -->
        <div class="text-center">
            @if($accion != 'D')
                <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">{{ $txtbtn }}</button>
            @else
                <button type="submit" class="btn btn-danger px-4 py-2 rounded-pill">Eliminar</button>
            @endif
            <a href="{{ route('lugares.index') }}" class="btn btn-secondary px-4 py-2 rounded-pill">Regresar</a>
        </div>
    </form>
</div>

@endsection
