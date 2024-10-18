@extends("menu2")

@section("contenido2")

<div class="container text-center">
    <ul>
        @foreach ($errors->all() as $error)
            <li>
                {{ $error }}
            </li>
        @endforeach
    </ul>

    @if ($accion == 'C')
        <h2>Registrando Plaza</h2>
        <form action="{{ route('plazas.store') }}" method="POST">
    @elseif ($accion == 'E')
        <h2>Editando Plaza</h2>
        <form action="{{ route('plazas.update', $plaza->id) }}" method="POST">
    @elseif ($accion == 'D')
        <h2>Eliminar Plaza</h2>
        <form action="{{ route('plazas.destroy', $plaza->id) }}" method="POST">
    @endif

    @csrf
        <div class="mb-3">
            <label for="idplaza" class="form-label">ID Plaza:</label>
            <div class="mx-auto" style="max-width: 300px;">
                <input type="text" class="form-control" id="idplaza" name="idplaza" value="{{ old('idplaza', $plaza->idplaza) }}" {{$des}}>
            </div>
            @error("idplaza")
                <p class="text-danger">Error en: {{ $message }}</p>
            @enderror
        </div>

        <div class="mb-3">
            <label for="nombreplaza" class="form-label">Nombre Plaza:</label>
            <div class="mx-auto" style="max-width: 300px;">
                <input type="text" class="form-control" id="nombreplaza" name="nombreplaza" value="{{ old('nombreplaza', $plaza->nombreplaza) }}" {{$des}}>
            </div>
            @error("nombreplaza")
                <p class="text-danger">Error en: {{ $message }}</p>
            @enderror 
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary">{{$txtbtn}}</button>
            <button type="reset" class="btn btn-secondary">Limpiar</button>
        </div>
    </form>
</div>

@endsection

