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
                <select class="form-control" id="nombre" name="nombre" {{$des}}>
                    <option value="">Seleccione un puesto</option>
                    <option value="Docente" {{ old('nombre', $puesto->nombre) == 'Docente' ? 'selected' : '' }}>Docente</option>
                    <option value="No docente" {{ old('nombre', $puesto->nombre) == 'No docente' ? 'selected' : '' }}>No docente</option>
                    <option value="Director" {{ old('nombre', $puesto->nombre) == 'Director' ? 'selected' : '' }}>Director</option>
                    <option value="Subdirector académico" {{ old('nombre', $puesto->nombre) == 'Subdirector académico' ? 'selected' : '' }}>Subdirector académico</option>
                    <option value="Subdirector de plantación" {{ old('nombre', $puesto->nombre) == 'Subdirector de plantación' ? 'selected' : '' }}>Subdirector de plantación</option>
                    <option value="Auxiliar de laboratorio" {{ old('nombre', $puesto->nombre) == 'Auxiliar de laboratorio' ? 'selected' : '' }}>Auxiliar de laboratorio</option>
                    <option value="Auxiliar de biblioteca" {{ old('nombre', $puesto->nombre) == 'Auxiliar de biblioteca' ? 'selected' : '' }}>Auxiliar de biblioteca</option>
                    <option value="Auxiliar de taller" {{ old('nombre', $puesto->nombre) == 'Auxiliar de taller' ? 'selected' : '' }}>Auxiliar de taller</option>
                    <option value="Jefe de recursos humanos" {{ old('nombre', $puesto->nombre) == 'Jefe de recursos humanos' ? 'selected' : '' }}>Jefe de recursos humanos</option>
                    <option value="Jefe académico" {{ old('nombre', $puesto->nombre) == 'Jefe académico' ? 'selected' : '' }}>Jefe académico</option>
                    <option value="Jefe división de estudiosos" {{ old('nombre', $puesto->nombre) == 'Jefe división de estudiosos' ? 'selected' : '' }}>Jefe división de estudiosos</option>
                </select>
                @error("nombre")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>            

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select class="form-control" id="tipo" name="tipo" {{$des}}>
                    <option value="" disabled {{ old('tipo', $puesto->tipo) == '' ? 'selected' : '' }}>Selecciona Tipo</option>
                    <option value="Docente" {{ old('tipo', $puesto->tipo) == 'Docente' ? 'selected' : '' }}>Docente</option>
                    <option value="Direccion" {{ old('tipo', $puesto->tipo) == 'Direccion' ? 'selected' : '' }}>Direccion</option>
                    <option value="Auxiliar" {{ old('tipo', $puesto->tipo) == 'Auxiliar' ? 'selected' : '' }}>Auxiliar</option>
                    <option value="Administrativo" {{ old('tipo', $puesto->tipo) == 'Administrativo' ? 'selected' : '' }}>Administrativo</option>
                </select>
                @error('tipo')
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="text-center">
                @if(!empty($txtbtn))
                    <button type="submit" class="btn btn-primary">{{$txtbtn}}</button>
                @endif
                <a href="{{ route('puestos.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
    </div>
</div>

@endsection
