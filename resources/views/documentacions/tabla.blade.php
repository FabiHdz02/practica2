@extends("menu2")

@section("contenido2")
    @if(session('mensaje'))
        <div class="alert alert-info text-center">
            {{ session('mensaje') }}
        </div>
    @endif

    <div class="container mt-4">
        <div class="mb-3">
            <a href="{{ route('documentacions.create') }}" class="btn btn-outline-secondary">Registrar Documentación</a>
        </div>

        <div class="table-responsive-md">
            <table class="table table-bordered table-striped table-hover">
                <thead class="table-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">CURP</th>
                        <th scope="col">Certificado</th>
                        <th scope="col">Comprobante de Domicilio</th>
                        <th scope="col">Acta de Nacimiento</th>
                        <th scope="col">Tipo de Inscripción</th>
                        <th scope="col">Alumno</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($documentacions as $documentacion)
                    <tr>
                        <td scope="row">{{ $documentacion->id }}</td>
                        <td>
                            <span class="d-inline-block text-truncate" style="max-width: 150px;" title="{{ $documentacion->curp }}">
                                {{ $documentacion->curp }}
                            </span>
                        </td>
                        <td>
                            <span class="d-inline-block text-truncate" style="max-width: 150px;" title="{{ $documentacion->certificado }}">
                                {{ $documentacion->certificado }}
                            </span>
                        </td>
                        <td>
                            <span class="d-inline-block text-truncate" style="max-width: 150px;" title="{{ $documentacion->cdomi }}">
                                {{ $documentacion->cdomi }}
                            </span>
                        </td>
                        <td>
                            <span class="d-inline-block text-truncate" style="max-width: 150px;" title="{{ $documentacion->actanac }}">
                                {{ $documentacion->actanac }}
                            </span>
                        </td>
                        <td>{{ $documentacion->tipoinsc->tipo ?? 'Sin asignar' }}</td>
                        <td>{{ $documentacion->alumno->nombre ?? 'Sin asignar' }}</td>
                        <td>
                            <a href="{{ route('documentacions.edit', $documentacion->id) }}" class="btn btn-outline-primary btn-sm">Editar</a>
                        </td>
                        <td>
                            <form action="{{ route('documentacions.destroy', $documentacion->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                        <td>
                            <a href="{{ route('documentacions.show', $documentacion->id) }}" class="btn btn-outline-info btn-sm">Ver</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $documentacions->links() }} <!-- Para la paginación -->
        </div>
    </div>
@endsection
