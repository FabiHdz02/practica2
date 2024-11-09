@if(session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif

<div class="table-responsive-md">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="mb-3"><br>
                <a href="{{ route('lugares.create') }}" class="btn btn-outline-secondary">Registrar Lugar</a>
            </div>

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre Lugar</th>
                        <th scope="col">Nombre Corto</th>
                        <th scope="col">Edificio</th>
                        <th scope="col" colspan="3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lugares as $lugar)
                    <tr>
                        <td scope="row">{{ $lugar->id }}</td>
                        <td>{{ $lugar->nombrelugar }}</td>
                        <td>{{ $lugar->nombrecorto }}</td>
                        <td>{{ $lugar->edificio->nombreedificio }}</td>
                        <td><a href="{{ route('lugares.edit', $lugar->id) }}" class="btn btn-outline-primary">Editar</a></td>
                        <td>
                            <form action="{{ route('lugares.destroy', $lugar->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>                
                        <td><a href="{{ route('lugares.show', $lugar->id) }}" class="btn btn-outline-info">Ver</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $lugares->links() }}
        </div>
    </div>
</div>
