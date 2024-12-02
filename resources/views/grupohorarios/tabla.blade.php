@extends("menu2")

@section("contenido2")
<div class="container mt-4">
    <div class="mb-3">
        <a href="{{ route('grupohorarios.create') }}" class="btn btn-outline-secondary">Registrar Horario</a>
    </div>

    <div class="table-responsive-md">
        <table class="table table-bordered table-striped table-hover">
            <thead class="table-light">
                <tr>
                    <th scope="col">Grupo</th>
                    <th scope="col">Lugar</th>
                    <th scope="col">Día</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($grupoHorarios as $horario)
                <tr>
                    <td>{{ $horario->grupo?->grupo }}</td>
                    <td>{{ $horario->lugar->nombrelugar }}</td>
                    <td>{{ $horario->dia }}</td>
                    <td>{{ $horario->hora }}</td>
                    <td>
                        <a href="{{ route('grupohorarios.edit', $horario->id) }}" class="btn btn-outline-primary">Editar</a>
                        <form action="{{ route('grupohorarios.destroy', $horario->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        {{ $grupoHorarios->links() }}
    </div>
</div>
@endsection
