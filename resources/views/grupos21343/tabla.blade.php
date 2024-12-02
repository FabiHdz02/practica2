@extends("menu2")

@section("contenido2")
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ route('grupos21343.create') }}" class="btn btn-outline-secondary">Registrar Grupo</a>
    </div>

    <div class="table-responsive-md">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">Grupo</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Máximo de Alumnos</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Periodo</th>
                    <th scope="col">Materia Abierta</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grupos as $grupo)
                <tr>
                    <td>{{ $grupo->grupo }}</td>
                    <td>{{ $grupo->descripcion }}</td>
                    <td>{{ $grupo->maxalumnos }}</td>
                    <td>{{ $grupo->fecha }}</td>
                    <td>{{ $grupo->periodo->periodo ?? 'Sin Asignar' }}</td> <!-- Relación con Periodo -->
                    <td>{{ $grupo->materiaAbierta->materia->nombremateria ?? 'Sin Asignar' }}</td> <!-- Relación con Materia Abierta -->
                    <td>
                        <a href="{{ route('grupos21343.edit', $grupo->id) }}" class="btn btn-outline-primary">Editar</a>
                        <form action="{{ route('grupos21343.destroy', $grupo->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                        </form>                        
                    </td>
                </tr>
                @endforeach
            </tbody>            
        </table>
        {{ $grupos->links() }}
    </div>
</div>
@endsection
