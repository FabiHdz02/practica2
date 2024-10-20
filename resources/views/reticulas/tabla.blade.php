@extends("menu2")

@section("contenido2")
    @if(session('mensaje'))
        <p>{{ session('mensaje') }}</p>
    @endif

    <div class="container mt-4">
        <div class="mb-3">
            <a href="{{ route('reticulas.create') }}" class="btn btn-outline-secondary">Registrar Retícula</a>
        </div>

        <div class="table-responsive-md">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID Retícula</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Fecha de Vigencia</th>
                        <th scope="col">Carrera</th>
                        <th scope="col" colspan="3">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reticulas as $reticula)
                    <tr>
                        <td scope="row">{{ $reticula->idreticula }}</td>
                        <td>{{ $reticula->descripcion }}</td>
                        <td>{{ $reticula->fechavigor }}</td>
                        <td>{{ $reticula->carrera->nombrecarrera }}</td>
                        <td><a href="{{ route('reticulas.edit', $reticula->id) }}" class="btn btn-outline-primary">Editar</a></td>
                        <td>
                            <form action="{{ route('reticulas.destroy', $reticula->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                            </form>
                        </td>
                        <td><a href="{{ route('reticulas.show', $reticula->id) }}" class="btn btn-outline-info">Ver</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $reticulas->links() }}
        </div>
    </div>
@endsection
