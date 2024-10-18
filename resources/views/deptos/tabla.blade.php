@if(session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif

<div class="mb-3">
    <a href="{{ route('departamentos.create') }}" class="btn btn-outline-secondary">Registrar Departamento</a>
</div>

<div class="table-responsive-md">
    <table class="table table-bordered table-striped table-hover">
        <thead class="table-light">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre Departamento</th>
                <th scope="col">Nombre Mediano</th>
                <th scope="col">Nombre Corto</th>
                <th scope="col" colspan="3">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($departamentos as $departamento)
            <tr>
                <td scope="row">{{ $departamento->iddepto }}</td>
                <td>{{ $departamento->nombredepto }}</td>
                <td>{{ $departamento->nombremediano }}</td>
                <td>{{ $departamento->nombrecorto }}</td>
                <td><a href="{{ route('departamentos.edit', $departamento->iddepto) }}" class="btn btn-outline-primary">Editar</a></td>
                <td><a href="{{ route('departamentos.show', $departamento->iddepto) }}" class="btn btn-outline-danger">Eliminar</a></td>
                <td><a href="{{ route('departamentos.show', $departamento->iddepto) }}" class="btn btn-outline-info">Ver</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $departamentos->links() }}
</div>
