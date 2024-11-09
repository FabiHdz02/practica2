@extends("menu2")

@section("contenido2")
    @if(session('mensaje'))
        <p>{{ session('mensaje') }}</p>
    @endif

    <div class="container mt-4">
        <div class="mb-3">
            <a href="{{ route('materias.create') }}" class="btn btn-outline-secondary">Registrar Materia</a>
        </div>

        <div class="table-responsive-md">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID Materia</th>
                        <th scope="col">Nombre de la Materia</th>
                        <th scope="col">Nivel</th>
                        <th scope="col">Nombre Corto</th>
                        <th scope="col">Modalidad</th>
                        <th scope="col">Retícula</th>
                        <th scope="col">Semestre</th>
                        <th scope="col" colspan="3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($materias as $materia)
                    <tr>
                        <td scope="row">{{ $materia->idmateria }}</td>
                        <td>{{ $materia->nombremateria }}</td>
                        <td>{{ $materia->nivel }}</td>
                        <td>{{ $materia->nombrecorto }}</td>
                        <td>{{ $materia->modalidad }}</td>
                        <td>{{ $materia->reticula->descripcion }}</td>
                        <td>{{ $materia->semestre }}</td>
                        <td><a href="{{ route('materias.edit', $materia->id) }}" class="btn btn-outline-primary">Editar</a></td>
                        <td>
                            <form action="{{ route('materias.destroy', $materia->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                        <td><a href="{{ route('materias.show', $materia->id) }}" class="btn btn-outline-info">Ver</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $materias->links() }}
        </div>
    </div>
@endsection
