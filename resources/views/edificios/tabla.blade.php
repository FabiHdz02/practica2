@if(session('mensaje'))
    <p>{{ session('mensaje') }}</p>
@endif

<div class="table-responsive-md">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="mb-3"><br>
                <a href="{{ route('edificios.create') }}" class="btn btn-outline-secondary">Registrar Edificio</a>
            </div>

            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre Edificio</th>
                        <th scope="col">Nombre Corto</th>
                        <th scope="col" colspan="3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($edificios as $edificio)
                    <tr>
                        <td scope="row">{{ $edificio->id }}</td>
                        <td>{{ $edificio->nombreedificio }}</td>
                        <td>{{ $edificio->nombrecorto }}</td>
                        <td><a href="{{ route('edificios.edit', $edificio->id) }}" class="btn btn-outline-primary">Editar</a></td>
                        <td>
                            <form action="{{ route('edificios.destroy', $edificio->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>                
                        <td><a href="{{ route('edificios.show', $edificio->id) }}" class="btn btn-outline-info">Ver</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $edificios->links() }}
        </div>
    </div>
</div>
