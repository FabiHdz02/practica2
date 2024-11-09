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
                <h2 class="text-center">Registrando Edificio</h2>
                <form action="{{ route('edificios.store') }}" method="POST">
            @elseif ($accion == 'E')
                <h2 class="text-center">Editando Edificio</h2>
                <form action="{{ route('edificios.update', $edificio->id) }}" method="POST">
                @csrf
                @method('PUT')
            @elseif ($accion == 'D')
                <h2 class="text-center">Eliminar Edificio</h2>
                <form action="{{ route('edificios.destroy', $edificio->id) }}" method="POST">
                @method('DELETE')
            @endif

            @csrf
            
            <div class="row mb-3">
                <label for="nombreedificio" class="col-sm-4 col-form-label">Nombre Edificio:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nombreedificio" name="nombreedificio" value="{{ old('nombreedificio', $edificio->nombreedificio) }}" {{$des}}>
                    @error("nombreedificio")
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="nombrecorto" class="col-sm-4 col-form-label">Nombre Corto:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nombrecorto" name="nombrecorto" value="{{ old('nombrecorto', $edificio->nombrecorto) }}" {{$des}}>
                    @error("nombrecorto")
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                @if(!empty($txtbtn))
                    <button type="submit" class="btn btn-primary">{{$txtbtn}}</button>
                @endif
                <a href="{{ route('edificios.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
