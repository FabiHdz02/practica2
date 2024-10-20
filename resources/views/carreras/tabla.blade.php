@extends("menu2")

@section("contenido2")

@if(session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif

<div class="container" style="max-width: 80%; margin: auto;">
    <div class="mb-3"><br>
        <a href="{{ route('carreras.create') }}" class="btn btn-outline-secondary">Registrar Carrera</a>
    </div>

    <div class="table-responsive-md">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">Id Carrera</th>
                    <th scope="col">Nombre Completo</th>
                    <th scope="col">Nombre Mediano</th>
                    <th scope="col">Nombre Corto</th>
                    <th scope="col">Depto</th>
                    <th scope="col" colspan="3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($carreras as $carrera)
                <tr>
                    <td scope="row">{{ $carrera->idcarrera }}</td>
                    <td>{{ $carrera->nombrecarrera }}</td>
                    <td>{{ $carrera->nombremediano }}</td>
                    <td>{{ $carrera->nombrecorto }}</td>
                    <td>{{ $carrera->depto->nombredepto }}</td>
                    <td><a href="{{ route('carreras.edit', $carrera->id) }}" class="btn btn-outline-primary">Editar</a></td>
                    <td>
                        <form action="{{ route('carreras.destroy', $carrera->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                        </form>
                    </td>                       
                    <td><a href="{{ route('carreras.show', $carrera->id) }}" class="btn btn-outline-info">Ver</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $carreras->links() }}
    </div>
</div>

@endsection
