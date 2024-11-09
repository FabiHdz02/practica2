@extends("menu2")

@section("contenido2")

@if(session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif

<div class="container" style="max-width: 80%; margin: auto;">
    <div class="mb-3"><br>
        <a href="{{ route('personals.create') }}" class="btn btn-outline-secondary">Registrar Personal</a>
    </div>

    <div class="table-responsive-md">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">RFC</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido P</th>
                    <th scope="col">Apellido M</th>
                    <th scope="col">Licenciatura</th>
                    <th scope="col">Departamento</th>
                    <th scope="col">Puesto</th>
                    <th scope="col" colspan="3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($personales as $personal)
                <tr>
                    <td scope="row">{{ $personal->RFC }}</td>
                    <td>{{ $personal->nombres }}</td>
                    <td>{{ $personal->apellidop }}</td>
                    <td>{{ $personal->apellidom }}</td>
                    <td>{{ $personal->licenciatura }}</td>
                    <td>{{ $personal->depto->nombredepto }}</td>
                    <td>{{ $personal->puesto->nombre }}</td>
                    <td><a href="{{ route('personals.edit', $personal->id) }}" class="btn btn-outline-primary">Editar</a></td>
                    <td>
                        <form action="{{ route('personals.destroy', $personal->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                        </form>
                    </td>                       
                    <td><a href="{{ route('personals.show', $personal->id) }}" class="btn btn-outline-info">Ver</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $personales->links() }}
    </div>
</div>

@endsection
