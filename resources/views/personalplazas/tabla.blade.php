@extends("menu2")

@section("contenido2")

@if(session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif

<div class="container" style="max-width: 80%; margin: auto;">
    <div class="mb-3"><br>
        <a href="{{ route('personalplazas.create') }}" class="btn btn-outline-secondary">Registrar Personal</a>
    </div>

    <div class="table-responsive-md">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">Nombramiento</th>
                    <th scope="col">Plaza</th>
                    <th scope="col">Personal</th>
                    <th scope="col" colspan="3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personalPlazas as $pe)
                <tr>
                    <td>{{ $pe->tiponombramiento }}</td>
                    <td>{{ $pe->plaza->idplaza }}</td>
                    <td>{{ $pe->personal ? $pe->personal->nombres . ' ' . $pe->personal->apellidop . ' ' . $pe->personal->apellidom : 'N/A' }}</td>
                    <td><a href="{{ route('personalplazas.edit', $pe->id) }}" class="btn btn-outline-primary">Editar</a></td>
                    <td>
                        <form action="{{ route('personalplazas.destroy', $pe->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                        </form>
                    </td>                       
                    <td><a href="{{ route('personalplazas.show', $pe->id) }}" class="btn btn-outline-info">Ver</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $personalPlazas->links() }}
    </div>
</div>

@endsection
