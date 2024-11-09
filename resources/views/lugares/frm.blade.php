@extends("menu2")

@section("contenido2")

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
                <h2 class="text-center">Registrando Lugar</h2>
                <form action="{{ route('lugares.store') }}" method="POST">
            @elseif ($accion == 'E')
                <h2 class="text-center">Editando Lugar</h2>
                <form action="{{ route('lugares.update', $lugar->id) }}" method="POST">
                @csrf
                @method('PUT')
            @elseif ($accion == 'D')
                <h2 class="text-center">Eliminar Lugar</h2>
                <form action="{{ route('lugares.destroy', $lugar->id) }}" method="POST">
                @method('DELETE')
            @endif

            @csrf

            <div class="row mb-3">
                <label for="nombrelugar" class="col-sm-4 col-form-label">Nombre Lugar:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nombrelugar" name="nombrelugar" value="{{ old('nombrelugar', $lugar->nombrelugar) }}" required {{ $des }}>
                </div>
            </div>

            <div class="row mb-3">
                <label for="nombrecorto" class="col-sm-4 col-form-label">Nombre Corto:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nombrecorto" name="nombrecorto" value="{{ old('nombrecorto', $lugar->nombrecorto) }}" required {{ $des }}>
                </div>
            </div>

            <div class="mb-3">
                <label for="edificio_id" class="form-label">Edificio: </label>
                <select class="form-select" id="edificio_id" name="edificio_id" {{ $des }}>
                    @foreach ($edificios as $edificio)
                        <option value="{{ $edificio->id }}" {{ old('edificio_id', $lugar->edificio_id) == $edificio->id ? 'selected' : '' }}>
                            {{ $edificio->nombreedificio }}
                        </option>
                    @endforeach
                </select>
                @error("edificio_id")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>
            
                  

            <div class="d-flex justify-content-center">
                @if($accion != 'D')
                    <button type="submit" class="btn btn-outline-primary">{{ $txtbtn }}</button>
                @endif
            </div>
        </form>
    </div>
</div>

</div>
@endsection
