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
                <h2 class="text-center">Registrando Periodo</h2>
                <form action="{{ route('periodos.store') }}" method="POST">
            @elseif ($accion == 'E')
                <h2 class="text-center">Editando Periodo</h2>
                <form action="{{ route('periodos.update', $periodo->id) }}" method="POST">
                @csrf
                @method('PUT')
            @elseif ($accion == 'D')
                <h2 class="text-center">Eliminar Periodo</h2>
                <form action="{{ route('periodos.destroy', $periodo->id) }}" method="POST">
                @method('DELETE')
            @endif

            @csrf

            <div class="row mb-3">
                <label for="periodo" class="col-sm-4 col-form-label">Periodo:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="periodo" name="periodo" value="{{ old('periodo', $periodo->periodo) }}" {{$des}}>
                    @error("periodo")
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="desccorta" class="col-sm-4 col-form-label">Descripción Corta:</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" id="desccorta" name="desccorta" value="{{ old('desccorta', $periodo->desccorta) }}" {{$des}}>
                    @error("desccorta")
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="fechaini" class="col-sm-4 col-form-label">Fecha de Inicio:</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="fechaini" name="fechaini" value="{{ old('fechaini', $periodo->fechaini) }}" {{$des}}>
                    @error("fechaini")
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="fechafin" class="col-sm-4 col-form-label">Fecha de Fin:</label>
                <div class="col-sm-8">
                    <input type="date" class="form-control" id="fechafin" name="fechafin" value="{{ old('fechafin', $periodo->fechafin) }}" {{$des}}>
                    @error("fechafin")
                        <div class="text-danger">Error en: {{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="text-center">
                @if(!empty($txtbtn))
                    <button type="submit" class="btn btn-primary">{{$txtbtn}}</button>
                @endif
                <a href="{{ route('periodos.index') }}" class="btn btn-secondary">Regresar</a>
            </div>
        </form>
        </div>
    </div>
</div>

@endsection
