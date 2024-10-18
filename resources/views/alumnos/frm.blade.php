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
                <h2 class="text-center">Registrando Alumno</h2>
                <form action="{{route('alumnos.store')}}" method="POST">
            @elseif ($accion == 'E')
                <h2 class="text-center">Editando Alumno</h2>
                <form action="{{route('alumnos.update', $alumno->id)}}" method="POST">
            @elseif ($accion == 'D')
                <h2 class="text-center">Eliminar Alumno</h2>
                <form action="{{route('alumnos.destroy', $alumno)}}" method="POST">
                @method('DELETE')
            @endif

            @csrf

            <div class="mb-3">
                <label for="noctrl" class="form-label">No Control</label>
                <input type="text" class="form-control" id="noctrl" name="noctrl" value="{{old('noctrl',$alumno->noctrl)}}" {{$des}}>
                @error("noctrl")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror 
            </div>

            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" value="{{old('nombre',$alumno->nombre)}}" {{$des}}>
                @error("nombre")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="apellidop" class="form-label">Apellido Paterno</label>
                <input type="text" class="form-control" id="apellidop" name="apellidop" value="{{old('apellidop',$alumno->apellidop)}}" {{$des}}>
                @error("apellidop")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror 
            </div>

            <div class="mb-3">
                <label for="apellidom" class="form-label">Apellido Materno</label>
                <input type="text" class="form-control" id="apellidom" name="apellidom" value="{{old('apellidom',$alumno->apellidom)}}" {{$des}}>
                @error("apellidom")
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror 
            </div>

            <div class="mb-3">
                <label for="sexo" class="form-label">Sexo</label>
                <select class="form-control" id="sexo" name="sexo" {{$des}}>
                    <option value="" disabled {{ old('sexo', $alumno->sexo) == '' ? 'selected' : '' }}>Selecciona sexo</option>
                    <option value="M" {{ old('sexo', $alumno->sexo) == 'M' ? 'selected' : '' }}>M</option>
                    <option value="F" {{ old('sexo', $alumno->sexo) == 'F' ? 'selected' : '' }}>F</option>
                </select>
                @error('sexo')
                    <p class="text-danger">Error en: {{ $message }}</p>
                @enderror
            </div>

            <div class="mb-3">
                <label for="carrera_id" class="form-label">Carrera</label>
                <select class="form-control" id="carrera_id" name="carrera_id" {{$des}}>
                    <option value="">Selecciona una carrera</option>
                    @foreach ($carreras as $carrera)
                        <option value="{{ $carrera->id }}" {{ old('carrera_id', $alumno->carrera_id) == $carrera->id ? 'selected' : '' }}>
                            {{ $carrera->nombrecarrera }}
                        </option>
                    @endforeach
                </select>
                @error('carrera_id')
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
