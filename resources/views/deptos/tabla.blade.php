@if(session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif

<div class="table-responsive-md">
    <div class="row justify-content-center">
        <div class="col-md-9">
<div class="mb-3"><br>
    <a href="{{ route('deptos.create') }}" class="btn btn-outline-secondary">Registrar Departamento</a>
</div>

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
                    @foreach ($deptos as $depto)
                    <tr>
                        <td scope="row">{{ $depto->iddepto }}</td>
                        <td>{{ $depto->nombredepto }}</td>
                        <td>{{ $depto->nombremediano }}</td>
                        <td>{{ $depto->nombrecorto }}</td>
                        <td><a href="{{ route('deptos.edit', $depto->id) }}" class="btn btn-outline-primary">Editar</a></td>
                        <td>
                            <form action="{{ route('deptos.destroy', $depto->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>                
                        <td><a href="{{ route('deptos.show', $depto->id) }}" class="btn btn-outline-info">Ver</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $deptos->links() }}
        </div>
    </div>
</div>
