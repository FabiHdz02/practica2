@extends("menu2")

@section("contenido2")
    @if(session('mensaje'))
        <p>{{ session('mensaje') }}</p>
    @endif 
    <div class="container mt-4">
    <div class="mb-3">
        <a href="{{ route('alumnos.create') }}" class="btn btn-outline-secondary">Registrar Alumno</a>
    </div>

        <div class="table-responsive-md">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No Control</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Apellido Paterno</th>
                        <th scope="col">Apellido Materno</th>
                        <th scope="col">Sexo</th>
                        <th scope="col">Carrera</th>
                        <th scope="col" colspan="3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($alumnos as $alumno)
                    <tr>
                        <td scope="row">{{ $alumno->noctrl }}</td>
                        <td>{{ $alumno->nombre }}</td>
                        <td>{{ $alumno->apellidop }}</td>
                        <td>{{ $alumno->apellidom }}</td>
                        <td>{{ $alumno->sexo }}</td>
                        <td>{{ $alumno->carrera->nombrecarrera }}</td>
                        <td><a href="{{ route('alumnos.edit', $alumno->id) }}" class="btn btn-outline-primary">Editar</a></td>
                        <td>
                            <form action="{{ route('alumnos.destroy', $alumno->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                        <td><a href="{{ route('alumnos.show', $alumno->id) }}" class="btn btn-outline-info">Ver</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $alumnos->links() }}
        </div>
    </div>
@endsection
