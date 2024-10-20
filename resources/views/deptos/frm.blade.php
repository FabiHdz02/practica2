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
                <h2 class="text-center">Registrando Departamento</h2>
                <form action="{{ route('deptos.store') }}" method="POST">
            @elseif ($accion == 'E')
                <h2 class="text-center">Editando Departamento</h2>
                <form action="{{ route('deptos.update', $depto->id) }}" method="POST">
                @csrf
                @method('PUT')
            @elseif ($accion == 'D')
                <h2 class="text-center">Eliminar Departamento</h2>
                <form action="{{ route('deptos.destroy', $depto->id) }}" method="POST">
                @method('DELETE')
            @endif

            @csrf

            <div class="row mb-3">
                <label for="iddepto" class="col-sm-4 col-form-label">ID Departamento:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="iddepto" name="iddepto" value="{{ old('iddepto', $depto->iddepto) }}" {{$des}}>
                    @error("iddepto")
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="nombredepto" class="col-sm-4 col-form-label">Nombre Departamento:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nombredepto" name="nombredepto" value="{{ old('nombredepto', $depto->nombredepto) }}" {{$des}}>
                    @error("nombredepto")
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="nombremediano" class="col-sm-4 col-form-label">Nombre Mediano:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nombremediano" name="nombremediano" value="{{ old('nombremediano', $depto->nombremediano) }}" {{$des}}>
                    @error("nombremediano")
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="nombrecorto" class="col-sm-4 col-form-label">Nombre Corto:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="nombrecorto" name="nombrecorto" value="{{ old('nombrecorto', $depto->nombrecorto) }}" {{$des}}>
                    @error("nombrecorto")
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                @if(!empty($txtbtn))
                    <button type="submit" class="btn btn-primary">{{$txtbtn}}</button>
                @endif
                <a href="{{ route('deptos.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
