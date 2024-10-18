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
                <h2 class="text-center">Registrando Puesto</h2>
                <form action="{{route('puestos.store')}}" method="POST">
            @elseif ($accion == 'E')
                <h2 class="text-center">Editando Puesto</h2>
                <form action="{{route('puestos.update', $puesto->id)}}" method="POST">
            @elseif ($accion == 'D')
                <h2 class="text-center">Eliminar Puesto</h2>
                <form action="{{route('puestos.destroy', $puesto)}}" method="POST">
                @method('DELETE')
            @endif

            @csrf

            <div class="mb-3">
                <label for="idpuesto" class="form-label">Id Puesto</label>
                <input type="text" class="form-control" id="idpuesto" name="idpuesto" value="{{old('idpuesto',$puesto->idpuesto)}}" {{$des}}>
                @error("idpuesto")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror 
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{old('nombre',$puesto->nombre)}}" {{$des}}>
                @error("nombre")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-control" id="tipo" name="tipo" {{$des}}>
                    <option value="" disabled {{ old('tipo', $puesto->tipo) == '' ? 'selected' : '' }}>Selecciona Tipo</option>
                    <option value="Administrativo" {{ old('tipo', $puesto->tipo) == 'Administrativo' ? 'selected' : '' }}>Administrativo</option>
                    <option value="Académico" {{ old('tipo', $puesto->tipo) == 'Académico' ? 'selected' : '' }}>Académico</option>
                    <option value="Directivo" {{ old('tipo', $puesto->tipo) == 'Directivo' ? 'selected' : '' }}>Directivo</option>
                </select>
                @error('tipo')
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">{{$txtbtn}}</button>
                <button type="reset" class="btn btn-secondary">Limpiar</button>
            </div>
        </form>
    </div>
</div>

@endsection
